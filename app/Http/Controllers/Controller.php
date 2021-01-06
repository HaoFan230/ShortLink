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
     * @param  Integer $min
     * @param  String  $oldKey
     * @return String  $encryptKey
     */
    protected function addRedisExpireKey($key,$min = 60,$oldKey = false)
    {
        if($min < 1) $min = 1;
        
        $encryptKey = null;
        
        // 如果oldkey还存在， 那么就直接设置过期时间
        if(!($oldKey && Redis::get($oldKey))) {
            $encryptKey = Hash::make($key);
            Redis::set($encryptKey,$key);
        }else $encryptKey = $oldKey;

        // 过期时间默认为一个小时
        Redis::expire($encryptKey,$min * 60);

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
     * @param  String    $emailAddress
     * @param  Integer   $min
     * @return Boolean 
     */
    protected function sendVerifyEmail($email , $min = 60) 
    {

        // 添加一个短期的Email Key
        $key = $this->addRedisExpireKey($email, $min);

        // 发送邮件的步骤
        $viewConfig = [
            'expiraTime'=> Carbon::now()->addHours(60 / $min),
            // 这里需要用base64编码，不然laravel路由会识别错误
            'emailAuthAddress'=> route('checkemail.show',base64_encode($key)),
        ];

        // 返回邮件是否有报错, 返回布尔值
        return $this->sendEmail($email,'用户注册',$viewConfig,'emails.register');
    }

    /**
     * 发送重置密码邮件
     *
     * @param  String    $emailAddress
     * @param  Integer   $min
     * @return Boolean 
     */
    protected function sendPassowrdResetEmail($email , $min = 60) 
    {

        // 添加一个短期的Email Key        
        $key = $this->addRedisExpireKey($email, $min);

        $viewConfig = [
            'expiraTime'=> Carbon::now()->addHours(60 / $min),
            'emailAuthAddress'=> route('password_reset.show',base64_encode($key)),
        ];

        // 返回邮件是否有报错, 返回布尔值
        return $this->sendEmail($email,'重设密码',$viewConfig,'emails.reset');
    }
}
