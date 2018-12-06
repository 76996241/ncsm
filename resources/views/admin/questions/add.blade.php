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
                    <form class="am-form tpl-form-line-form" enctype="multipart/form-data" action="{{ $data['QuestionsInsert'] }}" method="post" >
                        {{ csrf_field() }}
                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label"> 试题主题 <span class="tpl-form-line-small-title">Title</span></label>
                            <div class="am-u-sm-9">
                                <input type="text" class="tpl-form-input" id="questions-title"  name="questions-title" value="{{ old('questions-title') }}">
                                <small></small>
                            </div>
                        </div>

                        @foreach($data['select'] as $select)
                            @if($select['id']=='70' or $select['id']=='71')
                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">{{ $select['name'] }} <span class="tpl-form-line-small-title">{{ $select['slug'] }}</span></label>
                                    <div class="am-u-sm-9 questions-type" style="width: 75%" id="questions-type{!! $select['id'] !!}">
                                    </div>
                                </div>
                            @else
                        <div class="am-form-group">
                            <label for="user-phone" class="am-u-sm-3 am-form-label">{{ $select['name'] }} <span class="tpl-form-line-small-title">{{ $select['slug'] }}</span></label>
                            <div class="am-u-sm-9" style="width: 75%">
                                <select name="questions-type{!! $select['id'] !!}" id="questions-type{!! $select['id'] !!}" style="width: 25%">
                                </select>
                                <small>必选项</small>
                            </div>
                        </div>
                            @endif
                        @endforeach

                        <div class="am-form-group">
                            <label for="user-intro" class="am-u-sm-3 am-form-label">展示图片 <span class="tpl-form-line-small-title">Images</span></label>
                            <div class="am-u-sm-9"  style="height: 173px">
                                <div class="am-form-group am-form-file">
                                    <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                        <i class="am-icon-cloud-upload"></i> 选择要上传的文件</button>
                                    <input id="questions-images" type="file" name="questions-images" value="">
                                </div>
                                <div id="questions-images-image-holder"></div>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label"> 介绍 <span class="tpl-form-line-small-title">Content</span></label>
                            <div class="am-u-sm-9">


                                <script id="ueditor" type="text/plain" name="questions-content"  >{!! old('questions-content') !!}</script>


                            </div>
                        </div>

                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">  </label>
                            <div class="am-u-sm-9">
                                <input type="hidden" name="url" value="{{ $data['cncType']['slug'] }}">
                                <input type="hidden" name="project" value="{{ $data['project'] }}">
                                <button type="submit" id="button-2" class="am-btn am-btn-primary tpl-btn-bg-color-success "> <i class="am-icon-cog"></i> 保存 </button>
                            </div>
                        </div>



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
            GageAdd();
        })

        //表单失焦数据验证
        $('#questions-title').blur(function () {
            NcStore($(this).attr('id'));
        });
        $('#questions-introduce').blur(function () {
            NcStore($(this).attr('id'));
        });

        function GetText() {
            var title="{!! $errors->first('questions-title') !!}";
            GetErr('title','questions',title,'请填中文或英文5-150字左右。');

            @foreach($data['select'] as $select)
            var type="{!! $errors->first('questions-type'.$select['id']) !!}";
            GetErr('type{!! $select['id'] !!}','questions',type,'请选择分类');
            @endforeach

        }

        function GetErr(id,prefix,text,texts) {
            var str=prefix+'-'+id;
            if(text){
                $("#"+str+" + small").removeClass('green').text(text).addClass('red');
            }else{
                $("#"+str+" + small").text( texts ).removeClass('red').removeClass('green');
            }
        }
        //初始化量具教学资源添加表单
        function GageAdd() {
            GetText();//初始化提示语
            var  cage="{!! $data['cate'] !!}";
            var  getcate="{!! $data['getcate'] !!}";
            var  key="1";
            var  strs= []; //定义一数组
            strs=cage.split(","); //字符分割
            var cateids;
            $.ajax({
                type: 'POST',
                url: '{!! $data['selecturl'] !!}',
                data: {
                    'cage':cage,
                    'getcate':getcate,
                    'key':key,
                    '_token': $('input[name="_token"]').val()
                },
                dataType: 'json',
                success: function (data) {
                    for (i=0;i<strs.length ;i++ )
                    {
                        cateids='cate'+strs[i];

                        $('#questions-type'+strs[i]).html(data[cateids]);
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    var err=JSON.parse(XMLHttpRequest.responseText);
                    var htmltext=err.errors;
                    $.each(htmltext,function(i,val){
                        alert('分类获取失败');
                    });
                }
            });




        }

        OneFile('questions-images');
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