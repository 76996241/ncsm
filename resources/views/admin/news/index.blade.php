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
                                <th width="3%"><input type="checkbox"  class="tpl-table-fz-check"  id="checkAll"></th>
                                <th width="3%">ID</th>
                                <th width="41%">标题</th>
                                <th width="14%">分类</th>
                                <th width="14%">更新时间</th>
                                <th width="15%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data['news']  as $news)
                                <tr id="tr{{ $news['id'] }}">
                                    <td><input type="checkbox" name="subBox" value="{{ $news['id'] }}"></td>
                                    <td>{{ $news['id'] }}</td>
                                    <td>{{ $news['title'] }}</td>
                                    <td>{{ NcGetType($news['type'],'2') }}</td>
                                    <td>{{ $news['updated_at'] }}</td>

                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <button type="button"  class="am-btn am-btn-default am-btn-xs am-text-secondary" onclick="javascript:top.location='{{ route('newsedit') }}?id={{ $news['id'] }}'"><span class="am-icon-pencil-square-o"></span> 编辑</button>
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
                        {!! $data['news']->appends(['type' => $data['type'],'keyword' => $data['keyword']])->render() !!}
                         @else
                        {!! $data['news']->appends(['type' => $data['type']])->render() !!}
                        @endif

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
    <script language="JavaScript">
        $(document).ready(function () {
            NewsAdd();
            var keyword="{!! $data['keyword'] !!}";
            if(keyword){
                $('#news-keyword').val(keyword)
            }
        });

        $("#checkAll").click(function() {
            if($(this).prop('checked') == false ){
                $('input[name="subBox"]').prop("checked",false);
            }else{
                $('input[name="subBox"]').prop("checked",'checked');
            }
        });

        $('#news-type').change(function(){
            var val=$(this).children('option:selected').val();
            var type="{{ $data['type'] }}";
                if(type!=val){
                    var keyword="{{ $data['keyword'] }}";
                    if(keyword){
                        avascript:top.location='{{ route('news') }}?type='+val+'&keyword='+keyword;
                    }else{
                        avascript:top.location='{{ route('news') }}?type='+val;
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
            $("#news-type option[value=37]").attr("selected", true);
        }

        function TypeDel(id) {

            if(confirm("您是否要删除此资讯！")){
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
                    url: '{{ route('NewsDel') }}',
                    data: {
                        'id':id,
                        'url':'{!! Request::getRequestUri() !!}',
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

        function keywork() {
            var keyword=$('#news-keyword').val();
            if(keyword){
            var type="{{ $data['type'] }}";
            var page="0";

                avascript:top.location='{{ route('news') }}?type='+type+"&page="+page+"&keyword="+keyword;
            }else{
                alert('请输入关键词');
            }
        }


    </script>
@endsection