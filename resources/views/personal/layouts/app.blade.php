<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="{{ app()->getLocale() }}"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="{{ app()->getLocale() }}"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="{{ app()->getLocale() }}"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="{{ app()->getLocale() }}"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @section('title')
    @show
    <!-- Styles Css-->
    <!-- CSRF Token -->
    <link rel="apple-touch-icon" href="{{ asset('personals/images/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('personals/images/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('personals/images/apple-touch-icon-114x114.png') }}">
    <link href='http://cdn.webfont.youziku.com/webfonts/nomal/115382/19874/5aaf29ccf629d913683b8fc0.css' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="{{ asset('personals/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/font-awesome.4.6.0.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('personals/css/style.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('personals/css/simpletextrotator.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('personals/lib/honeySwitch.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('personals/css/jquery.mloading.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/ncsm.css') }}">

    <!--[if lt IE 9]>
    <script src=""></script>
    <![endif]-->
    <script src="{{ asset('personals/js/jquery.min.js') }}"></script> <!-- JQUERY -->
    <script src="{{ asset('personals/lib/honeySwitch.js') }}"></script>
    @yield('headerJsCss')
    </head>
    <body>

    <div class="loading-screen"></div>
    <div id="frontpage">
        <div class="shadow-img"></div>
        <img src="{{ asset('personals/images/front-image.jpg') }}" class="front-img img-responsive" alt ="Front-image"><!--IMAGE FOR FRONT SCREEN-->
        <h1><span class="invert">NCSM</span></h1><!--PROFILE NAME-->
        <h3 class="invert" style="margin-top: -10px; margin-bottom: 10px;">Web <span class="rotate">Smart Network</span></h3> <!--SUBTITLE IN PROFILE-->
        <div class="frontclick"><img src="{{ asset('personals/images/click.png') }}" alt="" class="img-responsive"><span class="pulse"></span></div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    <div class="container">
    <div id="content" class="row hidden">
    <div class="col-md-3">
            <!--namecard-->
            <div id="namecard" class="namecard">
                <div class="shadow-img"></div>
                <h1 class="maintitle"> <span class="invert">Ncsm</span></h1><!--PROFILE NAME-->
                <h3 class="invert sub-maintitle">Smart
                    <span class="rotate">Network</span><!--SUBTITLE AFTET NAME-->
                </h3>
                <img id="profile-img" class="profile-img transparent" src="{{ asset('personals/images/profile-thum.png') }}" alt="profile-image"/><!--PROFILE IMAGE-->
            </div><!--/#namecard-->
            <!--menu-->
            <div id="menu-container">
                <!--PAGE MENU-->
                <ul class="nav-menu no-padding">

                    @php
                        $navAuthority = NcGetAuthority( Auth::user()->user_group);
                        $path = Request::path();

                    //MM($navAuthority);
                    //MM($path);
                    @endphp

                    @foreach (NcGetType('6')  as $nav)
                        @php
                            $arrs = explode("/",$nav['description']);
                            $list = NcGetType($nav['id']);
                            if($loop->index=='0'){
                            $selected='selected';
                            }else{
                            $selected='';
                            }
                        @endphp
                        @if(in_array($nav['id'],$navAuthority[1]))

                            <li class="nav-btn {!! $selected !!}" data-page="{{ $nav['slug'] }}">
                                <div class="hover-background"></div>
                                <span class="css10e1648d1e1c2b6" style="font-weight: 900">{{ $nav['name'] }}</span><i class="fa {{ $nav['description'] }} fa-fw"></i>
                            </li>
                        @endif
                    @endforeach

                </ul><!--/.nav-menu __PAGE MENU ENDS-->

                <!--SOCIAL NAV MENU-->
                <div class="social-menu-container">
                    <ul class="social-menu no-padding">
                        <li><a href="javascript:;"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="javascript:;"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="https://shop156573949.taobao.com/" target="_blank"><i class="fa fa-leaf"></i></a></li>
                        <li><a href="javascript:;"><i class="fa fa-pinterest-p"></i></a></li>
                        <li><a href="javascript:;"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div><!--/.social-menu-container-->
            </div><!--#menu-container-->
        </div>
    @section('righter')
    @show
    </div></div>
    @yield('modal')
    <!-- Scripts Js-->
    <script type="text/javascript" src="{{ asset('personals/js/jQueryTween-aio-min.js') }}"></script> <!-- JQUERY Tween Plugin -->
    <script type="text/javascript" src="{{ asset('personals/js/jquery.tabslet.min.js') }}"></script> <!-- JQUERY Tab plugin-->
    <script type="text/javascript" src="{{ asset('personals/js/progressbar.min.js') }}"></script> <!-- JQUERY Progressbar Plugin-->
    <script type="text/javascript" src="{{ asset('personals/js/jquery.simple-text-rotator.min.js') }}"></script> <!-- JQUERY Text Rotator-->
    <script type="text/javascript" src="{{ asset('personals/js/bootstrap.min.js') }}"></script> <!-- Bootstrap file-->
    <script src="http://ditu.google.cn/maps/api/js?key=AIzaSyBPNkCVoBW_Jzl6x-hgGU6e7QW1QMwKles"></script>
    <script type="text/javascript" src="{{ asset('personals/js/isotope.pkgd.min.js') }}"></script> <!--SCRIPTS FOR PORTFOLIO IMAGE'S ANIMATION-->
    <script type="text/javascript" src="{{ asset('personals/js/custom.js') }}"></script>
    @yield('footerJsCss')
    </body>
    </html>
