<?php
#注册插件
RegisterPlugin("tt_bLazy","ActivePlugin_tt_bLazy");

function ActivePlugin_tt_bLazy() {
	Add_Filter_Plugin('Filter_Plugin_Zbp_MakeTemplatetags','tt_bLazy_main');
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','tt_bLazy_ViewPost_Content');//文章页替换
	Add_Filter_Plugin('Filter_Plugin_Zbp_BuildTemplate','tt_bLazy_Zbp_BuildTemplate_Content');//模板替换
}
function tt_bLazy_Zbp_BuildTemplate_Content(&$template){
global $zbp;	
	$pattern = "/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i";
$replacement = '<img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src=$2$3.$4$5 />';
$apl=explode(',',$zbp->Config('tt_bLazy')->templates);
foreach($apl as $key=> $value){	
if(isset($template[$value])){
$template[$value] = preg_replace($pattern, $replacement, $template[$value]);	
}		
}
}
function tt_bLazy_Template_Compiling_Begin_Content(&$this,&$content){
$pattern = "/<img(.*?)src=('|\")([^>]*).(bmp|gif|jpeg|jpg|png|swf)('|\")(.*?)>/i";
$replacement = '<img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src=$2$3.$4$5  />';
$content = preg_replace($pattern, $replacement, $content);
return $content;	
}
function tt_bLazy_main() {
	global $zbp;
	$zbp->footer .= '<script src="'.$zbp->host.'zb_users/plugin/tt_bLazy/js/blazy.min.js"></script>' . "\r\n";
	$zbp->footer .= '<script type="text/javascript">
(function() {

		var bLazy = new Blazy({
			breakpoints: [{
				}]
		  , success: function(element){
				setTimeout(function(){
					var parent = element.parentNode;
					parent.className = parent.className.replace(/\bloading\b/,\'\');
				}, 200);
			}
		});
	})();

	</script>' . "\r\n";
}

function tt_bLazy_ViewPost_Content(&$template){
global $zbp;
$article = $template->GetTags('article');
$pattern = "/<img(.*?)src=('|\")([^>]*).(bmp|gif|jpeg|jpg|png|swf)('|\")(.*?)>/i";
$replacement = '<img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src=$2$3.$4$5  />';
$content = preg_replace($pattern, $replacement, $article->Content);
$article->Content = $content;
$template->SetTags('article', $article);
}
function tt_bLazy_templates($default,$xuanze){
	global $zbp;
	$dir=$zbp->usersdir .'theme/' . $zbp->theme . '/template/';
	$files=GetFilesInDir($dir,'php');
	$s='';
	$apl=explode(',',$default);
	//print_r($default);
	//print_r($apl);
	foreach ($files as $key => $value) {
	 $s.='<li ><label class="selectit"><input value="'. $key.'"  '.(in_array($key,$apl)==$key?'checked="checked"':'') . ' name="'.$xuanze.'[]" type="checkbox"  > ' .  $key . '</label></li>';
	}
	return $s;
}
function InstallPlugin_tt_bLazy() {

}

function UninstallPlugin_tt_bLazy() {

}