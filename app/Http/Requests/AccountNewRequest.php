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
            //'protected.jwk' => 'required|array',
            //'payload.termsOfServiceAgreed' => 'required|accepted',
            'payload.contact' => 'array',
        ];
    }
}
