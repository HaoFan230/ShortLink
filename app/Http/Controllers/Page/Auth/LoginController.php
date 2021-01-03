<?php

namespace App\Http\Controllers\Page\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('login');
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
        // 登录参数验证
        $request->validate([
            'email'=> 'required|filled|email|exists:users,email',
            'password'=> 'required|filled|between:8,16',
        ],[
            'email.required'=> '请输入邮箱地址',
            'email.exists'=> '当前用户不存在',
            'email.email'=> '邮箱格式不正确,请重新输入',
            'password.required'=> '请输入账户密码',
            'password.between'=> '密码长度应在8-16位之间',
        ]);

        // 使用Laravel手动认证
        $AuthStatus = Auth::attempt([
            'email'=> $request->email,
            'password'=> $request->password,
        ],!!$request->remember ?? false);

        if(!$AuthStatus) return redirect()->back()->withErrors([
            'password'=>'密码错误! 请重新登录',
        ])->withInput();

        return redirect()->route('home.index');
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
