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
                            <button type="button" class="am-btn am-btn-default am-btn-secondary " onclick="TypeAdd()" ><span class="am-icon-plus"></span> 新增</button>
                            <button type="button" class="am-btn am-btn-default am-btn-danger" onclick="TypeDel()"><span class="am-icon-trash-o"></span> 删除</button>
                        @if($data['pids'])
                            <button type="button" class="am-btn am-btn-default am-btn-warning" onclick="history.go(-1)"><span class="am-icon-archive"></span> 返回上级</button>
                        @endif
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
                    <form class="am-form">
                        <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>
                                <th width="3%"><input type="checkbox"  class="tpl-table-fz-check"  id="checkAll"></th>
                                <th width="3%">ID</th>
                                <th width="34%">类名称</th>
                                <th width="17%">排序</th>
                                <th width="17%">下级分类数量</th>
                                <th width="26%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data['model']  as $post_cates)
                                <tr id="tr{{ $post_cates['id'] }}">
                                    <td><input type="checkbox" name="subBox" value="{{ $post_cates['id'] }}"></td>
                                    <td>{{ $post_cates['id'] }}</td>
                                    <td>{{ $post_cates['name'] }}</td>
                                    <td>{{ $post_cates['sequence'] }}</td>
                                    <td>{{ NcGetCount($post_cates['id']) }}</td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <button type="button"  class="am-btn am-btn-default am-btn-xs am-text-secondary" onclick="TypeEdit({{ $post_cates['id'] }})"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                                                <button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onclick="TypeDel({{ $post_cates['id'] }})"><span class="am-icon-trash-o"></span> 删除</button>
                                                @if(NcGetCount($post_cates['id'])>0)
                                                    <a class="am-btn am-btn-default am-btn-xs am-hide-sm-only" href='{{ route('cate') }}?id={{ $post_cates['id'] }}'"><span class="am-icon-copy"></span> 管理分类</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                        <br>
                        <hr>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('modal')
    <!--添加分类-->
    <div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
        <div class="am-modal-dialog">
            <div class="am-modal-hd"><span id="nc-text"></span>
                <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
            </div>
            <div class="am-modal-bd">
                <div class="tpl-block">
                    <div class="am-g">
                        <div class="tpl-form-body tpl-form-line">
                            <form class="am-form tpl-form-line-form" enctype="multipart/form-data"  method="post" name="cateAdd" >
                                {{ csrf_field() }}
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label"> 名称 <span class="tpl-form-line-small-title">Title</span></label>
                                    <div class="am-u-sm-9" style="width: 75%">
                                        <input type="text" class="tpl-form-input" id="nc-name"  name="name" value="">
                                        <small>请填中文或英文2-15字左右。</small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label"> 别名 <span class="tpl-form-line-small-title">Name</span></label>
                                    <div class="am-u-sm-9" style="width: 75%">
                                        <input type="text" class="tpl-form-input" id="nc-slug"  name="slug" value="">
                                        <small>请填中文或英文2-15字左右。</small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">父节点 <span class="tpl-form-line-small-title">Superclass</span></label>
                                    <div class="am-u-sm-9" style="width: 75%">
                                        <select name="pid" id="nc-pid" >

                                        </select>
                                        <small>必须选择项。</small>

                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label" > 排序 <span class="tpl-form-line-small-title">Sequence</span></label>
                                    <div class="am-u-sm-9" style="width: 75%">
                                        <input type="number" min="1" max="99"  style="width:65px;" class="tpl-form-input" id="nc-sequence"  name="sequence" value="1">
                                        <small>请填写1-99的数字。</small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label"> 分类描述 <span class="tpl-form-line-small-title">description	</span></label>
                                    <div class="am-u-sm-9"  style="width: 75%">
                                        <textarea  type="text" class="tpl-form-input" id="nc-description" placeholder="" name="description"></textarea>
                                        <small>选择添加，非必填项。</small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">  </label>
                                    <div class="am-u-sm-9" style="width: 75%">
                                        <input type="hidden" id="nc-id" name="nc-id" value="">
                                        <button type="submit" id="button-1" class="am-btn am-btn-primary tpl-btn-bg-color-success "> <i class="am-icon-cog"></i> 提交 </button>
                                        <button type="submit" id="button-2" class="am-btn am-btn-primary tpl-btn-bg-color-success "> <i class="am-icon-cog"></i> 编辑 </button>
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


        });

        //表单失焦数据验证
        $('#nc-name').blur(function () {
            NcStore($(this).attr('id'));
        });
        $('#nc-slug').blur(function () {
            NcStore($(this).attr('id'));
        });
        $('#nc-sequence').blur(function () {
            NcStore($(this).attr('id'));
        });
        //初始化提示语言
        function GetText() {
            $("#nc-name + small").text('请填中文或英文2-15字左右。').removeClass('red').removeClass('green');
            $("#nc-slug + small").text('请填中文或英文2-15字左右。').removeClass('red').removeClass('green');
            $("#nc-pid + small").text('必须选择项。').removeClass('red').removeClass('green');
            $("#nc-sequence + small").text('请填写1-99的数字。').removeClass('red').removeClass('green');
        }

        //添加分类
        $("#button-1").click(function(){
            $.ajax({
                type: 'POST',
                url: '{{ route('cateAdd') }}',
                data: {
                    'name': $('#nc-name').val(),
                    'slug': $('#nc-slug').val(),
                    'pid': $('#nc-pid').val(),
                    'sequence': $('#nc-sequence').val(),
                    'description': $('#nc-description').val(),
                    '_token': $('input[name="_token"]').val()
                },
                dataType: 'json',
                success: function (data) {
                    $('#doc-modal-1').modal('close');
                    alert('分类添加成功！');
                    if(data.url==undefined){
                        $('#tr'+data.id).html(data.html);
                    }else{
                        window.location.href=data.url;
                    }
                   // $('tbody').append(data.html);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    var err=JSON.parse(XMLHttpRequest.responseText);
                    var htmltext=err.errors;
                    $.each(htmltext,function(i,val){
                        $("#doc-modal-1 #nc-"+i+" + small").text(val).addClass('red');
                    });
                }
            });
            return false;
        });
        //AJAX表单验证
        function  NcStore(id) {
            var array={};
            var arr = id.split('-');
            arr=arr[1];
            array[arr]=$('#'+id).val();
            array['_token']=$('input[name="_token"]').val();
            $.ajax({
                type: 'POST',
                url: '{{ route('ncstore') }}',
                data: array,
                dataType: 'html',
                success: function (data) {
                    $("#doc-modal-1 #"+id+" + small").removeClass('red').text('输入正确！').addClass('green');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    var err=JSON.parse(XMLHttpRequest.responseText);
                    var htmltext=err.errors;
                    $.each(htmltext,function(i,val){
                        $("#doc-modal-1 #nc-"+i+" + small").removeClass('green').text(val).addClass('red');
                    });
                }
            });
        }
        //初始化分类添加表单
        function TypeAdd() {
            $('#doc-modal-1').modal('open');
            GetText();//初始化提示语
            //初始化表单
            var pid={{ $data['pids'] }};
            $('#nc-name').val('');
            $('#nc-slug').val('');
            $("#nc-pid option[value='"+pid+"']").attr("selected", true);
            $('#nc-sequence').val('1');
            $('#nc-description').val('');
            $('#nc-text').text('添加分类')
            $('#button-1').show();
            $('#button-2').hide();
            var id="{{ $data['pids'] }}";
            $.get("{{ route('cateselect') }}?id="+id, function(data){
                $('#nc-pid').html(data.html);
            });
        }
        function TypeEdit(id){
            //初始化化修改窗口
            $('#doc-modal-1').modal('open');
            GetText();//初始化提示语
            //初始化表单
            $('#nc-name').val('');
            $('#nc-slug').val('');
            $('#nc-pid').val('');
            $('#nc-sequence').val('');
            $('#nc-description').val('');
            $('#nc-text').text('编辑分类')
            $('#button-1').hide();
            $('#button-2').show();
            //表单赋值
            $.get("{{ route('cateedit') }}?id="+id, function(data){
                $('#nc-name').val(data.name);
                $('#nc-slug').val(data.slug);
                $('#nc-sequence').val(data.sequence);
                $('#nc-description').val(data.description);
                $('#nc-id').val(data.id);
                $('#nc-pid').html(data.html);
                $("#nc-edit-pid option[value='"+data.pid+"']").attr("selected", true);
            });
        }

        $("#button-2").click(function(){
            $.ajax({
                type: 'POST',
                url: '{{ route('cateedits') }}',
                data: {
                    'name': $('#nc-name').val(),
                    'slug': $('#nc-slug').val(),
                    'pid': $('#nc-pid').val(),
                    'sequence': $('#nc-sequence').val(),
                    'description': $('#nc-description').val(),
                    'id': $('#nc-id').val(),
                    '_token': $('input[name="_token"]').val()
                },
                dataType: 'json',
                success: function (data) {
                    $('#doc-modal-1').modal('close');
                    alert('分类信息编辑成功！');
                    if(data.url==undefined){
                        $('#tr'+data.id).html(data.html);
                    }else{
                        window.location.href=data.url;
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    var err=JSON.parse(XMLHttpRequest.responseText);
                    var htmltext=err.errors;
                    $.each(htmltext,function(i,val){
                        $("#doc-modal-1 #nc-"+i+" + small").text(val).addClass('red');
                    });
                }
            });
            return false;
        });

        function TypeDel(id) {

            if(confirm("您是否要删除此分类！")){

                if(id){

                }else{
                    var arr=[];
                    $('input[name="subBox"]:checked').each(function(){
                        arr.push(this.value);
                    })
                    var id = JSON.stringify(arr);//数组转换成json，都在了，数组和json

                }

                $.ajax({
                    type: 'POST',
                    url: '{{ route('catedel') }}',
                    data: {
                        'id':id,
                        '_token': $('input[name="_token"]').val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        alert(data.text);
                        if(data.url!=undefined){
                            window.location.href=data.url;
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert('删除失败！');
                    }
                });
            }
            return false;
        }

        $("#checkAll").click(function() {
            if($(this).prop('checked') == false ){
                $('input[name="subBox"]').prop("checked",false);
            }else{
                $('input[name="subBox"]').prop("checked",'checked');
            }
        });




    </script>
@endsection