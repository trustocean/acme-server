<?php

namespace App\Http;

use Illuminate\Http\Request as BaseRequest;

class Request extends BaseRequest
{
    /**
     * {@inheritDoc}
     */
    public function ajax()
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function expectsJson()
    {
        return true;
    }
}
