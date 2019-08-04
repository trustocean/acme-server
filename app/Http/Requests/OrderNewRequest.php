<?php

namespace App\Http\Requests;

class OrderNewRequest extends AcmeBaseRequest
{
    /**
     * {@inheritDoc}
     */
    protected function acmeRules()
    {
        return [
            'protected.kid' => 'required|string',
            'payload.identifiers' => 'required|array',
            'payload.identifiers.*.type' => 'required|string|in:http,dns', // challenge type
            'payload.identifiers.*.value' => 'required|string', // domain
            'payload.csr' => 'required|string', // finalize 才提供
            'payload.challenge_type' => 'required|string|in:http-01,dns-01', // finalize 才提供
            'payload.notBefore' => 'nullable|string', // 反正trustocean不支持，没什么暖用
            'payload.notAfter' => 'nullable|string', // 反正trustocean不支持，没什么暖用
        ];
    }
}
