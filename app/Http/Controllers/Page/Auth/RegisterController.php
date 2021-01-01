<?php

namespace App\Http\Controllers\Page\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use ViewUtils;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('register');
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
        // 一些基本参数验证
        $request->validate([
            'email'=> 'required|filled|email|unique:users,email',
            'password'=> 'required|filled|confirmed',
        ],[
            'email.required'=>'请填写邮箱',
            'email.email'=>'邮箱格式不正确，请重新填写',
            'email.unique'=>'该邮箱已注册',
            'password.required'=>'请填写密码',
            'password.confirmed'=>'两次填写的密码不一致',
        ]);
        
        // 创建账号
        $userInfo = User::create([
            'name'=> '用户'.substr(md5($request->email),0,10),
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => 'unauthenticated', 
            'role'=> 'user',
        ]);

        $this->sendVerifyEmail($request->email);

        // 重定向至登录页面
        return redirect()->route('login.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
