<?php

namespace App\Http\Middleware;

use Closure;
use AcmePhp\Ssl\Signer\DataSigner;
use AcmePhp\Core\Http\Base64SafeEncoder;
use Illuminate\Support\Arr;
use AcmePhp\Ssl\PublicKey;
use App\Models\User;
use CoderCat\JWKToPEM\JWKConverter;

class Authenticate
{
    /**
     * 检验当前请求是否满足 ACME 的签名
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function handle($request, Closure $next)
    {
        /**
         * @var DataSigner $dataSigner
         */
        $dataSigner = app(DataSigner::class);

        /**
         * @var Base64SafeEncoder $base64SafeEncoder
         */
        $base64SafeEncoder = app(Base64SafeEncoder::class);

        list($algorithm, $format) = $dataSigner->extractSignOptionFromJWSAlg($request->input('protected.alg'));

        $signature = $base64SafeEncoder->decode($request->input('signature'));
        $protected = $request->input('_protected');
        $payload = $request->input('_payload');

        $kid = $request->input('protected.kid');
        $userId = Arr::last(explode('/', $kid));
        $user = User::findOrFail($userId);

        app()->singleton('user_id', function () use ($userId) {
            return $userId;
        });
        app()->singleton('user', function () use ($user) {
            return User::find(app()->user_id);
        });

        if (!$user->public_key) {
            abort(500, 'system error');
        }

        $jwk = collect($user->public_key)->merge(["kid" => $kid, "use" => "sig", "alg" => $algorithm, ])->toArray();
        $convert = new JWKConverter();

        $publicKey = new PublicKey($convert->toPEM($jwk));
        $dataSigner->checkSign($signature, $protected . '.' . $payload, $publicKey, $algorithm, $format);
        return $next($request);
    }
}
