<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PromptController extends Controller
{
    /**
     * 页面跳转共用页面.
     *
     * @return void
     */


    public function index()
    {
        Auth::logout();
        //验证参数
        if(!empty(session('message')) && !empty(session('url')) && !empty(session('jumpTime'))){
            $data = [
                'message' => session('message'),
                'url' => session('url'),
                'jumpTime' => session('jumpTime'),
                'status' => session('status')
            ];
        } else {
            $data = [
                'message' => '请勿非法访问！',
                'url' => '/',
                'jumpTime' => 3,
                'status' => false
            ];
        }
        return view('admin.layouts.prompt',['data' => $data]);
    }
}

