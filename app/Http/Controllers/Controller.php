<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // 发送验证邮件
    public function sendVerifyEmail($email , $hours = 1) 
    {
        if($hours < 1) $hours = 1;

        // 通过Redis设置Key的过期时间
        $key = Hash::make($email);
        Redis::set($key,$email);

        // 过期时间为一个小时
        Redis::expire($key,$hours * 3600);

        // 发送邮件的步骤
        $mailConfig = [
            'expiraTime'=> Carbon::now()->addHours($hours),
            // 这里需要用base64编码，不然laravel路由会识别错误
            'emailAuthAddress'=> route('checkemail.show',base64_encode($key)),
        ];

        Mail::send('emails.register',$mailConfig,function($message) use($email) {
            $message->to($email)->subject('账户注册认证');
        });

        // 返回邮件是否有报错, 返回布尔值
        return count(Mail::failures()) < 1;
    }
}
