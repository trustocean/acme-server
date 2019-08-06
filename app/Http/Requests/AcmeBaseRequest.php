<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Base64Url\Base64Url;

abstract class AcmeBaseRequest extends FormRequest
{
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
            'payload' => 'array',
            'signature' => 'required|string',
        ])->merge($this->acmeRules())->toArray();
    }
}
