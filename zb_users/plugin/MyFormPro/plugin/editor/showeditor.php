<?php


function MyFormPro_Richtext_AntiXss($content) {

	global $bloghost;

	// 过滤XSS
	require_once('xsshtml.class.php');
	$xss = new XssHtml($content);
	$xss->setHost($bloghost);
	$xss->setDefaultImg($bloghost . 'zb_system/image/admin/error.png');
	return $xss->getHtml();

}



function MyFormPro_Richtext_Load() {
	global $zbp;
	echo "\r\n".';document.writeln("<script src=\'' . $zbp->host .'zb_users/plugin/MyFormPro/plugin/editor/tinymce/tinymce.min.js\' type=\'text/javascript\'></script>");'."\r\n";
?>
;$(document).ready(function(){
tinymce.init({
          selector:"#mfp_richtext",
          toolbar: "undo redo | fontsizeselect | bold italic forecolor |",  
          menubar: false,
          language: "zh_CN", 
          height: 200,
          plugins: [                            
                "textcolor"
          ],

});
});
<?php

}
function MyFormPro_Richtext_Load2() {
	global $zbp;
?>
window.UMEDITOR_CONFIG = {UMEDITOR_HOME_URL : "<?echo $zbp->host;?>" + "zb_users/plugin/MyFormPro/plugin/editor/ueditor/",toolbar: ['bold italic underline forecolor link unlink | emotion drafts'],minWidth: parseInt('<?php echo ((int)$zbp->Config('MyFormPro')->minWidth == 0 ? 500 : $zbp->Config('MyFormPro')->minWidth)?>'),minHeight: parseInt('<?php echo ((int)$zbp->Config('MyFormPro')->minHeight == 0 ? 500 : $zbp->Config('MyFormPro')->minHeight)?>')};
;$(document).ready(function(){
		<?php //UE压缩过了，再找哪个option好麻烦，直接UMEDITOR_CONFIG方便?>
	window.MYFORMPRO = UM.getEditor('mfp_richtext');;
});
<?php
	echo "\r\n".';document.writeln("<script src=\'' . $zbp->host .'zb_users/plugin/MyFormPro/plugin/editor/ueditor/umeditor.min.js\' type=\'text/javascript\'></script><link rel=\'stylesheet\' type=\'text/css\' href=\'' . $zbp->host .'zb_users/plugin/MyFormPro/plugin/editor/ueditor/themes/default/css/umeditor.min.css\'/>");'."\r\n";

}
