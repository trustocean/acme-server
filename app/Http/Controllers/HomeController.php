<?php
namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Welcome to ACME-SERVER of www.DIGITAL-SIGN.com.cn；欢迎使用帝玺ACME服务',
            'readme' => 'https://www.digital-sign.com.cn/tutorial/acme-ssl.html',
            'directory' => route('acme.directory'),
        ]);
    }
}
