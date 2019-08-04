<?php

if (!function_exists('trustocean')) {
    function trustocean()
    {
        return new \Londry\TrustOceanSSL\api\SslOrder(config('trustocean.username'), config('trustocean.password'));
    }
}

if (!function_exists('restore_csr')) {
    function restore_csr($string)
    {
        $encoder = app(\AcmePhp\Core\Http\Base64SafeEncoder::class);
        $string = $encoder->decode($string);
        $list = collect(str_split(base64_encode($string), 64));
        $list->prepend('-----BEGIN CERTIFICATE REQUEST-----');
        $list->push('-----END CERTIFICATE REQUEST-----');
        return $list->implode(PHP_EOL);
    }
}
