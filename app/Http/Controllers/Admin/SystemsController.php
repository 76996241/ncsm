<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;


class SystemsController extends Controller
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

    //平台基础信息设置
    public function systems(){

        $data['page']=array('title'=>'平台基础信息设置');


        $data['system']=$this->system;
        return view('admin.systems.systems',['data'=>$data]);

    }

    //平台基础信息设置
    public function mail(){

        $data['page']=array('title'=>'平台基础信息设置 - 邮件服务器');


        $data['system']=$this->system;
        return view('admin.systems.mail',['data'=>$data]);

    }
    //平台基础信息设置
    public function messages(){

        $data['page']=array('title'=>'平台基础信息设置 - 短信服务器');


        $data['system']=$this->system;
        return view('admin.systems.messages',['data'=>$data]);

    }

    //平台基础信息设置-提交
    public function update(Request $request){

        $data['page']=array('title'=>'平台基础信息设置 - 修改设置');
        $system=$request->system;
        $file=$request->file('system');
        $flight = \App\System::find(1);
        foreach($system as $key=>$val){
            $str = str_replace("'","",$key );
            $str = str_replace(" ","",$str );
            if( is_string($val)){
                $flight->$str=$val;
            }else{
                $goFile=$file[$key];
                if($goFile){
                    $store_result = $goFile->storeAs('logo',$str.'.png');
                    $flight->$str=$store_result;
                }
            }
        }

        $url=$request->input('url');
        if($flight->save()){
            return redirect('/prompt')->with(['message' => '设置成功', 'url' => '/admin/systems/'.$url, 'jumpTime' => 3, 'status' => '43AEFA']);
        }else{
            return redirect('/prompt')->with(['message' => '设置失败', 'url' => '/admin/systems/'.$url, 'jumpTime' => 4, 'status' => '#ff6600']);
        }
    }

    //分类设置
    public function cate(Request $request){


        $flight = new \App\Post_cate();

        if($request->get('id')){
            $model =  $flight
                ->where('pid',$request->get('id'))
                ->orderBy('sequence', 'asc')
                ->get();
            if(count($model)<1){
                return redirect('/prompt')->with(['message' => '分类不存在', 'url' => '/admin/systems/cate', 'jumpTime' => 2, 'status' => '#ff6600']);
            }

            $data['pids']=$request->get('id');
            $nav= $flight->find($request->get('id'));
            $data['page']=array('title'=>'系统管理 - 分类管理 - '.$nav['name']);
        }else{
            $model =  $flight
                ->where('pid','0')
                ->orderBy('sequence', 'asc')
                ->get();
            if(count($model)<1){
                return redirect('/prompt')->with(['message' => '分类不存在', 'url' => '/admin/systems/cate', 'jumpTime' => 2, 'status' => '#ff6600']);
            }
            $data['pids']='0';
            $data['page']=array('title'=>'系统管理 - 分类管理');
//.tpl-portlet-components
        }
        $data['model']=$model;
        $data['system']=$this->system;
        return view('admin.systems.cate',['data'=>$data]);
    }
    //分类设置
    public function cateAdd(Request $request){


        $re =    $this->validate($request, [
            'name' => 'required|min:2|max:15',
            'slug' => 'required|min:2|max:115',
            'pid' => 'required|integer',
            'sequence' => 'required|integer|min:1|max:99',
        ],['required'=>' 必填项',
            'max'=>' 输入长度不符合要求',
            'min'=>' 输入长度不符合要求',
            'pid'=>' 必须是整数',
            'sequence'=>' 必须是整数',
        ]);
        $flight = new \App\Post_cate();
        foreach($request->input() as $key=>$val){
            $str = str_replace("'","",$key );
            if($str!='_token'){
                $flight->$str=$val;
            }}
        if($flight->save()){
            $dataPostCate=$flight->orderBy('id', 'desc')->first();
            $html = "<tr id=\"tr".$dataPostCate['id']."\"><td><input type=\"checkbox\"></td>
                                <td>".$dataPostCate['id']."</td>
                                <td>".$dataPostCate['name']."</td>
                                <td>".$dataPostCate['sequence']."</td>
                                <td>".NcGetCount($dataPostCate['id'])."</td>
                                <td>
                      <div class=\"am-btn-toolbar\">
                                                <div class=\"am-btn-group am-btn-group-xs\">
                                                <button type=\"button\"  class=\"am-btn am-btn-default am-btn-xs am-text-secondary\" onclick=\"TypeEdit( ".$dataPostCate['id'].")\"><span class=\"am-icon-pencil-square-o\"></span> 编辑</button>
                                                <button type=\"button\" class=\"am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only\" onclick=\"TypeEdit(". $dataPostCate['id'].")\"><span class=\"am-icon-trash-o\"></span> 删除</button>";
            if(NcGetCount($dataPostCate['id']) >0)
            {
                $html.="  <a class=\"am-btn am-btn-default am-btn-xs am-hide-sm-only\" href='".route('cate')."?id=".$dataPostCate['id']."'\"><span class=\"am-icon-copy\"></span> 管理分类</a>";
            }
            $html.="  </div></div></td></tr>";
            $arr['html']=$html;
            $arr['url']=route('cate').'?id='.$flight->pid;
        }else{
            $arr = ["id"=>"0"];
        }
        return $arr;

    }

//分类设置
    public function ncstore(Request $request){

        //活动需要验证的字段名
        foreach ($_POST as $key=>$value){
            if($key!='_token'){
                $keys=$key;
            }
        }
        $name=array(
            'name' => 'required|min:2|max:15',
            'slug' => 'required|min:2|max:115',
            'pid' => 'required|integer',
            'sequence' => 'required|integer|min:1|max:99',
            //资讯页面验证
            'news-title' => 'required|min:10|max:50',
            'news-introduce' => '|min:0|max:255',
            //资讯页面验证
            'gage-title' => 'required|min:10|max:50',
            'gage-introduce' => '|min:0|max:255',
            //试题提交
            'questions-title' => 'required|min:3|max:150',
            //试题题目提交
            'subject-title' => 'required|min:3|max:50',
            //试题题目标准
            'standards-title' => 'required|min:3|max:50',
            'standards-scores' => 'required|numeric|min:0|max:500',
            //试题题目测量内容
            'measures-aspectdescription' => 'required|max:30',
            'measures-aspectsize' =>'required|numeric',
            'measures-aspecterrora' =>'required|numeric',
            'measures-aspecterrorb' =>'required|numeric',
            'measures-aspectadd' => 'required|min:0|max:80',
            'measures-maxmark' => 'required|numeric|min:0|max:500'
        );
        $content=array(
            'required'=>' 必填项！',
            'max'=>' 输入长度不符合要求！',
            'min'=>' 输入长度不符合要求！',
            'pid'=>' 必须是整数！',
            'sequence'=>' 必须是整数！',
            'numeric'=>' 必须是数字！',);
        $re =    $this->validate($request, [$keys => $name[$keys]],$content);

    }
    //ajax获取数据
    public function cateedit(Request $request){

        $Post_cate = new \App\Post_cate();
        $arr=$Post_cate->where('id', $request->get('id'))->first();
        $arr['html']=NcGetTypeS($arr['pid'],2);
        return $arr;

    }

    //分类设置
    public function cateedits(Request $request){


        $re =    $this->validate($request, [
            'name' => 'required|min:2|max:15',
            'slug' => 'required|min:2|max:115',
            'pid' => 'required|integer',
            'sequence' => 'required|integer|min:1|max:99',
        ],['required'=>' 必填项',
            'max'=>' 输入长度不符合要求',
            'min'=>' 输入长度不符合要求',
            'pid'=>' 必须是整数',
            'sequence'=>' 必须是整数',
        ]);
        $flight = \App\Post_cate::find($request->input('id'));
        $pid=$flight['pid'];
        foreach($request->input() as $key=>$val){
            $str = str_replace("'","",$key );
            if($str!='_token'){
                $flight->$str=$val;
            }}
        if($flight->save()){
            $dataPostCate=$flight->where('id', $request->get('id'))->first();
            $html = "<td><input type=\"checkbox\"></td>
                                <td>".$dataPostCate['id']."</td>
                                <td>".$dataPostCate['name']."</td>
                                <td>".$dataPostCate['sequence']."</td>
                                <td>".NcGetCount($dataPostCate['id'])."</td>
                                <td>
                      <div class=\"am-btn-toolbar\">
                                                <div class=\"am-btn-group am-btn-group-xs\">
                                                <button type=\"button\"  class=\"am-btn am-btn-default am-btn-xs am-text-secondary\" onclick=\"TypeEdit( ".$dataPostCate['id'].")\"><span class=\"am-icon-pencil-square-o\"></span> 编辑</button>
                                                <button type=\"button\" class=\"am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only\" onclick=\"TypeEdit(". $dataPostCate['id'].")\"><span class=\"am-icon-trash-o\"></span> 删除</button>";
            if(NcGetCount($dataPostCate['id']) >0)
            {
                $html.="  <a class=\"am-btn am-btn-default am-btn-xs am-hide-sm-only\" href='".route('cate')."?id=".$dataPostCate['id']."'\"><span class=\"am-icon-copy\"></span> 管理分类</a>";
            }
            $html.="  </div></div></td>";
            $arr['html']=$html;
            $arr['id']=$dataPostCate['id'];

            if($pid!=$dataPostCate['pid']){
                $arr['url']=route('cate').'?id='.$flight->pid;
            }
        }else{
            $arr = ["id"=>"0"];
        }

        return $arr;

    }
    //分类设置
    public function catedel(Request $request){

        $Post_cate = new \App\Post_cate();
        //拆散POST字符串为数组
        $arr=$request->input('id');
        $arr=NcGetArray($arr);
        //获取存在下级分类的类
        $model =  $Post_cate->whereIn('pid',$arr)->get();
        $val=[];
        foreach($model as $value){
            $val[]=$value->pid;
        }
        $modelId =  $Post_cate->whereIn('id',$arr)->get();
        //去除重复数据
        $val=array_unique($val);
        //合并数组，去除重复
        $delarr=array_diff($arr,$val);
        //获得不可删除类名
        $modelType =  $Post_cate->whereIn('id',$val)->get();
        $typeName='';
        foreach($modelType as $modelType){
            $typeName.=$modelType->name.'，';
        }

        if(count($val)==0){
            //全部可以删除
            $arr['id']=$Post_cate->destroy($delarr);
            if($arr['id']){
                $arr['text']="分类删除成功！";
                $arr['url']=route('cate').'?id='.$modelId[0]->pid;
            }else{
                $arr['text']="分类删除失败！-1";
            }
        }else{
            if(count($delarr)==0){
                $arr['text']=$typeName.'存在下级分类，无法删除！';
            }else{
                $arr['id']=$Post_cate->destroy($delarr);
                if($arr['id']){
                    $arr['text']=$typeName.'存在下级分类，无法删除！其他已删除！';
                    $arr['url']=route('cate').'?id='.$modelType->pid;
                }else{
                    $arr['text']="分类删除失败！-1";
                }
            }
        }
        return $arr;
    }

    //ajax获取分类下拉
    public function cateselect(Request $request){
        $arr['html']=NcGetTypeS($request->get('id'),'1');
        return $arr;
    }
    //资讯ajax获取分类下拉
    public function newsselect(Request $request){
        $arr['html']=NcGetTypeNews($request->get('id'),$request->get('key'),$request->get('type'));
        return $arr;
    }
    //量具教学ajax获取分类下拉
    public function gageselect(Request $request){
        $arr['html']=NcGetTypeNews($request->get('id'),$request->get('key'),$request->get('type'));
        return $arr;
    }
    //测量位置ajax获取分类下拉
    public function measureselect(Request $request){
        $arr['html']=NcGetTypeNews($request->get('id'),$request->get('key'),$request->get('type'));
        return $arr;
    }

    //权限管理页面
    public function authority(Request $request){

        $data['page']=array('title'=>'系统管理 - 权限管理');
        $data['cate']=NcGetType('2');
        return view('admin.systems.authority',['data'=>$data]);
    }

    //权限管理设置
    public function authorityadmin(Request $request){
        //获取当前用户组数据
        $cate=NcGetType($request->get('id'),'1');
        $Authority = new \App\Authority();
        $dataAuthority =  $Authority->where('cateid',$request->get('id'))->get();
        if($cate['pid']!='2'){
            return redirect('/prompt')->with(['message' => '用户组不存在', 'url' => '/admin/systems/authority', 'jumpTime' => 2, 'status' => '#ff6600']);
        }
        $data['id']=$request->get('id');
        $data['page']=array('title'=>'系统管理 - 权限设置 - '.$cate['name'].'权限设置');
        $data['cate']=NcGetList('3');
        $data['dataAuthority']=$dataAuthority;
        $data['system']=$this->system;
        return view('admin.systems.authorityadmin',['data'=>$data]);
    }

    public function authorityupdate(Request $request){

        $checkbox=array();
        $checkbox[]= NcGetArray($request->input('checkboxOnePost'));
        $checkbox[]= NcGetArray($request->input('checkboxTwePost'));
        $checkbox[]= NcGetArray($request->input('checkboxThreePost'));
        $checkbox[]= NcGetArray($request->input('checkboxFourPost'));
        $checkboxs = json_encode($checkbox);
        $Authority = new \App\Authority();
        $dataAuthority =  $Authority->where('cateid',$request->input('id'))->get();
        if(count($dataAuthority)==1){
            // $Authority->description = $checkboxs;
            $rs = $Authority->where('cateid',$request->input('id'))->update(['description'=>$checkboxs]);
        }else{
            $Authority->cateid=$request->input('id');
            $dataCate=NcGetType($request->input('id'),1);
            $Authority->display_name=$dataCate['name'];
            $Authority->description = $checkboxs;
            $rs = $Authority->save();
        }
        if($rs){
            $dataAuthority =  $Authority->where('cateid',$request->input('id'))->get();
            $arr['cateid']=$request->input('id');
        }else{
            $arr['cateid']='0';
        }
        return $arr;
    }
    //权限初始化
    public function authorityInit(Request $request){
        $Authority = new \App\Authority();
        $dataAuthority =  $Authority->where('cateid',$request->input('id'))->get();
        $arr['json'] = NcGetArray($dataAuthority['0']['description']);
        return $arr;
    }


}