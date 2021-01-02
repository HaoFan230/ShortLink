<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
}
