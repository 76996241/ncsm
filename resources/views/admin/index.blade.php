@extends('admin.layouts.app')
@section('title')
    {{$data['page']['title']}}
@endsection
@section('content')
    <div class="row">
        <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
            <div class="dashboard-stat blue">
                <div class="visual">
                    <i class="am-icon-comments-o"></i>
                </div>
                <div class="details">
                    <div class="number"> 1349 </div>
                    <div class="desc"> 学员用户数量 </div>
                </div>
                <a class="more" href="#"> 查看更多
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
            <div class="dashboard-stat red">
                <div class="visual">
                    <i class="am-icon-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number"> 62% </div>
                    <div class="desc"> 使用率 </div>
                </div>
                <a class="more" href="#"> 查看更多
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
            <div class="dashboard-stat green">
                <div class="visual">
                    <i class="am-icon-apple"></i>
                </div>
                <div class="details">
                    <div class="number"> 53 </div>
                    <div class="desc"> 实验指导数量 </div>
                </div>
                <a class="more" href="#"> 查看更多
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
        <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
            <div class="dashboard-stat purple">
                <div class="visual">
                    <i class="am-icon-android"></i>
                </div>
                <div class="details">
                    <div class="number"> 11786 </div>
                    <div class="desc"> 实验报告数量 </div>
                </div>
                <a class="more" href="#"> 查看更多
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>



    </div>
    <div class="row">
        <div class="am-u-md-6 am-u-sm-12 row-mb">
            <div class="tpl-portlet">
                <div class="tpl-portlet-title">
                    <div class="tpl-caption font-green ">
                        <i class="am-icon-cloud-download"></i>
                        <span> 学生实验数据统计</span>
                    </div>
                    <div class="actions">
                        <ul class="actions-btn">
                            <li class="red-on">昨天</li>
                            <li class="green">前天</li>
                            <li class="blue">本周</li>
                        </ul>
                    </div>
                </div>

                <!--此部分数据请在 js文件夹下中的 app.js 中的 “百度图表A” 处修改数据 插件使用的是 百度echarts-->
                <div class="tpl-echarts" id="tpl-echarts-A">

                </div>
            </div>
        </div>
        <div class="am-u-md-6 am-u-sm-12 row-mb">
            <div class="tpl-portlet">
                <div class="tpl-portlet-title">
                    <div class="tpl-caption font-red ">
                        <i class="am-icon-bar-chart"></i>
                        <span> 学生实验数据统计  </span>
                    </div>
                    <div class="actions">
                        <ul class="actions-btn">
                            <li class="purple-on">昨天</li>
                            <li class="green">前天</li>
                            <li class="dark">本周</li>
                        </ul>
                    </div>
                </div>
                <div class="tpl-scrollable">
                    <div class="number-stats">
                        <div class="stat-number am-fl am-u-md-6">
                            <div class="title am-text-right"> Total </div>
                            <div class="number am-text-right am-text-warning"> 2460 </div>
                        </div>
                        <div class="stat-number am-fr am-u-md-6">
                            <div class="title"> Total </div>
                            <div class="number am-text-success"> 2460 </div>
                        </div>

                    </div>

                    <table class="am-table tpl-table">
                        <thead>
                        <tr class="tpl-table-uppercase">
                            <th>学生</th>
                            <th>最后实验时间</th>
                            <th>次数</th>
                            <th>效率</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <img src="assets/img/user01.png" alt="" class="user-pic">
                                <a class="user-name" href="###">张敏</a>
                            </td>
                            <td>2017.10.11</td>
                            <td>65</td>
                            <td class="font-green bold">26%</td>
                        </tr>
                        <tr>
                            <td>
                                <img src="assets/img/user02.png" alt="" class="user-pic">
                                <a class="user-name" href="###">Alex</a>
                            </td>
                            <td>2017.6.13</td>
                            <td>52</td>
                            <td class="font-green bold">32%</td>
                        </tr>
                        <tr>
                            <td>
                                <img src="assets/img/user03.png" alt="" class="user-pic">
                                <a class="user-name" href="###">王先锋</a>
                            </td>
                            <td>2017.8.11</td>
                            <td>65</td>
                            <td class="font-green bold">51%</td>
                        </tr>
                        <tr>
                            <td>
                                <img src="assets/img/user04.png" alt="" class="user-pic">
                                <a class="user-name" href="###">刘佳</a>
                            </td>
                            <td>2017.10.11</td>
                            <td>65</td>
                            <td class="font-green bold">73%</td>
                        </tr>
                        <tr>
                            <td>
                                <img src="assets/img/user05.png" alt="" class="user-pic">
                                <a class="user-name" href="###">刘兴兴</a>
                            </td>
                            <td>2017.10.18</td>
                            <td>65</td>
                            <td class="font-green bold">12%</td>
                        </tr>
                        <tr>
                            <td>
                                <img src="assets/img/user06.png" alt="" class="user-pic">
                                <a class="user-name" href="###">吴浩</a>
                            </td>
                            <td>2017.7.25</td>
                            <td>65</td>
                            <td class="font-green bold">10%</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="am-u-md-6 am-u-sm-12 row-mb" style="display: none;">

            <div class="tpl-portlet">

                <div id="wrapper" class="wrapper">
                    <div id="scroller" class="scroller">

                    </div>
                </div>
            </div>
        </div>
        <div class="am-u-md-6 am-u-sm-12 row-mb" style="display: none;">
            <div class="tpl-portlet">


                <div class="am-tabs tpl-index-tabs" data-am-tabs>


                    <div class="am-tabs-bd">
                        <div class="am-tab-panel am-fade am-in am-active" id="tab1">
                            <div id="wrapperA" class="wrapper">
                                <div id="scroller" class="scroller">
                                    <ul class="tpl-task-list tpl-task-remind">
                                        <li>
                                            <div class="cosB">
                                                12分钟前
                                            </div>
                                            <div class="cosA">
                                                        <span class="cosIco">
                        <i class="am-icon-bell-o"></i>
                      </span>

                                                <span> 注意：Chrome 和 Firefox 下， display: inline-block; 或 display: block; 的元素才会应用旋转动画。<span class="tpl-label-info"> 提取文件
                                                            <i class="am-icon-share"></i>
                                                        </span></span>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="cosB">
                                                36分钟前
                                            </div>
                                            <div class="cosA">
                                                        <span class="cosIco label-danger">
                        <i class="am-icon-bolt"></i>
                      </span>

                                                <span> FontAwesome 在绘制图标的时候不同图标宽度有差异， 添加 .am-icon-fw 将图标设置为固定的宽度，解决宽度不一致问题（v2.3 新增）。</span>
                                            </div>

                                        </li>

                                        <li>
                                            <div class="cosB">
                                                2小时前
                                            </div>
                                            <div class="cosA">
                                                        <span class="cosIco label-info">
                        <i class="am-icon-bullhorn"></i>
                      </span>

                                                <span> 使用 flexbox 实现，只兼容 IE 10+ 及其他现代浏览器。</span>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="cosB">
                                                1天前
                                            </div>
                                            <div class="cosA">
                                                        <span class="cosIco label-warning">
                        <i class="am-icon-plus"></i>
                      </span>

                                                <span> 部分用户反应在过长的 Tabs 中滚动页面时会意外触发 Tab 切换事件，用户可以选择禁用触控操作。</span>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="cosB">
                                                12分钟前
                                            </div>
                                            <div class="cosA">
                                                        <span class="cosIco">
                        <i class="am-icon-bell-o"></i>
                      </span>

                                                <span> 注意：Chrome 和 Firefox 下， display: inline-block; 或 display: block; 的元素才会应用旋转动画。<span class="tpl-label-info"> 提取文件
                                                            <i class="am-icon-share"></i>
                                                        </span></span>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="cosB">
                                                36分钟前
                                            </div>
                                            <div class="cosA">
                                                        <span class="cosIco label-danger">
                        <i class="am-icon-bolt"></i>
                      </span>

                                                <span> FontAwesome 在绘制图标的时候不同图标宽度有差异， 添加 .am-icon-fw 将图标设置为固定的宽度，解决宽度不一致问题（v2.3 新增）。</span>
                                            </div>

                                        </li>

                                        <li>
                                            <div class="cosB">
                                                2小时前
                                            </div>
                                            <div class="cosA">
                                                        <span class="cosIco label-info">
                        <i class="am-icon-bullhorn"></i>
                      </span>

                                                <span> 使用 flexbox 实现，只兼容 IE 10+ 及其他现代浏览器。</span>
                                            </div>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="am-tab-panel am-fade" id="tab2">
                            <div id="wrapperB" class="wrapper">
                                <div id="scroller" class="scroller">
                                    <ul class="tpl-task-list tpl-task-remind">
                                        <li>
                                            <div class="cosB">
                                                12分钟前
                                            </div>
                                            <div class="cosA">
                                                        <span class="cosIco">
                        <i class="am-icon-bell-o"></i>
                      </span>

                                                <span> 注意：Chrome 和 Firefox 下， display: inline-block; 或 display: block; 的元素才会应用旋转动画。<span class="tpl-label-info"> 提取文件
                                                            <i class="am-icon-share"></i>
                                                        </span></span>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="cosB">
                                                36分钟前
                                            </div>
                                            <div class="cosA">
                                                        <span class="cosIco label-danger">
                        <i class="am-icon-bolt"></i>
                      </span>

                                                <span> FontAwesome 在绘制图标的时候不同图标宽度有差异， 添加 .am-icon-fw 将图标设置为固定的宽度，解决宽度不一致问题（v2.3 新增）。</span>
                                            </div>

                                        </li>

                                        <li>
                                            <div class="cosB">
                                                2小时前
                                            </div>
                                            <div class="cosA">
                                                        <span class="cosIco label-info">
                        <i class="am-icon-bullhorn"></i>
                      </span>

                                                <span> 使用 flexbox 实现，只兼容 IE 10+ 及其他现代浏览器。</span>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="cosB">
                                                1天前
                                            </div>
                                            <div class="cosA">
                                                        <span class="cosIco label-warning">
                        <i class="am-icon-plus"></i>
                      </span>

                                                <span> 部分用户反应在过长的 Tabs 中滚动页面时会意外触发 Tab 切换事件，用户可以选择禁用触控操作。</span>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="cosB">
                                                12分钟前
                                            </div>
                                            <div class="cosA">
                                                        <span class="cosIco">
                        <i class="am-icon-bell-o"></i>
                      </span>

                                                <span> 注意：Chrome 和 Firefox 下， display: inline-block; 或 display: block; 的元素才会应用旋转动画。<span class="tpl-label-info"> 提取文件
                                                            <i class="am-icon-share"></i>
                                                        </span></span>
                                            </div>

                                        </li>
                                        <li>
                                            <div class="cosB">
                                                36分钟前
                                            </div>
                                            <div class="cosA">
                                                        <span class="cosIco label-danger">
                        <i class="am-icon-bolt"></i>
                      </span>

                                                <span> FontAwesome 在绘制图标的时候不同图标宽度有差异， 添加 .am-icon-fw 将图标设置为固定的宽度，解决宽度不一致问题（v2.3 新增）。</span>
                                            </div>

                                        </li>

                                        <li>
                                            <div class="cosB">
                                                2小时前
                                            </div>
                                            <div class="cosA">
                                                        <span class="cosIco label-info">
                        <i class="am-icon-bullhorn"></i>
                      </span>

                                                <span> 使用 flexbox 实现，只兼容 IE 10+ 及其他现代浏览器。</span>
                                            </div>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
