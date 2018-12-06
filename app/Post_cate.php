<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post_cate extends Model
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

    public $timestamps = false;
   // protected $attributes = $this->;
}
