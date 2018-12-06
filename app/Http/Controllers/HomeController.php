<?php

namespace App\Http\Controllers;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->system=\App\System::find(1);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($guard = null)
    {
        $data=array();
        $data['nav']=array();
        if (Auth::guard($guard)->check()) {
            //exit;
            //获得用户权限
            $nav = NcGetAuthority( Auth::user()->user_group);
            $nav = NcGetType($nav['0'], '1');
            $data['nav'] = $nav;
            //判断用户权限可否访问几个系统，当只能访问一个系统之直接跳转，一个都不能访问跳转回登录
            $system=$this->system;
            $Logintime= new \App\Logintime();
            $time=time()-$system->systems_02*60*60*2;//10分钟不更新登录状态的用户自动删除

            $Logintime->where('edittime','<',$time)->delete();
            $Logintime->where('uid','=',Auth::user()->id)->delete();
            $loginNum=$Logintime->where('edittime','>=',$time)->count();

            if($loginNum>=$system->systems_01){
                return redirect('/prompt')->with(['message' => '以登录'.$system->systems_01.'人,达到授权上线！', 'url' => route('login'), 'jumpTime' => 2, 'status' => '#ff6600']);
            }else{
                $Logintime->uid = Auth::user()->id;
                $Logintime->edittime = time();
                $Logintime->save();
            }


            if (count($nav)==1) {
               return redirect($nav['0']['description']);
            } elseif (!$nav['0']) {
               return redirect('login');
            }
        }
        //MM($nav);
        return view('home',['data'=>$data]);
    }
    public function ajax(){
        $data=array();
        $data['a']='aaa';
        //echo "121212";
        return view('ajax',['data'=>$data]);
    }
}
