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

    /**
     * 添加过期时间的Key
     *
     * @param  String  $key
     * @param  Integer $hours
     * @return String  $encryptKey
     */
    protected function addRedisExpireKey($key,$hours = 1)
    {
        if($hours < 1) $hours = 1;

        // 通过Redis设置Key的过期时间
        $encryptKey = Hash::make($key);
        Redis::set($encryptKey,$key);

        // 过期时间为一个小时
        Redis::expire($encryptKey,$hours * 3600);

        return $encryptKey;
    }

    /**
     * 发送邮件
     *
     * @param  String  $emailAddress
     * @param  String  $emailTitle
     * @param  Array   $viewConfig
     * @param  Illuminate\Support\Facades\View $viewPath
     * @return Boolean 
     */
    protected function sendEmail($emailAddress,$emailTitle,$viewConfig,$viewPath) 
    {
        // 稍微封装了一下
        Mail::send($viewPath,$viewConfig,function($message) use($emailAddress,$emailTitle) {
            $message->to($emailAddress)->subject($emailTitle);
        });

        // 返回值
        return count(Mail::failures()) < 1;
    }

    /**
     * 发送验证邮件
     *
     * @param  String  $emailAddress
     * @param  Integer   $hours
     * @return Boolean 
     */
    protected function sendVerifyEmail($email , $hours = 1) 
    {

        // 添加一个短期的Email Key
        $key = $this->addRedisExpireKey($email, $hours);

        // 发送邮件的步骤
        $viewConfig = [
            'expiraTime'=> Carbon::now()->addHours($hours),
            // 这里需要用base64编码，不然laravel路由会识别错误
            'emailAuthAddress'=> route('checkemail.show',base64_encode($key)),
        ];

        // 返回邮件是否有报错, 返回布尔值
        return $this->sendEmail($email,'用户注册',$viewConfig,'emails.register');
    }

    /**
     * 发送重置密码邮件
     *
     * @param  String  $emailAddress
     * @param  Integer   $hours
     * @return Boolean 
     */
    protected function sendPassowrdResetEmail($email , $hours = 1) 
    {

        // 添加一个短期的Email Key
        $key = $this->addRedisExpireKey($email, $hours);

        $viewConfig = [
            'expiraTime'=> Carbon::now()->addHours($hours),
            'emailAuthAddress'=> route('password_reset.show',base64_encode($key)),
        ];

        // 返回邮件是否有报错, 返回布尔值
        return $this->sendEmail($email,'重设密码',$viewConfig,'emails.reset');
    }
}
