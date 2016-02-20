<?php
function MyFormPro_Upload_Load($bts=false) {
	global $zbp;
	$str='';
	$str.= '<script src="'. $zbp->host .'zb_users/plugin/MyFormPro/plugin/upload/jquery.form.js" type="text/javascript"></script>';

if(!$bts){
	$str.=  '<link href="'. $zbp->host .'zb_users/plugin/MyFormPro/plugin/upload/editstyle.css" rel="stylesheet" type="text/css" />';
	$str.=  '
	<div class="btn"> <span>添加附件</span> <input id="fileupload" type="file" name="mypic" /> </div>
	<div class="progress"> <span class="bar"></span><span class="percent">0%</span> </div>
	
	<script type="text/javascript">
	$(function () {
	var bar = $(\'.bar\');
	var percent = $(\'.percent\');
	var progress = $(".progress");
	var btn = $(".btn span");
	$("#fileupload").wrap("<form id=\'myupload\' action=\''. $zbp->host .'zb_users/plugin/MyFormPro/plugin/upload/do_upload.php\' method=\'post\' enctype=\'multipart/form-data\'></form>");
	$("#fileupload").change(function(){
		$("#myupload").ajaxSubmit({
			dataType:  \'json\',
			beforeSend: function() {
				progress.show();
				var percentVal = \'0%\';
				bar.width(percentVal);
				percent.html(percentVal);
				btn.html("上传中...");
			},
			uploadProgress: function(event, position, total, percentComplete) {
				var percentVal = percentComplete + \'%\';
				bar.width(percentVal);
				percent.html(percentVal);
			},
			success: function(data) {
			//console.log(data);
                if(data.size!=0){
                        var img = data.pic;
                        document.getElementById(\'valueimg\').value = img ;
                        btn.html("上传成功");
                }else{
                        progress.show();
                        var percentVal = \'0%\';
                        bar.width(percentVal);
                        percent.html(percentVal);
                        btn.html("上传失败");
                        alert("上传失败：文件过大或者文件类型不允许！");
                        bar.width(\'100%\')
                }			
			},
			error:function(xhr){
				progress.show();
				var percentVal = \'0%\';
				bar.width(percentVal);
				percent.html(percentVal);
				btn.html("上传失败");
				bar.width(\'100%\')
			}
		});
	});
});
</script>';
}else{
$str.=  '

<div class="col-sm-5">
              <input id="fileupload" type="file" name="mypic" />
</div>
<div class="col-sm-5">
<div class="progress">
  <div class="progress-bar progress-bar-striped active progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
    60%
  </div>
</div></div>


	
	<script type="text/javascript">
	$(function () {
	var bar = $(\'.progress-bar\');
	var percent = $(\'.percent\');
	var progress = $(".progress");
	$("#fileupload").wrap("<form id=\'myupload\' action=\''. $zbp->host .'zb_users/plugin/MyFormPro/plugin/upload/do_upload.php\' method=\'post\' enctype=\'multipart/form-data\'></form>");
	$("#fileupload").change(function(){
		$("#myupload").ajaxSubmit({
			dataType:  \'json\',
			beforeSend: function() {
				progress.show();
				var percentVal = \'0\';
				bar.attr("aria-valuenow",percentVal);
				bar.width(percentVal+\'%\');
        bar.addClass("progress-bar-striped");
        bar.removeClass("progress-bar-danger");
        bar.addClass("progress-bar-success");
			},
			uploadProgress: function(event, position, total, percentComplete) {
				var percentVal = percentComplete;
				bar.attr("aria-valuenow",percentVal);
				bar.width(percentVal+\'%\');
				bar.html(percentVal+\'%\');
			},
			success: function(data) {
                if(data.size!=0){
                        var img = data.pic;
                        document.getElementById(\'valueimg\').value = img ;
                        bar.width("100"+\'%\');
                        bar.html("上传成功");
                        bar.removeClass("progress-bar-striped");
                }else{
                        bar.width("100"+\'%\');
                        bar.html("上传失败：文件过大或者文件类型不允许！");
                        bar.removeClass("progress-bar-success");
                        bar.addClass("progress-bar-danger");


                }		

			},
			error:function(xhr){
				progress.show();
				var percentVal = \'0\';
				bar.attr("aria-valuenow",percentVal);
				bar.attr("aria-valuenow",100);
				bar.width("100"+\'%\');
				bar.html(percentVal+\'%\');
			}
		});
	});
});
</script>';

}
return $str;

}


