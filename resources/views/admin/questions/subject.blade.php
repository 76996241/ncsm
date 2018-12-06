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
                            <button type="button" class="am-btn am-btn-default am-btn-secondary " onclick="SubjectAdd()" ><span class="am-icon-plus"></span> 新增工件</button>
                            <button type="button" class="am-btn am-btn-default am-btn-danger" onclick="TypeDel()"><span class="am-icon-trash-o"></span> 删除</button>
                            <button type="button" class="am-btn am-btn-default am-btn-success" onclick="Sort()"><span class="am-icon-deaf"></span> 更新排序</button>
                           @if($data['questiondata']['cncuse']=='89')
                            <button type="button" class="am-btn am-btn-default am-btn-warning " onclick="Combination()" ><span class="am-icon-plus"></span> 选择组合工件</button>
                           @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="am-g">
                <div class="am-u-sm-12" style=" padding-left: 0px; padding-right: 0px;">
                    <form class="am-form sort">
                        <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>
                                <th width="5%">排序</th>
                                <th width="3%">ID</th>
                                <th width="40%">工件名称</th>
                                <th width="18%">更新时间</th>
                                <th width="21%">操作</th>
                            </tr>
                            </thead>
                            <tbody class="subject">
                            @foreach ($data['subject']  as $subjects)
                                <tr id="tr{{ $subjects['id'] }}">
                                    <td><input type="text" class="tpl-form-input" id="sort{{ $subjects['id'] }}"  name="questions-title" value="{{ $subjects['sort'] }}" style="font-size: 12px;width: 30px;height: 25px;line-height: 18px; text-align: center"></td>
                                    <td>{{ $subjects['id'] }}</td>
                                    <td>{{ $subjects['title'] }}</td>
                                    <td>{{ $subjects['updated_at'] }}</td>
                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <button type="button"  class="am-btn am-btn-default am-btn-xs am-text-secondary" onclick="javascript:top.location='{{ $data['url'] }}/subjectedit?sid={{ $subjects['id'] }}&qid={{ $data['qid'] }}'"><span class="am-icon-pencil-square-o"></span> 工件测量设置</button>
                                                <button type="button" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only" onclick="SubjectsDel({{ $subjects['id'] }})"><span class="am-icon-trash-o"></span> 删除</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                        @if($data['questiondata']['cncuse']=='89')
                        <table class="am-table am-table-striped am-table-hover table-main">
                            <thead>
                            <tr>
                                <th width="5%"></th>
                                <th width="3%"></th>
                                <th width="40%">您已经选择的组合工件</th>
                                <th width="18%"></th>
                                <th width="21%"></th>
                            </tr>
                            </thead>
                            <tbody id="SubjectSelect">


                            </tbody>
                        </table>
                        @endif
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
                            <form class="am-form tpl-form-line-form  " enctype="multipart/form-data" action="{!! $data['url'] !!}/SubjectInsert" method="post" >
                                {{ csrf_field() }}
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label"> 工件名称 <span class="tpl-form-line-small-title">Title</span></label>
                                    <div class="am-u-sm-9" style="width: 75%">
                                        <input type="text" class="tpl-form-input" id="subject-title"  name="title" value="">
                                        <small>请填中文或英文2-15字左右。</small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-intro" class="am-u-sm-3 am-form-label">图纸 <span class="tpl-form-line-small-title">Pdf</span></label>
                                    <div class="am-u-sm-9"  style="height: 33px">
                                        <div class="am-form-group am-form-file">
                                            <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                                <i class="am-icon-cloud-upload"></i> 选择要上传的PDF文件</button>
                                            <input id="subject-pdf" type="file" name="subject-pdf" value="">
                                        </div>
                                    </div>

                                    <div class="am-u-sm-9" id="subject-pdf-file" style="width: 75%">
                                        <small>图纸请上传PDF格式文件!</small>
                                    </div>
                                </div>

                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">  </label>
                                    <div class="am-u-sm-9" style="width: 75%">
                                        <input type="hidden" id="qid" name="qid" value="{!! $data['qid'] !!}">
                                        <button type="submit" id="button-1" class="am-btn am-btn-primary tpl-btn-bg-color-success "> <i class="am-icon-cog"></i> 提交 </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-2">
        <div class="am-modal-dialog" style=" width: 860px">
            <div class="am-modal-hd"><span id="nc-text"></span>
                <a href="javascript: void(0)" class="am-close am-close-spin" onclick="guanbi()">&times;</a>
            </div>
            <div class="am-g" style="padding: 10px 40px 0px 10px; background-color: #FFFFFF; ">

                <div class="am-u-sm-12 am-u-md-3">
                    <div class="am-form-group">
                        <select data-am-selected="" id="question-easy" onchange="Options()">

                        </select>
                    </div>
                </div>
                <div class="am-u-sm-12 am-u-md-3">
                    <div class="am-form-group">
                        <select multiple='multiple'  data-am-selected="" id="question-Knowledge" onchange="Options()">

                        </select>
                    </div>
                </div>

                <div class="am-u-sm-12 am-u-md-3">
                    <div class="am-input-group am-input-group-sm">
                        <input type="text" class="am-form-field" value="" name="keywork" id="question-keyword" >
                        <span class="am-input-group-btn">
            <button class="am-btn  am-btn-default am-btn-success tpl-am-btn-success am-icon-search" type="button" onclick="Options()"></button>
          </span>
                    </div>
                </div>
            </div>
            <div class="am-modal-bd" style="height: 260px;padding: 0 10px 10px 20px; overflow-y: scroll">
                <table class="am-table am-table-striped am-table-hover table-main" >
                    <thead>
                    <tr>
                        <th width="5%">选择</th>
                        <th width="10%">试题编号</th>
                        <th width="48%">试题名称</th>
                        <th width="18%">添加时间</th>
                        <th width="6%">图纸</th>

                    </tr>
                    </thead>
                    <tbody id="CombinationHtml">

                    </tbody>
                </table>

            </div>
            <div class="am-modal-bd" style="height: 250px;padding: 0 10px 10px 20px;width: 98% ">
                <table class="am-table am-table-striped am-table-hover table-main" >
                    <thead>
                    <tr>
                        <th width="5%"></th>
                        <th width="10%"></th>
                        <th width="48%" style="color: #f0ad4e">你已经选择的工件</th>
                        <th width="18%"></th>
                        <th width="6%"></th>
                    </tr>
                    </thead>
                    <tbody id="CombinationHtmlSelect">

                    </tbody>
                </table>

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
            $('#question-keyword').val('');
            GuestionAdd();
            CombinationHtml();

        });

        //表单失焦数据验证
        $('#subject-title').blur(function () {
            NcStore($(this).attr('id'));
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

        $('#button-1').click(function () {

            if($('#subject-title').val()==''){
                $("#subject-title + small").removeClass('green').text('工件名称输入错误!').addClass('red');
                return false;
            }
            var str = $("#subject-pdf-file small").html();

            if(str=='图纸请上传PDF格式文件!'){
                $("#subject-pdf-file small").removeClass('green').text('请上传PDF格式的文件!').addClass('red');
                return false;
            }else{
                if(str.indexOf("pdf")==-1){
                    $("#subject-pdf-file small").removeClass('green').text('请上传PDF格式的文件!').addClass('red');
                    return false;
                }
            }

        })

        //初始化分类添加表单
        function SubjectAdd() {

            var cncuse="{!! $data['questiondata']['cncuse'] !!}";
            var subject=$('.subject tr').length;
            if(cncuse==59 && subject>0){
                alert("本试题是单工件试题，只能添加1个工件！");
            }else{
                $('#doc-modal-1').modal('open');
            }
            $('#subject-title').val('');
            $('#subject-pdf-file small').text('图纸请上传PDF格式文件!');
        }

        //初始化分类添加表单
        function Combination() {

            var cncuse="{!! $data['questiondata']['cncuse'] !!}";
            var subject=$('.subject tr').length;
            if(cncuse==89){
                $('#doc-modal-2').modal({closeViaDimmer: 0, width: 900, height: 600});

            }
        }


        OneFilePdf('subject-pdf');
        var ue=UE.getEditor("ueditor");
        ue.ready(function(){
            //因为Laravel有防csrf防伪造攻击的处理所以加上此行
            ue.execCommand('serverparam','_token','{{ csrf_token() }}');
        });

        //更新排序
        function Sort(){

            var id='';
            var val='';
            for (var i=0;i<$('.sort input').length;i++)
            {
                if($('.sort input').length!=i+1){
                id+= $('.sort input:eq('+i+')').attr('id')+',';
                val+=$('.sort input:eq('+i+')').val()+',';
                }else{
                id+= $('.sort input:eq('+i+')').attr('id');
                val+=$('.sort input:eq('+i+')').val();
                }
            }
            $.ajax({
                type: 'POST',
                url: "{!! $data['url'] !!}/SubjectsSort",
                data: {
                    'id': id,
                    'val': val,
                    'getid': "{!! $data['qid'] !!}",
                    '_token': $('input[name="_token"]').val()
                },
                dataType: 'json',
                success: function (data) {
                    if(data.id=='1'){
                        alert('更新排序成功');
                        avascript:top.location="{!! $data['url'] !!}/subject?id="+data.qid;
                    }else{
                        alert('更新排序失败！');
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert('更新排序失败！');
                }
            });


        }   function SubjectsDel(id){
            if(confirm("您确定要删除此题目！")){
                $.ajax({
                    type: 'POST',
                    url: '{!! $data['url'] !!}/SubjectsDel',
                    data: {
                        'id':id,
                        '_token': $('input[name="_token"]').val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        if(data.id=='0'){
                            alert('删除失败！此工件下添加了测量标准，请删除测量标准后在删除工件！');
                        }else{
                            alert('删除成功！');
                            $('#tr'+data.id).remove();
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert('删除失败！');
                    }
                });
            }
            return false;
        }

        //初始化资讯添加表单
        function CombinationHtml() {
            var id="{{ $data['qid'] }}";
            $.get("{{ $data['url'] }}/CombinationHtml?id="+id, function(data){
                $('#CombinationHtml').html(data.CombinationHtml);
                $('#CombinationHtmlSelect').html(data.CombinationHtmlSelect);
                $('#SubjectSelect').html(data.CombinationHtmlSelects);
            });
        }

        //初始化资讯添加表单
        function GuestionAdd() {
            var id="{{ $data['pids'] }}";
            var key="10";
            var type="{{ $data['type'] }}";
            $.get("{{ $data['url'] }}/QuestionsSelectss?id="+id+"&key="+key+"&type="+type, function(data){
                $('#question-Knowledge').html(data.Knowledge);
                $('#question-easy').html(data.easy);
            });
        }

        function Options(){

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
            var val=easy+','+Knowledge;
            var id="{{ $data['qid'] }}";
            var arr=[];
            $('#CombinationHtmlSelect input:checked').each(function(){
                arr.push(this.value);
            })
            var type = JSON.stringify(arr);//数组转换成json，都在了，数组和json

                var keyword = $('#question-keyword').val();
                if (keyword) {
                    $.get("{{ $data['url'] }}/CombinationHtml?id="+id+'&val='+val+'&type='+type+'&keyword='+keyword, function(data){
                        $('#CombinationHtml').html(data.CombinationHtml);
                    });
                } else {
                    $.get("{{ $data['url'] }}/CombinationHtml?id="+id+'&val='+val+'&type='+type, function(data){
                        $('#CombinationHtml').html(data.CombinationHtml);
                    });
                }


        }

        function CombinationSelect(id) {

            if($('#vol'+id).prop('checked') == false ){
                $('#trs'+id).remove();
            }else{
                if($('#CombinationHtmlSelect tr').length>4){
                    alert('最多只能选择5个工件组合！');
                    $('#tr'+id+' input').prop("checked",false);
                }else{
                var trs="<tr id=\"trs"+id+"\">"+$('#tr'+id).html()+"</tr>";
                var trsS="<tr id=\"trsS"+id+"\">"+$('#tr'+id).html()+"</tr>";
                $('#CombinationHtmlSelect').prepend(trs);
                $('#trs'+id+' input').prop("checked",'checked');
                $('#trs'+id+' input').attr("onclick",'CombinationSelects(\''+id+'\')');
                $('#SubjectSelect').prepend(trsS);
                $('#trsS'+id+' input').remove();
                  }
            }
        }
        function CombinationSelects(id) {
            $('#trs'+id).remove();
            $('#trsS'+id).remove();
            $('#tr'+id+' input').prop("checked",false);
        }
        //提交已经选择的工件
        function button4(){
           // alert(111);
            var arr=[];
            $('#CombinationHtmlSelect input:checked').each(function(){
                arr.push(this.value);
            })
            var combination = JSON.stringify(arr);//数组转换成json，都在了，数组和json
            $.ajax({
                type: 'POST',
                url: "{!! $data['url'] !!}/CombinationInsert",
                data: {
                    'id': "{{ $data['qid'] }}",
                    'combination': combination,
                    '_token': $('input[name="_token"]').val()
                },
                dataType: 'json',
                success: function (data) {
                    $('#doc-modal-2').modal('close');
                    if(data.id=='1'){
                        //alert('组合件关联设置成功！');
                    }else if(data.id>'1'){
                       // alert('组合件关联设置成功！');
                    }else{
                        alert('组合件关联设置失败！');
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
        }

        function guanbi() {

            if(confirm("窗口关闭后将保存您的选择，确实是否关闭？")){
                button4();
            }else{
                return false;
            }
        }

    </script>

@endsection