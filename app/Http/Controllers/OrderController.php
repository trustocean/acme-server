<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\OrderNewRequest;
use App\Http\Responses\OrderNewResponse;
use App\Jobs\SubmitOrderJob;
use App\Http\Requests\OrderFinalizeRequest;
use App\Http\Responses\OrderDetailResponse;
use Illuminate\Support\Facades\Cache;
use Londry\TrustOceanSSL\TrustoceanException;
use Illuminate\Http\Request;
use Symfony\Polyfill\Intl\Idn\Idn;

class OrderController extends Controller
{
    public function create(OrderNewRequest $request)
    {
        $order = new Order();
        $order->fill([
            'identifiers' => $request->input('payload.identifiers'),
            'csr' => restore_csr($request->input('payload.csr')),
            'challenge_type' => $request->input('payload.challenge_type'),
        ]);
        $order->save();

        // 将 $order 提交给 trustocean. 但是, 在finalize 时候才提交 csr
        dispatch(new SubmitOrderJob($order));

        return new OrderNewResponse($order);
    }

    public function detail($order_id)
    {
        /**
         * @var \App\Models\Order $order
         */
        $order = Order::findOrFail($order_id);

        return new OrderDetailResponse($order);
    }

    public function authzDetail($order_id, $domain)
    {
        /**
         * @var \App\Models\Order $order
         */
        $order = Order::findOrFail($order_id);

        $domain_dcv = [];
        $dcv_info = data_get($order->add_ssl_order_response, 'dcv_info', []);
        foreach ($dcv_info as $key => $info) {
            if (strtolower(trim($key)) == Idn::idn_to_ascii(strtolower(trim($domain)), 0, 1)) {
                $domain_dcv = $info;
                break;
            }
        }

        return response()->json([
            'status' => 'pending',
            'expires' => $order->created_at->addWeek(),
            'identifier' => collect($order->identifiers)->where('value', $domain)->first(),
            'challenges' => [
                $order->challenge_type == 'http-01' ? [
                    'status' => 'pending',
                    'type' => 'http-01',
                    'url' => route('acme.account.authz_submit', [$order_id, $domain]),
                    'path' => '/.well-known/pki-validation/',
                    'token' => data_get($domain_dcv, 'http_filename'),
                    'filecontent' => data_get($domain_dcv, 'http_filecontent'),
                        'verifyurl' => data_get($domain_dcv, 'http_verifylink'),
                ]
                :
                [
                    'status' => 'pending',
                    'type' => 'dns-01',
                    'url' => route('acme.account.authz_submit', [$order_id, $domain]),
                    'path' => data_get($domain_dcv, 'dns_type'),
                    'token' => data_get($domain_dcv, 'dns_host'),
                    'filecontent' => data_get($domain_dcv, 'dns_value'),
                    'verifyurl' => data_get($domain_dcv, 'http_verifylink'),
                ]
            ],
        ]);
    }

    public function authzSubmit($order_id, $domain)
    {
        /**
         * @var \App\Models\Order $order
         */
        $order = Order::findOrFail($order_id);

        $domain_dcv = [];
        $dcv_info = data_get($order->add_ssl_order_response, 'dcv_info', []);
        foreach ($dcv_info as $key => $info) {
            if (trim($key) == trim($domain)) {
                $domain_dcv = $info;
                break;
            }
        }

        $domain_count = Cache::increment(__METHOD__ . '_DOMAIN_COUNT');
        if ($domain_count >= collect($order->identifiers)->count() || true) {
            try {
                if (!Cache::has('call-order-dcv:' . $order_id)) {
                    trustocean()->callInit($order->ca_order_id)->callRetryDcvProcess();
                    Cache::put('call-order-dcv:' . $order_id, 1, 5);
                }
            } catch (TrustoceanException $e) {
            }
            //$status = trustocean()->callInit($order->ca_order_id)->callGetDcvDetails();
            //$status = trustocean()->callInit($order->ca_order_id)->callGetDcvDetails();
            //$dcv_status = data_get(collect($status->getDcvInfo())->where('domain', $domain)->first(), 'status', 'invalid');
            //$order_status = $status->getOrderStatus();
            //$status_map = [
            //    'Processing' => 'pending',
            //    'needverification' => 'pending',
            //    'success' => 'valid',
            //    'Success' => 'valid',
            //    'Valid' => 'valid',
            //    'issued_active' => 'valid',
            //];
            //$status = data_get($status_map, $order_status, 'pending');

            $status = 'pending';
            if (trim(data_get($order->get_ssl_details_response, 'cert'))) {
                $status = 'valid';
            }
        } else {
            $status = 'valid';
        }

        return response()->json([
            'status' => $status,
            'type' => 'http-01',
            'url' => route('acme.account.authz_submit', [$order_id, $domain]),
            'token' => data_get($domain_dcv, 'http_filename'),
            'filecontent' => data_get($domain_dcv, 'http_filecontent'),
            'verifyurl' => data_get($domain_dcv, 'http_verifylink'),
        ]);
    }

    public function authzFinalize($order_id, OrderFinalizeRequest $orderFinalizeRequest)
    {
        /**
         * @var \App\Models\Order $order
         */
        $order = Order::findOrFail($order_id);

        return new OrderDetailResponse($order);
    }

    public function retriveCert($order_id)
    {
        /**
         * @var \App\Models\Order $order
         */
        $order = Order::findOrFail($order_id);
        return response(collect([
            $order->get_ssl_details_response['cert'],
            $order->get_ssl_details_response['ca'],
        ])->implode(PHP_EOL))->withHeaders([
            'Content-Type' => 'application/pem-certificate-chain'
        ]);
    }

    public function issuePush(Request $request)
    {
        $trustocean_id = $request->input('trustocean_id');
        $status = $request->input('status');

        if (!$trustocean_id) {
            abort(412, 'trustocean_id is required');
        }

        if ($status == 'issued_active') {
            /**
             * @var \App\Models\Order $order
             */
            $order = Order::where('ca_order_id', $trustocean_id)->firstOrFail();

            $cert = $request->input('cert_code');
            $ca = $request->input('ca_code');

            $order->fill([
                'get_ssl_details_response' => collect($order->get_ssl_details_response)->merge([
                    'cert' => $cert,
                    'ca' => $ca,
                ]),
            ]);

            $order->save();
        }

        return response()->json([
            'success' => true,
        ]);
    }
}
