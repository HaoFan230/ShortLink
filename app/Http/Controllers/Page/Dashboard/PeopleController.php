<?php

namespace App\Http\Controllers\Page\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use ViewUtils;
use Auth;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
    public function edit(User $user)
    {
        $viewConfig = ViewUtils::generateConfig([
            'pageInfo'=>[
                'title'=>'个人设置',
                'description'=>'嘘,不要告诉任何人',
            ],
        ]);

        return view('Dashboard.People.edit',$viewConfig); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        // 一些基本参数验证
        $request->validate([
            'name'=> 'filled|unique:users,name',
            'password'=> 'filled|confirmed',
            'access_token'=>"filled|exists:users,access_token",
        ],[
            'name.unique'=>'换个用户名吧',
            'password.confirmed'=>'两次填写的密码不一致',
            'access_token.exists'=>'无效的AccessToken',
        ]);
        
        // 判断是否本人操作
        if($user->id != Auth::user()->id) return redirect()->back()->withErrors([
            'name'=>'非法操作',
        ]);

        // 只获取 name, password,access_token 参数
        $args = $request->only(['name','password','access_token']);

        if(isset($args['password']))  $args['password'] = bcrypt($args['password']);
        if(isset($args['access_token']))  $args['access_token'] = base64_encode(bcrypt(Auth::user()->email));
        
        $user->update($args);
            
        return redirect()->route('people.edit',$user->name)->withInput([
            'success'=>'更新成功',
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
