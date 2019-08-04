<?php
namespace App\Http\Controllers;

class DirectoryController extends Controller
{
    public function index()
    {
        return response()->json([
            "keyChange" => route('acme.key.change'),
            "newAccount" => route('acme.account.new'),
            "newNonce" => route('acme.nonce.new'),
            "newOrder" => route('acme.order.new'),
            "revokeCert" => route('acme.cert.revoke'),
            "meta" => [
                "caaIdentities" => [
                    "sectigo.com",
                    "trust-provider.com",
                    "usertrust.com",
                    "comodoca.com",
                    "comodo.com"
                ],
                "termsOfService" => "https://www.trustocean.com/product-contract-list",
                "website" => "https://www.trustocean.com/",
                "csrEager" => true,
            ],
        ]);
    }
}
