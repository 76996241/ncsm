<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        $myfile = fopen("vericut.log", "r") or die("Unable to open file!");
        $mystr = fread($myfile, filesize("vericut.log"));
        fclose($myfile);
        $a = $this->fetch_match_contents('警告：FEATURE ', ' \| Measured', $mystr);
        $b = $this->fetch_match_contents('Measured VALUE = ', ' \| Theoretical', $mystr);
        $c = $this->fetch_match_contents('Theoretical VALUE = ', '\r', $mystr);
        $array = array();
        for ($i = 0; $i < count($a[1]); $i++) {
            $d = $a[1][$i];
            $array[$d][] = array($b[1][$i], $c[1][$i]);
        }
      //  MM($array);
        foreach ($array as $key => $vol) {
        echo count($vol);
        }
        exit;
        $data=array();
        $data['title']='个人模块 - '.$this->system["systems_name"];
        $data['description']=$this->system["systems_description"];
        $data['keywords']=$this->system["systems_keyword"];
        return view('personal.index.index',['data'=>$data]);
    }
    function fetch_urlpage_contents($url){
        $c=file_get_contents($url);
        return $c;
    }
//获取匹配内容
    function fetch_match_contents($begin,$end,$c)
    {
        $begin=$this->change_match_string($begin);
        $end=$this->change_match_string($end);
        $p = "#$begin(.*)$end#iU";//i表示忽略大小写，U禁止贪婪匹配
        if(preg_match_all($p,$c,$rs))
        {
            return $rs;
        }else{
            return "";
        }
    }
    //转义正则表达式字符串
    function change_match_string($str){
    //注意，以下只是简单转义
        $old=array("/","$",'?');
        $new=array("/","$",'?');
        $str=str_replace($old,$new,$str);
        return $str;
    }

    //采集网页
    function pick($url,$ft,$th)
    {
        $c=fetch_urlpage_contents($url);
        foreach($ft as $key => $value)
        {
            $rs[$key]=fetch_match_contents($value["begin"],$value["end"],$c);
            if(is_array($th[$key]))
            { foreach($th[$key] as $old => $new)
            {
                $rs[$key]=str_replace($old,$new,$rs[$key]);
            }
            }
        }
        return $rs;
    }



}
