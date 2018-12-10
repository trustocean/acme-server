<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Base64Url\Base64Url;
use Symfony\Component\HttpKernel\Exception\HttpException;

abstract class AcmeBaseRequest extends FormRequest
{
    /**
     * 因为 ACME 协议的请求都走了 base64url_encode, 此处解码出来
     *
     * {@inheritDoc}
     */
    protected function prepareForValidation()
    {
        $protected = $this->input('protected');
        if (!$protected) {
            throw new HttpException(412, 'protected is required, and must be base64url encoded!');
        }
        $payload = $this->input('payload');
        if (!$payload) {
            throw new HttpException(412, 'payload is required, and must be base64url encoded!');
        }

        $protected = Base64Url::decode($protected);
        $payload = Base64Url::decode($payload);

        $merge = [];
        $merge['protected'] = $protected;
        $merge['payload'] = $payload;

        $this->merge($merge);
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
            'protected.nonce' => 'required|string',
            'protected.url' => 'required|string',
            'payload' => 'required',
            'signature' => 'required|string',
        ])->merge($this->acmeRules())->toArray();
    }
}
