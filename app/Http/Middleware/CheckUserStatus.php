<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 用户有三种登录状态: normal , freeze
        if(Auth::user()->status == "freeze") return redirect()->route('login.index')->withErrors([
            'password'=>'该账户已冻结,请联系管理员',
        ]);

        return $next($request);
    }
}
