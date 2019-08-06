<?php

namespace App\Http\Middleware;

use Closure;
use Base64Url\Base64Url;

/**
 * 还原ACME请求的protected和payload参数
 */
class AcmeDecode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $protected = $request->input('protected', '');
        $payload = $request->input('payload', '');

        $protected = json_decode(Base64Url::decode($protected), true);
        $payload = json_decode(Base64Url::decode($payload), true);

        $merge = [];
        $merge['protected'] = $protected;
        $merge['payload'] = $payload;

        $request->merge($merge);

        $response = $next($request);

        return $response;
    }
}
