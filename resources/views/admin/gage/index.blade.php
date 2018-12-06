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
                <div class="am-u-sm-12 am-u-md-3" style=" padding-left: 0px; padding-right: 0px">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <button type="button" class="am-btn am-btn-default am-btn-secondary " onclick="javascript:top.location='{{ route('gageadd') }}' "><span class="am-icon-plus"></span> 新增</button>
                            <button type="button" class="am-btn am-btn-default am-btn-danger" onclick="TypeDel()"><span class="am-icon-trash-o"></span> 删除</button>
                        </div>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-3">
                    <div class="am-form-group">
                        <select data-am-selected="" id="gage-type">
                            <option value="0">量具类型</option>
                        </select>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-3">
                    <div class="am-form-group">
                        <select data-am-selected="" id="gage-hrand">
                            <option value="0">量具品牌</option>
                        </select>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-3">
                    <div class="am-input-group am-input-group-sm">
                        <input type="text" class="am-form-field" value="" name="keywork" id="gage-keyword" >
                        <span class="am-input-group-btn">
            <button class="am-btn  am-btn-default am-btn-success tpl-am-btn-success am-icon-search" type="button" onclick="keyword()"></button>
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
                            @foreach ($data['gage']  as $gage)
                                <tr id="tr{{ $gage['id'] }}">
                                    <td><input type="checkbox" name="subBox" value="{{ $gage['id'] }}"></td>
                                    <td>{{ $gage['id'] }}</td>
                                    <td>{{ $gage['title'] }}</td>
                                    <td>{{ NcGetType($gage['type'],'2') }} - {{ NcGetType($gage['hrand'],'2') }}</td>
                                    <td>{{ $gage['updated_at'] }}</td>

                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <button type="button"  class="am-btn am-btn-default am-btn-xs am-text-secondary" onclick="javascript:top.location='{{ route('gageedit') }}?id={{ $gage['id'] }}'"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                                                <button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onclick="TypeDel({{ $gage['id'] }})"><span class="am-icon-trash-o"></span> 删除</button>
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
                        {!! $data['gage']->appends(['type' => $data['type'],'hrand' => $data['hrands'],'keyword' => $data['keyword']])->render() !!}
                         @else
                        {!! $data['gage']->appends(['type' => $data['type'],'hrand' => $data['hrands']])->render() !!}
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
            GageAdd();
            GageAddHrand()
            var keyword="{!! $data['keyword'] !!}";
            if(keyword){
                $('#gage-keyword').val(keyword)
            }
        });

        $("#checkAll").click(function() {
            if($(this).prop('checked') == false ){
                $('input[name="subBox"]').prop("checked",false);
            }else{
                $('input[name="subBox"]').prop("checked",'checked');
            }
        });

        $('#gage-type').change(function(){
            var val=$(this).children('option:selected').val();
            var hrand="{{ $data['hrands'] }}";
            var type ="{{ $data['type'] }}";

                if(type!=val){
                    var keyword="{{ $data['keyword'] }}";
                    if(keyword){
                        avascript:top.location='{{ route('gage') }}?type='+val+'&hrand='+hrand+'&keyword='+keyword;
                    }else{
                        avascript:top.location='{{ route('gage') }}?type='+val+'&hrand='+hrand;
                    }

                }
        });
        $('#gage-hrand').change(function(){
            var vals="{{ $data['type'] }}";
            var hrands=$(this).children('option:selected').val();
            var types ="{{ $data['hrands'] }}";
            if(types!=hrands){
                var keyword="{{ $data['keyword'] }}";
                if(keyword){
                    avascript:top.location='{{ route('gage') }}?type='+vals+'&hrand='+hrands+'&keyword='+keyword;
                }else{
                    avascript:top.location='{{ route('gage') }}?type='+vals+'&hrand='+hrands;
                }

            }
        });
        //初始化资讯添加表单
        function GageAdd() {
            var id="{{ $data['pids'] }}";
            var key="3";
            var type="{{ $data['type'] }}";
            $.get("{{ route('gageselect') }}?id="+id+"&key="+key+"&type="+type, function(data){
                $('#gage-type').html(data.html);
            });
        }
        //初始化资讯添加表单
        function GageAddHrand() {
            var id="{{ $data['hrand'] }}";
            var key="4";
            var hrand="{{ $data['hrands'] }}";
            $.get("{{ route('gageselect') }}?id="+id+"&key="+key+"&type="+hrand, function(data){
                $('#gage-hrand').html(data.html);
            });
        }

        function TypeDel(id) {

            if(confirm("您是否要删除此条资源！")){
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
                    url: '{{ route('GageDel') }}',
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

        function keyword() {
            var keyword=$('#gage-keyword').val();
            if(keyword){
            var type="{{ $data['type'] }}";
            var hrand="{{ $data['hrands'] }}";
            var page="0";

                avascript:top.location='{{ route('gage') }}?type='+type+'&hrand='+hrand+"&page="+page+"&keyword="+keyword;
            }else{
                alert('请输入关键词');
            }
        }


    </script>
@endsection