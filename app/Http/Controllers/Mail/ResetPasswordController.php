<?php

namespace App\Http\Controllers\Mail;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    //邮件发送
    public function sendEmail(Request $request)
    {
        $token = Hash::make(date('Y-m-d H-i-s',time()));

        $url = 'http://www.exam.cn:8080/password/reset/'.$token;
        $email = $request->input('email','');

        Mail::send('emails.reset',['url'=>$url],function ($message) use($email){

            //接收的邮箱对象
            $to = $email;
            //邮箱主题
            $message->to($to)->subject('重置密码');
        });

        if(count(Mail::failures()) < 1){
            echo '发送邮件成功，请查收！';
        }else{
            echo '发送邮件失败，请重试！';
        }

    }
}