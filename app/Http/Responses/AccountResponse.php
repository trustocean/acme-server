<?php
namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use App\Models\User;

class AccountResponse extends JsonResponse
{
    public function __construct(User $data = null, $status = JsonResponse::HTTP_CREATED, $headers = [], $options = 0)
    {
        $response = [
            "status" => "valid",
            "contact" => 'mailto:' . $data->email,
        ];

        parent::__construct($response, $status, $headers, $options);
        $this->withHeaders(['Location' => route('acme.account.detail', $data->id ?? -1)]);
    }
}
