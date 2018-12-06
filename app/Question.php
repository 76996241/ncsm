<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Question extends Model
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

    /**
     * 关联单工件试题。
     */
    public function Subject()
    {
        return $this->hasOne('App\Subject','uid','id');
    }
    // protected $attributes = $this->;
}
