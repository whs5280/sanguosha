<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthLoginController extends Controller
{
    protected $allow = ['github', 'qq', 'weibo'];
    /**
     * 第三方授权登录跳转
     *
     * @param Request $request
     * @return mixed
     */
    public function redirectToAuth(Request $request)
    {

    }

    /**
     * 第三方授权认证回调
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function handleCallback(Request $request){

    }
}