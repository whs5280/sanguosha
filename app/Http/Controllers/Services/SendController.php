<?php

namespace App\Http\Controllers\Services;

use App\Entity\TempPhone;
use App\Models\M3Result;
use App\Utils\Sms\SendTemplateSms;
use Illuminate\Http\Request;

class SendController
{
    public function send(Request $request)
    {
        $m3_result = new M3Result();

        $phone = $request->input('phone', '13434118350');
        if($phone == '') {
            $m3_result->status = 1;
            $m3_result->message = '手机号不能为空';
            return $m3_result->toJson();
        }
        if(strlen($phone) != 11 || $phone[0] != '1') {
            $m3_result->status = 2;
            $m3_result->message = '手机格式不正确';
            return $m3_result->toJson();
        }

        //随机生成6位数验证码
        $code = $this->randomkeys();

        $sendTemplateSMS = new SendTemplateSms();
        $m3_result = $sendTemplateSMS->sendTemplateSMS($phone,$code);

        //判断是否存在
        if($m3_result->status == 0) {
            $tempPhone = TempPhone::where('phone', $phone)->first();
            if($tempPhone == null) {
                $tempPhone = new TempPhone;
            }
            $tempPhone->phone = $phone;
            $tempPhone->code = $code;
            $tempPhone->deadline = date('Y-m-d H-i-s', time() + 5*60);
            $tempPhone->save();
        }

        return $m3_result->toJson();
    }

    //随机生成6位数
    public function randomkeys(){
        $code = '';
        $charset = '1234567890';

        $_len = strlen($charset) - 1;
        for ($i = 0;$i < 6;++$i) {
            $code .= $charset[mt_rand(0, $_len)];
        }

        return $code;
    }
}