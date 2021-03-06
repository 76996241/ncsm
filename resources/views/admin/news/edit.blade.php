@extends('admin.layouts.app')

@section('title')
    {{$data['page']['title']}}
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
    <div class="tpl-portlet-components" style=" min-height: 600px;">
        <div class="portlet-title">
            <div class="caption font-green bold am-serif"  style=" ">
                <i class="am-icon-tasks" aria-hidden="true"></i> {{$data['page']['title']}}
            </div>
            <div class="tpl-portlet-input tpl-fz-ml">
                <div class="portlet-input input-small input-inline">
                    <div class="input-icon right">
                        <div class="am-btn-group am-btn-group-xs" style="float: right" >
                            <button type="button" class="am-btn am-btn-default am-btn-warning" onclick="history.go(-1)"><span class="am-icon-archive"></span> 返回上级</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="tpl-block">
            <div class="am-g">
                <div class="tpl-form-body tpl-form-line">
                    <form class="am-form tpl-form-line-form" enctype="multipart/form-data" action="{{ route('NewsUpdate') }}" method="post" >
                        {{ csrf_field() }}
                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label"> 标题 <span class="tpl-form-line-small-title">Title</span></label>
                            <div class="am-u-sm-9">
                                <input type="text" class="tpl-form-input" id="news-title"  name="news-title" value="{{ old('news-title') ? old('news-title') : $data['news']['title']}}">
                                <small></small>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">资讯分类 <span class="tpl-form-line-small-title">Type</span></label>
                            <div class="am-u-sm-9" style="width: 75%">
                                <select name="news-type" id="news-type" style="width: 25%">

                                </select>
                                <small></small>

                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-description" class="am-u-sm-3 am-form-label"> 简介 <span class="tpl-form-line-small-title">Description</span></label>
                            <div class="am-u-sm-9">
                                <textarea  type="text" class="tpl-form-input" id="news-introduce" placeholder="" name="news-introduce">{{ old('news-introduce') ? old('news-introduce') : $data['news']['introduce'] }}</textarea>
                                <small></small>
                            </div>
                        </div>


                        <div class="am-form-group">
                            <label for="user-intro" class="am-u-sm-3 am-form-label">图片 <span class="tpl-form-line-small-title">Images</span></label>
                            <div class="am-u-sm-9"  style="height: 173px">
                                <div class="am-form-group am-form-file">
                                    <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                        <i class="am-icon-cloud-upload"></i> 选择要上传的文件</button>
                                    <input id="news-images" type="file" name="news-images" value="{!! old('news-images') ? old('news-images') : $data['news']['images'] !!}">
                                </div>
                                <div id="news-images-image-holder"></div>
                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label"> 内容 <span class="tpl-form-line-small-title">Content</span></label>
                            <div class="am-u-sm-9">


                                <script id="ueditor" type="text/plain" name="news-content"  >{!! old('news-content') ? old('news-content') : $data['news']['content'] !!}</script>


                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">  </label>
                            <div class="am-u-sm-9">
                                <button type="submit" id="button-2" class="am-btn am-btn-primary tpl-btn-bg-color-success "> <i class="am-icon-cog"></i> 保存资讯 </button>
                            </div>
                        </div>

                        <input type="hidden" name="id" value="{{ $data['news']['id'] }}">

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')

@endsection
@section('footerJsCss')
    <script src="{{ asset('js/ncsm.js') }}"></script>
    <script src="{{ asset('/laravel-u-editor/ueditor.config.js')}}"></script>
    <script src="{{ asset('/laravel-u-editor/ueditor.all.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            NewsAdd();
            OneFileImg('news-images','{{ asset('/upload/'.$data['news']['images']) }}');

            //历史信息
            var type="{!! old('news-type') ? old('news-type') : $data['news']['type'] !!}";

        })

        //表单失焦数据验证
        $('#news-title').blur(function () {
            NcStore($(this).attr('id'));
        });
        $('#news-introduce').blur(function () {
            NcStore($(this).attr('id'));
        });

        function GetText() {
            var title="{!! $errors->first('news-title') !!}";
            var introduce="{!! $errors->first('introduce') !!}";
            GetErr('title','news',title,'请填中文或英文10-50字左右。');
            GetErr('introduce','news',introduce,'请填中文或英文0,255字左右。');
        }

        function GetErr(id,prefix,text,texts) {
            var str=prefix+'-'+id;
            if(text){
                $("#"+str+" + small").removeClass('green').text(text).addClass('red');
            }else{
                $("#"+str+" + small").text( texts ).removeClass('red').removeClass('green');
            }
        }
        //初始化资讯添加表单
        function NewsAdd() {
            GetText();//初始化提示语
            var id="{{ $data['pids'] }}";
            var key="1";
            var type="{!! old('news-type') ? old('news-type') : $data['news']['type'] !!}";
            $.get("{{ route('newsselect') }}?id="+id+"&&key="+key+"&&type="+type, function(data){
                $('#news-type').html(data.html);
            });
        }

        OneFile('news-images');
        var ue=UE.getEditor("ueditor");
        ue.ready(function(){
            //因为Laravel有防csrf防伪造攻击的处理所以加上此行
            ue.execCommand('serverparam','_token','{{ csrf_token() }}');
        });

        //AJAX表单验证
        function  NcStore(id) {
            var array={};
            var arr = id;
            array[arr]=$('#'+id).val();
            array['_token']=$('input[name="_token"]').val();
            $.ajax({
                type: 'POST',
                url: '{{ route('ncstore') }}',
                data: array,
                dataType: 'html',
                success: function (data) {
                    $("#"+id+" + small").removeClass('red').text('输入正确！').addClass('green');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    var err=JSON.parse(XMLHttpRequest.responseText);
                    var htmltext=err.errors;
                    $.each(htmltext,function(i,val){
                        $("#"+i+" + small").removeClass('green').text(val).addClass('red');
                    });
                }
            });
        }

    </script>
@endsection