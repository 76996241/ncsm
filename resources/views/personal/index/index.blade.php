@extends('personal.layouts.app')

@section('title')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="apple-mobile-web-app-title" content="{{ config('app.name', 'ncsm') }} UI" />
    <title>{!! $data['title'] !!}</title>
    <meta name="description" content="{!! $data['description'] !!}" />
    <meta name="keywords" content="{!! $data['keywords'] !!}" />
@endsection
@section('righter')
    <div class="col-md-9 page-segment">
        <ul class="page-container no-padding">

            <li id="home" class="selected">
                <div class="title-container hidden">
                    <div class="shadow-img"></div>
                    <h2 class="rotate-out"><span style="margin-bottom: 0px;">Welcome To</span> <span class="invert css10e1648d1e1c2b6" style="font-size: 40px;">数控智能测量系统</span></h2><!--HOME TITLE-->
                </div>
                <div class="description hidden">
                    <div class="watermark-home"></div>

                    <div class="fade-text transparent">
                        <!--DESCRIPTION ON HOME-->
                        <div class="strong-text">Hello, I am <span>Li Dada</span></div>
                        <div class="focus-text"><span>Web Developer & </span><span>Web Designer</span></div>
                        <p class="large-paragraph">I have ten years experience as a web/interface designer.I have a love of clean, elegant styling. I have lots of experience in the production of CSS and HTML for modern websites.</p>
                        <!--DESCRIPTION ON HOME ENDS-->
                    </div>

                    <!--ALL PERSONAL DETAILS-->
                    <h3 class="personal-info-title title">Personal Info</h3>
                    <ul class="personal-info">
                        <li class="rotate-out rotated"><label>Name</label><span>Anderson smith</span></li>
                        <li class="rotate-out rotated"><label>Address</label><span>Melbourne Victoria 3000 Australia</span></li>
                        <li class="rotate-out rotated"><label>Email</label><span>nurealamsabbir@authlab.io</span></li>
                        <li class="rotate-out rotated"><label>Phone</label><span>+8801979791001</span></li>
                    </ul><!--/ul.personal-info-->
                </div>
            </li><!--/#user-->

            <li id="practice" class="hidden">
                <div class="title-container">
                    <div class="shadow-img"></div>
                    <h2 class="rotate-out rotated css10e1648d1e1c2b6" style=" margin-left: 20px"><span class="invert">Personal practice</span> 个人练习</h2> <!--RESUME TITLE-->
                </div>
                <div class="description">
                    <div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="myTab">
                            <li role="presentation" class="active"><a href="#homePer" aria-controls="homePer"  role="tab" data-toggle="tab" onclick="HomePerState()">智能选题练习</a></li>
                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" onclick="ProfileState()">练习记录</a></li>
                            <li role="presentation"><a href="#training" aria-controls="training" role="tab" data-toggle="tab" onclick="TrainingState()">正在进行的训练</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content" >
                            <div role="tabpanel" class="tab-pane active" id="homePer">

                                <div class="page" id="page1">
                                    <h3 style=" color:#f0ad4e" class="css10e1648d1e1c2b6">智能匹配训练试题 - 设置训练要素</h3>

                                    <div class="common-row" style="padding-left: 5px">
                                        <div class="cell-left" style="color: #2ca02c"> 试题难度设置</div>
                                    </div>
                                    <div class="common-row" id="difficult">
                                        @foreach ($data['difficult']  as $difficult)
                                            <div style="width: 33%; float: left">
                                                <div class="cell-left" style="padding-left: 33px; width: 40%">{!! $difficult['name'] !!}</div>
                                                <div class="cell-right" style="width: 40%; margin-right: 40px"><span class="switch-off" id="id{!! $difficult['id'] !!}" data-id="{!! $difficult['id'] !!}" onclick="Difficult('{!! $difficult['id'] !!}')"></span></div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="common-row" id="cncuse" style="padding-left: 5px">
                                        <div class="cell-left" style="color:red ;width: 16%" > 训练类型选择</div>
                                        <div style="width: 33%; float: left">
                                            <div class="cell-left" style="padding-left: 33px; width: 45%" >单零件试题</div>
                                            <div class="cell-right" style="width: 36%; margin-right: 40px">
                                                <span class="switch-on" themeColor="red" id="id59" data-id="59" onclick="Cncuse('59')"></span>
                                            </div>
                                        </div>
                                        <div style="width: 40%;float: left">
                                            <div class="cell-left" style="padding-left: 33px; width: 40%">组合零件试题</div>
                                            <div class="cell-right" style="width: 27%; margin-right: 40px">
                                                <span class="switch-off" themeColor="red" id="id89"  data-id="89" onclick="Cncuse('89')"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="common-row" id="Knowledge" style="padding-left: 5px">
                                        <div class="cell-left" style="color:gold ;width: 16%" > 知识点设置</div>
                                        <div style="width: 33%; float: left">
                                            <div class="cell-left" style="padding-left: 33px; width: 45%" >数控铣知识点</div>
                                            <div class="cell-right" style="width: 36%; margin-right: 40px">
                                                <span class="switch-on" themeColor="gold" id="car"  data-id="46" onclick="Knowledge('car')"></span>
                                            </div>
                                        </div>

                                        <div style="width: 40%;float: left">
                                            <div class="cell-left" style="padding-left: 33px; width: 40%">数控车知识点</div>
                                            <div class="cell-right" style="width: 27%; margin-right: 40px">
                                                <span class="switch-off" themeColor="gold" id="milling"  data-id="47" onclick="Knowledge('milling')"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="common-row" id="selectcar" style="display: block; height:160px ">
                                        @foreach ($data['car']  as $car)
                                            <div style="width: 33%; float: left">
                                                <div class="cell-left" style="padding-left: 33px; width: 40%">{!! $car['name'] !!}</div>
                                                <div class="cell-right" style="width: 40%; margin-right: 40px">
                                                    <span class="switch-off" themeColor="gold" id="id{!! $car['id'] !!}" data-id="{!! $car['id'] !!}"> </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="common-row" id="selectmilling" style="display: none; height:160px">
                                        @foreach ($data['milling']  as $milling)
                                            <div style="width: 33%; float: left">
                                                <div class="cell-left" style="padding-left: 33px; width: 40%">{!! $milling['name'] !!}</div>
                                                <div class="cell-right" style="width: 40%; margin-right: 40px"><span class="switch-off" themeColor="gold" id="id{!! $milling['id'] !!}"  data-id="{!! $milling['id'] !!}"></span></div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div style="margin-top: 15px">

                                        <button type="button" class="btn btn-primary" onclick="Page('page2')" data-loading-text="Loading..." class="btn btn-primary" autocomplete="off"> 开始匹配 </button>

                                    </div>
                                </div>
                                <div class="page" id="page2">
                                    <h3 style=" color:#f0ad4e" class="css10e1648d1e1c2b6">智能匹配训练试题 - 选择训练试题(<span id="text"></span>)</h3>
                                    <div class="" style="height: 320px; overflow-y: scroll">

                                        <table class="table table-condensed" style="width: 98%">
                                            <tr id="question"><td style="width: 5%">选项</td><td style="width: 10%">试题编号</td><td style="width: 40%">试题名称</td><td  style="width: 30%">工件</td><td>收录时间</td><td style="width: 5%">图纸</td></tr>


                                        </table>


                                    </div>
                                    <div style="margin-top: 15px">
                                        <button type="button" class="btn btn-primary" onclick="Page('page1')"> 返回训练要素设置 </button>
                                        <button type="button" class="btn btn-primary" onclick="Page('page3')" data-style="slide-down" id="testpaper"> 创建训练试卷 </button>
                                    </div>
                                </div>

                            </div>
                            <div role="tabpanel" class="tab-pane" id="profile">
<div style=" height: 370px">
                                <table class="table table-condensed" style="width: 98%; margin-top: 5px; margin-bottom: -5px" id="profileList">
                                    <tr style="border: 0px"><td style="width: 5%;border-top:0px">编号</td>
                                         <td style="width: 35%;border-top:0px">训练名称</td>
                                         <td  style="width: 20%;border-top:0px">创建时间</td>
                                         <td  style="width: 20%;border-top:0px">测量数据变更时间</td>
                                         <td style="border-top:0px">操作</td></tr>
                                    <tbody id="profileTbody"></tbody>
                                </table></div>
<div id="profilePage"></div>

                            </div>
                            <div role="tabpanel" class="tab-pane" id="training">

                                <div class="page" id="page2">
                                    <h3 style=" font-size: 14px;padding-left: 6px" >训练名称：<span id="trainingTitle"></span></h3>
                                    <div class="" style="height: 320px; overflow-y: scroll">

                                        <table class="table table-condensed" style="width: 98%" id="trainingList">
                                            <tr ><td style="width: 5%">编号</td><td style="width: 35%">试题名称</td><td  style="width: 35%">工件</td><td style="width: 8%">图纸</td><td>操作</td></tr>
                                            <tr id="trainingTbodys" style="display: none;color:#f60"><td style="width: 5%"></td><td style="width: 35%">组合工件部分</td><td  style="width: 35%"></td><td style="width: 8%"></td><td></td></tr>
                                            <tbody id="trainingTbody" style="color:#f60"></tbody>
                                            <tr id="combinationTbodys" style="display: none"><td style="width: 5%"></td><td style="width: 35%">单工件部分</td><td  style="width: 35%"></td><td style="width: 8%"></td><td></td></tr>
                                            <tbody id="combinationTbody" style="display: none"></tbody>
                                        </table>


                                    </div>
                                    <div style="margin-top: 15px">
                                        <button type="button" class="btn btn-primary" onclick="EndMeasures('2')" data-style="slide-down" id="testpaper"> 完成训练 </button>
                                        <button type="button" class="btn btn-primary" onclick="EndMeasures('3')" data-style="slide-down" id="testpaper"> 取消训练 </button>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </li>

            <li id="train" class="hidden">
                <div class="title-container">
                    <div class="shadow-img"></div>
                    <h2 class="rotate-out rotated"><span class="invert">Teaching and training</span> 教学训练</h2> <!--PORTFOLIO TITLE-->
                </div>

                <div class="description">
                    <div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="myTab">
                            <li role="presentation" class="active"><a href="#profileT" aria-controls="profileT" role="tab" data-toggle="tab" onclick="ProfileStateT()">教学训练记录</a></li>
                            <li role="presentation"><a href="#trainingT" aria-controls="trainingT" role="tab" data-toggle="tab" onclick="TrainingStateT()">正在进行的训练</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content" >
                            <div role="tabpanel" class="tab-pane active" id="profile">
                                <div style=" height: 370px">
                                    <table class="table table-condensed" style="width: 98%; margin-top: 5px; margin-bottom: -5px" id="profileList">
                                        <tr style="border: 0px"><td style="width: 5%;border-top:0px">编号</td>
                                            <td style="width: 35%;border-top:0px">训练名称</td>
                                            <td  style="width: 20%;border-top:0px">创建时间</td>
                                            <td  style="width: 20%;border-top:0px">测量数据变更时间</td>
                                            <td style="border-top:0px">操作</td></tr>
                                        <tbody id="profileTbodyT"></tbody>
                                    </table></div>
                                <div id="profilePageT"></div>

                            </div>
                            <div role="tabpanel" class="tab-pane" id="training">

                                <div class="page" id="page2">
                                    <h3 style=" font-size: 14px;padding-left: 6px" >训练名称：<span id="trainingTitle"></span></h3>
                                    <div class="" style="height: 320px; overflow-y: scroll">

                                        <table class="table table-condensed" style="width: 98%" id="trainingList">
                                            <tr ><td style="width: 5%">编号</td><td style="width: 35%">试题名称</td><td  style="width: 35%">工件</td><td style="width: 8%">图纸</td><td>操作</td></tr>
                                            <tr id="trainingTbodys" style="display: none;color:#f60"><td style="width: 5%"></td><td style="width: 35%">组合工件部分</td><td  style="width: 35%"></td><td style="width: 8%"></td><td></td></tr>
                                            <tbody id="trainingTbody" style="color:#f60"></tbody>
                                            <tr id="combinationTbodys" style="display: none"><td style="width: 5%"></td><td style="width: 35%">单工件部分</td><td  style="width: 35%"></td><td style="width: 8%"></td><td></td></tr>
                                            <tbody id="combinationTbody" style="display: none"></tbody>
                                        </table>


                                    </div>
                                    <div style="margin-top: 15px">
                                        <button type="button" class="btn btn-primary" onclick="EndMeasures('2')" data-style="slide-down" id="testpaper"> 完成训练 </button>
                                        <button type="button" class="btn btn-primary" onclick="EndMeasures('3')" data-style="slide-down" id="testpaper"> 取消训练 </button>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </li><!--/#portfolio-->

            <li id="performance" class="hidden">
                <div class="title-container">
                    <div class="shadow-img"></div>
                    <h2 class="rotate-out rotated">Portfolio</h2> <!--PORTFOLIO TITLE-->
                </div>

                <!--PORTFOLIO CATEGORY LIST-->
                <div class="abs-child">
                    <ul class="button-group filters-button-group">
                        <li class="button is-checked" data-filter="*">Show All</li>
                        <li class="button" data-filter=".photography">Photography</li>
                        <li class="button" data-filter=".commercial">Commercial</li>
                        <li class="button" data-filter=".potrait">Potrait</li>
                    </ul><!--/.button-group filters-button-group-->
                </div>

                <div class ="sec-porfolio description">
                    <div class="row">
                        <!--PORTFOLIO ITEM CONTAINER-->
                        <div class="folio-container">
                            <ul class="folio-item"><!--PORTFOLIO INDIVIDAUAL ITEM-->
                                <li class="view view-first photography">
                                    <img src="images/folio/logs.jpg" alt="logs" /><!--PORTFOLIO INDIVIDAUAL ITEM IMAGE-->
                                    <div class="mask">
                                        <h2>woodsman</h2> <!--PORTFOLIO INDIVIDAUAL ITEM TITLE-->
                                        <!-- Button trigger modal -->
                                        <a role="button" class="info" data-toggle="modal" data-target="#myModal">Read More</a><!--PORTFOLIO INDIVIDAUAL ITEM MODAL LINK BY 'data-target'-->
                                    </div>
                                </li>
                                <li class="view view-second commercial"><!--PORTFOLIO INDIVIDAUAL ITEM-->
                                    <img src="images/folio/book.jpg" alt="book" /><!--PORTFOLIO INDIVIDAUAL ITEM IMAGE-->
                                    <div class="mask"></div>
                                    <div class="content">
                                        <h2>Hover Style #2</h2><!--PORTFOLIO INDIVIDAUAL ITEM TITLE-->
                                        <a role="button" class="info" data-toggle="modal" data-target="#myModal2">Read More</a><!--PORTFOLIO INDIVIDAUAL ITEM MODAL LINK BY 'data-target'-->
                                    </div>
                                </li>
                                <li class="view view-tenth photography"> <!--PORTFOLIO INDIVIDAUAL ITEM-->
                                    <img src="images/folio/beach.jpg" alt="beach" /> <!--PORTFOLIO INDIVIDAUAL ITEM IMAGE-->
                                    <div class="mask">
                                        <h2>New York</h2><!--PORTFOLIO INDIVIDAUAL ITEM TITLE-->
                                        <a role="button" class="info" data-toggle="modal" data-target="#myModal5">Read More</a>  <!--PORTFOLIO INDIVIDAUAL ITEM MODAL LINK BY 'data-target'-->
                                    </div>
                                </li>
                                <li class="view view-second commercial"><!--PORTFOLIO INDIVIDAUAL ITEM-->
                                    <img src="images/folio/guy.jpg" alt="guy" /><!--PORTFOLIO INDIVIDAUAL ITEM IMAGE-->
                                    <div class="mask"></div>
                                    <div class="content">
                                        <h2>Image Name</h2><!--PORTFOLIO INDIVIDAUAL ITEM TITLE-->
                                        <a role="button" class="info" data-toggle="modal" data-target="#myModal3">Read More</a><!--PORTFOLIO INDIVIDAUAL ITEM MODAL LINK BY 'data-target'-->
                                    </div>
                                </li>

                                <li class="view view-first potrait"><!--PORTFOLIO INDIVIDAUAL ITEM-->
                                    <img src="images/folio/illustration.jpg" alt="illustration" /><!--PORTFOLIO INDIVIDAUAL ITEM IMAGE-->
                                    <div class="mask">
                                        <h2>New York</h2>
                                        <a role="button" class="info" data-toggle="modal" data-target="#myModal4">Read More</a> <!--PORTFOLIO INDIVIDAUAL ITEM MODAL LINK BY 'data-target'-->
                                    </div>
                                </li>
                                <li class="view view-second photography"><!--PORTFOLIO INDIVIDAUAL ITEM-->
                                    <img src="images/folio/guy.jpg" alt="guy" /><!--PORTFOLIO INDIVIDAUAL ITEM IMAGE-->
                                    <div class="mask"></div>
                                    <div class="content">
                                        <h2>Image Name</h2><!--PORTFOLIO INDIVIDAUAL ITEM TITLE-->
                                        <a role="button" class="info" data-toggle="modal" data-target="#myModal3">Read More</a><!--PORTFOLIO INDIVIDAUAL ITEM MODAL LINK BY 'data-target'-->
                                    </div>
                                </li>
                                <li class="view view-tenth potrait"> <!--PORTFOLIO INDIVIDAUAL ITEM-->
                                    <img src="images/folio/logs.jpg" alt="logs" /> <!--PORTFOLIO INDIVIDAUAL ITEM IMAGE-->
                                    <div class="mask">
                                        <h2>woodsman</h2><!--PORTFOLIO INDIVIDAUAL ITEM TITLE-->
                                        <a role="button" class="info" data-toggle="modal" data-target="#myModal">Read More</a> <!--PORTFOLIO INDIVIDAUAL ITEM MODAL LINK BY 'data-target'-->
                                    </div>
                                </li>

                                <li class="view view-tenth commercial"><!--PORTFOLIO INDIVIDAUAL ITEM-->
                                    <img src="images/folio/beach.jpg" alt="beach" /> <!--PORTFOLIO INDIVIDAUAL ITEM IMAGE-->
                                    <div class="mask">
                                        <h2>New York</h2><!--PORTFOLIO INDIVIDAUAL ITEM TITLE-->
                                        <a role="button" class="info" data-toggle="modal" data-target="#myModal5">Read More</a> <!--PORTFOLIO INDIVIDAUAL ITEM MODAL LINK BY 'data-target'-->
                                    </div>
                                </li>


                            </ul>
                        </div>
                        <!--PORTFOLIO ITEM CONTAINER ENDS-->
                    </div>
                </div>
            </li><!--/#portfolio-->

            <li id="effect" class="hidden">
                <div class="title-container" >
                    <div class="shadow-img"></div>
                    <h2 class="rotate-out rotated">Contact</h2><!--CONTACT PAGE TITLE-->
                </div>
                <div class="description">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="map-container">
                                <div id="map" style="width:100%;height:325px;"></div><!--GOOGLE MAP-->
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <!--CONTACT DESCRIPTION-->
                            <h3 class="title">Contact Info</h3>
                            <h6 class="sm-title"><span class="address-icon"><i class="fa fa-map-marker"></i></span>311B, Jalalabad, Sylhet</h6>
                            <h6 class="sm-title"><span class="address-icon"><i class="fa fa-phone"></i></span>+8801979791001</h6>
                            <h6 class="sm-title"><span class="address-icon"><i class="fa fa-envelope"></i></span>nurealamsabbir@authlab.io</h6>
                            <!--/CONTACT DESCRIPTION ENDS-->
                        </div>
                        <div class="col-sm-7">

                            <div class="mail-container">
                                <div class="cnmail result">
                                    <div class="msg success-msg"><i class="icon svg-check"><!--?xml version="1.0" encoding="utf-8"?-->  <svg xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"> <path d="M16 2.688c-7.375 0-13.313 5.938-13.313 13.313s5.938 13.313 13.313 13.313c7.375 0 13.313-5.938 13.313-13.313s-5.938-13.313-13.313-13.313zM16 28.25c-6.75 0-12.25-5.5-12.25-12.25s5.5-12.25 12.25-12.25c6.75 0 12.25 5.5 12.25 12.25s-5.5 12.25-12.25 12.25zM22.688 11.25l-8.563 8.313-3-3c-0.313-0.313-0.813-0.313-1.125 0s-0.313 0.813 0 1.125l3.563 3.563c0.125 0.125 0.313 0.188 0.563 0.188 0.188 0 0.375-0.063 0.5-0.188l9.125-8.875c0.375-0.313 0.375-0.813 0.063-1.125s-0.813-0.313-1.125 0z"></path> </svg> </i><span> You email has been stored!</span></div>
                                    <div class="msg error-msg"><i class="icon svg-close-circle"><!--?xml version="1.0" encoding="utf-8"?-->  <svg xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"> <path d="M6.563 6.563c-5.188 5.188-5.188 13.688 0 18.875s13.688 5.188 18.875 0c5.188-5.188 5.188-13.625 0-18.875-5.188-5.188-13.625-5.188-18.875 0zM24.688 24.688c-4.813 4.75-12.563 4.75-17.375 0-4.75-4.813-4.75-12.563 0-17.375 4.813-4.75 12.563-4.75 17.375 0 4.75 4.813 4.75 12.563 0 17.375zM10.75 10l-0.813 0.75 5.313 5.25-5.25 5.25 0.75 0.75 5.25-5.25 5.25 5.25 0.75-0.75-5.25-5.25 5.313-5.25-0.813-0.75-5.25 5.25z"></path> </svg> </i><span> Sorry! Something went wrong!</span></div>
                                </div>
                                <h3 class="title invert">Don't Forget To Mail Me</h3>
                                <!--CONTACT FORM-->
                                <form action="sendmail.php" class="form-horizontal" id="contact-form">
                                    <div class="form-group">
                                        <input name="name" class="form-control required" placeholder="Name" data-placement="top" type="text">
                                    </div>
                                    <div class="form-group">
                                        <input name="email" class="form-control email" placeholder="Email" type="text">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" placeholder="Message" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">SEND</button>
                                    </div>

                                </form><!--/#contact-form-->
                            </div>

                        </div>

                    </div>
                </div>
            </li><!--/#contact-->
        </ul>

        <div class="row mobile-nav-container">
            <!--SOCIAL NAV FOR MOBILE-->
            <ul class="mobile-social no-padding">
                <li>Connect With Me</li>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul><!--/.mobile-social-->
        </div>
    </div>
@endsection
@section('modal')
    <!-- Modal -->


    <div class="modal fade bs-example-modal-lg" id="exampleModapdf" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <iframe src="" width="100%" height="600px"></iframe>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModa2" tabindex="-10" role="dialog" aria-labelledby="exampleModalLabel" >
        <div class="modal-dialog" role="document" style="width: 80%; ">
            <div class="modal-content"  style="border: 0px">
                <div class="modal-header" style="background-color: #FFFFFF">
                    <h4 class="modal-title" id="exampleModalLabel" style="color: #5e5e5e">零件测量 </h4>
                </div>
                <div class="modal-body" id="my-container" style=" overflow-y: scroll;">

                    <div style="float: left; width: 80%; height: 100%;border-right: 1px darkgrey double;">
                        <div style="height: 50px">
                            <button type="button" class="btn btn-primary" onclick="MeasureStart('0','正在加载测量信息，请稍后........')"> 开始测量 </button>
                            <button type="button" class="btn btn-primary" id="Measurepdf" onclick="Measurepdf()"> 零件图纸 </button>
                        </div>
                        <div class="form-group" id="MeasureHtml">
                            程序加载中，请稍后... ...
                        </div>
                        <div style="height: 50px"><button type="button" class="btn btn-primary" onclick="MeasureClose()"> 结束测量 </button></div>
                    </div>
                    <div style="float: left; width: 20%; height: 100%;display: none" id="MeasuresData" data-num="0">

                        <ul style="margin-bottom: 15px">
                            <h5 class="modal-title" id="exampleModalLabel" style="color: #5e5e5e">当前测量位置 </h5>
                        </ul>
                        <ul>
                            <li>考核内容及要求 Aspect - Description</li>
                            <li style="color:#f60">请选择测量内容</li>
                            <li>附加内容 Add - (Extra Aspect Information)</li>
                            <li style="color:#f60">请选择测量内容</li>
                            <li>类型 AspectType</li>
                            <li style="color:#f60">请选择测量内容</li>
                            <li>满分/配分 Max Mark</li>
                            <li style="color:#f60">请选择测量内容</li>
                            <li>工件测量结果 Measurement Result</li>
                            <li>
                                <input class="tpl-form-input" name="questions-title" value="" style="font-size: 12px;width: 60px;height: 22px;line-height: 18px; text-align: center; border:#9BA2AB 1px double" type="text" >
                            </li>
                            <li>
                            </li>
                        </ul>
                        <ul style="margin-top: 15px" id="position">
                            <button type="button" class="btn btn-primary" onclick="position('up')" style="display: none"> 上一位置 </button>
                            <button type="button" class="btn btn-primary" onclick="position('down')" style="display: none"> 下一位置 </button>
                            <button type="button" class="btn btn-primary" onclick="position('post')" style="display: none"> 提交数据 </button>
                        </ul>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="top:30%">
        <div class="modal-dialog" role="document">
            <div class="modal-content"  style="border: 0px">
                <div class="modal-header" style="background-color: #FFFFFF">
                    <h4 class="modal-title" id="exampleModalLabel" style="color: #5e5e5e">提示 </h4>
                </div>
                <div class="modal-body">

                    <div class="form-group" id="loadtext">
                        程序加载中，请稍后... ...
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModa3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="top:30%">
        <div class="modal-dialog" role="document">
            <div class="modal-content"  style="border: 0px">
                <div class="modal-header" style="background-color: #FFFFFF">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: #5e5e5e">提示</h5>
                </div>
                <div class="modal-body">

                    <div class="form-group" id="loadtext">
                        正在加载测量信息，请稍后........
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModa4" tabindex="-10" role="dialog" aria-labelledby="exampleModalLabel" >
        <div class="modal-dialog" role="document" style="width: 80%; ">
            <div class="modal-content"  style="border: 0px">
                <div class="modal-header" style="background-color: #FFFFFF">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background:#ffffff;color: #5e5e5e">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="exampleModalLabel" style="color: #5e5e5e">测量成绩查看 </h4>
                </div>
                <div class="modal-body" id="my-results" style=" overflow-y: scroll;">

                    <div style="float: left; width: 98%; height: 100%;">
                        <div class="form-group" id="ResultsHtml" style="margin-bottom: 40px">
                            数据加载中，请稍后... ...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footerJsCss')
    <script src="{{ asset('js/ncsm.js') }}"></script>
    <script src="{{ asset('personals/js/bootstrap-loading.js')}}"></script>

    <script language="JavaScript">
        $(document).ready(function () {
            var height=$(window).height()*83/100;
            $('#my-container').css('height',height+'px');
            $('#my-results').css('height',height+'px');
            var url="{!! route('EditTime') !!}";
            var time="{!! $data['systems_01'] !!}";
            var token= $('input[name="_token"]').val()
            publicBusi(time,url,token);
            Practice();
            PracticeT();
        });
        function Difficult() {
            $('#difficult .cell-right .switch-on').addClass('switch-off').removeClass('switch-on').css('border-color','rgb(223, 223, 223)').css('box-shadow','0px 0px 0px 0px rgb(223, 223, 223) inset').css('background-color','rgb(255, 255, 255)');
        }
        function Knowledge(id) {
            $('#Knowledge .cell-right .switch-on').addClass('switch-off').removeClass('switch-on').css('border-color','rgb(223, 223, 223)').css('box-shadow','0px 0px 0px 0px rgb(223, 223, 223) inset').css('background-color','rgb(255, 255, 255)');
            $('#selectmilling .cell-right .switch-on').addClass('switch-off').removeClass('switch-on').css('border-color','rgb(223, 223, 223)').css('box-shadow','0px 0px 0px 0px rgb(223, 223, 223) inset').css('background-color','rgb(255, 255, 255)');
            $('#selectcar .cell-right .switch-on').addClass('switch-off').removeClass('switch-on').css('border-color','rgb(223, 223, 223)').css('box-shadow','0px 0px 0px 0px rgb(223, 223, 223) inset').css('background-color','rgb(255, 255, 255)');

            if(id == 'car'){
                $('#selectmilling').slideUp("slow");
                $('#selectcar').slideDown("slow");
            }
            if(id == 'milling'){
                $('#selectcar').slideUp("slow");
                $('#selectmilling').slideDown("slow");
            }
        }
        function Cncuse() {
            $('#cncuse .cell-right .switch-on').addClass('switch-off').removeClass('switch-on').css('border-color','rgb(223, 223, 223)').css('box-shadow','0px 0px 0px 0px rgb(223, 223, 223) inset').css('background-color','rgb(255, 255, 255)');
        }
        function Page(id){


            if(id=='page2') {
                $('.question').remove();
                var difficultid=$('#difficult .cell-right .switch-on').attr('data-id');
                var cncuseid=$('#cncuse .cell-right .switch-on').attr('data-id');

                if(cncuseid=='59'){
                    $('#text').text('单零件试题，至少选择一个零件')
                }
                if(cncuseid=='89'){
                    $('#text').text('组合零件试题，最多选择一个零件')
                }
                var Knowledgeid=$('#Knowledge .cell-right .switch-on').attr('data-id');
                var Knowledge=$('#Knowledge .cell-right .switch-on').attr('id');
                var arr=[];
                $('#select'+Knowledge+' .cell-right .switch-on').each(function(){
                    arr.push($(this).attr('data-id'));
                })
                var selectid = JSON.stringify(arr);//数组转换成json，都在了，数组和json

                var difficult=$('#difficult .cell-right .switch-on').length;
                var cncuse=$('#cncuse .cell-right .switch-on').length;
                var select=$('#select'+Knowledge+' .cell-right .switch-on').length;
                if(difficult==1 && select>0 && cncuse==1){
                    loading('正在匹配试题，请稍后......');
                    setTimeout('loadings()',2000);
                    setTimeout('Matching('+difficultid+','+cncuseid+','+Knowledgeid+','+selectid+')',2500);

                    return false;
                }else{
                    if(difficult<1){
                        alert('试题难度未设置')
                        return false;
                    }
                    if(select<1){
                        alert('知识点未设置')
                        return false;
                    }
                    if(cncuse<1){
                        alert('训练类型未设置')
                        return false;
                    }
                }
            }
            if(id=='page1') {//返回
                setTimeout('Return()',500);

            }
            if(id=='page3') {//创建试卷

                loading('正在创建训练，请稍后......');
                setTimeout('loadings()',2000);
                setTimeout('TestPaper()',2500);

            }

        }

        function loading(text) {
            $('#loadtext').text(text)
            $('#exampleModal').modal({backdrop:'static', keyboard:'false'});
        }
        function loadings() {
            $('#exampleModal').modal('toggle');
        }
        function MeasureClose() {
            $('#exampleModa2').modal('toggle');
        }
        function MeasuresClose() {
            $('#exampleModa3').modal('toggle');
        }
        function Return() {
            $('#page2').slideUp("slow");
            $('#page1').slideDown("slow");
        }
        function TestPaper() {
            //获得单或组合
            var cncuseid=$('#cncuse .cell-right .switch-on').attr('data-id');
            var num=$('input[name="subBox"]:checked').length;
            if(num==0){
                alert('至少选择一个零件，才可以开始训练');
                return false;
            }

            if(cncuseid=='59'){
                if(num>5){
                    alert('单零件题，最多只能选择5个零件训练');
                    return false;
                }
            }
            if(cncuseid=='89'){
                if(num>1){
                    alert('组合零件试题,最多只能选择1组组合零件训练');
                    return false;
                }
            }

            //获取选择数据
            var arr=[];
            $('input[name="subBox"]:checked').each(function(){
                arr.push(this.value);
            })
            var TestPaperId = JSON.stringify(arr);//数组转换成json，都在了，数组和json
            //提交数据创建试卷
            $.get("{{ route('TrainAdd') }}?"+"choiceid="+TestPaperId+"&combination="+cncuseid, function(data){
                getLogin(data.login);
                $('#myTab li:eq(2)').show();
                $('#trainingTitle').html(data.title);
                if(data.combination=='89'){
                    $('#trainingTbodys').show();
                    $('#combinationTbodys').show();
                    $('#combinationTbody').show();
                    $('#trainingTbody').html(data.list);
                    $('#combinationTbody').html(data.lists);
                }
                if(data.combination=='59'){
                    $('#trainingTbodys').hide();
                    $('#combinationTbodys').hide();
                    $('#combinationTbody').hide();
                    $('#trainingTbody').html(data.list);
                }
                $('#myTab a[href="#training"]').tab('show');
                return false;
            });

        }

        //弹窗查看图纸
        function getpdf(id) {
            $('#exampleModapdf iframe').attr('src',"{{ route('trainpdf') }}?id="+id);
            $('#exampleModapdf').modal('toggle');
        }
        function getLogin(key) {
            if(key!='1'){
                loading('操作超时，刷新页面后，重新登录后再进行操作！');
            }
        }
        function Matching(difficultid,cncuseid,Knowledgeid,selectid) {
            $('#testpaper').hide();
            $.get("{{ route('Page2') }}?difficultid="+difficultid+"&cncuseid="+cncuseid+"&Knowledgeid="+Knowledgeid+"&selectid="+selectid, function(data){
                $('#question').after(data.html);
                getLogin(data.login);
                if(data.html==''){
                    $('#testpaper').hide();
                }else{
                    $('#testpaper').show();
                }
                $('#page1').slideUp("slow");
                $('#page2').slideDown("slow");
            });
        }

        $('#myTab li:eq(0) a').click(function (e) {
            e.preventDefault();
            State();
            return false
        });
        function State() {
            $.get("{{ route('TrainState') }}", function(data){
                getLogin(data.login);
                if(data.state==1){
                    loading('您有未完成的训练，请完成训练或取消训练！');
                    setTimeout('loadings()',1500);
                    $('#trainingTitle').html(data.title);
                    if(data.combination=='89'){
                        $('#trainingTbodys').show();
                        $('#combinationTbodys').show();
                        $('#combinationTbody').show();
                        $('#trainingTbody').html(data.list);
                        $('#combinationTbody').html(data.lists);
                    }
                    if(data.combination=='59'){
                        $('#trainingTbodys').hide();
                        $('#combinationTbodys').hide();
                        $('#combinationTbody').hide();
                        $('#trainingTbody').html(data.list);
                    }

                    $('#myTab li:eq(2) a').tab('show');
                }else{
                    $('#myTab li:eq(2)').hide();
                    $('#myTab li:eq(0) a').tab('show');

                }


            });
        }

        function States() {
            $.get("{{ route('TrainState') }}", function(data){
                getLogin(data.login);
                if(data.state==1){
                    loading('正在加载未完成的训练，请稍后... ...');
                    setTimeout('loadings()',1500);
                    $('#trainingTitle').html(data.title);
                    if(data.combination=='89'){
                        $('#trainingTbodys').show();
                        $('#combinationTbodys').show();
                        $('#combinationTbody').show();
                        $('#trainingTbody').html(data.list);
                        $('#combinationTbody').html(data.lists);
                    }
                    if(data.combination=='59'){
                        $('#trainingTbodys').hide();
                        $('#combinationTbodys').hide();
                        $('#combinationTbody').hide();
                        $('#trainingTbody').html(data.list);
                    }

                    setTimeout('$(\'#myTab li:eq(2) a\').tab(\'show\')',1500);

                }else{
                    $('#myTab li:eq(2)').hide();
                    $('#myTab li:eq(0) a').tab('show');

                }


            });
        }

        function StatesT(id) {
            alert(1212);
            $.get("{{ route('TrainStateT') }}?id="+id, function(data){
                getLogin(data.login);
                if(data.state==1){
                    loading('正在加载未完成的训练，请稍后... ...');
                    setTimeout('loadings()',1500);
                    $('#trainingTitle').html(data.title);
                    if(data.combination=='89'){
                        $('#trainingTbodys').show();
                        $('#combinationTbodys').show();
                        $('#combinationTbody').show();
                        $('#trainingTbody').html(data.list);
                        $('#combinationTbody').html(data.lists);
                    }
                    if(data.combination=='59'){
                        $('#trainingTbodys').hide();
                        $('#combinationTbodys').hide();
                        $('#combinationTbody').hide();
                        $('#trainingTbody').html(data.list);
                    }

                    setTimeout('$(\'#myTab li:eq(2) a\').tab(\'show\')',1500);

                }else{
                    $('#myTab li:eq(2)').hide();
                    $('#myTab li:eq(0) a').tab('show');

                }


            });
        }

        //点击事件，判断是否有未完成训练
        $('#menu-container li:eq(1) span').click(function (e) {
            setTimeout('State()',500);
        });

        function measure(sid) {
            $('#exampleModa2').modal({backdrop:'static', keyboard:'false'});
            $.get("{{ route('Measure') }}?"+"sid="+sid, function(data){
                getLogin(data.login);
                if(data.id==-1){
                    alert('数据错误请联系管理员');
                    return false;
                }

                $('#MeasuresData').hide();
                $('#MeasureHtml').html(data.MeasureHtml);
                $('#Measurepdf').attr('onclick',"Measurepdf('"+sid+"')")


            });

        }
        function MeasureStart(id,text,key) {
            loading(text);
            setTimeout('loadings()',1000);
            setTimeout('Measureing('+id+')',1500);
        }
        function Measureing(id) {
            $('#MeasuresData').show();
            var measureiid=$('#MeasureHtml .strip:eq('+id+')').attr('data-list');//获取当前条数
            $('#MeasureHtml .strip').css('color','#9BA2AB');
            $('#strip'+measureiid).css('color','red');
            $('#MeasuresData li:eq(1)').text($('#strip'+measureiid+' td:eq(0)').text());
            $('#MeasuresData li:eq(3)').text($('#strip'+measureiid+' td:eq(1)').text());
            $('#MeasuresData li:eq(5)').text($('#strip'+measureiid+' td:eq(2)').text());
            $('#MeasuresData li:eq(7)').text($('#strip'+measureiid+' td:eq(3)').text());
            $('#MeasuresData li:eq(10)').html($('#strip'+measureiid+' td:eq(5)').html());
            $('#MeasuresData').attr('data-num',id);
            $('#MeasuresData input').val('');
            $('#MeasuresData input').focus();

         var count=$('#MeasureHtml .strip').length;
           if(count==1 ){
                $('#position button:eq(0)').hide();
                $('#position button:eq(1)').hide();
                $('#position button:eq(2)').show();
            }else if(id==(count-1)){
                $('#position button:eq(0)').show();
                $('#position button:eq(1)').hide();
                $('#position button:eq(2)').show();
            }else  if(id==0){
               $('#position button:eq(0)').hide();
               $('#position button:eq(1)').show();
               $('#position button:eq(2)').hide();
           }else{
                $('#position button:eq(0)').show();
                $('#position button:eq(1)').show();
                $('#position button:eq(2)').hide();
            }

        }
        function jiaodian() {
            $('#MeasuresData input').val('');
            $('#MeasuresData input').focus();
        }
        function position(type) {
            var id=Number($('#MeasuresData').attr('data-num'));
            var count=$('#MeasureHtml .strip').length;
            var num=Number($('#MeasuresData input').val());
            var measureiid=$('#MeasureHtml .strip:eq('+id+')').attr('data-list');//获取当前条数
            var Result=$('#strip'+measureiid+' #Result').html();

            if(type!='up') {
                if (isNaN(num)) {
                    loading('录入的测量数据必须是数字，请正确录入！！');
                    setTimeout('loadings()', 1500);
                    setTimeout('jiaodian()', 2000);;
                    return false;
                }

                if ($('#MeasuresData input').val() == '') {
                    if(Result=='&nbsp;') {
                        loading('未录入测量数据，请正确录入！');
                        setTimeout('loadings()', 1500);
                        setTimeout('jiaodian()', 2000);;
                        return false
                    }else{
                        if(id==(count-1)){
                            $('#MeasuresData').hide();
                            $('#MeasuresData input').blur();
                            loading('测量完成，测量数据已经提交！');
                            setTimeout('loadings()',2000);
                            return false;
                        }
                        MeasureStart(id+1,'正在加载测量信息，请稍后........');
                        return false;
                    }
                }

            }

            if(type=='down'){
                MeasuresData();
                if(id==(count-1)){
                    $('#MeasuresData').hide();
                    $('#MeasuresData input').blur();
                    loading('测量完成，测量数据已经提交！');
                    setTimeout('loadings()',2000);
                    return false;
                }
                MeasureStart(id+1,'正在加载测量信息，请稍后........');
            }
            if(type=='up'){
                MeasureStart(id-1,'正在加载测量信息，请稍后........');
            }
            if(type=='post'){
                MeasuresData();
                if(id==(count-1)){
                    $('#MeasuresData').hide();
                    $('#MeasuresData input').blur();
                    loading('测量完成，测量数据已经提交！');
                    setTimeout('loadings()',2000);
                    return false;
                }

            }
        }
        $('#MeasuresData input').keydown(function(event) {
            if (event.keyCode == 13) {
                position('down');


            }
        })

        function MeasuresData() {

            var id=Number($('#MeasuresData').attr('data-num'));
            var measureiid=$('#MeasureHtml .strip:eq('+id+')').attr('data-list');//获取当前条数
            var num=Number($('#MeasuresData input').val());
            PostMeasures(measureiid,num);//提交数据
            $('#strip'+measureiid+' #Result').text(num);
            $('#strip'+measureiid).css('color','#9BA2AB');
        }

        $('#MeasuresData input').blur( function () {
            $('#MeasuresData input').focus();

        });
        function    PostMeasures(id,value) {
            $.ajax({
                type: 'POST',
                url: '{{ route('PostMeasures') }}',
                data: {
                    'value':value,
                    'id':id,
                    '_token': $('input[name="_token"]').val()
                },
                dataType: 'json',
                success: function (data) {
                    getLogin(data.login);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert('失败！');
                }
            });

        }

        //打开图纸
    function Measurepdf(id){

        window.open("{{ route('trainpdf') }}?id="+id,"_blank");

    }
    //提交训练状态
    function EndMeasures(key){
        $.ajax({
            type: 'POST',
            url: '{{ route('EndMeasures') }}',
            data: {
                'key':key,
                '_token': $('input[name="_token"]').val()
            },
            dataType: 'json',
            success: function (data) {
                getLogin(data.login);
                if(data.id==1){
                    loading('设置成功,结束训练！');
                    setTimeout('loadings()',2500);
                    setTimeout('$(\'#myTab li:eq(1) a\').tab(\'show\')',2500);
                    setTimeout('$(\'#myTab li:eq(2) a\').hide()',2500);
                    Practice();
                }else if(data.id==-5){
                    loading('您有未完成测量的项目，请完成测量后设置！');
                    setTimeout('loadings()',2500);
                }else{
                    alert('设置失败，错误'+data.id);
                }

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert('删除失败！');
            }
        });
    }
        //练习记录
    function Practice(page){
        $.get("{{ route('Practice') }}?"+"page="+page, function(data){
            getLogin(data.login);
            if(data.id==-1){
                alert('数据错误请联系管理员');
                return false;
            }
            $('#profileTbody').html(data.html);
            $('#profilePage').html(data.page);
        });
    }

        //教学训练记录
    function PracticeT(page){
            $.get("{{ route('PracticeT') }}?"+"page="+page, function(data){
                getLogin(data.login);
                if(data.id==-1){
                    alert('数据错误请联系管理员');
                    return false;
                }
                $('#profileTbodyT').html(data.html);
                $('#profilePageT').html(data.page);
            });
      }

    function ProfileState() {
        Practice();
    }
    function getPractice(id) {
        Practice(id);
    }


    function getResults(id){
        loading('训练成绩加载中，请稍后... ...');
        setTimeout('loadings()',2500);
        setTimeout("$('#exampleModa4').modal({backdrop:'static', keyboard:'false'})",2500);
        setTimeout('Results('+id+')',2500);
    }
    function Results(id){
        $.ajax({
            type: 'POST',
            url: '{{ route('Results') }}',
            data: {
                'id':id,
                '_token': $('input[name="_token"]').val()
            },
            dataType: 'json',
            success: function (data) {
                getLogin(data.login);
                $('#ResultsHtml').html(data.html);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert('失败！');
            }
        });
    }


    </script>



@endsection
