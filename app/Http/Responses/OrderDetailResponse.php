<?php
namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class OrderDetailResponse extends JsonResponse
{
    /**
     * 订单详情响应
     *
     * @param \App\Models\Order $data
     * @param int $status
     * @param array $headers
     * @param integer $options
     */
    public function __construct($data = null, $status = JsonResponse::HTTP_CREATED, $headers = [], $options = 0)
    {
        $response = [
            "status" => collect($data->get_ssl_details_response)->count() ? 'valid' : "pending",
            "expires" => now()->addWeek()->format('Y-m-d\TH:i:s.u\Z'),
            'notBefore' => now()->format('Y-m-d\TH:i:s\Z'),
            'notAfter' => now()->addYear()->format('Y-m-d\TH:i:s\Z'),
            "identifiers" => $data->identifiers,
            "authorizations" => $data->authorizations,
            "finalize" => $data->finalize,
            'certificate' => collect($data->get_ssl_details_response)->count() ? route('acme.order.retrive_cert', $data->id) : null,
        ];

        parent::__construct($response, $status, $headers, $options);
    }
}
