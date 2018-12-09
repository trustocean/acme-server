<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class AcmeBaseRequest extends FormRequest
{
    /**
     * 因为 ACME 协议的请求都走了 base64url_encode, 此处解码出来
     * {@inheritDoc}
     */
    protected function prepareForValidation()
    {
        // TODO: maybe base64 is not base64url
        $protected = base64_decode($this->input('protected'));
        $payload = base64_decode($this->input('payload'));

        $merge = [];
        $merge['protected'] = $protected;
        $merge['payload'] = $payload;

        $this->merge($merge);
    }

    /**
     * {@inheritDoc}
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 基于 AcmeBaseRequest::rules 增加额外的验证
     *
     * @return array
     */
    abstract protected function acmeRules();

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return collect([
            'protected' => 'required',
            'protected.alg' => 'required|string',
            'protected.jwk' => 'required|array',
            'protected.nonce' => 'required|string',
            'protected.url' => 'required|string',
            'payload' => 'required',
            'signature' => 'required|string',
        ])->merge($this->acmeRules())->toArray();
    }
}
