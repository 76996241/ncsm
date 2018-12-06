<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Validation\Validator;



class UserController extends Controller
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
     * .资讯类信息管理
     *
     * @var string
     */
    // protected $redirectTo = '/news';

    //平台基础信息设置
    public function index(Request $request){
        $user = new \App\User();
        $where=array();
        if($request->get('type')){
         $where['user_group']= $request->get('type');
        }
        if($request->get('keyword')){
            $data['user']=$user->where($where)->where('name','LIKE','%'.$request->get('keyword').'%')->orderby('id','desc')->paginate(15);
        }else{
            $data['user']=$user->where($where)->orderby('id','desc')->paginate(15);
        }
        $data['page']=array('title'=>'用户数据管理');
        $data['pids']='2';
        $data['cate']=NcGetType('36');
        $data['type']=$request->get('type');
        $data['pages']=$request->get('page');
        $data['keyword']=$request->get('keyword');
        return view('admin.user.index',['data'=>$data]);
    }


    // 获得权限数据
    public function UserEdit(Request $request){
        $user = new \App\User();
        $list = $user->find($request->input('id'));
        $arr=$list;
        $arr['html']=NcGetTypeNews('2','9',$list['user_group']);
        return $arr;
    }

    // 获得权限数据
    public function UserUpdate(Request $request){
        $user = new \App\User();
        $list = $user->find($request->input('id'));
        $str = str_replace("[","",$request->input('user_group'));
        $str = str_replace("]","",$str);
        $str = str_replace('"',"",$str);
        $list->user_group=$str;

        if($list->save()){
            $arr['id']='1';
        }else{
            $arr['id']='0';
            }
        return $arr;
    }

    public function NewsDel(Request $request){
        $news = new \App\Ncnew();
        //拆散POST字符串为数组
        $arr=$request->input('id');
        $arr=NcGetArray($arr);
            //全部可以删除
            $rs=$news->destroy($arr);
            if($rs){
                $arr['text']="资讯删除成功！";
                $arr['url']=$request->input('url');
            }else{
                $arr['text']="资讯删除失败！-1";
            }
        return $arr;
    }

}