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
                    <form class="am-form tpl-form-line-form" enctype="multipart/form-data" action="{!! $data['url'] !!}/SubjectUpdate" method="post" >
                        <div class="am-g">
                            <div class="am-u-sm-12 am-u-md-6" style=" padding-left: 0px; padding-right: 0px;margin-bottom: 30px">
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <button type="submit" id="button-1" class="am-btn am-btn-primary tpl-btn-bg-color-success "> <i class="am-icon-cog"></i> 编辑题目信息 </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label"> 题目名称 <span class="tpl-form-line-small-title">Title</span></label>
                            <div class="am-u-sm-9" style="width: 75%">
                                <input type="text" class="tpl-form-input" id="subject-title"  name="title" value="{!! old('subject-title') ? old('subject-title') : $data['subject']['title'] !!}">
                                <small>请填中文或英文2-15字左右。</small>
                            </div>
                        </div>
                        <div class="am-form-group">
                            <label for="user-intro" class="am-u-sm-3 am-form-label">图纸 <span class="tpl-form-line-small-title">Pdf</span></label>
                            <div class="am-u-sm-9"  style="height: 33px; width: 25%">
                                <div class="am-form-group am-form-file">
                                    <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                        <i class="am-icon-cloud-upload"></i> 选择要上传的PDF文件</button>
                                    <input id="subject-pdf" type="file" name="subject-pdf" value="{!! old('subject-pdf') ? old('subject-pdf') : $data['subject']['pdf'] !!}">
                                </div>
                            </div>
                            <div class="am-u-sm-9" id="subject-pdf-file" style="width: 75%">
                                <small style="width: 280px;">{!! old('subject-pdf') ? old('subject-pdf') : $data['subject']['pdf'] !!}</small><span style=" margin-left: 50px; font-size: 12px">@if($data['subject']['pdf']) <a href="/upload/{!! old('subject-pdf') ? old('subject-pdf') : $data['subject']['pdf'] !!}" target="_blank">查看图纸</a> @endif</span>
                            </div>

                        </div>

                        <div class="am-form-group">
                            <label for="user-name" class="am-u-sm-3 am-form-label">  </label>
                            <div class="am-u-sm-9" style="width: 75%">
                                <input type="hidden" id="qid" name="qid" value="{!! $data['qid'] !!}">
                                <input type="hidden" id="id" name="id" value="{!! $data['subject']['id'] !!}">
                            </div>
                        </div>

                    </form>
                    <div class="am-g bz">
                        <div class="am-u-sm-12 am-u-md-6" style=" padding-left: 0px; padding-right: 0px;margin-bottom: 10px; margin-top: 20px">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <button type="button" class="am-btn am-btn-default am-btn-secondary " onclick="StandardsAdd()" ><span class="am-icon-plus"></span> 新增测量标准</button>
                                    <button type="button" class="am-btn am-btn-default am-btn-success" onclick="StandardsSort()"><span class="am-icon-deaf"></span> 更新排序</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($data['standard']  as $standard)
                        <div id="bz{{ $standard['id']  }}">
                            <div class="biaozhun" id="biaozhun{{ $standard['id']  }}">
                                <div class="left" style="width:40px"><input type="text" class="tpl-form-input" id="StandardsSort{{ $standard['id'] }}"  name="questions-title" value="{{ $standard['sort'] }}" style="font-size: 12px;width: 30px;height: 22px;line-height: 18px; text-align: center; border:#9BA2AB 1px double"></div><div class="left"><span id="title">{{ $standard['title']  }}</span>（分值<span id="scores">{{ $standard['scores']  }}</span>）</div>
                                <div class="right"><span style=" cursor: pointer" onclick="StandardsEdit('{{ $standard['id']  }}')">编辑</span> | <span style=" cursor: pointer" onclick="StandardsDel('{{ $standard['id']  }}')">删除</span> | <span style=" cursor: pointer" onclick="measureAdd('{{ $standard['id']  }}')">增加测量内容</span> | <span style=" cursor: pointer" onclick="MeasureSort('{{ $standard['id']  }}')">更新排序</span></div>
                            </div>

                            @php $i=$data['measure'.$standard['id']]  @endphp
                            @if(count($i)>0)
                                @php $aa='display: block'; @endphp
                            @else
                                @php $aa='display: none'; @endphp
                            @endif

                            <div class="biaozhunlist" id="biaozhunlist{{ $standard['id']  }}" style="{!! $aa !!}">
                                <li style=" width: 8%;">Number<br/>排序</li>
                                <li style=" width: 10%;">AspectType<br/>类型</li>
                                <li style=" width: 14%;">Aspect - Description<br/>考核内容及要求</li>
                                <li style=" width: 25%;">Requirement or Nominal Size<br/>标准尺寸</li>
                                <li style=" width: 22%;">Add - (Extra Aspect Information)<br/>附加内容</li>
                                <li style=" width: 10%;">Max Mark<br/>满分/配分</li>
                                <li style=" width: 9%; border-right:0px">Operation<br/>操作</li>
                            </div>


                            @foreach($i as $measure)
                                <div class="biaozhunlists biaozhunlists{{ $standard['id']  }}" id="biaozhunlists{{ $measure['id'] }}">
                                    <li style=" width: 8%; text-align: center" id=""><input type="text" class="tpl-form-input" id="MeasureSort{{ $measure['id'] }}"  name="questions-title" value="{{ $measure['sort'] }}" style="font-size: 12px;width: 30px;height: 22px;line-height: 18px; text-align: center; border:#9BA2AB 1px double"></li>
                                    <li style=" width: 10%;">{{ NcGetType($measure['aspecttype'],'2') }}</li>
                                    <li style=" width: 14%;">{{ $measure['aspectdescription'] }}</li>
                                    <li style=" width: 25%;">{{ $measure['aspectsize'] }}（偏差值：{{ $measure['aspecterrora'] }}，{{ $measure['aspecterrorb'] }}）</li>
                                    <li style=" width: 22%;">{{ $measure['aspectadd'] }}</li>
                                    <li style=" width: 10%;">{{ $measure['maxmark'] }}</li>
                                    <li style=" width: 9%; border-right:0px"><span style=" cursor: pointer; color:#be590a " onclick="MeasureEdit('{{ $measure['id']  }}')">编辑</span> | <span style=" cursor: pointer; color:#be590a " onclick="MeasureDel('{{ $measure['id']  }}')">删除</span></li>
                                </div>
                            @endforeach
                        </div>
                    @endforeach




                </div>
            </div>
        </div>
    </div>

@endsection

@section('modal')
    <!--编辑测量标准-->
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
                                    <label for="user-name" class="am-u-sm-3 am-form-label"> 标准名称 <span class="tpl-form-line-small-title">Title</span></label>
                                    <div class="am-u-sm-9" style="width: 75%">
                                        <input type="text" class="tpl-form-input" id="standards-title"  name="title" value="">
                                        <small>请填中文或英文2-15字左右。</small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label"> 标准分值 <span class="tpl-form-line-small-title">Sort</span></label>
                                    <div class="am-u-sm-9" style="width: 75%">
                                        <input type="number" class="tpl-form-input" id="standards-scores"  name="scores" value="">
                                        <small>请填1-100的整数。</small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">  </label>
                                    <div class="am-u-sm-9" style="width: 75%">
                                        <input type="hidden" id="qid" name="qid" value="{!! $data['qid'] !!}">
                                        <input type="hidden" id="sid" name="sid" value="{!! $data['sid'] !!}">
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
    <!--编辑测量内容-->
    <div class="am-modal am-modal-no-btn" tabindex="-2" id="doc-modal-2">
        <div class="am-modal-dialog" style="width: 640px">

            <div class="am-modal-hd"><span id="nc-text"></span>
                <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
            </div>

            <div class="am-modal-bd">
                <div class="tpl-block">
                    <div class="am-g">
                        <div class="tpl-form-body tpl-form-line">
                            <form class="am-form tpl-form-line-form" enctype="multipart/form-data"  method="post" >
                                {{ csrf_field() }}
                                <div class="am-form-group" style="margin-bottom: 1rem;">
                                    <label for="user-name" class="am-u-sm-4 am-form-label"> 类型<br/> <span class="tpl-form-line-small-title">AspectType</span></label>
                                    <div class="am-u-sm-8" style="width: 66%">
                                        <select name="measures-aspecttype" id="measures-aspecttype" style="width: 30%">

                                        </select>

                                        <small></small>
                                    </div>
                                </div>
                                <div class="am-form-group"  style="margin-bottom: 1rem;">
                                    <label for="user-name" class="am-u-sm-4 am-form-label"> 考核内容<br/> <span class="tpl-form-line-small-title">Aspect - Descriptio</span></label>
                                    <div class="am-u-sm-8" style="width: 66%">
                                        <input type="text" class="tpl-form-input" id="measures-aspectdescription"  name="measures-aspectdescription" value="">
                                        <small>请填1-100的整数。</small>
                                    </div>
                                </div>
                                <div class="am-form-group" style="margin-bottom: 1rem;">
                                    <label for="user-name" class="am-u-sm-4 am-form-label"> 测量类型<br/> <span class="tpl-form-line-small-title">Type of measurement
</span></label>
                                    <div class="am-u-sm-8" style="width: 66%">
                                        <div style="width: 40%; float: left">
                                        <select name="measures-measuretype" id="measures-measuretype" style="width: 100%">
                                        </select>
                                            <small></small></div>
                                        <div style="width: 40%; float: left; margin-left: 15px">
                                            <select name="measures-measuretype" id="measures-measuretype" style="width:60%">
                                            </select>
                                            <small></small></div>
                                    </div>
                                </div>
                                <div class="am-form-group" style="margin-bottom: 1rem;">
                                    <label for="user-name" class="am-u-sm-4 am-form-label"> 标准尺寸<br/> <span class="tpl-form-line-small-title">Requirement or Nominal Size</span></label>
                                    <div class="am-u-sm-8" style="width: 66%">
                                        <div style="width: 24%; float: left"><input type="text" class="tpl-form-input" id="measures-aspectsize"  name="measures-aspectsize" value="" style="width:84px; ">
                                            <small style="float: left; margin-top: 5px">请填1-100的整数。</small></div>
                                        <div style="width: 26%; text-align: center; float: left" class="tpl-form-line-form am-form-label">偏差范围<span class="tpl-form-line-small-title">Deviation</span></div>
                                        <div style="width:25%; float: left"><input type="text" class="tpl-form-input" id="measures-aspecterrora"  name="measures-aspecterrora" value="" style="width:60px; ">
                                            <small style="float: left; margin-top: 5px">请填1-100的整数。</small></div>
                                        <div style="width: 25%; float: left"><input type="text" class="tpl-form-input" id="measures-aspecterrorb"  name="measures-aspecterrorb" value="" style="width:60px; ">
                                            <small style="float: left; margin-top: 5px">请填1-100的整数。</small></div>
                                    </div>
                                </div>
                                <div class="am-form-group" style="margin-bottom: 1rem;">
                                    <label for="user-name" class="am-u-sm-4 am-form-label"> 附加内容 <br/> <span class="tpl-form-line-small-title">Extra Aspect Information)</span></label>
                                    <div class="am-u-sm-8" style="width: 66%">
                                        <input type="text" class="tpl-form-input" id="measures-aspectadd"  name="measures-aspectadd" value="">
                                        <small>请填1-100的整数。</small>
                                    </div>
                                </div>
                                <div class="am-form-group" style="margin-bottom: 1rem;">
                                    <label for="user-name" class="am-u-sm-4 am-form-label"> 满分/配分<br/>  <span class="tpl-form-line-small-title">Max Mark</span></label>
                                    <div class="am-u-sm-8" style="width: 66%">
                                        <input type="text" class="tpl-form-input" id="measures-maxmark"  name="measures-maxmark" value="" style="width: 100px">
                                        <small>请填加数字。</small>
                                    </div>
                                </div>
                                <div class="am-form-group" style="margin-bottom: 1rem; margin-top: 15px">
                                    <label for="user-name" class="am-u-sm-4 am-form-label">  </label>
                                    <div class="am-u-sm-5" style="width: 66%">
                                        <input type="hidden" id="measures-qid" name="measures-qid" value="{!! $data['qid'] !!}">
                                        <input type="hidden" id="measures-sid" name="measures-sid" value="{!! $data['sid'] !!}">
                                        <input type="hidden" id="measures-ssid" name="measures-ssid" value="0">
                                        <input type="hidden" id="measures-id" name="measures-id" value="0">
                                        <button type="submit" id="button-3" class="am-btn am-btn-primary tpl-btn-bg-color-success "> <i class="am-icon-cog"></i> 设置测量内容 </button>
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
        $('#standards-title').blur(function () {
            NcStore($(this).attr('id'));
        });
        //表单失焦数据验证
        $('#standards-scores').blur(function () {
            NcStore($(this).attr('id'));
        });

        //表单失焦数据验证
        $('#measures-aspectdescription').blur(function () {
            NcStore($(this).attr('id'));
        });
        //表单失焦数据验证
        $('#measures-aspectsize').blur(function () {
            NcStore($(this).attr('id'));
        });
        //表单失焦数据验证
        $('#measures-aspecterrora').blur(function () {
            NcStore($(this).attr('id'));
        });
        //表单失焦数据验证
        $('#measures-aspecterrorb').blur(function () {
            NcStore($(this).attr('id'));
        });
        //表单失焦数据验证
        $('#measures-aspectadd').blur(function () {
            NcStore($(this).attr('id'));
        });
        //表单失焦数据验证
        $('#measures-maxmark').blur(function () {
            NcStore($(this).attr('id'));
        });


        function GetText() {
            var title="{!! $errors->first('standards-title') !!}";
            var scores="{!! $errors->first('standards-scores') !!}";
            GetErr('title','standards',title,'请填中文或英文10-50字左右。');
            GetErr('scores','standards',scores,'请填1-100的整数。');
        }

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
                $("#subject-title + small").removeClass('green').text('题目名称输入错误!').addClass('red');
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

        OneFilePdf('subject-pdf');
        var ue=UE.getEditor("ueditor");
        ue.ready(function(){
            //因为Laravel有防csrf防伪造攻击的处理所以加上此行
            ue.execCommand('serverparam','_token','{{ csrf_token() }}');
        });

        //初始化添加表单
        function StandardsAdd() {
            $('#doc-modal-1').modal('open');
            $('#id').val('0');
            $('#standards-title').val('');
            $('#standards-title + small').text('请填中文或英文2-15字左右。').removeClass('red').removeClass('green');
            $('#standards-scores').val('');
            $('#standards-scores + small').text('请填1-100的整数。').removeClass('red').removeClass('green');
        }
        //初始化添加表单
        function StandardsEdit(id) {
            $('#doc-modal-1').modal('open');

            $('#standards-title').val('');
            $('#standards-scores').val('');
            $('#id').val('0');

            $.get("{!! $data['url'] !!}/standards?id="+id, function(data){
                $('#standards-title').val(data.title);
                $('#standards-scores').val(data.scores);
                $('#id').val(data.id);
            });
            $('#standards-title + small').text('请填中文或英文2-15字左右。').removeClass('red').removeClass('green');
            $('#standards-scores + small').text('请填1-100的整数。').removeClass('red').removeClass('green');
        }

        //提交测量标准
        $("#button-2").click(function(){
            $.ajax({
                type: 'POST',
                url: "{!! $data['url'] !!}/StandardsInsert",
                data: {
                    'title': $('#standards-title').val(),
                    'scores': $('#standards-scores').val(),
                    'sid': $('#sid').val(),
                    'qid': $('#qid').val(),
                    'id': $('#id').val(),
                    '_token': $('input[name="_token"]').val()
                },
                dataType: 'json',
                success: function (data) {
                    $('#doc-modal-1').modal('close');
                    if(data.id=='1'){
                        alert('测量标准添加成功！');
                        $('.bz').after(data.html);
                    }else if(data.id>'1'){
                        alert('测量标准编辑成功！');
                        $('#bz'+data.id+' #title').html(data.title)
                        $('#bz'+data.id+' #scores').html(data.scores)
                    }else{
                        alert('测量标准添加失败！');
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

        function measureAdd(id) {
            $('#doc-modal-2').modal('open');
            $('#measures-aspectdescription').val('');
            $('#measures-aspecttype').val('');
            $('#measures-aspectsize').val('');
            $('#measures-measuretype').val('');
            $('#measures-aspecterrora').val('');
            $('#measures-aspecterrorb').val('');
            $('#measures-aspectadd').val('');
            $('#measures-maxmark').val('');
            $('#measures-ssid').val(id);
            $('#measures-id').val('0');
            var key='7';
            var aspecttype="{{ $data['aspecttype'] }}";
            var aspecttypeid="{{ $data['aspecttypeid'] }}";
            $.get("{{ route('measureselect') }}?id="+aspecttypeid+'&key='+key+'&type='+aspecttype, function(data){
                $('#measures-aspecttype').html(data.html);
            });
            key='8';
            var measuretype="{{ $data['measuretype'] }}";
            var measuretypeid="{{ $data['measuretypeid'] }}";
            $.get("{{ route('measureselect') }}?id="+measuretypeid+'&key='+key+'&type='+measuretype, function(data){
                $('#measures-measuretype').html(data.html);
            });
            $('#measures-aspectdescription + small').text('请填中文或英文30字以内。').removeClass('red').removeClass('green');
            $('#measures-aspecttype + small').text('必选项。').removeClass('red').removeClass('green');
            $('#measures-measuretype + small').text('必选项。').removeClass('red').removeClass('green');
            $('#measures-aspectsize + small').text('请输入数字。').removeClass('red').removeClass('green');
            $('#measures-aspecterrora + small').text('请输入数字。').removeClass('red').removeClass('green');
            $('#measures-aspecterrorb + small').text('请输入数字。').removeClass('red').removeClass('green');
            $('#measures-aspectadd + small').text('请填中文或英文30字以内。').removeClass('red').removeClass('green');
            $('#measures-maxmark + small').text('请输入数字。').removeClass('red').removeClass('green');

        }


        function MeasureEdit(id) {
            $('#doc-modal-2').modal('open');
            $('#measures-aspectdescription').val('');
            $('#measures-aspecttype').val('');
            $('#measures-aspectsize').val('');
            $('#measures-measuretype').val('');
            $('#measures-aspecterrora').val('');
            $('#measures-aspecterrorb').val('');
            $('#measures-aspectadd').val('');
            $('#measures-maxmark').val('');
            $('#measures-ssid').val();
            $('#measures-id').val();
            $.get("{!! $data['url'] !!}/measures?id="+id, function(data){
                $('#doc-modal-2').modal('open');
                $('#measures-aspectdescription').val(data.aspectdescription);
                $('#measures-aspecttype').html(data.aspecttype);
                $('#measures-aspectsize').val(data.aspectsize);
                $('#measures-measuretype').html(data.measuretype);
                $('#measures-aspecterrora').val(data.aspecterrora);
                $('#measures-aspecterrorb').val(data.aspecterrorb);
                $('#measures-aspectadd').val(data.aspectadd);
                $('#measures-maxmark').val(data.maxmark);
                $('#measures-ssid').val(data.ssid);
                $('#measures-id').val(data.id);
            });

            $('#measures-aspectdescription + small').text('请填中文或英文30字以内。').removeClass('red').removeClass('green');
            $('#measures-aspecttype + small').text('必选项。').removeClass('red').removeClass('green');
            $('#measures-measuretype + small').text('必选项。').removeClass('red').removeClass('green');
            $('#measures-aspectsize + small').text('请输入数字。').removeClass('red').removeClass('green');
            $('#measures-aspecterrora + small').text('请输入数字。').removeClass('red').removeClass('green');
            $('#measures-aspecterrorb + small').text('请输入数字。').removeClass('red').removeClass('green');
            $('#measures-aspectadd + small').text('请填中文或英文30字以内。').removeClass('red').removeClass('green');
            $('#measures-maxmark + small').text('请输入数字。').removeClass('red').removeClass('green');

        }



        //提交测量内容
        $("#button-3").click(function(){
            $.ajax({
                type: 'POST',
                url: "{!! $data['url'] !!}/MeasuresInsert",
                data: {
                    'aspectdescription': $('#measures-aspectdescription').val(),
                    'aspecttype': $('#measures-aspecttype').val(),
                    'aspectsize': $('#measures-aspectsize').val(),
                    'measuretype': $('#measures-measuretype').val(),
                    'aspecterrora': $('#measures-aspecterrora').val(),
                    'aspecterrorb': $('#measures-aspecterrorb').val(),
                    'aspectadd': $('#measures-aspectadd').val(),
                    'maxmark': $('#measures-maxmark').val(),
                    'ssid': $('#measures-ssid').val(),
                    'sid': $('#measures-sid').val(),
                    'qid': $('#measures-qid').val(),
                    'id': $('#measures-id').val(),
                    '_token': $('input[name="_token"]').val()
                },
                dataType: 'json',
                success: function (data) {
                    $('#doc-modal-2').modal('close');
                    if(data.id=='1'){
                        alert('测量内容添加成功！');
                        $('#biaozhunlist'+data.ssid).show();
                        $('#biaozhunlist'+data.ssid).after(data.html);
                    }else if(data.id>'1'){
                        alert('测量内容编辑成功！');
                        $('#biaozhunlists'+data.id).after(data.html);
                        $('#biaozhunlists'+data.id).remove();
                    }else{
                        alert('测量内容添加失败！');
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    var err=JSON.parse(XMLHttpRequest.responseText);
                    var htmltext=err.errors;
                    $.each(htmltext,function(i,val){
                        $("#doc-modal-2 #measures-"+i+" + small").text(val).addClass('red');
                    });
                }
            });
            return false;
        });

        //更新测量标准排序
        function StandardsSort(){
            var id='';
            var val='';
            for (var i=0;i<$('.biaozhun input').length;i++)
            {
                if($('.biaozhun input').length!=i+1){
                    id+= $('.biaozhun input:eq('+i+')').attr('id')+',';
                    val+=$('.biaozhun input:eq('+i+')').val()+',';
                }else{
                    id+= $('.biaozhun input:eq('+i+')').attr('id');
                    val+=$('.biaozhun input:eq('+i+')').val();
                }
            }
            $.ajax({
                type: 'POST',
                url: "{!! $data['url'] !!}/StandardsSort",
                data: {
                    'id': id,
                    'val': val,
                    '_token': $('input[name="_token"]').val()
                },
                dataType: 'json',
                success: function (data) {


                    if(data.id=='1'){
                        alert('更新排序成功');
                        avascript:top.location="{!! $data['url'] !!}/subjectedit?sid={!! $data['sid'] !!}&qid={!! $data['qid'] !!}";
                    }else{
                        alert('更新排序失败！');
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert('更新排序失败！');
                }
            });


        }

        //更新测量内容排序
        function MeasureSort(ids){
            var id='';
            var val='';
            for (var i=0;i<$('.biaozhunlists'+ids+' input').length;i++)
            {
                if($('.biaozhunlists'+ids+' input').length!=i+1){
                    id+= $('.biaozhunlists'+ids+' input:eq('+i+')').attr('id')+',';
                    val+=$('.biaozhunlists'+ids+' input:eq('+i+')').val()+',';
                }else{
                    id+= $('.biaozhunlists'+ids+' input:eq('+i+')').attr('id');
                    val+=$('.biaozhunlists'+ids+' input:eq('+i+')').val();
                }
            }
            $.ajax({
                type: 'POST',
                url: "{!! $data['url'] !!}/MeasureSort",
                data: {
                    'id': id,
                    'val': val,
                    'ssid': ids,
                    '_token': $('input[name="_token"]').val()
                },
                dataType: 'json',
                success: function (data) {


                    if(data.id=='1'){
                        alert('更新排序成功');
                        $('.biaozhunlists'+ids).remove();
                        $('#biaozhunlist'+data.ssid).after(data.html);
                    }else{
                        alert('更新排序失败！');
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert('更新排序失败！');
                }
            });


        }

        function MeasureDel(id){
            if(confirm("您确定要删除此测量内容！")){
                $.ajax({
                    type: 'POST',
                    url: '{!! $data['url'] !!}/MeasureDel',
                    data: {
                        'id':id,
                        '_token': $('input[name="_token"]').val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        alert('删除成功！');
                        $('#biaozhunlists'+data.id).remove();
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert('删除失败！');
                    }
                });
            }
            return false;
        }
        function StandardsDel(id){
            if(confirm("您确定要删除此测量标准！")){
                $.ajax({
                    type: 'POST',
                    url: '{!! $data['url'] !!}/StandardsDel',
                    data: {
                        'id':id,
                        '_token': $('input[name="_token"]').val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        if(data.id=='0'){
                            alert('删除失败！此标准下添加了测量内容，请删除测量内容后再删除测量标准！');
                        }else{
                            alert('删除成功！');
                            $('#biaozhunlist'+data.id).remove();
                            $('#biaozhun'+data.id).remove();
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert('删除失败！');
                    }
                });
            }
            return false;
        }
    </script>
@endsection