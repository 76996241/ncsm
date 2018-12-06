<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Validation\Validator;



class QuestionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    var $system;
    var $cncType;
    var $path;
    public function __construct(Request $request)
    {

        $this->system=\App\System::find(1);
        //获取当前地址下，页面标识对应试题分类模型
        $this->path = $request->path();
        $key = explode("/",$this->path);
        $this->path=$key['0'].'/'.$key['1'].'/'.$key['2'];
        $cncType=\App\Post_cate_path::where('slug',$key['2'])->orderBy('sequence','asc')->get();
        if(count($cncType)<1){
                header("location:/admin");
                exit;
        }
        $this->cncType=$cncType[0];
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

    //试题管理
    public function index(Request $request){
        $question = new \App\question();
        $key = explode("/",$this->path);
        $data['cncType']=$this->cncType;
        $where=array();
        if($key['2']=='CncMilling'){
        $where['project']= $data['cncType']['id'];
        }elseif($key['2']=='CncCar'){
        $where['project']= $data['cncType']['id'];
        }elseif($key['2']=='CncUse'){
            $where['project']= $data['cncType']['id'];
        }
        $val=$request->get('val');
        $type=$request->get('type');
        if($val==''){
            $val='0,0,0';
        }
        if($type==''){
            $type='0,0,0';
        }
        $val=explode(',',$val);
        $type=explode(',',$type);

        $val['0'] ? $data['cncuse']=$val['0']:$data['cncuse']='0';
        $val['1'] ? $data['easy']=$val['1']:$data['easy']='0';
        $val['2'] ? $data['Knowledge']=$val['2']:$data['Knowledge']='0';

        if($val['0']){
            $where['cncuse']= $val['0'];
        }
        if($val['1']){
            $where['easy']= $val['1'];
        }
        if($val['2']){
            $like=explode('|',$val['2']);
            $likes="%";
            for($i=0;$i<count($like);$i++){
                if($like[$i]>0){
                    $likes.=','.$like[$i].','.'%';
                }
            }
        }


        if($request->get('keyword')){
            if($val['2']) {
                $data['question'] = $question->where($where)->where('Knowledge', 'LIKE', $likes)->where('title','LIKE','%'.$request->get('keyword').'%')->orderby('id', 'desc')->paginate(15);
            }else{
                $data['question'] = $question->where($where)->where('title','LIKE','%'.$request->get('keyword').'%')->orderby('id', 'desc')->paginate(15);
            }
        }else{
            if($val['2']) {
                $data['question'] = $question->where($where)->where('Knowledge', 'LIKE', $likes)->orderby('id', 'desc')->paginate(15);
            }else{
                $data['question'] = $question->where($where)->orderby('id', 'desc')->paginate(15);
            }
        }
        $data['page']=array('title'=>$this->cncType['name'].'试题管理');

        $data['cncType']=$this->cncType;
        $data['project']=$data['cncType']['id'];
        $projectid=NcGetType($data['project']);
        $Knowledge=NcGetType($projectid[0]['id'],'4');
        $data['pids']='52,81,'.$Knowledge['id'];

        //获得所需分类
        $data['cate']=NcGetType('1');
        $i=1;

        foreach ( $data['cate'] as $list){
            if($list['id']=='51'){
                $projectid=NcGetType($data['project']);
                $select[$i]=$projectid[0]['id'];
                $getcate[$i]='0';
                $data['cate'][0]=NcGetType($projectid[0]['id'],'4');
            }else{
                $select[$i]=$list['id'];
                $getcate[$i]='0';
            }
            $i++;
        }

        $data['type']=$data['cncuse'].','.$data['easy'].','.$data['Knowledge'];
        $data['select']=$data['cate'];
        $data['cate']=implode(',',$select);
        $data['getcate']=implode(',',$getcate);
        $data['selecturl']='/'.$this->path.'/QuestionsSelect';
        $data['pages']=$request->get('page');
        $data['keyword']=$request->get('keyword');
        $data['url']='/'.$this->path;
        $data['addurl']='/'.$this->path.'/add';
        return view('admin.questions.index',['data'=>$data]);
    }

    public function add(Request $request){

        $data['page']=array('title'=>$this->cncType['name'].'试题管理 - 添加试题');
        //获得所需分类
        $data['cate']=NcGetType('1');
        $i=1;
        $data['cncType']=$this->cncType;
        $data['project']=$data['cncType']['id'];

        foreach ( $data['cate'] as $list){
            if($list['id']=='51'){
                $projectid=NcGetType($data['project']);
                $select[$i]=$projectid[0]['id'];
                $getcate[$i]='0';

                $data['cate'][0]=NcGetType($projectid[0]['id'],'4');;
            }else{
                $select[$i]=$list['id'];
                $getcate[$i]='0';
            }
            $i++;
        }
        $data['select']=$data['cate'];
        $data['cate']=implode(',',$select);
        //MM($data['cncType']);
        $data['getcate']=implode('|',$getcate);
        $data['addurl']='/'.$this->path.'/add';
        $data['selecturl']='/'.$this->path.'/QuestionsSelect';
        $data['QuestionsInsert']='/'.$this->path.'/QuestionsInsert';
        $data['url']='/'.$this->path;

        return view('admin.questions.add',['data'=>$data]);
    }

    public function edit(Request $request){
        $question = new \App\question();
        $data['question'] = $question->find($request->get('id'));
        if(empty($data['question']['id'])){
            return redirect('/prompt')->with(['message' => '数据不存在', 'url' => $this->path, 'jumpTime' => 2, 'status' => '#ff6600']);
        }
        $data['page']=array('title'=>$this->cncType['name'].'试题管理 - 添加试题');
        //获得所需分类
        $data['cate']=NcGetType('1');
        $i=1;
        $data['cncType']=$this->cncType;
        $data['project']=$data['cncType']['id'];

        foreach ( $data['cate'] as $list){
            if($list['id']=='51'){
                $projectid=NcGetType($data['project']);
                $select[$i]=$projectid[0]['id'];
                $getcate[$i]='0';

                $data['cate'][0]=NcGetType($projectid[0]['id'],'4');;
            }else{
                $select[$i]=$list['id'];
                $getcate[$i]='0';
            }
            $i++;
        }
        $data['select']=$data['cate'];
        $data['cate']=implode(',',$select);
        //MM($data['cncType']);
        $data['getcate']=$data['question']['Knowledge'].'|'.$data['question']['cncuse'].'|'.$data['question']['easy'];
        $data['pids']='39';
        $data['addurl']='/'.$this->path.'/add';
        $data['selecturl']='/'.$this->path.'/QuestionsSelect';
        $data['QuestionsUpdate']='/'.$this->path.'/QuestionsUpdate';
        $data['url']='/'.$this->path;

        return view('admin.questions.edit',['data'=>$data]);
    }
    public function QuestionsSelect(Request $request){
        $cate=explode(',',$request->input('cage'));
        $getcate=explode('|',$request->input('getcate'));
        $arr=array();
        for ($i=0;$i<count($cate);$i++){
            $arr['cate'.$cate[$i]]=NcGetTypeNews($cate[$i],'5',$getcate[$i]);
        }
        return $arr;
    }
    public function QuestionsSelects(Request $request){
        $arr['html']=NcGetTypeNews($request->input('id'),'6',$request->input('type'));
        return $arr;
    }
    public function QuestionsSelectss(Request $request){

        $id=explode(',',$request->input('id'));
        $type=explode(',',$request->input('type'));

        $arr['cncuse']=NcGetTypeNews($id['0'],'10',$type['0']);
        $arr['easy']=NcGetTypeNews($id['1'],'10',$type['1']);
        $arr['Knowledge']=NcGetTypeNews($id['2'],'10',$type['2']);

        return $arr;
    }
    //资讯信息添加
    public function QuestionsInsert(Request $request){

        $re =    $this->validate($request, [
            'questions-title' => 'required|min:5|max:150',
            'questions-type81' => 'required|integer|min:1|max:99',
            'questions-type52' => 'required|integer|min:1|max:99',
        ],['required'=>':attribute ',
            'max'=>':attribute ',
            'min'=>':attribute ',
        ],['questions-title' => '标题长度输入有误，5-150个字符',
            'questions-type81' => '请选择试题难度',
            'questions-type52' => '请选择试题用途分类',
           ]);
        $question = new \App\question();
        foreach($request->input() as $key=>$val){
            $str = str_replace("'","",$key );
            if($str!='_token'){
                $str = str_replace("'","",$key );
                $str = str_replace("questions-","",$str );
                if($str=='url'){
                $url=$val;
                }elseif($str=='type81'){
                    $question->easy=$val;
                }elseif($str=='type52'){
                    $question->cncuse=$val;
                }elseif($str=='Knowledge'){
                    $question->Knowledge=',,,'.implode(',,,',$val).',,,';
                }else{
                    $question->$str=$val;
                }
            }}
        $file=$request->file('questions-images');
        $time=time();
        if($file){
            $store_result = $file->storeAs('questions/'.date('ymd'),$time.rand(10,10000).'.png');
            $question->images=$store_result;
        }



        if($question->save()){
           // $list = $gage->findOrFail(1);
            return redirect('/prompt')->with(['message' => '添加成功', 'url' => $this->path, 'jumpTime' => 3, 'status' => '43AEFA']);
        }else{
            return redirect('/prompt')->with(['message' => '添加失败', 'url' => $this->path.'/questionsadd', 'jumpTime' => 2, 'status' => '#ff6600']);
        }

    }
    //资讯信息修改
    public function QuestionsUpdate(Request $request){
        $re =    $this->validate($request, [
            'questions-title' => 'required|min:5|max:150',
            'questions-type81' => 'required|integer|min:1|max:99',
            'questions-type52' => 'required|integer|min:1|max:99',
        ],['required'=>':attribute ',
            'max'=>':attribute ',
            'min'=>':attribute ',
        ],['questions-title' => '标题长度输入有误，5-150个字符',
            'questions-type81' => '请选择试题难度',
            'questions-type52' => '请选择试题用途分类',
        ]);
        $question = new \App\question();
        $list = $question->find($request->input('id'));
        if(empty($list['id'])){
            return redirect('/prompt')->with(['message' => '数据不存在', 'url' => $this->path, 'jumpTime' => 2, 'status' => '#ff6600']);
        }

        foreach($request->input() as $key=>$val){
            $str = str_replace("'","",$key );
            if($str!='_token'){
                $str = str_replace("'","",$key );
                $str = str_replace("questions-","",$str );
                if($str=='url'){
                    $url=$val;
                }elseif($str=='type81'){
                    $list->easy=$val;
                }elseif($str=='type52'){
                    $list->cncuse=$val;
                }elseif($str=='Knowledge'){
                    $list->Knowledge=',,,'.implode(',,,',$val).',,,';
                }else{
                    $list->$str=$val;
                }
            }}
        $file=$request->file('questions-images');
        $time=time();
        if($file){
            $store_result = $file->storeAs('questions/'.date('ymd'),$time.rand(10,10000).'.png');
            $list->images=$store_result;
        }else{
            $list->images=$list['images'];
        }


        if($list->save()){
            return redirect('/prompt')->with(['message' => '编辑成功', 'url' => $this->path.'/questionsedit?id='.$list['id'], 'jumpTime' => 3, 'status' => '43AEFA']);
        }else{
            return redirect('/prompt')->with(['message' => '编辑失败', 'url' => $this->path.'/questionsedit?id='.$list['id'], 'jumpTime' => 2, 'status' => '#ff6600']);
        }

    }
    //资讯删除
    public function QuestionsDel(Request $request){
        $question = new \App\question();
        //拆散POST字符串为数组
        $arr=$request->input('id');
        $arr=NcGetArray($arr);

        $subjects = new \App\subject();
        $model =  $subjects->whereIn('qid',$arr)->count();



            if($model<1){
                //全部可以删除
                $rs=$question->destroy($arr);
            }else{
                $rs='';
            }


            if($rs){
                $arr['text']="试题删除成功！";
                $arr['url']=$request->input('url');
            }else{
                $arr['text']="您要删除的试题，已经设置题目，请先删除题目！";
            }
        return $arr;
    }


    //题目管理
    public function subject(Request $request){

        $data['cncType']=$this->cncType;
        $where=array();
        $where['qid']= $request->input('id');
        $subject = new \App\subject();
        $data['subject']=$subject->where($where)->orderby('sort','asc')->orderby('id','desc')->paginate(15);
        $question = new \App\question();
        $questiondata = $question->find($request->input('id'));
        if(empty($questiondata['id'])){
            return redirect('/prompt')->with(['message' => '数据不存在', 'url' => $this->path, 'jumpTime' => 2, 'status' => '#ff6600']);
        }
        $val=$request->get('val');
        $type=$request->get('type');
        if($val==''){
            $val='0,0,0';
        }
        if($type==''){
            $type='0,0,0';
        }
        $val=explode(',',$val);
        $type=explode(',',$type);
        $val['0'] ? $data['cncuse']=$val['0']:$data['cncuse']='0';
        $val['1'] ? $data['easy']=$val['1']:$data['easy']='0';
        $val['2'] ? $data['Knowledge']=$val['2']:$data['Knowledge']='0';
        $data['type']=$data['cncuse'].','.$data['easy'].','.$data['Knowledge'];

        $data['questiondata']=$questiondata;
        $data['page']=array('title'=>$questiondata->title.' 题目管理');

        $data['cncType']=$this->cncType;
        $data['project']=$data['cncType']['id'];
        $projectid=NcGetType($data['project']);
        $Knowledge=NcGetType($projectid[0]['id'],'4');
        $data['pids']='52,'.'81,'.$Knowledge['id'];
        $data['pages']=$request->get('page');
        $data['qid']=$questiondata->id;
        $data['url']='/'.$this->path;
        $data['addurl']='/'.$this->path.'/add';
        return view('admin.questions.subject',['data'=>$data]);
    }
    //题目管理
    public function subjectedit(Request $request){

        $data['cncType']=$this->cncType;
        $where=array();
       // $where['qid']= $request->input('qid');
        $subject = new \App\subject();
        $subjectdata = $subject->find($request->input('sid'));
        $question = new \App\question();
        $questiondata = $question->find($request->input('qid'));
        $standard = new \App\subject_standard();
        $measure = new \App\subject_measure();


        $where['sid']=$request->input('sid');
        $orderby['sort']='desc';
        $orderby['id']='desc';
        $data['standard']=$standard->where('sid',$request->input('sid'))->orderby('sort','asc')->orderby('id','desc')->get();//paginate(15);
       // MM($data['standard']);


        foreach ($data['standard'] as $vol){
            $data['measure'.$vol['id']]=$measure->where('ssid',$vol['id'])->orderby('sort','asc')->orderby('id','desc')->get();
        }


        $data['subject']=$subjectdata;
        $data['question']=$questiondata;
        if(empty($questiondata['id'])){
            return redirect('/prompt')->with(['message' => '数据不存在', 'url' => $this->path, 'jumpTime' => 2, 'status' => '#ff6600']);
        }

        $data['page']=array('title'=>$questiondata->title.' - '.$data['subject']['title'].' 详细题目管理');
        $data['pids']='52';
        $data['pages']=$request->get('page');
        $data['qid']=$request->input('qid');
        $data['sid']=$request->input('sid');
        $data['url']='/'.$this->path;
        $data['addurl']='/'.$this->path.'/add';
        $data['aspecttype']='';
        $data['measuretype']='';
        $data['aspecttypeid']='65';
        $data['measuretypeid']='60';
        return view('admin.questions.subjectedit',['data'=>$data]);
    }
    //题目管理添加
    public function SubjectInsert(Request $request){

        $question = new \App\question();
        $questiondata = $question->find($request->input('qid'));
        if(empty($questiondata['id'])){
            return redirect('/prompt')->with(['message' => '数据不存在', 'url' => $this->path.'/subject?id='.$request->input('qid'), 'jumpTime' => 2, 'status' => '#ff6600']);
        }
        $subject = new \App\subject();
        foreach($request->input() as $key=>$val){
            $str = str_replace("'","",$key );
            if($str!='_token'){
                $str = str_replace("'","",$key );
                $str = str_replace("subject-","",$str );
                $subject->$str=$val;
            }}
       $file=$request->file('subject-pdf');
        $time=time();
        if($file){
            $store_result = $file->storeAs('subject/'.date('ymd'),$time.rand(10,10000).'.pdf');
            $subject->pdf=$store_result;
        }


        if($subject->save()){
            // $list = $gage->findOrFail(1);
            return redirect('/prompt')->with(['message' => '添加成功', 'url' => $this->path.'/subject?id='.$request->input('qid'), 'jumpTime' => 3, 'status' => '43AEFA']);
        }else{
            return redirect('/prompt')->with(['message' => '添加失败', 'url' => $this->path.'/subject?id='.$request->input('qid'), 'jumpTime' => 2, 'status' => '#ff6600']);
        }

    }
    //题目管理添加
    public function SubjectUpdate(Request $request){

        $question = new \App\question();
        $questiondata = $question->find($request->input('qid'));
        if(empty($questiondata['id'])){
            return redirect('/prompt')->with(['message' => '数据不存在', 'url' => $this->path.'/subject?id='.$request->input('qid'), 'jumpTime' => 2, 'status' => '#ff6600']);
        }
        $subject = new \App\subject();

        $subject=$subject->find($request->input('id'));

        foreach($request->input() as $key=>$val){
            $str = str_replace("'","",$key );
            if($str!='_token'){
                $str = str_replace("'","",$key );
                $str = str_replace("subject-","",$str );
                $subject->$str=$val;
            }}

        $file=$request->file('subject-pdf');
        $time=time();
        if($file){
            $store_result = $file->storeAs('subject/'.date('ymd'),$time.rand(10,10000).'.pdf');
            $subject->pdf=$store_result;
        }
        $url = $this->path.'/subjectedit?sid='.$request->input('id').'&qid='.$request->input('qid');

        if($subject->save()){
            // $list = $gage->findOrFail(1);
            return redirect('/prompt')->with(['message' => '编辑成功', 'url' => $url, 'jumpTime' => 3, 'status' => '43AEFA']);
        }else{
            return redirect('/prompt')->with(['message' => '添加失败', 'url' => $url, 'jumpTime' => 2, 'status' => '#ff6600']);
        }

    }
    //测评标准添加
    public function StandardsInsert(Request $request){
        $re =    $this->validate($request, [
            'title' => 'required|min:3|max:50',
            'scores' => 'required|integer|min:1|max:100',
        ],['required'=>' 必填项',
            'max'=>' 输入长度不符合要求',
            'min'=>' 输入长度不符合要求',
            'pid'=>' 必须是整数',
            'sequence'=>' 必须是整数',
        ]);
        $standard= new \App\subject_standard();

        if($request->input('id')!=0 ){
            $standard=$standard->where('id',$request->input('id'))->first();

        }
        foreach($request->input() as $key=>$val){
            $str = str_replace("'","",$key );
            if($str!='_token'){
                $standard->$str=$val;
            }}
        if($standard->save()){
            if($request->input('id')==0 ) {
                $standarddate = $standard->orderBy('id', 'desc')->first();
                $arr = array();
                $arr['html'] = "<div id=\"bz" . $standarddate['id'] . "\">
                    <div class=\"biaozhun\" id=\"biaozhun\">
                     <div class=\"left\" style=\"width:40px\"><input type=\"text\" class=\"tpl-form-input\" id=\"StandardsSort" . $standarddate['id'] . "\"  name=\"questions-title\" value=\"" . $standarddate['sort'] . "\" style=\"font-size: 12px;width: 30px;height: 22px;line-height: 18px; text-align: center; border:#9BA2AB 1px double\"></div>
                        <div class=\"left\">" . $standarddate['title'] . "（分值" . $standarddate['scores'] . "）</div>
                        <div class=\"right\"><span style=\" cursor: pointer\" onclick=\"StandardsEdit('" . $standarddate['id'] . "')\">编辑</span> | <span style=\" cursor: pointer\" onclick=\"StandardsDel('" . $standarddate['id'] . "')\">删除</span> | <span style=\" cursor: pointer\" onclick=\"measureAdd('" . $standarddate['id'] . "')\">增加测量内容</span>  | <span style=\" cursor: pointer\" onclick=\"MeasureSort('" . $standarddate['id'] . "')\">更新排序</span></div>
                    </div>
                       <div class=\"biaozhunlist\" id=\"biaozhunlist".$standard['id']."\" style=\"display: none\">
                         <li style=\" width: 8%;\">Number<br/>排序</li>
                         <li style=\" width: 10%;\">AspectType<br/>类型</li>
                         <li style=\" width: 14%;\">Aspect - Description<br/>考核内容及要求</li>
                         <li style=\" width: 25%;\">Requirement or Nominal Size<br/>标准尺寸</li>
                        <li style=\" width: 22%;\">Add - (Extra Aspect Information)<br/>附加内容</li>
                         <li style=\" width: 10%;\">Max Mark<br/>满分/配分</li>
                        <li style=\" width: 9%; border-right:0px\">Operation<br/>操作</li>
                       </div>";
                $arr['id'] = 1;
            }else{
                $standarddate = $standard->where('id',$request->input('id'))->first();
                $arr = $standarddate;
                //$arr['id'] = 2;
            }
        }else{
            $arr = ["id"=>"0"];
        }

        return $arr;

    }
    //ajax获取数据
    public function standards(Request $request){
        $Subject_standard = new \App\Subject_standard();
        $arr=$Subject_standard->where('id', $request->get('id'))->first();
        return $arr;

    }
    //测评标准添加
    public function MeasuresInsert(Request $request){
        $re =    $this->validate($request, [
            'aspectdescription' => 'required|max:30',
            'aspectsize' =>'required|numeric',
            'aspecterrora' =>'required|numeric',
            'aspecterrorb' =>'required|numeric',
            'aspectadd' => 'required|min:0|max:80',
            'maxmark' => 'required|numeric|min:0|max:500'
        ],[ 'required'=>' 必填项！',
            'max'=>' 输入长度不符合要求！',
            'min'=>' 输入长度不符合要求！',
            'pid'=>' 必须是整数！',
            'sequence'=>' 必须是整数！',
            'numeric'=>' 必须是数字！',
        ]);
        $measure= new \App\subject_measure();
        if($request->input('id')!=0 ){
            $measure=$measure->where('id',$request->input('id'))->first();

        }
        foreach($request->input() as $key=>$val){
            $str = str_replace("'","",$key );
            if($str!='_token'){
                $measure->$str=$val;
            }}
        if($measure->save()){
            if($request->input('id')==0 ) {
                $measuredata = $measure->where('ssid', $request->input('ssid'))->orderBy('id', 'desc')->first();
                $arr = array();
                $arr['html'] = "<div class=\"biaozhunlists\" id=\"biaozhunlists".$measuredata['id']."\">
                            <li style=\" width: 8%; text-align: center\">". $measuredata['sort']."</li>
                            <li style=\" width: 10%;\">". NcGetType($measuredata['aspecttype'],'2')."</li>
                            <li style=\" width: 14%;\">".$measuredata['aspectdescription']."</li>
                            <li style=\" width: 25%;\">".$measuredata['aspectsize']."（偏差值：". $measuredata['aspecterrora']."，". $measuredata['aspecterrorb']."）</li>
                            <li style=\" width: 22%;\">". $measuredata['aspectadd']."</li>
                            <li style=\" width: 10%;\">". $measuredata['maxmark']."</li>
                            <li style=\" width: 9%; border-right:0px\"><span style=\" cursor: pointer; color:#be590a \" onclick=\"MeasureEdit('". $measuredata['id']."')\">编辑</span></li>
                        </div>";
                $arr['ssid']=$request->input('ssid');
                $arr['id'] = 1;
            }else{
                $measuredata = $measure->where('id', $request->input('id'))->orderBy('id', 'desc')->first();
                $arr = array();
                $arr['html'] = "<div class=\"biaozhunlists\" id=\"biaozhunlists".$measuredata['id']."\">
                             <li style=\" width: 8%; text-align: center\"><input type=\"text\" class=\"tpl-form-input\" id=\"MeasureSort".$measuredata['id']."\"  name=\"questions-title\" value=\"".$measuredata['sort']."\" style=\"font-size: 12px;width: 30px;height: 22px;line-height: 18px; text-align: center; border:#9BA2AB 1px double\"></li>
                            <li style=\" width: 10%;\">". NcGetType($measuredata['aspecttype'],'2')."</li>
                            <li style=\" width: 14%;\">".$measuredata['aspectdescription']."</li>
                            <li style=\" width: 25%;\">".$measuredata['aspectsize']."（偏差值：". $measuredata['aspecterrora']."，". $measuredata['aspecterrorb']."）</li>
                            <li style=\" width: 22%;\">". $measuredata['aspectadd']."</li>
                            <li style=\" width: 10%;\">". $measuredata['maxmark']."</li>
                            <li style=\" width: 9%; border-right:0px\"><span style=\" cursor: pointer; color:#be590a \" onclick=\"MeasureEdit('". $measuredata['id']."')\">编辑</span> | <span style=\" cursor: pointer; color:#be590a \" onclick=\"MeasureDel('". $measuredata['id']."')\">删除</span></li></li>
                        </div>";
               $arr['id']=$measuredata['id'];
                //$arr['id'] = 1;
                //$arr['id'] = 2;
            }
        }else{
            $arr = ["id"=>"0"];
        }

        return $arr;

    }

    //ajax获取数据
    public function measures(Request $request){
        $Subject_measure = new \App\Subject_measure();
        $arr=$Subject_measure->where('id', $request->get('id'))->first();

        $arr['aspecttype']=NcGetTypeNews('65','7',$arr['aspecttype']);
        $arr['measuretype']=NcGetTypeNews('60','8',$arr['measuretype']);

        return $arr;

    }
    //ajax更新题目排序
    public function SubjectsSort(Request $request){
        $Subject = new \App\Subject();
        $id = str_replace("sort","",$request->input('id') );
        $val=$request->input('val');

        $idarr=explode(',',$id);
        $valarr=explode(',',$val);

        for ($i=0;$i<count($idarr);$i++){
            $Subject->where('id',$idarr[$i])->update(['sort' => $valarr[$i]]);
        }

       // MM($idarr);
        $arr['id']='1';
        $arr['qid']=$request->input('getid');
        return $arr;

    }
    //ajax更新测量标准排序
    public function StandardsSort(Request $request){
        $subject_standard = new \App\subject_standard();
        $id = str_replace("StandardsSort","",$request->input('id') );
        $val=$request->input('val');

        $idarr=explode(',',$id);
        $valarr=explode(',',$val);

        for ($i=0;$i<count($idarr);$i++){
            $subject_standard->where('id',$idarr[$i])->update(['sort' => $valarr[$i]]);
        }

        // MM($idarr);
        $arr['id']='1';
        return $arr;

    }

    //ajax更新测量标准排序
    public function MeasureSort(Request $request){
        $measure= new \App\subject_measure();
        $id = str_replace("MeasureSort","",$request->input('id') );
        $val=$request->input('val');

        $idarr=explode(',',$id);
        $valarr=explode(',',$val);

        for ($i=0;$i<count($idarr);$i++){
            $measure->where('id',$idarr[$i])->update(['sort' => $valarr[$i]]);
        }


        $measures= $measure->where('ssid', $request->input('ssid'))->orderby('sort','asc')->orderby('id','desc')->get();
        $arr = array();
        $html='';
        foreach ($measures as $measuredata){
        $html.= "<div class=\"biaozhunlists biaozhunlists".$measuredata['ssid']."\" id=\"biaozhunlists".$measuredata['id']."\">
                            <li style=\" width: 8%; text-align: center\"><input type=\"text\" class=\"tpl-form-input\" id=\"MeasureSort".$measuredata['id']."\"  name=\"questions-title\" value=\"".$measuredata['sort']."\" style=\"font-size: 12px;width: 30px;height: 22px;line-height: 18px; text-align: center; border:#9BA2AB 1px double\"></li>
                            <li style=\" width: 10%;\">".NcGetType($measuredata['aspecttype'],'2')."</li>
                            <li style=\" width: 14%;\">".$measuredata['aspectdescription']."</li>
                            <li style=\" width: 25%;\">".$measuredata['aspectsize']."（偏差值：". $measuredata['aspecterrora']."，". $measuredata['aspecterrorb']."）</li>
                            <li style=\" width: 22%;\">".$measuredata['aspectadd']."</li>
                            <li style=\" width: 10%;\">".$measuredata['maxmark']."</li>
                            <li style=\" width: 9%; border-right:0px\"><span style=\" cursor: pointer; color:#be590a \" onclick=\"MeasureEdit('". $measuredata['id']."')\">编辑</span></li>
                        </div>";
        }
        $arr['ssid']=$request->input('ssid');
        $arr['html']=$html;
        $arr['id'] = 1;

        return $arr;

    }

    //测量内容删除
    public function MeasureDel(Request $request){
        $measure= new \App\subject_measure();
        $rs=$measure->destroy($request->input('id'));
        if($rs){
            $arr['text']="资讯删除成功！";
            $arr['id']=$request->input('id');
        }else{
            $arr['text']="资讯删除失败！-1";
        }
        return $arr;
    }
    //测量标准删除
    public function StandardsDel(Request $request){
        $measure= new \App\subject_measure();

        $measures= $measure->where('ssid', $request->input('id'))->orderby('sort','asc')->orderby('id','desc')->get();

        if(count($measures)>0){
            $arr['id']="0";
        }else{
            $subject_standard = new \App\subject_standard();
            $rs=$subject_standard->destroy($request->input('id'));
            if($rs){
                $arr['text']="资讯删除成功！";
                $arr['id']=$request->input('id');
            }else{
                $arr['text']="资讯删除失败！-1";
            }
        }
        return $arr;
    }
    //测量标准删除
    public function SubjectsDel(Request $request){
        $standard= new \App\subject_standard();

        $measures= $standard->where('sid', $request->input('id'))->orderby('sort','asc')->orderby('id','desc')->get();

        if(count($measures)>0){
            $arr['id']="0";
        }else{
            $subjects = new \App\subject();
            $rs=$subjects->destroy($request->input('id'));
            if($rs){
                $arr['text']="资讯删除成功！";
                $arr['id']=$request->input('id');
            }else{
                $arr['text']="资讯删除失败！-1";
            }
        }
        return $arr;
    }

    //组合工件试题选择（单工件试题）
    public function combination(Request $request){

        $question = new \App\question();


        $questions = DB::table('questions')
            ->select('questions.*', 'subjects.id as s_id')
            ->join('subjects', 'questions.id', '=', 'subjects.qid')
            ->get();
        MM($questions);
    }

    public function CombinationHtml(Request $request){

        $questions = new \App\question();
        $key = explode("/",$this->path);
        $data['cncType']=$this->cncType;
        $where=array();
        if($key['2']=='CncMilling'){
            $where['project']= $data['cncType']['id'];
        }elseif($key['2']=='CncCar'){
            $where['project']= $data['cncType']['id'];
        }elseif($key['2']=='CncUse'){
            $where['project']= $data['cncType']['id'];
        }
        $val=$request->get('val');
        $type=$request->get('type');
        if($val==''){
            $val='0,0';
        }
        if($type==''){
            $type='0,0';
        }
        $val=explode(',',$val);
        $type=explode(',',$type);


        $val['0'] ? $data['easy']=$val['0']:$data['easy']='0';
        $val['1'] ? $data['Knowledge']=$val['1']:$data['Knowledge']='0';


        $where['cncuse']= '59';

        if($val['0']){
            $where['easy']= $val['0'];
        }
        if($val['1']){
            $like=explode('|',$val['1']);
            $likes="%";
            for($i=0;$i<count($like);$i++){
                if($like[$i]>0){
                    $likes.=','.$like[$i].','.'%';
                }
            }
        }


        if($request->get('keyword')){
            if($val['1']) {
                $data['question'] = DB::table('questions')
                    ->select('questions.*', 'subjects.id as sid', 'subjects.title as stitle', 'subjects.pdf')
                    ->join('subjects', 'questions.id', '=', 'subjects.qid')
                    ->where($where)->where('questions.Knowledge', 'LIKE', $likes)
                    ->where('questions.title','LIKE','%'.$request->get('keyword').'%')
                    ->orderby('questions.id', 'desc')->get();
            }else{
                $data['question'] = DB::table('questions')
                    ->select('questions.*', 'subjects.id as sid', 'subjects.title as stitle', 'subjects.pdf')
                    ->join('subjects', 'questions.id', '=', 'subjects.qid')
                    ->where($where)
                    ->where('questions.title','LIKE','%'.$request->get('keyword').'%')
                    ->orderby('questions.id', 'desc')->get();
            }
        }else{
            if($val['1']) {
                $data['question'] = DB::table('questions')
                    ->select('questions.*', 'subjects.id as sid', 'subjects.title as stitle', 'subjects.pdf')
                    ->join('subjects', 'questions.id', '=', 'subjects.qid')
                    ->where($where)
                    ->where('questions.Knowledge', 'LIKE', $likes)
                    ->orderby('questions.id', 'desc')->get();
            }else{
                $data['question'] = DB::table('questions')
                    ->select('questions.*', 'subjects.id as sid', 'subjects.title as stitle', 'subjects.pdf')
                    ->join('subjects', 'questions.id', '=', 'subjects.qid')
                    ->where($where)
                    ->orderby('questions.id', 'desc')
                    ->get();
            }
        }
        $arrid = $questions->find($request->input('id'));
        $CombinationHtml='';
        $combination=array();
        if($arrid->combination) {
            $combination = explode(',', $arrid->combination);
        }
        if($request->input('type')){
        $types=NcGetArray($request->input('type'));
        $combination=$types;
    }
        $checked='';
        foreach ($data['question'] as $question){
            if($combination[0]) {

                if(in_array($question->id,$combination)){
                $checked="checked=\"checked\"";
                }else{
                $checked='';
                }}

            $CombinationHtml.="     <tr id=\"tr".$question->id."\">
                            <td style=\"text-align: center\"><input id=\"vol".$question->id."\" type=\"checkbox\" name=\"subBox\" ".$checked." value=\"".$question->id."\" onclick=\"CombinationSelect('".$question->id."')\"></td>
                            <td>".$question->id."</td>
                            <td>".$question->title."（零件：".$question->stitle."）</td>
                            <td>".$question->updated_at."</td>
                            <td><a href=\"/upload/".$question->pdf."\" target='_blank'><i class=\"fab am-icon-wpforms\"></i></a></td>
                        </tr>";
        }
        $CombinationHtmlSelect='';
        $CombinationHtmlSelects='';

        if($arrid->combination){
            $combination=explode(',',$arrid->combination);
            $questiondata=DB::table('questions')
                ->select('questions.*', 'subjects.id as sid', 'subjects.title as stitle', 'subjects.pdf')
                ->join('subjects', 'questions.id', '=', 'subjects.qid')
                ->whereIn('questions.id',$combination)
                ->orderby('questions.id', 'desc')
                ->get();
            foreach ($questiondata as $question){
                $CombinationHtmlSelect.="     <tr id=\"trs".$question->id."\">
                            <td style=\"text-align: center\"><input id=\"vol".$question->id."\" type=\"checkbox\" name=\"subBox\" checked=\"checked\" value=\"".$question->id."\" onclick=\"CombinationSelects('".$question->id."')\"></td>
                            <td>".$question->id."</td>
                            <td>".$question->title."（零件：".$question->stitle."）</td>
                            <td>".$question->updated_at."</td>
                            <td><a href=\"/upload/".$question->pdf."\" target='_blank'><i class=\"fab am-icon-wpforms\"></i></a></td>
                        </tr>";
            }

            foreach ($questiondata as $question){
                $CombinationHtmlSelects.="     <tr id=\"trsS".$question->id."\">
                            <td style=\"text-align: center\"></td>
                            <td>".$question->id."</td>
                            <td>".$question->title."（零件：".$question->stitle."）</td>
                            <td>".$question->updated_at."</td>
                            <td><a href=\"/upload/".$question->pdf."\" target='_blank'><i class=\"fab am-icon-wpforms\"></i></a></td>
                        </tr>";
            }

        }
        $arr['CombinationHtml']=$CombinationHtml;
        $arr['CombinationHtmlSelect']=$CombinationHtmlSelect;
        $arr['CombinationHtmlSelects']=$CombinationHtmlSelects;
        return $arr;
        //MM($CombinationHtml);

    }

    //组合工件关联
    public function CombinationInsert(Request $request){

        $question= new \App\question();
        if($request->input('id')!=0 ){
            $question=$question->where('id',$request->input('id'))->first();
        }


        $combination=NcGetArray($request->input('combination'));
        $combination=implode(',',$combination);
        $question->combination = $combination;

        if($question->save()){
            $arr = ["id"=>"1"];
        }else{
            $arr = ["id"=>"0"];
        }

        return $arr;

    }

}