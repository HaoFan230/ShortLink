<?php

namespace App\Http\Controllers\Page\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tuupola\Base62;
use App\Link;
use ViewUtils;
use Auth;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // 获取用户创建的所有连接
        $links = Link::whereUserId(Auth::user()->id)->paginate(30);

        $viewConfig = ViewUtils::generateConfig([
            'pageInfo'=>[
                'title'=> '短链接',
                'description'=> '注意短链接的时效性',
            ],
            'linkList'=> $links,
        ]);

        return view('Dashboard.Links.home',$viewConfig); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $viewConfig = ViewUtils::generateConfig([
            'pageInfo'=>[
                'title'=>'短链接',
                'description'=>'创建链接',
            ],
            'showBackButton'=> true,
        ]);

        return view('Dashboard.Links.create',$viewConfig); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 验证参数
        $request->validate(array_merge(
            [
                'target'=> 'required|filled|url',
                'type'=> 'required|filled|in:longterm,shortterm',
            ],
            $request->type == "shortterm" ? [ 
                // 如果是短期，那么过期时间应该大于服务器时间
                'expiratime'=> 'required|filled|date_format:Y-m-d\TH:i|after:'.date('Y-m-d\TH:i')
            ] : [],
        ),[
            'target.required'=>'请填写目标URL',
            'target.url'=>'请确认目标URL的格式',
            'type.required'=>'请选择正确的选项',
            'type.in'=>'请选择正确的选项',
            'expiratime.required'=> '请填写过期时间',
            'expiratime.date_format'=> '时间格式不正确',
            'expiratime.after'=> '过期时间超前了',
        ]);

        // 创建短链接
        // 转为正常日期格式
        $expiratime = Date('Y-m-d H:i:s',strtotime($request->expiratime));

        $link = Link::create([
            'url'=> $request->target,
            'type'=> $request->type,
            'expiratime'=> $request->type == 'shortterm' ? $expiratime : null,
            'user_id'=> Auth::user()->id,    
        ]);

        // 使用 Base62 加密
        $shortKey = (new Base62)->encode($link->id);
        
        $link->update([
            'shortkey'=>$shortKey,
        ]);

        $viewConfig = ViewUtils::generateConfig([
            'pageInfo'=> [
                'title'=>'创建成功',
                'description'=> route('link.show',$shortKey),
            ],
            'showBackBtn'=> true,
            'linkInfo'=> $link,
        ]);

        return view('Dashboard.Links.result',$viewConfig);
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
