<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\AccountNewRequest;
use App\Http\Requests\AccountDetailRequest;
use App\Http\Responses\AccountResponse;
use CoderCat\JWKToPEM\JWKConverter;

class AccountController extends Controller
{
    public function create(AccountNewRequest $request)
    {
        $onlyReturnExisting = $request->input('payload.onlyReturnExisting', false);
        $alg = $request->input('protected.alg');
        $nonce = $request->input('protected.nonce');

        $jwk = $request->input('protected.jwk');
        $email =  str_replace('mailto:', '', collect($request->input('payload.contact'))->first());

        $convert = new JWKConverter();
        $publicKey = $convert->toPEM($jwk);
        $publicKey = trim(str_replace(['-----BEGIN PUBLIC KEY-----', '-----END PUBLIC KEY-----', PHP_EOL, "\r"], '', $publicKey));
        $publicKey = base64_decode($publicKey);
        $fingerprint = md5($publicKey);

        $attributes = [
            'email' => $email,
            'public_key' => $jwk,
            'fingerprint' => $fingerprint,
        ];

        $user = User::where('fingerprint', $fingerprint)->first();
        if ($onlyReturnExisting) {
            if (!$user) {
                abort(404, 'User not exists');
            }
        } else {
            if (!$user) {
                $user = User::create($attributes);
            }
        }

        return new AccountResponse($user);
    }

    public function detail($id, AccountDetailRequest $request)
    {
        $user = User::findOrFail($id);

        return new AccountResponse($user);
    }
}
