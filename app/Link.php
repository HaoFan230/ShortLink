<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;

class Link extends Model
{
    protected $fillable = [
        'shortkey', 'url', 'type','expiratime','user_id','status'
    ];

    // 追加一个status字段，判断是否短链接失效
    protected $appends = [
        'status'
    ];

    public function getStatusAttribute() {
        return $this->expiratime ? Carbon::now()->lt($this->expiratime) : true;
    }

    public function getRouteKeyName() {
        return 'shortkey';
    }

    // 判断是不是当前用户所创建的短链接
    public function resolveRouteBinding($value,$field = null) {
        return $this->where([
            'shortkey'=> $value,
            'user_id'=> Auth::user()->id
        ])->firstOrFail();
    }
}
