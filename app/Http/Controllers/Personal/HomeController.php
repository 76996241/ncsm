<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Validation\Validator;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['login']='1';//登录状态
        $data=array();
        $data['pids']=array('81','70','71');
        $data['key']=array("11","11","11");
        $data['type']=array("0","0","0");
        $data['difficult']=NcGetTypeNews($data['pids']['0'],$data['key']['0'],$data['type']['0']);
        $data['car']=NcGetTypeNews($data['pids']['1'],$data['key']['1'],$data['type']['1']);
        $data['milling']=NcGetTypeNews($data['pids']['2'],$data['key']['2'],$data['type']['2']);

        $data['title']='个人模块 - '.$this->system["systems_name"];
        $data['description']=$this->system["systems_description"];
        $data['keywords']=$this->system["systems_keyword"];
        $data['systems_01']=$this->system["systems_01"];
        $data['systems_02']=$this->system["systems_02"];
        return view('personal.index.index',['data'=>$data]);
    }

    public function Page2(Request $request)
    {
        $arr['login']='1';
        $where['easy']= $request->input('difficultid');
        $where['cncuse']= $request->input('cncuseid');
        $where['project']= $request->input('Knowledgeid');
        $like=NcGetArray($request->input('selectid'));
        $likes="%";
        for($i=0;$i<count($like);$i++){
            if($like[$i]>0){
                $likes.=','.$like[$i].','.'%';
            }
        }


        $data['question'] = DB::table('questions')
            ->select('questions.*', 'subjects.id as sid', 'subjects.title as stitle', 'subjects.pdf')
            ->join('subjects', 'questions.id', '=', 'subjects.qid')
            ->where($where)
            ->where('questions.Knowledge', 'LIKE', $likes)
            ->orderby('questions.id', 'desc')
            ->get();
        $html='';
        $subject_measure= new \App\subject_measure();
        foreach ($data['question'] as $question){

            $count = $subject_measure->where('sid', $question->sid)->count();
            if($count>0) {
                if ($request->input('cncuseid') == 59) {
                    $html .= "<tr class='question'><td style=\"text-align: center\"><input type=\"checkbox\" name=\"subBox\" value=\"" . $question->id . "\"></td>
                  <td>" . $question->id . "</td>
                  <td>" . $question->title . "</td>
                  <td>" . $question->stitle . "</td>
                  <td>" . str_limit($question->created_at, 10, '') . "</td>
                  <td style=\"text-align: center\"><span class=\"glyphicon glyphicon-picture\" onclick=\"Measurepdf('" . $question->sid . "')\" style=\" cursor: pointer\" ></span></td>
                  </tr>";
                }

                if ($request->input('cncuseid') == 89) {
                    $html .= "<tr class='question'><td style=\"text-align: center\"><input type=\"radio\" name=\"subBox\" value=\"" . $question->id . "\"></td>
                  <td>" . $question->id . "</td>
                  <td>" . $question->title . "</td>
                  <td>" . $question->stitle . "</td>
                  <td>" . str_limit($question->created_at, 10, '') . "</td>
                  <td style=\"text-align: center\"><span class=\"glyphicon glyphicon-picture\" onclick=\"Measurepdf('" . $question->sid . "')\" style=\" cursor: pointer\" ></span></td>
                  </tr>";
                }
            }
        }
        $arr['html']=$html;
        return $arr;
    }

    public function TrainAdd(Request $request)
    {
        $arr['login']='1';//登录状态
        //  $where['choiceid']= $request->input('choiceid');
        $like=NcGetArray($request->input('choiceid'));
        $likes='';
        for($i=0;$i<count($like);$i++){
            if($like[$i]>0){
                $likes.=','.$like[$i].',';
            }
        }
        $train= new \App\train();
        $train->title= date('Y-m-d H:i:s',time()).' 创建的训练';
        $train->type='91';
        $train->combination=$request->input('combination');
        $train->choice=$likes;

        if($train->save()){
            $where['source']='1';
            $where['uid']=Auth::user()->id;
            $traindata = $train->where($where)->orderBy('id', 'desc')->get();
            //当前用户有未完成的训练
            if(count($traindata)>0){
                $traindata=$traindata['0'];
                if($traindata['combination']=='89'){
                    //获得组合零件
                    $like=array_filter(NcGetArray($traindata->choice));//去空数组
                    $data['question'] = DB::table('questions')
                        ->select('questions.*', 'subjects.id as sid', 'subjects.title as stitle', 'subjects.pdf')
                        ->join('subjects', 'questions.id', '=', 'subjects.qid')
                        ->whereIn('questions.id', $like)
                        ->orderby('questions.id', 'desc')
                        ->get();
                    $list='';
                    foreach ($data['question'] as $question){
                        $list.="<tr class='question'>
                  <td>".$question->id."</td>
                  <td>".$question->title."</td>
                  <td>".$question->stitle."</td>
                  <td style=\"text-align: left\"><a href=\"".route('trainpdf')."?id=".$question->sid."\" target='_blank'>  <span class=\"glyphicon glyphicon-picture\"></span></a></td>
                  <td><span style='cursor:pointer' onclick='measure(".$question->sid.")'>测量零件</span></td>
                  </tr>";
                    }
                    $arr['list']=$list;
                    //获得单零件
                    $like=array_filter(NcGetArray($data['question'][0]->combination));//去空数组

                    $data['question'] = DB::table('questions')
                        ->select('questions.*', 'subjects.id as sid', 'subjects.title as stitle', 'subjects.pdf')
                        ->join('subjects', 'questions.id', '=', 'subjects.qid')
                        ->whereIn('questions.id', $like)
                        ->orderby('questions.id', 'desc')
                        ->get();
                    $list='';
                    foreach ($data['question'] as $question){
                        $list.="<tr class='question'>
                  <td>".$question->id."</td>
                  <td>".$question->title."</td>
                  <td>".$question->stitle."</td>
                  <td style=\"text-align: left\"><a href=\"".route('trainpdf')."?id=".$question->sid."\" target='_blank'>  <span class=\"glyphicon glyphicon-picture\"></span></a></td>
                  <td><span style='cursor:pointer' onclick='measure(".$question->sid.")'>测量零件</span></td>
                  </tr>";
                    }
                    $arr['state']='1';
                    $arr['title']=$traindata->title;
                    $arr['lists']=$list;
                    $arr['combination']=$traindata->combination;
                }else{
                    $like=array_filter(NcGetArray($traindata->choice));//去空数组
                    $data['question'] = DB::table('questions')
                        ->select('questions.*', 'subjects.id as sid', 'subjects.title as stitle', 'subjects.pdf')
                        ->join('subjects', 'questions.id', '=', 'subjects.qid')
                        ->whereIn('questions.id', $like)
                        ->orderby('questions.id', 'desc')
                        ->get();

                    $list='';
                    foreach ($data['question'] as $question){
                        $list.="<tr class='question'>
                  <td>".$question->id."</td>
                  <td>".$question->title."</td>
                  <td>".$question->stitle."</td>
                  <td style=\"text-align: left\"><a href=\"".route('trainpdf')."?id=".$question->sid."\" target='_blank'>  <span class=\"glyphicon glyphicon-picture\"></span></a></td>
                  <td><span style='cursor:pointer' onclick='measure(".$question->sid.")'>测量零件</span></td>
                  </tr>";
                    }
                    $arr['state']='1';
                    $arr['title']=$traindata->title;
                    $arr['list']=$list;
                    $arr['combination']=$traindata->combination;
                }
            }else{
                $arr['state']='0';
            }

        }else{
            $arr['id']=0;
        }
        return $arr;
    }
    public function trainpdf(Request $request)
    {
        $arr['login']='1';//登录状态
        $where['subjects.id']=$request->input('id');
        $data = DB::table('questions')
            ->select('questions.*', 'subjects.id as sid', 'subjects.title as stitle', 'subjects.pdf')
            ->join('subjects', 'questions.id', '=', 'subjects.qid')
            ->where($where)
            ->orderby('questions.id', 'desc')
            ->get();

        $data['question']=$data['0'];
        $data['title']='图纸查看 - '.$this->system["systems_name"];
        $data['description']=$this->system["systems_description"];
        $data['keywords']=$this->system["systems_keyword"];
        return view('personal.index.trainpdf',['data'=>$data]);
    }
    //获取当前用户训练状态
    public function TrainState(Request $request)
    {
        $arr['login']='1';//登录状态
        $train= new \App\train();
        $where['uid']=Auth::user()->id;
        $where['status']='1';
        $where['source']='1';
        $traindata = $train->where($where)->orderBy('id', 'desc')->get();

        //当前用户有未完成的训练
        if(count($traindata)>0){
            $traindata=$traindata['0'];
            if($traindata['combination']=='89'){
                //获得组合零件
                $like=array_filter(NcGetArray($traindata->choice));//去空数组
                $data['question'] = DB::table('questions')
                    ->select('questions.*', 'subjects.id as sid', 'subjects.title as stitle', 'subjects.pdf')
                    ->join('subjects', 'questions.id', '=', 'subjects.qid')
                    ->whereIn('questions.id', $like)
                    ->orderby('questions.id', 'desc')
                    ->get();
                $list='';
                foreach ($data['question'] as $question){
                    $list.="<tr class='question'>
                  <td>".$question->id."</td>
                  <td>".$question->title."</td>
                  <td>".$question->stitle."</td>
                  <td style=\"text-align: left\"><a href=\"".route('trainpdf')."?id=".$question->sid."\" target='_blank'>  <span class=\"glyphicon glyphicon-picture\"></span></a></td>
                  <td><span style='cursor:pointer' onclick='measure(".$question->sid.")'>测量零件</span></td>
                  </tr>";
                }
                $list .= "<tr ><td></td><td></td><td></td> <td></td><td></td></tr></table>";
                $arr['list']=$list;
                //获得单零件
                $like=array_filter(NcGetArray($data['question'][0]->combination));//去空数组

                $data['question'] = DB::table('questions')
                    ->select('questions.*', 'subjects.id as sid', 'subjects.title as stitle', 'subjects.pdf')
                    ->join('subjects', 'questions.id', '=', 'subjects.qid')
                    ->whereIn('questions.id', $like)
                    ->orderby('questions.id', 'desc')
                    ->get();
                $list='';
                foreach ($data['question'] as $question){
                    $list.="<tr class='question'>
                  <td>".$question->id."</td>
                  <td>".$question->title."</td>
                  <td>".$question->stitle."</td>
                  <td style=\"text-align: left\"><a href=\"".route('trainpdf')."?id=".$question->sid."\" target='_blank'>  <span class=\"glyphicon glyphicon-picture\"></span></a></td>
                  <td><span style='cursor:pointer' onclick='measure(".$question->sid.")'>测量零件</span></td>
                  </tr>";
                }
                $list .= "<tr ><td></td><td></td><td></td> <td></td><td></td></tr></table>";
                $arr['state']='1';
                $arr['title']=$traindata->title;
                $arr['lists']=$list;
                $arr['combination']=$traindata->combination;
            }else{
                $like=array_filter(NcGetArray($traindata->choice));//去空数组
                $data['question'] = DB::table('questions')
                    ->select('questions.*', 'subjects.id as sid', 'subjects.title as stitle', 'subjects.pdf')
                    ->join('subjects', 'questions.id', '=', 'subjects.qid')
                    ->whereIn('questions.id', $like)
                    ->orderby('questions.id', 'desc')
                    ->get();

                $list='';
                foreach ($data['question'] as $question){
                    $list.="<tr class='question'>
                  <td>".$question->id."</td>
                  <td>".$question->title."</td>
                  <td>".$question->stitle."</td>
                  <td style=\"text-align: left\"><a href=\"".route('trainpdf')."?id=".$question->sid."\" target='_blank'>  <span class=\"glyphicon glyphicon-picture\"></span></a></td>
                  <td><span style='cursor:pointer' onclick='measure(".$question->sid.")'>测量零件</span></td>
                  </tr>";
                }
                $list .= "<tr ><td></td><td></td><td></td> <td></td><td></td></tr></table>";
                $arr['state']='1';
                $arr['title']=$traindata->title;
                $arr['list']=$list;
                $arr['combination']=$traindata->combination;
            }
        }else{
            $arr['state']='0';
        }

        $arr['id']=1;

        return $arr;
    }
    //获取当前用户训练状态
    public function Measure(Request $request)
    {
        $arr['login']='1';//登录状态
        $train= new \App\train();
        $question = new \App\question();
        $subject = new \App\subject();
        $subject_standard = new \App\subject_standard();
        $subject_measure = new \App\subject_measure();
        $where['source']='1';
        $where['uid']=Auth::user()->id;
        $traindata = $train->where($where)->orderBy('id', 'desc')->first();

        if($traindata->combination=='89'){
            $qid = str_replace(",","",$traindata->choice);
            $questiondata = $question->find($qid);
            $s =$qid.','.$questiondata->combination;
            $s = explode(",",$s);
        }
        if($traindata->combination=='59'){
            $s = array_filter(explode(",",$traindata->choice));
        }

        $getMeasure=$this->getMeasure($s,'1');


        //以上是获取用户训练的试题ID
        if($traindata->result==''){//未初始换直接添加
            $results=$getMeasure;
            $traindata->result=json_encode($getMeasure);
        }else{//已经初始化，数据对比后覆盖
            $result= object_arrays(json_decode($traindata->result));
            foreach ($getMeasure as $key=>$vol){
                if(array_key_exists($key,$result)){
                    $results[$key]=$result[$key];
                }else{
                    $results[$key]="";
                }
            }
            $getMeasure=$results;
            $traindata->result=json_encode($getMeasure);

        }
        if($traindata->save()) {
            $sid = $request->input('sid');
            $subjectdata = $subject->find($sid);
            $questiondata = $question->where('id', $subjectdata->qid)->first();
            $subject_standarddata = $subject_standard->where('sid', $sid)->orderby('sort', 'asc')->orderby('id', 'desc')->get();
            $MeasureHtml = '';
            $i=0;
            foreach ($subject_standarddata as $subject_standardlist) {
                $MeasureHtml .= "<div style=\"line-height: 40px;color: #f60;\">$subject_standardlist->title</div>";
                $MeasureHtml .= "<table class=\"table table-condensed\" style=\"width: 98%; line-height: 40px\" id=\"trainingList\">
                        <tr >    
                            <td  style=\"width: 29%\">Aspect - Description<br/>考核内容及要求</td>
                            <td style=\"width: 29%\">Add - (Extra Aspect Information)<br/>附加内容</td>
                            <td style=\"width: 11%\">AspectType<br/>类型</td>
                            <td style=\"width: 11%\">Max Mark<br/>满分/配分</td>
                            <td>Measurement Result<br/>工件测量结果</td>
                        </tr>";
                $subject_measuredata = $subject_measure->where('ssid', $subject_standardlist->id)->orderby('sort', 'asc')->orderby('id', 'desc')->get();
                foreach ($subject_measuredata as $subject_measurelist) {
                    if($results["$subject_measurelist->id"]!==''){
                        $span=$results["$subject_measurelist->id"];
                    }else{
                        $span='&nbsp';
                    }

                    $MeasureHtml .= "<tr style='color: #9BA2AB' id=\"strip$subject_measurelist->id\" class='strip' data-list=\"$subject_measurelist->id\">
                            <td>$subject_measurelist->aspectdescription</td>
                            <td>$subject_measurelist->aspectadd</td>
                            <td>" . NcGetType($subject_measurelist->aspecttype, 2) . "</td>
                            <td>$subject_measurelist->maxmark</td>
                            <td>
                                <span>（</span><span id='Result' style='width: 60px; text-align: center'>$span</span><span>）</span>
                                <span class='glyphicon glyphicon-cog' style=\" margin-left: 5px; color: red;cursor:pointer;width: 60px\" onclick=\"MeasureStart('".$i."','正在加载测量信息，请稍后........')\" alt='重新测量'>  </span>
                            </td>
                             <td style='display: none'>
                               标准尺寸：" . $subject_measurelist->aspectsize ."<br/>偏差值：" . $subject_measurelist->aspecterrora . "，" . $subject_measurelist->aspecterrorb . "
                            </td>                           
                        </tr>";
                    $i++;
                }
                $MeasureHtml .= "<tr ><td></td><td></td><td></td> <td></td><td></td></tr></table>";

            }
            $arr['MeasureHtml'] = $MeasureHtml;
            $arr['id'] = 1;
        }else{
            $arr['id']=-1;
        }
        $arr['sid']=$request->input('sid');
        return $arr;
    }
    //获取当前用户训练状态
    public function TrainStateT(Request $request)
    {
        $arr['login']='1';//登录状态
        $train= new \App\train();
        $where['uid']=Auth::user()->id;
        $where['status']='2';
        $where['source']='1';
        $where['id']=$request->input('id');
        $traindata = $train->where($where)->orderBy('id', 'desc')->get();

        //当前用户有未完成的训练
        if(count($traindata)>0){
            $traindata=$traindata['0'];
            if($traindata['combination']=='89'){
                //获得组合零件
                $like=array_filter(NcGetArray($traindata->choice));//去空数组
                $data['question'] = DB::table('questions')
                    ->select('questions.*', 'subjects.id as sid', 'subjects.title as stitle', 'subjects.pdf')
                    ->join('subjects', 'questions.id', '=', 'subjects.qid')
                    ->whereIn('questions.id', $like)
                    ->orderby('questions.id', 'desc')
                    ->get();
                $list='';
                foreach ($data['question'] as $question){
                    $list.="<tr class='question'>
                  <td>".$question->id."</td>
                  <td>".$question->title."</td>
                  <td>".$question->stitle."</td>
                  <td style=\"text-align: left\"><a href=\"".route('trainpdf')."?id=".$question->sid."\" target='_blank'>  <span class=\"glyphicon glyphicon-picture\"></span></a></td>
                  <td><span style='cursor:pointer' onclick='measure(".$question->sid.")'>测量零件</span></td>
                  </tr>";
                }
                $list .= "<tr ><td></td><td></td><td></td> <td></td><td></td></tr></table>";
                $arr['list']=$list;
                //获得单零件
                $like=array_filter(NcGetArray($data['question'][0]->combination));//去空数组

                $data['question'] = DB::table('questions')
                    ->select('questions.*', 'subjects.id as sid', 'subjects.title as stitle', 'subjects.pdf')
                    ->join('subjects', 'questions.id', '=', 'subjects.qid')
                    ->whereIn('questions.id', $like)
                    ->orderby('questions.id', 'desc')
                    ->get();
                $list='';
                foreach ($data['question'] as $question){
                    $list.="<tr class='question'>
                  <td>".$question->id."</td>
                  <td>".$question->title."</td>
                  <td>".$question->stitle."</td>
                  <td style=\"text-align: left\"><a href=\"".route('trainpdf')."?id=".$question->sid."\" target='_blank'>  <span class=\"glyphicon glyphicon-picture\"></span></a></td>
                  <td><span style='cursor:pointer' onclick='measure(".$question->sid.")'>测量零件</span></td>
                  </tr>";
                }
                $list .= "<tr ><td></td><td></td><td></td> <td></td><td></td></tr></table>";
                $arr['state']='1';
                $arr['title']=$traindata->title;
                $arr['lists']=$list;
                $arr['combination']=$traindata->combination;
            }else{
                $like=array_filter(NcGetArray($traindata->choice));//去空数组
                $data['question'] = DB::table('questions')
                    ->select('questions.*', 'subjects.id as sid', 'subjects.title as stitle', 'subjects.pdf')
                    ->join('subjects', 'questions.id', '=', 'subjects.qid')
                    ->whereIn('questions.id', $like)
                    ->orderby('questions.id', 'desc')
                    ->get();

                $list='';
                foreach ($data['question'] as $question){
                    $list.="<tr class='question'>
                  <td>".$question->id."</td>
                  <td>".$question->title."</td>
                  <td>".$question->stitle."</td>
                  <td style=\"text-align: left\"><a href=\"".route('trainpdf')."?id=".$question->sid."\" target='_blank'>  <span class=\"glyphicon glyphicon-picture\"></span></a></td>
                  <td><span style='cursor:pointer' onclick='measure(".$question->sid.")'>测量零件</span></td>
                  </tr>";
                }
                $list .= "<tr ><td></td><td></td><td></td> <td></td><td></td></tr></table>";
                $arr['state']='1';
                $arr['title']=$traindata->title;
                $arr['list']=$list;
                $arr['combination']=$traindata->combination;
            }
        }else{
            $arr['state']='0';
        }

        $arr['id']=1;

        return $arr;
    }
    //获取测量数据模型
    private function getMeasure($array,$key){
        $arr['login']='1';//登录状态
        $question = new \App\question();
        $subject = new \App\subject();
        $subject_standard = new \App\subject_standard();
        $subject_measure = new \App\subject_measure();
        $s=$array;
        $array=array();
        if($key=='0'){
            foreach ($s as $val){
                $questionlist = $question->find($val);
                $subjectlist = $subject->where('qid',$val)->get();
                $array[$val]['a']=$questionlist;
                $array[$val]['b']=$subjectlist;
                foreach ($subjectlist as $subjectvol){
                    $subject_standardlist = $subject_standard->where('sid',$subjectvol->id)->get();
                    $array[$val]['c'][$subjectvol->id]=$subject_standardlist;
                    foreach ($subject_standardlist as $subject_standardvol){
                        $subject_measurelist = $subject_measure->where('ssid',$subject_standardvol->id)->get();
                        $array[$val]['d'][$subjectvol->id][$subject_standardvol->id]=$subject_measurelist;
                    }
                }
            }
        }else{
            foreach ($s as $val){
                $questionlist = $question->find($val);
                $subjectlist = $subject->where('qid',$val)->get();
                foreach ($subjectlist as $subjectvol){
                    $subject_standardlist = $subject_standard->where('sid',$subjectvol->id)->get();
                    foreach ($subject_standardlist as $subject_standardvol){
                        $subject_measurelist = $subject_measure->where('ssid',$subject_standardvol->id)->get();
                        foreach ($subject_measurelist as $subject_measurevol){
                            if($key==1){//测量模型初始化
                                $array[$subject_measurevol->id]="";
                            }
                            if($key==2){//测量模型对比数据获取
                                $array[$subject_measurevol->id]=$subject_measurevol;
                            }

                        }
                    }
                }
            }
        }

        return $array;

    }
    //提交测量数据
    public function PostMeasures(Request $request){
        $arr['login']='1';//登录状态
        $train= new \App\train();
        $question = new \App\question();
        $subject = new \App\subject();
        $subject_standard = new \App\subject_standard();
        $subject_measure = new \App\subject_measure();
        $where['source']='1';
        $where['uid']=Auth::user()->id;
        $traindata = $train->where($where)->orderBy('id', 'desc')->first();
        $result= object_arrays(json_decode($traindata->result));

        $id=$request->input('id');
        $result[$id]=$request->input('value');
        $getMeasure=$result;
        $traindata->result=json_encode($getMeasure);

        if($traindata->save()) {
            $arr['id']=1;
        }else{
            $arr['id']=-1;
        }

        return $arr;

    }

    //完成训练设置
    public function EndMeasures(Request $request)
    {
        $arr['login']='1';//登录状态
        $train= new \App\train();
        $question = new \App\question();
        $subject = new \App\subject();
        $subject_standard = new \App\subject_standard();
        $subject_measure = new \App\subject_measure();
        $where['source']='1';
        $where['uid']=Auth::user()->id;
        $traindata = $train->where($where)->orderBy('id', 'desc')->first();

        if($traindata->combination=='89'){
            $qid = str_replace(",","",$traindata->choice);
            $questiondata = $question->find($qid);
            $s =$qid.','.$questiondata->combination;
            $s = explode(",",$s);
        }
        if($traindata->combination=='59'){
            $s = array_filter(explode(",",$traindata->choice));
        }

        if($request->input('key')=='2'){
        if($traindata->status==1){

            $getMeasure=$this->getMeasure($s,'1');
            //以上是获取用户训练的试题ID
            if($traindata->result==''){//未初始换直接添加
                $results=$getMeasure;
                $traindata->result=json_encode($getMeasure);
            }else{//已经初始化，数据对比后覆盖
                $result= object_arrays(json_decode($traindata->result));
                foreach ($getMeasure as $key=>$vol){
                    if(array_key_exists($key,$result)){
                        $results[$key]=$result[$key];
                    }else{
                        $results[$key]="";
                    }
                }
                $getMeasure=$results;
                $traindata->result=json_encode($getMeasure);
            }
            if(in_array('', $results)){
                $arr['id']='-5';
                return $arr;
            }
            if(in_array(' ', $results)){
                $arr['id']='-5';
                return $arr;
            }

            $traindata->status='2';
            if($traindata->save()){
                $arr['id']='1';
            }else{
                $arr['id']='-1';
            }
        }else{
            $arr['id']='-2';
        }}elseif($request->input('key')=='3'){
            if($traindata->status==1){
                $traindata->status='3';
                if($traindata->save()){
                    $arr['id']='1';
                }else{
                    $arr['id']='-3';
                }
            }else{
                $arr['id']='-2';
            }
        }else{
             $arr['id']='0';
        }

        return $arr;

    }
    //练习记录
    public function Practice(Request $request){
        $arr['login']='1';//登录状态
        $train= new \App\train();
        $question = new \App\question();
        $subject = new \App\subject();
        $subject_standard = new \App\subject_standard();
        $subject_measure = new \App\subject_measure();
        $where['source']='1';
        $where['uid']=Auth::user()->id;
        $traindata = $train->where($where)->orderBy('id','desc')->paginate('10');
        $html='';
        foreach ($traindata as $val){
            $html.="    <tr ><td style=\"width: 5%\">$val->id</td>
                                         <td style=\"width: 35%\">$val->title</td>
                                         <td  style=\"width: 15%\">$val->created_at</td>
                                         <td  style=\"width: 20%\">$val->updated_at</td>";
            if($val->status==1){
                $html.=" <td><button type=\"button\" class=\"btn btn-primary btn-xs\" style='margin-right: 15px'>未完成</button> <button type=\"button\" class=\"btn btn-default  btn-xs\" onclick='States()'>继续测量</button></td></tr>";
            }elseif($val->status==2){
                $html.=" <td><button type=\"button\" class=\"btn btn-info btn-xs\" style='margin-right: 15px'>已完成</button> <button type=\"button\" class=\"btn btn-default  btn-xs\" onclick=\"getResults('$val->id')\">查看成绩</button></td></tr>";
            }elseif($val->status==3){
                $html.=" <td><button type=\"button\" class=\"btn btn-warning btn-xs\">已取消</button></td></tr>";
            }

        }
        $html .= "<tr ><td></td><td></td><td></td> <td></td><td></td></tr></table>";

        $traindata->withPath('getPractice(');
        $page=$traindata->fragment(')')->links();
        $page=str_replace("<a","<span style=\"cursor:pointer\"",$page);
        $page=str_replace("a>","span>",$page);
        $page=str_replace("href","onclick",$page);
        $page=str_replace("href","onclick",$page);
        $page=str_replace("?page=","'",$page);
        $page=str_replace("#","'",$page);
        $arr['html']=$html;
        $arr['page']=$page;
        return $arr;
    }
    //练习记录
    public function PracticeT(Request $request){
        $arr['login']='1';//登录状态
        $train= new \App\train();
        $question = new \App\question();
        $subject = new \App\subject();
        $subject_standard = new \App\subject_standard();
        $subject_measure = new \App\subject_measure();
        $where['source']='2';
        $where['uid']=Auth::user()->id;
        $traindata = $train->where($where)->orderBy('id','desc')->paginate('10');
        $html='';
        foreach ($traindata as $val){
            $html.="    <tr ><td style=\"width: 5%\">$val->id</td>
                                         <td style=\"width: 35%\">$val->title</td>
                                         <td  style=\"width: 15%\">$val->created_at</td>
                                         <td  style=\"width: 20%\">$val->updated_at</td>";
            if($val->status==1){
                $html.=" <td><button type=\"button\" class=\"btn btn-primary btn-xs\" style='margin-right: 15px'>未完成</button> <button type=\"button\" class=\"btn btn-default  btn-xs\" onclick='StatesT('$val->id')'>继续测量</button></td></tr>";
            }elseif($val->status==2){
                $html.=" <td><button type=\"button\" class=\"btn btn-info btn-xs\" style='margin-right: 15px'>已完成</button> <button type=\"button\" class=\"btn btn-default  btn-xs\" onclick=\"getResultsT('$val->id')\">查看成绩</button></td></tr>";
            }elseif($val->status==3){
                $html.=" <td><button type=\"button\" class=\"btn btn-warning btn-xs\">已取消</button></td></tr>";
            }

        }
        $html .= "<tr ><td></td><td></td><td></td> <td></td><td></td></tr></table>";

        $traindata->withPath('getPractice(');
        $page=$traindata->fragment(')')->links();
        $page=str_replace("<a","<span style=\"cursor:pointer\"",$page);
        $page=str_replace("a>","span>",$page);
        $page=str_replace("href","onclick",$page);
        $page=str_replace("href","onclick",$page);
        $page=str_replace("?page=","'",$page);
        $page=str_replace("#","'",$page);
        $arr['html']=$html;
        $arr['page']=$page;
        return $arr;
    }
    //登录时间
    public function EditTime(Request $request)
    {

        $Logintime= new \App\Logintime();
        $system=$this->system;
        $time=time()-$system->systems_02*60*60*2;//10分钟不更新登录状态的用户自动删除
        $Logintime->where('edittime','<',$time)->delete();//删除规定时间不更新的操作
        $loginNum=$Logintime->where('uid',Auth::user()->id)->get();

        if(count($loginNum)>0){
            $loginNum=$Logintime->where('uid',Auth::user()->id)->update(['edittime' => time()]);
            return $arr['a']=1;
        }else{
            Auth::logout();
            return $arr['a']=0;
        }

    }
    public function Results(Request $request){
        $arr['login']='1';//登录状态
        $train= new \App\train();
        $question = new \App\question();
        $subject = new \App\subject();
        $subject_standard = new \App\subject_standard();
        $subject_measure = new \App\subject_measure();
        $traindata = $train->where('uid', Auth::user()->id)->where('id', $request->input('id'))->first();

        if($traindata->combination=='89'){
            $qid = str_replace(",","",$traindata->choice);
            $questiondata = $question->find($qid);
            $s =$qid.','.$questiondata->combination;
            $s = explode(",",$s);
        }
        if($traindata->combination=='59'){
            $s = array_filter(explode(",",$traindata->choice));
        }

        $getMeasure=$this->getMeasure($s,'0');

        $result= object_arrays(json_decode($traindata->result));
        $Html='';
        $i=1;
        $m=0;
        $mm=0;
        $mmm=0;

        foreach ($getMeasure as $questions){
            $a=0;
            $m++;
            foreach ($questions['b'] as $subjects){
                $aa=0;
                $mm++;
                foreach ($questions['c'][$subjects->id] as $subject_standards){
                    $aaa=0;
                    foreach ($questions['d'][$subjects->id][$subject_standards->id] as $subject_measures){
                        if (array_key_exists($subject_measures->id,$result)){
                            $getResults = getResults($subject_measures->aspectsize, $subject_measures->aspecterrora, $subject_measures->aspecterrorb, $subject_measures->maxmark, $result[$subject_measures->id], $subject_measures->aspecttype);
                            $aaa = $aaa + $getResults;
                            $mmm = $mmm + $getResults;
                        }
                    }
                    $countrequest[$questions['a']->id][$subjects->id][$subject_standards->id]=$aaa;
                    $aa=$aa+$countrequest[$questions['a']->id][$subjects->id][$subject_standards->id];
                }
                $countrequest[$questions['a']->id][$subjects->id]['a']=$aa;
            }
            $a=$a+$countrequest[$questions['a']->id][$subjects->id]['a'];
            $countrequest[$questions['a']->id]['a']=$a;
        }
        $Html.="<div style=\"line-height: 30px;color: #f60; margin-bottom: 20px; border-bottom: 1px darkgray double ;\">本次训练您共选择训练试题 ".$m." 个，加工零件与组合零件共计 ".$mm." 个，共获得成绩 ".$mmm." 分。</div>";
        foreach ($getMeasure as $questions){
            $Html.= "<div style=\"line-height: 40px;\">".$i."）训练试题：".$questions['a']->title." （试题得分：".$countrequest[$questions['a']->id]['a']."）</div>";
            $ii=1;
            foreach ($questions['b'] as $subjects){
                $Html.= "<div style=\"line-height: 40px;\">".$i.".".$ii."）加工零件：".$subjects->title." （零件得分：".$countrequest[$questions['a']->id][$subjects->id]['a']."）</div>";
                $iii=1;
                foreach ($questions['c'][$subjects->id] as $subject_standards){
                    $Html.= "<div style=\"line-height: 40px;\">".$i.".".$ii.".".$iii."）测量要素：".$subject_standards->title." （要素得分：".$countrequest[$questions['a']->id][$subjects->id][$subject_standards->id]."，满分：".$subject_standards->scores."）</div>";
                    $Html.= "<table class=\"table table-condensed\" style=\"width: 98%; line-height: 40px\" id=\"trainingList\">
                        <tr >    
                            <td  style=\"width: 20%\">Aspect - Description<br/>考核内容及要求</td>
                            <td style=\"width: 20%\">Add - (Extra Aspect Information)<br/>附加内容</td>
                            <td style=\"width: 10%\">AspectType<br/>类型</td>
                            <td style=\"width: 10%\">Max Mark<br/>满分/配分</td>
                            <td style=\"width: 20%\">Requirement or Nominal Size<br/>标准尺寸</td>
                            <td style='color: #00a0e9;width: 10%'>Result<br/>工件测量结果</td>
                            <td style='color: #00a0e9;width: 10%'>Achievement<br/>成绩</td>
                        </tr>";

                    foreach ($questions['d'][$subjects->id][$subject_standards->id] as $subject_measures){
                        if (array_key_exists($subject_measures->id,$result)) {
                            $Html .= "<tr style='color: #9BA2AB' data-list=\"$subject_measures->id\">
                            <td>$subject_measures->aspectdescription</td>
                            <td>$subject_measures->aspectadd</td>
                            <td>" . NcGetType($subject_measures->aspecttype, 2) . "</td>
                            <td>$subject_measures->maxmark</td>
                            <td>" . $subject_measures->aspectsize . "（偏差值：" . $subject_measures->aspecterrora . "，" . $subject_measures->aspecterrorb . "）</td>
                            <td style='color: #00a0e9'>" . $result[$subject_measures->id] . "</td>
                            <td style='color: #00a0e9'>" . getResults($subject_measures->aspectsize, $subject_measures->aspecterrora, $subject_measures->aspecterrorb, $subject_measures->maxmark, $result[$subject_measures->id], $subject_measures->aspecttype) . "</td>";
                        }
                        }
                    $Html.= "<tr ><td></td><td></td><td></td> <td></td><td></td><td></td><td></td></tr></table>";
                    $iii++;
                }
                $ii++;
            }
            $i++;
            $Html.= "<div style='height: 40px'></div>";
        }

        $arr['html']=$Html;
        $arr['title']=$traindata->title;

        return $arr;
    }
}
