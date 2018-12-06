<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    var $system;
    public function __construct()
    {
        // $this->middleware('auth');
        $this->system=\App\System::find(1);
    }

    /*
    |--------------------------------------------------------------------------
    | Admin Controller
    |--------------------------------------------------------------------------
    |
    | NCSM - 管 理 后 台
    |
    */


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/login';


    public function index(Request $request){
        $data['page']=array('title'=>'平台基础信息设置');
        $data['system']=$this->system;
        return view('admin.index',['data'=>$data]);

    }
}
