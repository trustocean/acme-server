<?php
namespace App\Http\Controllers;

use App\Http\Responses\AccountNewResponse;
use App\Http\Requests\AccountNewRequest;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function create(AccountNewRequest $request)
    {
        // @TODO: 存储到 account 模型
        return new AccountNewResponse(['id' => 1, 'emails' => Str::random() . '@' . Str::random() . '.com']);
    }
}
