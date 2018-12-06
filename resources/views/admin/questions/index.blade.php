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
                <div class="am-u-sm-12 am-u-md-2" style=" padding-left: 0px; padding-right: 0px">
                    <div class="am-btn-toolbar">
                        <div class="am-btn-group am-btn-group-xs">
                            <button type="button" class="am-btn am-btn-default am-btn-secondary " onclick="javascript:top.location='{!! $data['addurl'] !!}' "><span class="am-icon-plus"></span> 新增</button>
                            <button type="button" class="am-btn am-btn-default am-btn-danger" onclick="TypeDel()"><span class="am-icon-trash-o"></span> 删除</button>
                        </div>
                    </div>
                </div>

                <div class="am-u-sm-12 am-u-md-2">
                    <div class="am-form-group">
                        <select data-am-selected="" id="question-cncuse" onchange="Options()" >

                        </select>
                    </div>
                </div>


                <div class="am-u-sm-12 am-u-md-2">
                    <div class="am-form-group">
                        <select data-am-selected="" id="question-easy" onchange="Options()">

                        </select>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-2">
                    <div class="am-form-group">
                        <select multiple='multiple'  data-am-selected="" id="question-Knowledge" onchange="Options()">

                        </select>
                    </div>
                </div>

                <div class="am-u-sm-12 am-u-md-3">
                    <div class="am-input-group am-input-group-sm">
                        <input type="text" class="am-form-field" value="" name="keywork" id="question-keyword" >
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
                                <th width="31%">标题</th>
                                <th width="19%">分类</th>
                                <th width="14%">更新时间</th>
                                <th width="20%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data['question']  as $question)
                                <tr id="tr{{ $question['id'] }}">
                                    <td><input type="checkbox" name="subBox" value="{{ $question['id'] }}"></td>
                                    <td>{{ $question['id'] }}</td>
                                    <td>{{ $question['title'] }}</td>
                                    <td>{{ NcGetType($question['project'],'2') }} - {{ NcGetType($question['cncuse'],'2') }}</td>
                                    <td>{{ $question['updated_at'] }}</td>

                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <button type="button"  class="am-btn am-btn-default am-btn-xs am-text-secondary" onclick="javascript:top.location='{{ $data['url'] }}/questionsedit?id={{ $question['id'] }}'"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                                                <button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onclick="TypeDel({{ $question['id'] }})"><span class="am-icon-trash-o"></span> 删除</button>
                                                <a class="am-btn am-btn-default am-btn-xs am-hide-sm-only" href='{{ $data['url'] }}/subject?id={{ $question['id'] }}'><span class="am-icon-copy"></span> 试题设置</a>
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
            GuestionAdd();
            var keyword="{!! $data['keyword'] !!}";
            if(keyword){
                $('#question-keyword').val(keyword)
            }
            $('#question-cncuse + .am-selected').css('width','150px');
            $('#question-easy + .am-selected').css('width','150px');
            $('#question-Knowledge + .am-selected').css('width','150px');
        });

        $("#checkAll").click(function() {
            if($(this).prop('checked') == false ){
                $('input[name="subBox"]').prop("checked",false);
            }else{
                $('input[name="subBox"]').prop("checked",'checked');
            }
        });



        function Options(){

            var cncuse=$('#question-cncuse').children('option:selected').val();
            var easy=$('#question-easy').children('option:selected').val();
            var Knowledge='';
            var i=0;
            $("#question-Knowledge option:selected").each(function(){
                if(i==0){
                    Knowledge+=$(this).val();
                }else{
                    Knowledge+='|'+$(this).val();
                }
                i=i+1;
            });

            if(Knowledge==''){
                Knowledge='0';

            }
            var cncusetype="{{ $data['cncuse'] }}";
            var easytype="{{ $data['easy'] }}";
            var Knowledgetype="{{ $data['Knowledge'] }}";
            var val=cncuse+','+easy+','+Knowledge;
            var type=cncusetype+','+easytype+','+Knowledgetype;
            if(cncuse!=cncusetype || easy!=easytype || Knowledge!=Knowledgetype ) {
                var keyword = "{{ $data['keyword'] }}";
                if (keyword) {
                   avascript:top.location = '{{ $data['url'] }}/?val=' + val + '&type=' + type+ '&keyword=' + keyword;
                } else {
                    avascript:top.location = '{{ $data['url'] }}/?val=' + val + '&type=' + type;
                }
            }

        };



        //初始化资讯添加表单
        function GuestionAdd() {
            var id="{{ $data['pids'] }}";
            var key="10";
            var type="{{ $data['type'] }}";
            $.get("{{ $data['url'] }}/QuestionsSelectss?id="+id+"&key="+key+"&type="+type, function(data){
                $('#question-cncuse').html(data.cncuse);
                $('#question-Knowledge').html(data.Knowledge);
                $('#question-easy').html(data.easy);
            });
        }


        function TypeDel(id) {

            if(confirm("您是否要删除此试题，试题的相关设置将一起删除！")){
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
                    url: '{{ $data['url'] }}/QuestionsDel',
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
            var keyword=$('#question-keyword').val();
            if(keyword){
            var type="{{ $data['type'] }}";
            var hrand="";
            var page="0";

                avascript:top.location='{{ $data['url'] }}?type='+type+"&page="+page+"&keyword="+keyword;
            }else{
                alert('请输入关键词');
            }
        }


    </script>
@endsection