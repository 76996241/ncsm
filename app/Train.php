<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Train extends Model
{

    /**
     * 设定用户uid。
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
