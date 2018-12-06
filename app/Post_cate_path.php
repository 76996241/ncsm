<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post_cate_path extends Model
{

    /**
     * 设定管理员的uid。
     *
     * @param  string  $value
     * @return void
     */
    protected $table = 'Post_cates';
    public $timestamps = false;
   // protected $attributes = $this->;
}
