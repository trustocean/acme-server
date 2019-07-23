<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class SlashReplace
{
    /**
     * 替换斜杠
     *
     * @param Request $request
     * @param \Closure $next
     * @return Response
     */
    public function handle(Request $request, $next)
    {
        /**
         * @var \Illuminate\Http\JsonResponse $response
         */
        $response = $next($request);
        $response->setContent(str_replace('\/', '/', $response->getContent()));
        return $response;
    }
}
