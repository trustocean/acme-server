<?php

namespace App\Http\Requests;

class AccountDetailRequest extends AcmeBaseRequest
{
    /**
     * {@inheritDoc}
     */
    protected function acmeRules()
    {
        return [
            'protected.kid' => 'required|url',
        ];
    }
}
