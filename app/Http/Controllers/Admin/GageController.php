<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Validation\Validator;



class GageController extends Controller
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
    // protected $redirectTo = '/gage';

    //平台基础信息设置
    public function index(Request $request){
        $gage = new \App\Gage();
        $where=array();
        if($request->get('type')){
        $where['type']= $request->get('type');
        }
        if($request->get('hrand')){
            $where['hrand']= $request->get('hrand');
        }
        if($request->get('keyword')){
            $data['gage']=$gage->where($where)->where('title','LIKE','%'.$request->get('keyword').'%')->orderby('id','desc')->paginate(15);
        }else{
            $data['gage']=$gage->where($where)->orderby('id','desc')->paginate(15);
        }
        $data['page']=array('title'=>'量具教学资源管理');
        $data['pids']='39';
        $data['hrand']='43';
        $data['cate']=NcGetType('36');

        $request->get('type') ? $data['type']=$request->get('type'):$data['type']='0';
        $request->get('hrand') ? $data['hrands']=$request->get('hrand'):$data['hrands']='0';

        $data['pages']=$request->get('page');
        $data['keyword']=$request->get('keyword');
        return view('admin.gage.index',['data'=>$data]);
    }

    public function add(Request $request){
        $data['page']=array('title'=>'量具教学资源管理 - 添加资源');
        $data['cate']=NcGetType('39');
        $data['pids']='39';
        $data['hrand']='43';
        return view('admin.gage.add',['data'=>$data]);
    }

    public function edit(Request $request){
        $gage = new \App\Gage();
        $data['gage'] = $gage->find($request->get('id'));

        if(empty($data['gage']['id'])){
            return redirect('/prompt')->with(['message' => '数据不存在', 'url' => route('gage'), 'jumpTime' => 2, 'status' => '#ff6600']);
        }

        $data['page']=array('title'=>'量具教学资源管理 - 编辑资源');
        $data['cate']=NcGetType('39');
        $data['pids']='39';
        $data['hrand']='43';
        return view('admin.gage.edit',['data'=>$data]);
    }

    //资讯信息添加
    public function GageInsert(Request $request){
        $re =    $this->validate($request, [
            'gage-title' => 'required|min:10|max:50',
            'gage-introduce' => 'min:0|max:255',
        ],['required'=>':attribute 必填项',
            'max'=>':attribute 输入长度不符合要求',
            'min'=>':attribute 输入长度不符合要求',
        ],['gage-title' => '标题',
           'gage-introduce' => '简介',]);
        $gage = new \App\Gage();
        foreach($request->input() as $key=>$val){
            $str = str_replace("'","",$key );
            if($str!='_token'){
                $str = str_replace("'","",$key );
                $str = str_replace("gage-","",$str );
                $gage->$str=$val;
            }}

        $file=$request->file('gage-images');
        $time=time();
        if($file){
            $store_result = $file->storeAs('gage/'.date('ymd'),$time.rand(10,10000).'.png');
            $gage->images=$store_result;
        }

        if($gage->save()){
           // $list = $gage->findOrFail(1);
            return redirect('/prompt')->with(['message' => '添加成功', 'url' => route('gage').'?id='.$gage->type, 'jumpTime' => 3, 'status' => '43AEFA']);
        }else{
            return redirect('/prompt')->with(['message' => '添加失败', 'url' => route('gageadd'), 'jumpTime' => 2, 'status' => '#ff6600']);
        }

    }
    //资讯信息修改
    public function GageUpdate(Request $request){
        $re =    $this->validate($request, [
            'gage-title' => 'required|min:10|max:50',
            'gage-introduce' => 'min:0|max:255',
        ],['required'=>':attribute 必填项',
            'max'=>':attribute 输入长度不符合要求',
            'min'=>':attribute 输入长度不符合要求',
        ],['gage-title' => '标题',
            'gage-introduce' => '简介',]);
        $gage = new \App\Gage();
        $list = $gage->find($request->input('id'));


        if(empty($list['id'])){
            return redirect('/prompt')->with(['message' => '数据不存在', 'url' => route('gage'), 'jumpTime' => 2, 'status' => '#ff6600']);
        }
        foreach($request->input() as $key=>$val){
            $str = str_replace("'","",$key );
            if($str!='_token'){
                $str = str_replace("'","",$key );
                $str = str_replace("gage-","",$str );
                $list->$str=$val;
            }}
        $file=$request->file('gage-images');
        $time=time();
        if($file){
            $store_result = $file->storeAs('gage/'.date('ymd'),$time.rand(10,10000).'.png');
            $list->images=$store_result;
        }else{
            $list->images=$list['images'];
        }
        if($list->save()){
            return redirect('/prompt')->with(['message' => '编辑成功', 'url' => route('gageedit').'?id='.$list['id'], 'jumpTime' => 3, 'status' => '43AEFA']);
        }else{
            return redirect('/prompt')->with(['message' => '编辑失败', 'url' => route('gageedit').'?id='.$list['id'], 'jumpTime' => 2, 'status' => '#ff6600']);
        }

    }
    //资讯删除
    public function GageDel(Request $request){
        $gage = new \App\Gage();
        //拆散POST字符串为数组
        $arr=$request->input('id');
        $arr=NcGetArray($arr);
            //全部可以删除
            $rs=$gage->destroy($arr);
            if($rs){
                $arr['text']="资源删除成功！";
                $arr['url']=$request->input('url');
            }else{
                $arr['text']="资源删除失败！-1";
            }
        return $arr;
    }

}