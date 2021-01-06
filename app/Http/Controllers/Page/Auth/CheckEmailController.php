<?php

namespace App\Http\Controllers\Page\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;
use App\User;
use ViewUtils;
use Auth;

class CheckEmailController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->only(['index','store']);
    }

    public function verifyUserStatus()
    {
        return Auth::user()->status != 'unauthenticated';
    }

    /**
     * 如果用户的状态是未认证的,通过该方法提示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // 验证用户的状态
        if($this->verifyUserStatus()) return redirect()->route('home.index');

        $viewConfig = ViewUtils::generateConfig([
            'pageInfo'=> [
                'title'=> '未认证邮箱',
                'description'=> '快去邮箱里查收认证邮件吧',
            ],
        ]);

        return view('emails.fail',$viewConfig);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * 用户认证邮件过期,重新发送
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 验证用户的状态
        if($this->verifyUserStatus()) return redirect()->route('home.index');
        
        $this->sendVerifyEmail(Auth::user()->email);

        return redirect()->route('checkemail.index')->withInput([
            'sendStatus'=> true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($accessToken)
    {
        // 先解码一下
        $accessToken = base64_decode($accessToken);

        if(!isset($accessToken) || !($email = Redis::get($accessToken))) {
            return redirect()->route('home.index');
        }

        // 修改用户状态
        User::where(['email'=> $email, 'status'=>'unauthenticated'])->update([
            'status'=>'normal',
        ]);

        // 清除相对应的Redis Key值
        Redis::del($accessToken);

        $viewConfig = ViewUtils::generateConfig([
            'pageInfo'=> [
                'title'=> '邮箱验证通过',
                'description'=> '快进仪表盘试试看吧',
            ],
        ]);

        return view('emails.pass',$viewConfig);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
