<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="apple-mobile-web-app-title" content="{{ config('app.name', 'ncsm') }} UI" />
    <title>{{ config('app.name', 'ncsm') }} -@yield('title')</title>
    <link rel="icon" type="image/png" href="assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
    <!-- Styles Css-->
    <link rel="stylesheet" href="{{ asset('assets/css/amazeui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ncsm.css') }}">
    @yield('headerJsCss')
</head>
<body>

@section('header')
    <header class="am-topbar am-topbar-inverse admin-header">
        <div class="am-topbar-brand">

            <span>NCSM </span>-数控智能测量系统

        </div>
        <div class="am-icon-list tpl-header-nav-hover-ico am-fl am-margin-right">

        </div>

        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

        <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

            <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list tpl-header-list">
                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                        <span class="am-icon-bell-o"></span> 提醒 <span class="am-badge tpl-badge-success am-round">1</span>
                    </a>
                    <ul class="am-dropdown-content tpl-dropdown-content">
                        <li class="tpl-dropdown-content-external">
                            <h3>你有 <span class="tpl-color-success">1</span> 条提醒</h3><a href="###">全部</a></li>
                        <li class="tpl-dropdown-list-bdbc"><a href="#" class="tpl-dropdown-list-fl"><span class="am-icon-btn am-icon-plus tpl-dropdown-ico-btn-size tpl-badge-success"></span> 请您查看您的训练报告</a>
                            <span class="tpl-dropdown-list-fr">3小时前</span>
                        </li>

                    </ul>
                </li>
                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                        <span class="am-icon-comment-o"></span> 消息 <span class="am-badge tpl-badge-danger am-round">9</span>
                    </a>
                    <ul class="am-dropdown-content tpl-dropdown-content">
                        <li class="tpl-dropdown-content-external">
                            <h3>你有 <span class="tpl-color-danger">9</span> 条新消息</h3><a href="###">全部</a></li>
                        <li>
                            <a href="#" class="tpl-dropdown-content-message">
                                <span class="tpl-dropdown-content-photo">
                      <img src="{{ asset('assets/img/user02.png') }}" alt=""> </span>
                                <span class="tpl-dropdown-content-subject"  style=" display: none;">
                      <span class="tpl-dropdown-content-from" style=" display: ;">> 禁言小张 </span>
                                <span class="tpl-dropdown-content-time">10分钟前 </span>
                                </span>

                                <span class="tpl-dropdown-content-subject">
                      <span class="tpl-dropdown-content-from"> Steam </span>
                                <span class="tpl-dropdown-content-time">18分钟前</span>
                                </span>
                                <span class="tpl-dropdown-content-font"> 为了能最准确的传达所描述的问题， 建议你在反馈时附上演示，方便我们理解。 </span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle style="display: none;">
                    <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                        <span class="am-icon-calendar"></span> 进度 <span class="am-badge tpl-badge-primary am-round">4</span>
                    </a>
                    <ul class="am-dropdown-content tpl-dropdown-content">
                        <li class="tpl-dropdown-content-external">
                            <h3>你有 <span class="tpl-color-primary">4</span> 个任务进度</h3><a href="###">全部</a></li>
                        <li>
                            <a href="javascript:;" class="tpl-dropdown-content-progress">
                                <span class="task">
                        <span class="desc">数字化制造全周期虚拟仿真平台演示版  v1.1 </span>
                                <span class="percent">45%</span>
                                </span>
                                <span class="progress">
                        <div class="am-progress tpl-progress am-progress-striped"><div class="am-progress-bar am-progress-bar-success" style="width:45%"></div></div>
                    </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" class="tpl-dropdown-content-progress">
                                <span class="task">
                        <span class="desc">新闻内容页 </span>
                                <span class="percent">30%</span>
                                </span>
                                <span class="progress">
                       <div class="am-progress tpl-progress am-progress-striped"><div class="am-progress-bar am-progress-bar-secondary" style="width:30%"></div></div>
                    </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" class="tpl-dropdown-content-progress">
                                <span class="task">
                        <span class="desc">管理中心 </span>
                                <span class="percent">60%</span>
                                </span>
                                <span class="progress">
                        <div class="am-progress tpl-progress am-progress-striped"><div class="am-progress-bar am-progress-bar-warning" style="width:60%"></div></div>
                    </span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen" class="tpl-header-list-link"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>

                <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                    <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                        <span class="tpl-header-list-user-nick" style="display: none;">禁言小张</span><span class="tpl-header-list-user-ico"> <img src="{{ asset('assets/img/user01.png') }}"></span>
                    </a>
                    <ul class="am-dropdown-content">
                        <li><a href="#"><span class="am-icon-bell-o"></span> 资料</a></li>
                        <li><a href="#"><span class="am-icon-cog"></span> 设置</a></li>
                        <li><a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">><span class="am-icon-power-off"></span> 退出

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </a></li>
                    </ul>
                </li>
                <li><a href="###" class="tpl-header-list-link"><span class="am-icon-sign-out tpl-header-list-ico-out-size"></span></a></li>
            </ul>
        </div>
    </header>
@show

<div class="tpl-page-container tpl-page-header-fixed">
    @section('sidebar')
        <div class="tpl-left-nav tpl-left-nav-hover">
            <div class="tpl-left-nav-title">
                Function List
            </div>
            @php
                $navAuthority = NcGetAuthority( Auth::user()->user_group);
                $path = Request::path();
                $arr['1']='';
                $arr = explode("/",$path);
                $path='/'.$path;
                if(count($arr)=='1'){
                $active='active';
                }else{
                $active='';
                }
            @endphp
            <div class="tpl-left-nav-list">
                <ul class="tpl-left-nav-menu">
                    <li class="tpl-left-nav-item">
                        <a href="/{{ $arr['0'] }}" class="nav-link {{ $active }}">
                            <i class="am-icon-home" style="width: 23px"></i>
                            <span>首页</span>
                        </a>
                    </li>
                    @foreach (NcGetType('9')  as $nav)
                        @php
                            $arrs = explode("/",$nav['description']);
                            $list = NcGetType($nav['id']);
                        @endphp
                        @if(count($list)>0)
                            @php
                                $urls='javascript:;';
                                $urla='/'.$arr['0'].$nav['description'];
                                $icon='<i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right"></i>';
                                $path = Request::path();
                                $path='/'.$path;
                            @endphp
                        @else
                            @php
                                 $urls='/'.$arr['0'].$nav['description'];
                                 $urla=$urls;
                                 $icon='';
                                 $active='';
                                 if(count($arr)>1){
                                  $path='/'.$arr['0'].'/'.$arr['1'];
                                 }

                            @endphp
                        @endif
                        @php
                                if($path==$urla and $nav['description']!=''){
                                $active='active';
                                }else{
                                $active='';
                                }
                                if(count($arr)>'1'){
                                if($urla=='/'.$arr['0'].'/'.$arr['1']){
                                $show="display: block;";
                                }else{
                                $show="";
                                }
                            }else{
                            $show="";
                            }
                        @endphp

                            @if(in_array($nav['id'],$navAuthority[1]))
                                <li class="tpl-left-nav-item">
                                    <a href="{{ $urls }}" class="nav-link  tpl-left-nav-link-list {!! $active !!}">
                                        <i class="{{ $nav['slug'] }}" style="width: 18px"></i>
                                        <span style="padding-left: 5px;">{{ $nav['name'] }}</span>
                                        {!! $icon !!}
                                    </a>
                                    <ul class="tpl-left-nav-sub-menu" style="{{ $show }}">
                                        <li>
                                            @foreach ($list as $navs)

                                                @if(in_array($navs['id'],$navAuthority[2]))
                                                    @php

                                                        $arrs2 = explode("?",$navs['description']);
                                                        $urlb=$urla.$arrs2['0'];
                                                        if($path==$urlb and $arrs2['0']!=''){
                                                        $active='active';
                                                        $arrs2=[];
                                                        }else{
                                                        $active='';
                                                        }
                                                    @endphp
                                                <a href="{{$urlb}}" class="{{ $active }}">
                                                    <i class="am-icon-angle-right"></i>
                                                    <span>{{ $navs['name'] }}</span>
                                                    <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                                </a>
                                             @endif
                                            @endforeach
                                        </li>
                                    </ul>

                                </li>
                            @endif

                        @endforeach
                    </ul>
                </div>
            </div>
        @show
        <div class="tpl-content-wrapper">
            @section('contentHeader')
                <div class="tpl-content-page-title">
                    NC simulation 首页组件
                </div>
                <ol class="am-breadcrumb">
                    <li><a href="#" class="am-icon-home">首页</a></li>
                    <li><a href="#">分类</a></li>
                    <li class="am-active">内容</li>
                </ol>
                <div class="tpl-content-scope">
                    <div class="note note-info">
                        <h3>NCSM - 数控智能测量系统后台使用提示
                            <span class="close" data-close="note"></span>
                        </h3>
                        <p> </p>
                        <p><span class="label label-danger">提示:</span>
                        </p>
                    </div>
                </div>
            @show

            @yield('content')
        </div></div>

    @section('footer')

    @show
    @yield('modal')
    <!-- Scripts Js-->
    <script src="{{ asset('assets/js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('assets/js/amazeui.min.js') }}"></script>
    <script src="{{ asset('assets/js/iscroll.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/echarts.min.js') }}"></script>
    @yield('footerJsCss')
    </body>
    </html>
