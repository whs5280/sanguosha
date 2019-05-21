<?php

namespace App\Utils\Sms;

use App\Models\M3Result;

class SendTemplateSms
{

    //榛子云的SDK
    private $apiUrl = 'http://sms_developer.zhenzikj.com';
    private $appId = '100779';
    private $appSecret = '29317b6e-7cb5-4376-86aa-1a723601d284';

    public function sendTemplateSMS($phone,$code)
    {
        $m3_result = new M3Result();

        //初始化SDK
        $client = new ZhenziSmsClient($this->apiUrl,$this->appId,$this->appSecret);

        //发送短信
        $result = $client->send($phone, "您的验证码为:".$code.",有效时间为5分钟");
        $result = json_decode($result);

        //statue为0发送成功
        if($result == NULL ){
            $m3_result->status = 3;
            $m3_result->message = 'result error!';
        }
        if($result->code != 0){
            $m3_result->status = $result->code;
            $m3_result->message = $result->data;
        }else{
            $m3_result->status = $result->code;
            $m3_result->message = $result->data;
        }

        return $m3_result;
    }

}