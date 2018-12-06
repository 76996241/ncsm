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
                                <label for="user-name" class="am-u-sm-3 am-form-label"> 平台名称 <span class="tpl-form-line-small-title">Title</span></label>
                                <div class="am-u-sm-9">
                                    <input type="text" class="tpl-form-input" id="user-name"  name="system['systems_name']" value="{{ $data['system']['systems_name'] }}">
                                    <small>请填系统名称文字10-30字左右。</small>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label"> KeyWord <span class="tpl-form-line-small-title">KeyWord</span></label>
                                <div class="am-u-sm-9">
                                    <textarea  type="text" class="tpl-form-input" id="doc-ta-1" placeholder="" name="system['systems_keyword']">{{ $data['system']['systems_keyword'] }}</textarea>
                                    <small>请填KeyWord文字10-100字左右。</small>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label"> Description <span class="tpl-form-line-small-title">Description</span></label>
                                <div class="am-u-sm-9">
                                    <textarea  type="text" class="tpl-form-input" id="doc-ta-2" placeholder="" name="system['systems_description']">{{ $data['system']['systems_description'] }}</textarea>
                                    <small>请填Description文字10-120字左右。</small>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-weibo" class="am-u-sm-3 am-form-label">服务端LOGO <span class="tpl-form-line-small-title">Images</span></label>
                                <div class="am-u-sm-9"  style="height: 173px">
                                    <div class="am-form-group am-form-file">
                                        <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                            <i class="am-icon-cloud-upload"></i> 选择要上传的文件</button>
                                        <input id="systems-slogo" type="file" name="system['systems_slogo']" value="">
                                    </div>
                                    <div id="systems-slogo-image-holder"></div>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-intro" class="am-u-sm-3 am-form-label">智能测量系统LOGO <span class="tpl-form-line-small-title">Images</span></label>
                                <div class="am-u-sm-9"  style="height: 173px">
                                    <div class="am-form-group am-form-file">
                                        <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                            <i class="am-icon-cloud-upload"></i> 选择要上传的文件</button>
                                        <input id="systems-logo" type="file" name="system['systems_logo']" value="">
                                    </div>
                                    <div id="systems-logo-image-holder"></div>
                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label"> 平台版权信息 <span class="tpl-form-line-small-title">footer</span></label>
                                <div class="am-u-sm-9">


                                    <script id="ueditor" type="text/plain" name="system['systems_copyright']" >{!!  html_entity_decode($data['system']['systems_copyright']) !!}</script>


                                </div>
                            </div>

                            <div class="am-form-group">
                                <label for="user-name" class="am-u-sm-3 am-form-label">  </label>
                                <div class="am-u-sm-9">
                                    <input type="hidden" id="url" name="url" value="systems">
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