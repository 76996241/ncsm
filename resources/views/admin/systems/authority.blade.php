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
                            <button type="button" class="am-btn am-btn-default am-btn-secondary " onclick="javascript:top.location='{{ route('cate') }}?id=3'" ><span class="am-icon-plus"></span> 新增权限 </button>


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

                                <th width="3%">ID</th>
                                <th width="24%">用户组名称</th>
                                <th width="34%">更新时间</th>
                                <th width="26%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data['cate']  as $post_cates)
                                <tr id="tr{{ $post_cates['id'] }}">
                                    <td>{{ $post_cates['id'] }}</td>
                                    <td>{{ $post_cates['name'] }}</td>
                                    <td>{{ $post_cates['sequence'] }}</td>

                                    <td>
                                        <div class="am-btn-toolbar">
                                            <div class="am-btn-group am-btn-group-xs">
                                                <button type="button"  class="am-btn am-btn-default am-btn-xs am-text-secondary" onclick="javascript:top.location='{{ route('authorityadmin') }}?id={{ $post_cates['id'] }}'"><span class="am-icon-pencil-square-o"></span> 编辑权限</button>
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

@endsection
@section('footerJsCss')
    <script src="{{ asset('js/ncsm.js') }}"></script>
    <script src="{{ asset('/laravel-u-editor/ueditor.config.js')}}"></script>
    <script src="{{ asset('/laravel-u-editor/ueditor.all.min.js')}}"></script>
    <script language="JavaScript">
        $(document).ready(function () {


        });








    </script>
@endsection