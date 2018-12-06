<?php     header("Access-Control-Allow-Origin: *");?>
<script src="{{ asset('assets/js/jquery-2.1.1.js') }}"></script>
<div id="text"></div>

<script type="text/javascript">

        $(document).ready(function () {
            test();
        })

    function test() {
        var datas = "{starttime:'2018-01-01 12:00:12',endtime:'2018-06-05 12:00:12'}";
        //var datas;
        $.ajax({
            type: "POST",
            url: "http://2b1141169w.51mypc.cn:8080/WorldInComption/out/student/train_result",
            data: datas,
            datatype: "xml",
            success: function (data) {
                alert(data);
            },
            //调用出错执行的函数
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                // 状态码
                console.log(XMLHttpRequest.status);
                // 状态
                console.log(XMLHttpRequest.readyState);
                // 错误信息
                console.log(textStatus);
            }
        })
    }

</script>