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


        </div>
        <div class="tpl-block">
            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6" style=" padding-left: 0px; padding-right: 0px">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <button type="button" class="am-btn am-btn-default am-btn-secondary " onclick="javascript:top.location='{{ route('newsadd') }}' "><span class="am-icon-plus"></span> 新增</button>
                            <button type="button" class="am-btn am-btn-default am-btn-danger" onclick="TypeDel()"><span class="am-icon-trash-o"></span> 删除</button>
                        </div>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-3">
                    <div class="am-form-group">
                        <select data-am-selected="" id="news-type">



                        </select>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-3">
                    <div class="am-input-group am-input-group-sm">
                        <input type="text" class="am-form-field" value="" name="keywork" id="news-keyword" >
                        <span class="am-input-group-btn">
            <button class="am-btn  am-btn-default am-btn-success tpl-am-btn-success am-icon-search" type="button" onclick="keywork()"></button>
          </span>
                    </div>
                </div>
            </div>
            <div class="am-g">
                <div class="am-u-sm-12" style=" padding-left: 0px; padding-right: 0px">
                    <form class="am-form">
                        <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>

                                <th width="3%">ID</th>
                                <th width="33%">用户名</th>
                                <th width="18%">注册时间</th>
                                <th width="18%">更新时间</th>
                                <th width="18%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data['user']  as $news)
                                <tr id="tr{{ $news['id'] }}">

                                    <td>{{ $news['id'] }}</td>
                                    <td>{{ $news['name'] }}</td>
                                    <td>{{ $news['updated_at'] }}</td>
                                    <td>{{ $news['updated_at'] }}</td>

                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <button type="button"  class="am-btn am-btn-default am-btn-xs am-text-secondary" onclick="UserEdit({{ $news['id'] }})"><span class="am-icon-pencil-square-o"></span> 编辑权限</button>
                                                <button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onclick="TypeDel({{ $news['id'] }})"><span class="am-icon-trash-o"></span> 删除</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                        <br>
                        <hr>
                        @if($data['keyword'])
                        {!! $data['user']->appends(['type' => $data['type'],'keyword' => $data['keyword']])->render() !!}
                         @else
                        {!! $data['user']->appends(['type' => $data['type']])->render() !!}
                        @endif

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('modal')
    <!--用户权限管理-->
    <div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
        <div class="am-modal-dialog">

            <div class="am-modal-hd"><span id="nc-text"></span>
                <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
            </div>

            <div class="am-modal-bd">
                <div class="tpl-block">
                    <div class="am-g">
                        <div class="tpl-form-body tpl-form-line">
                            <form class="am-form tpl-form-line-form" enctype="multipart/form-data"  method="post" >
                                {{ csrf_field() }}
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label"> 用户名<span class="tpl-form-line-small-title">Name</span></label>
                                    <div class="am-u-sm-9" style="width: 75%">
                                        <input type="text" class="tpl-form-input" id="user-name"  name="user-name" value="" disabled="disabled">
                                        <small>用户要求唯一性，不可修改！</small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label"> 用户组 <span class="tpl-form-line-small-title">group</span></label>
                                    <div class="am-u-sm-9" id="user-user_groups" style="width: 75%">


                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">  </label>
                                    <div class="am-u-sm-9" style="width: 75%">

                                        <input type="hidden" id="id" name="id" value="0">
                                        <button type="submit" id="button-2" class="am-btn am-btn-primary tpl-btn-bg-color-success "> <i class="am-icon-cog"></i> 设置测量标准 </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('footerJsCss')
    <script src="{{ asset('js/ncsm.js') }}"></script>
    <script src="{{ asset('/laravel-u-editor/ueditor.config.js')}}"></script>
    <script src="{{ asset('/laravel-u-editor/ueditor.all.min.js')}}"></script>
    <script language="JavaScript">
        $(document).ready(function () {
            NewsAdd();
            var keyword="{!! $data['keyword'] !!}";
            if(keyword){
                $('#news-keyword').val(keyword)
            }
        });


        $('#news-type').change(function(){
            var val=$(this).children('option:selected').val();
            var type="{{ $data['type'] }}";
                if(type!=val){
                    var keyword="{{ $data['keyword'] }}";
                    if(keyword){
                        avascript:top.location='{{ route('user') }}?type='+val+'&keyword='+keyword;
                    }else{
                        avascript:top.location='{{ route('user') }}?type='+val;
                    }

                }
        });

        //初始化资讯添加表单
        function NewsAdd() {
            var id="{{ $data['pids'] }}";
            var key="2";
            var type="{{ $data['type'] }}";
            $.get("{{ route('newsselect') }}?id="+id+"&&key="+key+"&&type="+type, function(data){
                $('#news-type').append(data.html);
            });
        }

        //初始化添加表单
        function UserEdit(id) {
            $('#doc-modal-1').modal('open');
            $('#id').val(id);
            $('#user-name').val('');
            $.get("{{ route('UserEdit') }}/?id="+id, function(data){
                $('#user-name').val(data.name);
                $('#user-user_groups').html(data.html);
                $('#id').val(data.id);
            });
            $('#user_user_group').val('');
        }

        $("#button-2").click(function(){

            var arr=[];
            $('input[name="user_user_group"]:checked').each(function(){
                arr.push(this.value);
            })
            var user_group = JSON.stringify(arr);//数组转换成json，都在了，数组和json

            $.ajax({
                type: 'POST',
                url: "{{ route('UserUpdate') }}",
                data: {
                    'id':  $('#id').val(),
                    'user_group': user_group,
                    '_token': $('input[name="_token"]').val()
                },
                dataType: 'json',
                success: function (data) {
                    $('#doc-modal-1').modal('close');
                    if(data.id=='1'){
                        alert('用户权限设置成功！');
                    }else{
                        alert('用户权限设置失败！');
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    var err=JSON.parse(XMLHttpRequest.responseText);
                    var htmltext=err.errors;
                    $.each(htmltext,function(i,val){
                        $("#doc-modal-1 #standards-"+i+" + small").text(val).addClass('red');
                    });
                }
            });
            return false;
        });
        function keywork() {
            var keyword=$('#news-keyword').val();
            if(keyword){
            var type="{{ $data['type'] }}";
            var page="0";
                avascript:top.location='{{ route('user') }}?type='+type+"&page="+page+"&keyword="+keyword;
            }else{
                alert('请输入关键词');
            }
        }


    </script>
@endsection