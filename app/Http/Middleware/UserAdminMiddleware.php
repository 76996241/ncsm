<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class UserAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->id!='0'){
                $nav = NcGetAuthority( Auth::user()->user_group);
                $navs = NcGetType('3');
                foreach ($navs as $list){
                    $arr=str_replace('/','',$list['description']);
                    if ($request->is($arr.'*')) {
                        if(in_array($list['id'],$nav[0])){
                            //该用户有使用权限
                        }else{
                            return redirect('/prompt')->with(['message' => '权限不足，请更换账号！', 'url' => '/login', 'jumpTime' => 2, 'status' => '#ff6600']);
                        }
                    }
                }
            }
            }else{
             return redirect('login');
        }

return $next($request);
}
}
