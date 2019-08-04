<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Str;
use App\Models\Order;
use Londry\TrustOceanSSL\definition\CertificateType;
use Londry\TrustOceanSSL\definition\CertificatePeriod;
use Londry\TrustOceanSSL\model\Csr;

class SubmitOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Order|null
     */
    protected $order;

    /**
     * 免费版 TrustOcean Encryption365 SSL
     *
     * @var integer
     */
    protected $type = CertificateType::TrustOceanEncryption365Ssl;

    /**
     * 期限3个月
     *
     * @var int
     */
    protected $period = CertificatePeriod::ThreeMonths;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ca = trustocean();
        $ca->setCertificateType($this->type);
        $ca->setCertificatePeriod($this->period);
        $ca->setContactEmail(config('trustocean.username'));
        $ca->setUniqueId(Str::random());
        $ca->setRenew(true);
        $ca->setDomains(collect($this->order->identifiers)->pluck('value')->toArray());
        $ca->setDcvMethod(collect($this->order->identifiers)->map(function ($identifier) {
            return collect(explode('-', $this->order->challenge_type))->first();
        })->toArray());
        $ca->setCsrCode(new Csr($this->order->csr));
        $submit = $ca->callInit()->callCreate();

        $this->order->fill([
            'add_ssl_order_response' => [
                'dcv_info'      =>  $submit->getDcvInfo(),
                'order_status'  =>  $submit->getOrderStatus(),
                'order_id'      =>  $submit->getOrderId(),
                'created_at'    =>  $submit->getCreatedAt()
            ],
            'ca_order_id'      =>   $submit->getOrderId(),
        ]);
        $this->order->save();
    }
}
