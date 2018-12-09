<?php

namespace App\Http\Requests;

class AccountNewRequest extends AcmeBaseRequest
{
    /**
     * {@inheritDoc}
     */
    protected function acmeRules()
    {
        return [
            'protected.jwk' => 'required|array',
            'payload' => 'required',
            'payload.termsOfServiceAgreed' => 'required|bool|in:true',
            'payload.contact' => 'array',
        ];
    }
}
