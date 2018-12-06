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
                    </div>
                </div>
            </div>


        </div> <form class="am-form">
            {{ csrf_field() }}
            <input type="hidden" id="id" name="id" value="{{ $data['id'] }}">
        <div class="tpl-block">
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6" style=" padding-left: 0px; padding-right: 0px">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <button type="button" class="am-btn am-btn-default am-btn-secondary " onclick="javascript:top.location='{{ route('cate') }}?id=3'" ><span class="am-icon-plus"></span> 新增权限 </button>
                            <button type="button" class="am-btn am-btn-default am-btn-secondary" id="authorityupdate"><span class="am-icon-save"></span> 保存设置</button>
                        </div>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-3">

                </div>
                <div class="am-u-sm-12 am-u-md-3">

                </div>
            </div>
            <div class="am-g">
                <div class="am-u-sm-12" style=" padding-left: 0px; padding-right: 0px">

                        <table class="am-table am-table-striped am-table-hover table-main" style="margin-top: 10px">
                            <thead>
                            <tr>

                                <th class="col-sm-3">一级权限</th>
                                <th class="col-sm-3">二级权限</th>
                                <th class="col-sm-3">三级权限</th>
                                <th class="col-sm-3">四级权限</th>

                            </tr>
                            </thead>
                        </table>
                            @foreach ($data['cate']  as $post_cates)
                                <div id="authority{{ $post_cates['id'] }}" class="am-g am-g-font">
                                    <div class="col-sm-3"><label class="am-checkbox-inline"><input class= "checkbox checkboxOne"  id="checkboxOne" type="checkbox"  name="checkboxOne" value="{{ $post_cates['id'] }}" {!! $post_cates['disabled'] !!}> {{ $post_cates['name'] }}</label></div>
                                    <div class="col-sm-9">
                                        @foreach ($post_cates['subset']  as $subset)
                                            <div id="authority{{ $subset['id'] }}" class="am-g am-g-font" style=" border-left: double 1px #cccccc;">
                                            <div class="col-lg-4" >
                                                <label class="am-checkbox-inline"><input class="checkboxTwe" data-quanxian="{{ $subset['pid'] }}" id="checkboxTwe" type="checkbox" value="{{ $subset['id'] }}" {{ $subset['disabled'] }}  name="checkboxTwe"> {!! $subset['name'] !!}</label>
                                            </div>
                                            <div class="col-sm-8">
                                                @foreach ($subset['subset']  as $subset1)
                                                    <div id="authority{{ $subset1['id'] }}" class="am-g am-g-font" style=" border-left: double 1px #cccccc;">
                                                    <div  class="col-lg-6">
                                                        <label class="am-checkbox-inline"><input class="checkboxThree" data-quanxian="{{ $subset1['pid'] }}" id="checkboxThree{{ $subset1['pid'] }}" type="checkbox" value="{{ $subset1['id'] }}" {!! $subset1['disabled'] !!} name="checkboxThree">{{ $subset1['name'] }}</label>
                                                    </div>
                                                    <div  class="col-lg-6">

                                                        @foreach ($subset1['subset']  as $subset2)
                                                            <div>
                                                                <label class="am-checkbox-inline"><input class="checkboxFour" data-quanxian="{{ $subset2['pid'] }}" id="checkboxFour{{ $subset2['pid'] }}" type="checkbox" value="{{ $subset2['id'] }}" name="checkboxFour" > {{ $subset2['name'] }}</label>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                    </div><hr/>
                                                @endforeach
                                            </div>
                                            </div><hr/>
                                        @endforeach
                                    </div>

                                </div><hr/>
                            @endforeach




                </div>

            </div>
        </div>
        </form>
    </div>
@endsection

@section('modal')

@endsection
@section('footerJsCss')
    <script src="{{ asset('js/ncsm.js') }}"></script>
    <script src="{{ asset('/laravel-u-editor/ueditor.config.js')}}"></script>
    <script src="{{ asset('/laravel-u-editor/ueditor.all.min.js')}}"></script>
    <script language="JavaScript">
        $(document).ready(function () {
            authorityInit($('#id').val());
        });
       // 选择按钮联动选择效果
        $("input").click(function() {
            var id=$(this).attr('data-quanxian');
            var id1=$('input[value="'+ id+'"]').attr('data-quanxian');
            var id2=$('input[value="'+id1+'"]').attr('data-quanxian');

            if($(this).prop('checked') == false ){
                if($('input[data-quanxian="'+id+'"]:checked').prop('checked')!=true ){
                    $('input[value="'+id+'"]').prop("checked",false);
                    if($('input[data-quanxian="'+id1+'"]:checked').prop('checked')!=true ){
                        $('input[value="'+id1+'"]').prop("checked",false);
                        if($('input[data-quanxian="'+id2+'"]:checked').prop('checked')!=true ){
                            $('input[value="'+id2+'"]').prop("checked",false);
                        }
                    }
                }
            }else{
                $('input[value="'+id+'"] ').prop("checked",'checked');
                $('input[value="'+id1+'"]').prop("checked",'checked');
                $('input[value="'+id2+'"]').prop("checked",'checked');
            }
        });


        //权限设置数据提交AJAX
        $('#authorityupdate').click(function () {
            var checkboxOne=[];
            var checkboxTwe=[];
            var checkboxThree=[];
            var checkboxFour=[];
            $('input[name="checkboxOne"]:checked').each(function(){
                checkboxOne.push(this.value);
            })
            $('input[name="checkboxTwe"]:checked').each(function(){
                checkboxTwe.push(this.value);
            })
            $('input[name="checkboxThree"]:checked').each(function(){
                checkboxThree.push(this.value);
            })
            $('input[name="checkboxFour"]:checked').each(function(){
                checkboxFour.push(this.value);
            })
            var checkboxOnePost = JSON.stringify(checkboxOne);
            var checkboxTwePost = JSON.stringify(checkboxTwe);
            var checkboxThreePost = JSON.stringify(checkboxThree);
            var checkboxFourPost = JSON.stringify(checkboxFour);
            $.ajax({
                type: 'POST',
                url: '{{ route('authorityupdate') }}',
                data: {
                    'id':$('#id').val(),
                    'checkboxOnePost':checkboxOnePost,
                    'checkboxTwePost':checkboxTwePost,
                    'checkboxThreePost':checkboxThreePost,
                    'checkboxFourPost':checkboxFourPost,
                    '_token': $('input[name="_token"]').val()
                },
                dataType: 'json',
                success: function (data) {
                    if(data.id!='0'){
                        alert('权限设置成功！');
                    }else{
                        alert('权限设置失败！');
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert('删除失败！');
                }
            });
        })
       //权限初始化数据
        function authorityInit(id){
            $.ajax({
                type: 'POST',
                url: '{{ route('authorityInit') }}',
                data: {
                    'id':id,
                    '_token': $('input[name="_token"]').val()
                },
                dataType: 'json',
                success: function (data) {
                   // alert(data);
                    $.each(data.json,function(i,n){
                        $('input[value="'+n+'"] ').prop("checked",'checked');
                    })
                }
            });

        }


    </script>
@endsection