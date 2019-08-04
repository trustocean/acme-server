<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class NonceController extends Controller
{
    public function create()
    {
        return response()->noContent(200, [
            'Replay-Nonce' => Str::random(43),
            'Link' => '<' . route('acme.directory') . '>;rel="index"',
            'Content-Length' => 0,
        ]);
    }
}
