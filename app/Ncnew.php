<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ncnew extends Model
{
    /**
     * 设定管理员的uid。
     *
     * @param  string  $value
     * @return void
     */
    protected $attributes = [];
    public function __construct(){
        $this->attributes =array('uid'=>Auth::user()->id);
    }

    public $timestamps = true;
    // protected $attributes = $this->;
}
