<?php
namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Welcome to ACME-SERVER',
            'directory' => route('acme.directory'),
        ]);
    }
}
