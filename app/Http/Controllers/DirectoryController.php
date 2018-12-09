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
                    "comodoca.com"
                ],
                "termsOfService" => "https://www.trustocean.com/term-of-service.php",
                "website" => "https://www.trustocean.com/",
            ],
            str_random(8) => "https://community.letsencrypt.org/t/adding-random-entries-to-the-directory/33417",
        ]);
    }
}
