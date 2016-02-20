<?php

$DefaultKeyWord = "Tm9iaXJkfOm4n+WEv+WNmuWuonxodHRwOi8vd3d3LmJpcmRvbC5jb20v";

$Nobird_Keywords_table = '%pre%KeyWordLinks';

$Nobird_Keywords_datainfo = array(
	'ID'=>array('KeyWord_ID','integer','',0),
	'Type'=>array('KeyWord_Type','integer','',0),
	'Title'=>array('KeyWord_Title','string',255,''),
	'Url'=>array('KeyWord_Url','string',255,''),
	'Des'=>array('KeyWord_Des','string',255,''),
	'Order'=>array('KeyWord_Order','integer','',99),
	'Code'=>array('KeyWord_Code','string',255,''),
	'IsUsed'=>array('KeyWord_IsUsed','boolean','',true),
	'Intro'=>array('KeyWord_Intro','string',255,''),
	'Addtime'=>array('KeyWord_Addtime','integer','',0),
	'Endtime'=>array('KeyWord_Endtime','integer','',0),
);



function KeyWordLinks_GetKeyWord($Nobird_Keywords_table,$Nobird_Keywords_datainfo){
	global $zbp,$str;
	$where = array(array('=','KeyWord_Type','0'),array('=','KeyWord_IsUsed','1'));
	$order = array('KeyWord_IsUsed'=>'DESC','KeyWord_ID'=>'ASC');
	$sql= $zbp->db->sql->Select($Nobird_Keywords_table,'*',$where,$order,null,null);
	$array=$zbp->GetListCustom($Nobird_Keywords_table,$Nobird_Keywords_datainfo,$sql);
	foreach ($array as $key => $reg) {
		$str .= $reg->Title.",".$reg->Url."|";
	}
	$arr=explode("|",$str);
	$result=array();
	foreach($arr as $data){
		trim($data) && $result[]=explode(",",$data); //首先要检查$data是否为空
	}
	return $result;
}

function KeyWordLinks_GetTagsKeyWord(){
	global $zbp;
	$num=	$zbp->Config('Nobird_Keywordlink')->Keywordlink_Num;
	if(!$num){$num=100;}
	$array = $zbp->GetTagList('','',array('tag_Count'=>'DESC'),array($num),'');
	$result=array();
	foreach($array as $key=>$value){
		$result[$value->Name] = $value->Url;
	}
	return $result;
}

function KeyWordLinks_CreateTable(){
	global $zbp;
	if($zbp->db->ExistTable($GLOBALS['Nobird_Keywords_table'])==false){
		$s=$zbp->db->sql->CreateTable($GLOBALS['Nobird_Keywords_table'],$GLOBALS['Nobird_Keywords_datainfo']);
		$zbp->db->QueryMulit($s);
	}
}

function KeyWordLinks_DefaultCode(){
	global $zbp;
	$Arr_DF = explode('|',base64_decode($GLOBALS['DefaultKeyWord']));
	$r = new Base($GLOBALS['Nobird_Keywords_table'],$GLOBALS['Nobird_Keywords_datainfo']);
	$r->Title=$Arr_DF[0];
	$r->Des=$Arr_DF[1];
	$r->Url=$Arr_DF[2];
	$r->Save();
}


function Nobird_KeyWordLinks_Uninstall(){
	global $zbp;
	$s=$zbp->db->sql->DelTable($GLOBALS['Nobird_Keywords_table']);
	$zbp->db->QueryMulit($s);
	$zbp->DelConfig('Nobird_Keywordlink');

}



function   KeyWordLinks_Main(&$template){
	global $zbp,$Nobird_Keywords_table,$Nobird_Keywords_datainfo;
	
	$article = $template->GetTags('article');
	$str = $article->Content;
	#$key = new KeyReplace($str,array("鸟"=>"www.baidu.com","鸟儿"=>'http://birdol.com',"鸟儿博客"=>'google.com'));
	#$article->Content = $key->getResultText(); 
	
	$array_first = KeyWordLinks_GetKeyWord($Nobird_Keywords_table,$Nobird_Keywords_datainfo);
	$array_last = array();
	foreach($array_first as $key=>$value){
		$array_last[$value[0]] = $value[1];
	}
	if ($zbp->Config('Nobird_Keywordlink')->Keywordlink_UseTags==1){
    $array2=KeyWordLinks_GetTagsKeyWord();
    $array_content = array_merge($array2, $array_last);  
	}else{
    $array_content=$array_last;
	}
//	$array_not=array('DOCTYPE','a','abbr','acronym','address','applet','area','article','aside','audio','b','base','basefont','bdi','bdo','big','blockquote','body','br','button','canvas','caption','center','cite','code','col','colgroup','command','datalist','dd','del','details','dfn','dialog','dir','div','dl','dt','em','embed','fieldset','figcaption','figure','font','footer','form','frame','frameset','h1','h6','head','header','hr','html','i','iframe','img','input','ins','kbd','keygen','label','legend','li','link','main','map','mark','menu','menuitem','meta','meter','nav','noframes','noscript','object','ol','optgroup','option','output','p','param','pre','progress','q','rp','rt','ruby','s','samp','script','section','select','small','source','span','strike','strong','style','sub','summary','sup','table','tbody','td','textarea','tfoot','th','thead','time','title','tr','track','tt','u','ul','var','video','wbr');
	//$array_content=array_diff($array_content,$array_not);
	if($zbp->Config('Nobird_Keywordlink')->Keywordlink_Times){
    $times=$zbp->Config('Nobird_Keywordlink')->Keywordlink_Times;
	}else{
    $times=1;
	}
	$key = new Nobird_KeyReplace($str,$array_content,true,array(),false,$times);
	$article->Content = $key->getResultText().'<!--'.$key->getRuntime().'-->'; 

}

function Nobird_Keywordlink_Install(){
	global $zbp;
	if(!$zbp->Config('Nobird_Keywordlink')->HasKey('Version')) {
	$zbp->Config('Nobird_Keywordlink')->Version = '1.0';
	$zbp->Config('Nobird_Keywordlink')->Keywordlink_UseTags = 1;//默认启用Tag关键字链接
	$zbp->Config('Nobird_Keywordlink')->Keywordlink_Times = '1';//单个关键词在某一篇文章内被替换次数
	$zbp->Config('Nobird_Keywordlink')->Keywordlink_Num='100';//替换前多少个Tag 按使用次数排队
	$zbp->Config('Nobird_Keywordlink')->Keywordlink_CLASSNAME="keywordlink";//替换前多少个Tag 按使用次数排队

	$zbp->Config('Nobird_Keywordlink')->protect_pre = 1;//保护pre标签
	$zbp->Config('Nobird_Keywordlink')->protect_script = 0;//保护script标签
	$zbp->Config('Nobird_Keywordlink')->protect_vars = 1;//保护普通html标签

	$zbp->SaveConfig('Nobird_Keywordlink');
	}
	
}



?>