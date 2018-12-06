<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Validation\Validator;



class NewsController extends Controller
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
        $news = new \App\Ncnew();
        $where=array();
        if($request->get('type')){
        $where['type']= $request->get('type');
        }
        if($request->get('keyword')){
            $data['news']=$news->where($where)->where('title','LIKE','%'.$request->get('keyword').'%')->orderby('id','desc')->paginate(15);
        }else{
            $data['news']=$news->where($where)->orderby('id','desc')->paginate(15);
        }
        $data['page']=array('title'=>'资讯类信息管理');
        $data['pids']='36';
        $data['cate']=NcGetType('36');
        $data['type']=$request->get('type');
        $data['pages']=$request->get('page');
        $data['keyword']=$request->get('keyword');
        return view('admin.news.index',['data'=>$data]);
    }

    public function add(Request $request){
        $data['page']=array('title'=>'资讯类信息管理 - 信息添加');
        $data['cate']=NcGetType('36');
        $data['pids']='36';
        return view('admin.news.add',['data'=>$data]);
    }

    public function edit(Request $request){
        $news = new \App\Ncnew();
        $data['news'] = $news->find($request->get('id'));

        if(empty($data['news']['id'])){
            return redirect('/prompt')->with(['message' => '数据不存在', 'url' => route('news'), 'jumpTime' => 2, 'status' => '#ff6600']);
        }

        $data['page']=array('title'=>'资讯类信息管理 - 信息编辑');
        $data['cate']=NcGetType('36');
        $data['pids']='36';
        return view('admin.news.edit',['data'=>$data]);
    }

    //资讯信息添加
    public function NewsInsert(Request $request){
        $re =    $this->validate($request, [
            'news-title' => 'required|min:10|max:50',
            'news-introduce' => 'min:0|max:255',
        ],['required'=>':attribute 必填项',
            'max'=>':attribute 输入长度不符合要求',
            'min'=>':attribute 输入长度不符合要求',
        ],['news-title' => '标题',
           'news-introduce' => '简介',]);
        $news = new \App\Ncnew();
        foreach($request->input() as $key=>$val){
            $str = str_replace("'","",$key );
            if($str!='_token'){
                $str = str_replace("'","",$key );
                $str = str_replace("news-","",$str );
                $news->$str=$val;
            }}

        $file=$request->file('news-images');
        $time=time();
        if($file){
            $store_result = $file->storeAs('news/'.date('ymd'),$time.rand(10,10000).'.png');
            $news->images=$store_result;
        }

        if($news->save()){
           // $list = $news->findOrFail(1);
            return redirect('/prompt')->with(['message' => '添加成功', 'url' => route('news').'?id='.$news->type, 'jumpTime' => 3, 'status' => '43AEFA']);
        }else{
            return redirect('/prompt')->with(['message' => '添加失败', 'url' => route('newsadd'), 'jumpTime' => 2, 'status' => '#ff6600']);
        }

    }
    //资讯信息修改
    public function NewsUpdate(Request $request){
        $re =    $this->validate($request, [
            'news-title' => 'required|min:10|max:50',
            'news-introduce' => 'min:0|max:255',
        ],['required'=>':attribute 必填项',
            'max'=>':attribute 输入长度不符合要求',
            'min'=>':attribute 输入长度不符合要求',
        ],['news-title' => '标题',
            'news-introduce' => '简介',]);
        $news = new \App\Ncnew();
        $list = $news->find($request->input('id'));


        if(empty($list['id'])){
            return redirect('/prompt')->with(['message' => '数据不存在', 'url' => route('news'), 'jumpTime' => 2, 'status' => '#ff6600']);
        }
        foreach($request->input() as $key=>$val){
            $str = str_replace("'","",$key );
            if($str!='_token'){
                $str = str_replace("'","",$key );
                $str = str_replace("news-","",$str );
                $list->$str=$val;
            }}
        $file=$request->file('news-images');
        $time=time();
        if($file){
            $store_result = $file->storeAs('news/'.date('ymd'),$time.rand(10,10000).'.png');
            $list->images=$store_result;
        }else{
            $list->images=$list['images'];
        }
        if($list->save()){
            return redirect('/prompt')->with(['message' => '编辑成功', 'url' => route('newsedit').'?id='.$list['id'], 'jumpTime' => 3, 'status' => '43AEFA']);
        }else{
            return redirect('/prompt')->with(['message' => '编辑失败', 'url' => route('newsedit').'?id='.$list['id'], 'jumpTime' => 2, 'status' => '#ff6600']);
        }

    }
    //资讯删除
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