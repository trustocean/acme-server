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
            'payload' => 'required',
            'payload.termsOfServiceAgreed' => 'required|bool|in:true',
            'payload.contact' => 'array',
        ];
    }
}
