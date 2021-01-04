<?php

namespace App\Http\Controllers\Page\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\User;
use ViewUtils;

class PasswordResetController extends Controller
{

    public function __construct() 
    {
        // 设置节流器
        $this->middleware('throttle:5,1')->only([
            'store'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Password.reset');
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 参数验证
        $request->validate([
            'email'=> 'required|filled|email',
        ],[
            'email.required'=> '请输入邮箱地址',
            'email.email'=> '邮箱格式不正确,请重新输入',
        ]);
        
        $viewConfig = ViewUtils::generateConfig([
            'pageInfo'=> [
                'title'=> '邮件已发送',
                'description'=> '快进邮箱看看吧',
            ],
        ]);

        // 获取当前邮箱账户的状态
        $user = User::whereEmail($request->email)->firstOrFail();
        
        // 如果不存在用户，也提示成功发送邮件
        if(!$user) return view('emails.result',$viewConfig);

        // 如果状态是冻结的,返回提示
        if($user->status == "freeze") return redirect()->route('password_reset.index')
                                    ->withErrors([
                                        'email'=> '该账户已冻结,请联系管理员'
                                    ])
                                    ->withInput();
        // 发送重置密码邮件
        $this->sendPassowrdResetEmail($request->email);
        

        return view('emails.result',$viewConfig);
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $accessToken
     * @return \Illuminate\Http\Response
     */
    public function show($accessToken)
    {
        $accessToken = base64_decode($accessToken);

        if(!isset($accessToken) || !($email = Redis::get($accessToken))) {
            return redirect()->route('home.index');
        }

        return view('Password.update',[
            'accessToken'=> base64_encode($accessToken),
        ]);
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
     * @param  String  $accessToken
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $accessToken)
    {

        // 一些基本参数验证
        $request->validate([
            'password'=> 'required|filled|confirmed',
        ],[
            'password.required'=>'请填写密码',
            'password.confirmed'=>'两次填写的密码不一致',
        ]);

        $accessToken = base64_decode($accessToken);

        if(!isset($accessToken) || !($email = Redis::get($accessToken))) {
            return redirect()->route('home.index');
        }

        // 不会更新冻结用户
        User::where([
            ['status','!=','freeze'],
            'email'=> $email
        ])->update([
            'password'=> bcrypt($request->password),
        ]);
        
        Redis::del($accessToken);
        
        return redirect()->route('login.index')->withInput([
            'success'=> '修改成功',
            'email'=> $email,
        ]);
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
