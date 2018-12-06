@extends('admin.layouts.app')

@section('title')
 - 系统信息设置
@endsection

@section('headerJsCss')
@endsection

@section('contentHeader')
    <div class="tpl-content-page-title">
        NCSM 服务端组件
    </div>
    <ol class="am-breadcrumb" style="font-size: 12px">
        <li><a href="{{ url('admin/index') }}" class="am-icon-home">首页</a></li>
        <li class="am-active">{{$data['page']['title']}}</li>
    </ol>
@endsection


@section('content')



        <div class="tpl-portlet-components">
            <div class="portlet-title">
                <div class="caption font-green bold">
                    <span class="am-icon-code"></span> {{$data['page']['title']}}
                </div>
                <div class="tpl-portlet-input tpl-fz-ml">
                    <div class="portlet-input input-small input-inline">
                        <div class="input-icon right">

                             </div>
                    </div>
                </div>
            </div>

            <div class="tpl-block">
                <div class="am-g">
                    <div class="tpl-form-body tpl-form-line">
                        <form class="am-form tpl-form-line-form" enctype="multipart/form-data" action="{{ route('systemsUpdate') }}" method="post" >
                            {{ csrf_field() }}
                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label"> 短信服务器地址 <span class="tpl-form-line-small-title">Smtp</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="user-name"  name="system['systems_sms']" value="{{ $data['system']['systems_sms'] }}">
                                    <small>请填写Smtp。</small>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label"> 短信服务器用户名 <span class="tpl-form-line-small-title">Username</span></label>
                                <div class="am-u-sm-9">
                                    <input  type="text" class="tpl-form-input" id="doc-ta-1" placeholder="" name="system['systems_smsuser']" value="{{ $data['system']['systems_smsuser'] }}">
                                    <small>请填写Username。</small>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label"> 短信服务器密码 <span class="tpl-form-line-small-title">Password</span></label>
                                <div class="am-u-sm-9">
                                    <input  type="text" class="tpl-form-input" id="doc-ta-2" placeholder="" name="system['systems_smspass']" value="{{ $data['system']['systems_smspass'] }}">
                                    <small>请填写Password。</small>
                                </div>
                            </div>


                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">  </label>
                                <div class="am-u-sm-9">
                                    <input type="hidden" id="url" name="url" value="messages">
                                    <button type="submit" class="am-btn am-btn-primary tpl-btn-bg-color-success "> <i class="am-icon-cog"></i> 保存设置 </button>
                                </div>
                            </div>



                        </form>

                    </div>
                </div>
            </div>
        </div>




@endsection

@section('footerJsCss')

<script src="{{ asset('js/ncsm.js') }}"></script>
<script src="{{ asset('/laravel-u-editor/ueditor.config.js')}}"></script>
<script src="{{ asset('/laravel-u-editor/ueditor.all.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
       OneFileImg('systems-slogo','{{ asset('/upload/'.$data['system']['systems_slogo']) }}');
       OneFileImg('systems-logo','{{ asset('/upload/'.$data['system']['systems_logo']) }}');
    })
    OneFile('systems-slogo');
    OneFile('systems-logo');
    var ue=UE.getEditor("ueditor");
    ue.ready(function(){
        //因为Laravel有防csrf防伪造攻击的处理所以加上此行
        ue.execCommand('serverparam','_token','{{ csrf_token() }}');
        });
    </script>
@endsection