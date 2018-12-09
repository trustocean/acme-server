<?php
namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class AccountNewResponse extends JsonResponse
{
    public function __construct($data = null, $status = JsonResponse::HTTP_CREATED, $headers = [], $options = 0)
    {
        $response = [
            "status" => "valid",
            "contact" => collect(data_get($data, 'emails'))->map(function ($email) {
                return 'mailto:' . $email;
            }),
        ];

        parent::__construct($response, $status, $headers, $options);
        $this->withHeaders(['Location' => route('acme.account.detail', data_get($data, 'id') ?? -1)]);
    }
}
