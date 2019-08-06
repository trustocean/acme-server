<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\AccountNewRequest;
use App\Http\Requests\AccountDetailRequest;
use App\Http\Responses\AccountResponse;

class AccountController extends Controller
{
    public function create(AccountNewRequest $request)
    {
        $onlyReturnExisting = $request->input('payload.onlyReturnExisting', false);
        $alg = $request->input('protected.alg');
        $nonce = $request->input('protected.nonce');

        $jwk_e = $request->input('protected.jwk.e');
        $jwk_kty = $request->input('protected.jwk.kty');
        $jwk_n = $request->input('protected.jwk.n');
        $email =  str_replace('mailto:', '', collect($request->input('payload.contact'))->first());

        $attributes = [
            'email' => $email,
            'e' => $jwk_e,
            'kty' => $jwk_kty,
            'n' => $jwk_n,
        ];
        if ($onlyReturnExisting) {
            unset($attributes['email']);
            $user = User::where($attributes)->firstOrFail();
        } else {
            $user = User::firstOrCreate($attributes);
        }

        return new AccountResponse($user);
    }

    public function detail($id, AccountDetailRequest $request)
    {
        $user = User::findOrFail($id);

        return new AccountResponse($user);
    }
}
