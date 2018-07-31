<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>音乐</title>
</head>
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<body>
<div class="box_input" style="margin-bottom: 20px;">

    <form action="shiyancl.php" method="post" style="width: 960px;" enctype="multipart/form-data">
        <input id="test" style="display: inline-block;" type="file"  name="file"/>
        <audio id="audio" controls autoplay="" style="display: none; "></audio>
        <input type="submit" id="mp3_submit" style="display: none;margin-left: 25px;" type="button" value="提交"/>
    </form>

</div>
</body>
<script>
    //录音上传
    $(function () {
        $("#test").change(function () {
            var objUrl = getObjectURL(this.files[0]);
            $("#audio").attr("src", objUrl);
            $("#audio")[0].pause();
            $("#audio").show();
            $("#mp3_submit").show()
            getTime();

        });
    });
    <!--获取mp3文件的时间 兼容浏览器-->
    function getTime() {
        setTimeout(function () {
            var duration = $("#audio")[0].duration;
            if(isNaN(duration)){
                getTime();
            }
            else{
                console.info("该歌曲的总时间为："+$("#audio")[0].duration+"秒")
            }
        }, 10);
    }
    <!--把文件转换成可读URL-->
    function getObjectURL(file) {
        var url = null;
        if (window.createObjectURL != undefined) { // basic
            url = window.createObjectURL(file);
        } else if (window.URL != undefined) { // mozilla(firefox)
            url = window.URL.createObjectURL(file);
        } else if (window.webkitURL != undefined) { // webkit or chrome
            url = window.webkitURL.createObjectURL(file);
        }
        return url;

    }
</script>
</html>
