<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>查看图纸</title>
    <script src="{{ asset('personals/js/jquery.min.js') }}"></script> <!-- JQUERY -->
    <script src="{{ asset('js/pdfobject.min.js') }}"></script>
</head>
<body>




<style>
    /* Only resize the element if PDF is embedded */
    .pdfobject-container {
        width: 100%;
        height: 100%;
    }
    body{margin: 0;padding: 0}
</style>

<div id="my-container"></div>

<script>
    $(document).ready(function () {
        var height=$(window).height();
        $('#my-container').css('height',height+'px')
    })


    PDFObject.embed("/upload/{!! $data['question']->pdf !!}", "#my-container");
</script>




</body>