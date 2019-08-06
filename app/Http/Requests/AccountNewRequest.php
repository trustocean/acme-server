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
            'protected.jwk.e' => 'required|string',
            'protected.jwk.n' => 'required|string',
            'protected.jwk.kty' => 'required|string|in:RSA,ECSDA',
            //'payload.termsOfServiceAgreed' => 'required|accepted',
            'payload.contact' => 'array',
        ];
    }
}
