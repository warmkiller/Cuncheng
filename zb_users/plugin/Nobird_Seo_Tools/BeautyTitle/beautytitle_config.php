<?php

function Nobird_Seo_Tools_Filter_Plugin_Edit_End(){
global $zbp;
if($zbp->Config('Nobird_BeautyTitle')->check){
	echo '<script src="'. $zbp->host .'zb_users/plugin/Nobird_Seo_Tools/BeautyTitle/common.js" type="text/javascript"></script>';
}
}

function nbseo_replace_dot($content){
	global $zbp,$article;

		$array=array();
		preg_match_all('/".+?"|\'.+?\'/', $content,$array,PREG_SET_ORDER);
		if(count($array)>0){
			foreach($array as $a){
				$a=$a[0];
				if(strstr($a,'.')!=false){
					$b=str_replace('.','{%_dot_%}',$a);
					$content=str_replace($a,$b,$content);
				}
			}
		}
		$content=str_replace(' . ',' {%_dot_%} ',$content);
		$content=str_replace('. ','{%_dot_%} ',$content);
		$content=str_replace(' .',' {%_dot_%}',$content);
		$content=str_replace('.','->',$content);
		$content=str_replace('{%_dot_%}','.',$content);
		return $content;
}

function nbseo_parse_vars_replace_dot($matches){
	global $zbp,$article;

		if(strpos($matches[1],'=')===false){
			return '{php} echo $' . nbseo_replace_dot($matches[1]) . '; {/php}';
		}else{
			return '{php} $' . nbseo_replace_dot($matches[1]) . '; {/php}';
		}
}

function Nobird_Seo_Tools_BeautyTitle(&$template){
	global $zbp,$article;

if ($zbp->Config('Nobird_BeautyTitle')->BeautyTitle_IsUse){
	$zbp->templates['header'] = preg_replace("/<title>.+<\/title>/is", 
	'{php}
if ($type=="index"&&$page=="1"){
$strtitle=$zbp->Config("Nobird_BeautyTitle")->s_index;
}elseif ($type=="index"&&$page>"1"){
$strtitle=$zbp->Config("Nobird_BeautyTitle")->s_list;
$Arr_Title = explode(" ",$title);
$strtitle = str_replace("%page%",$Arr_Title[0],$strtitle);
}elseif ($type=="article"){
$strtitle=$zbp->Config("Nobird_BeautyTitle")->s_article;
$strtitle = str_replace("%catename%",$article->Category->Name,$strtitle);
$strtitle = str_replace("%postname%",$article->Title,$strtitle);
if($zbp->Config("Nobird_BeautyTitle")->Use_DIY_article){
$strtitle = str_replace("%nbname%",$article->Metas->Nobird_Seo_Tools_DIY_article,$strtitle);
}

}elseif ($type=="page"){
$strtitle=$zbp->Config("Nobird_BeautyTitle")->s_page;
$strtitle = str_replace("%postname%",$article->Title,$strtitle);

}elseif($type!="index"&&$page>"1"){
$strtitle=$zbp->Config("Nobird_BeautyTitle")->s_all_list;
$Arr_Title = explode(" ",$title);
$strtitle = str_replace("%page%",$Arr_Title[1],$strtitle);
$strtitle = str_replace("%catetagdate%",$Arr_Title[0],$strtitle);
}elseif($type!="index"&&$page=="1"){
$strtitle=$zbp->Config("Nobird_BeautyTitle")->s_all;
$strtitle = str_replace("%catetagdate%",$title,$strtitle);

}
else{
$strtitle=$zbp->title.$zbp->Config("Nobird_BeautyTitle")->Title_Separator.$zbp->name;

}

if($type=="category"){
$strtitle = str_replace("%nbname%",$category->Metas->NBTitle,$strtitle);
}elseif($type=="tag"){
$strtitle = str_replace("%nbname%",$tag->Metas->NBTitle,$strtitle);
}else{
$strtitle = str_replace("%nbname%","",$strtitle);
}
$strtitle = str_replace("%name%",$zbp->name,$strtitle);
$strtitle = str_replace("%subname%",$zbp->subname,$strtitle);
if(!$strtitle){
$strtitle=$zbp->title.$zbp->Config("Nobird_BeautyTitle")->Title_Separator.$zbp->name;
}
echo "<title>".$strtitle."</title>";
{/php}
	
{if $type}{$Nobird_Seo_KeyAndDes}{/if}', $zbp->templates['header']); //article

}else{
	$zbp->templates['header'] = preg_replace("/<title>(.+)<\/title>/is",'<title>$1</title>
	{if $type}{$Nobird_Seo_KeyAndDes}{/if}', $zbp->templates['header']); //article

}





}




function Nobird_BeautyTitle_Install(){
	global $zbp;
	if(!$zbp->Config('Nobird_BeautyTitle')->HasKey('Version')) {
	$zbp->Config('Nobird_BeautyTitle')->Version = '1.0';
	if($zbp->host=='http://www.birdol.com/'){
	$zbp->Config('Nobird_BeautyTitle')->BeautyTitle_IsUse = 1;
	}
	$zbp->Config('Nobird_BeautyTitle')->Title_Separator= ' - ';	
	$zbp->Config('Nobird_BeautyTitle')->s_index = '%name%-%subname%';
	$zbp->Config('Nobird_BeautyTitle')->s_list = '%page%-%name%-%subname%';
	$zbp->Config('Nobird_BeautyTitle')->s_all = '%catetagdate%%nbname%-%name%';
	$zbp->Config('Nobird_BeautyTitle')->s_all_list = '%catetagdate%%nbname%-%name%-%page%';
	$zbp->Config('Nobird_BeautyTitle')->s_article = '%postname%-%catename%-%name%';
	$zbp->Config('Nobird_BeautyTitle')->s_page = '%postname%-%name%';
	$zbp->Config('Nobird_BeautyTitle')->check = 1;
	
	$zbp->SaveConfig('Nobird_BeautyTitle');
	}
	
}



function Nobird_BeautyTitle_Uninstall(){
	global $zbp;
	$zbp->DelConfig('Nobird_BeautyTitle');
}


?>