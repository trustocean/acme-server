<?php
namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class OrderNewResponse extends JsonResponse
{
    /**
     * 下单响应
     *
     * @param \App\Models\Order $data
     * @param int $status
     * @param array $headers
     * @param integer $options
     */
    public function __construct($data = null, $status = JsonResponse::HTTP_CREATED, $headers = [], $options = 0)
    {
        $response = [
            "status" => "pending",
            "expires" => now()->addWeek()->format('Y-m-d\TH:i:s.u\Z'),
            "identifiers" => $data->identifiers,
            "authorizations" => $data->authorizations,
            "finalize" => $data->finalize,
        ];

        parent::__construct($response, $status, $headers, $options);
        $this->withHeaders(['Location' => route('acme.account.order_detail', data_get($data, 'id') ?? -1)]);
    }
}
