//图片上传预览
function OneFile ( id ) {

    $('#'+ id).on('change', function() {

        if (typeof (FileReader) != "undefined") {

            var image_holder = $("#"+id+"-image-holder");
            image_holder.empty();

            var reader = new FileReader();
            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                }).appendTo(image_holder);

            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            alert("你的浏览器不支持FileReader.");
        }

    });

}
//图片编辑初始化
function OneFileImg ( id ,imgurl) {
    if(imgurl){
    var image_holder = $("#"+id+"-image-holder");
    image_holder.empty();
    $("<img src='"+ imgurl +"' class='thumb-image'/>").appendTo(image_holder);
    }
}


//图片上传预览
function OneFilePdf ( id ) {

    $('#'+ id).on('change', function() {
        $("#"+id+"-file small").removeClass('red').text('上传的文件：'+$('#'+ id).val()).addClass('green');
    });

}

$("#edui3_body").click(function () {
    alert(12121);
});

function publicBusi(time,url,token){
    setInterval('EditTime(\''+url+'\',\''+token+'\')',1000*60*time);//这里的1000表示1秒有1000毫秒,1分钟有60秒,7表示总共7分钟
}
function EditTime(url,token){
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            '_token': token
        },
        dataType: 'json',
        success: function (data) {
        }
    });

}