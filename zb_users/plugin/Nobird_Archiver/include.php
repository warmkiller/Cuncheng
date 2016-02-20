<?php

RegisterPlugin("Nobird_Archiver","ActivePlugin_Nobird_Archiver");

function ActivePlugin_Nobird_Archiver() {

	Add_Filter_Plugin('Filter_Plugin_Index_Begin','Nobird_Archiver_Main');
}

function InstallPlugin_Nobird_Archiver(){
	global $zbp;
		if(!$zbp->Config('Nobird_Archiver')->title_text){
		$zbp->Config('Nobird_Archiver')->title_text='存档';
		$zbp->Config('Nobird_Archiver')->readme_text='<p>本页面由<a href="http://www.birdol.com/">鸟儿博客</a>提供技术支持</p>';
		$zbp->SaveConfig('Nobird_Archiver');
	}
		//$zbp->AddItemToNavbar('item','Nobird_Archiver',$zbp->Config('Nobird_Archiver')->title_text,$zbp->host.'?archive');
}

function Nobird_Archiver_Main(){
	global $zbp;

	if(isset($_GET['archive'])){
	Nobird_Archiver_Page();

foreach ($GLOBALS['Filter_Plugin_Index_End'] as $fpname => &$fpsignal) {$fpname();}

RunTime();
		die();
	}
	
}


function Nobird_Archiver_Page(){

	global $zbp;
	$zbp->header .='<link rel="stylesheet" href="'.$zbp->host.'zb_users/plugin/Nobird_Archiver/style.css" type="text/css" />' . "\r\n";

	$article = new Post;
	$article->Title=$zbp->Config('Nobird_Archiver')->title_text;
	
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
	$article->Content .=$zbp->Config('Nobird_Archiver')->readme_text;
	$article->Content .='<ul class="archive">';
	$article->Content .=Nobird_Archiver_List();
	$article->Content .='</ul>';
	$zbp->template->SetTags('title',$article->Title);
	$zbp->template->SetTags('article',$article);
	$zbp->template->SetTemplate($article->Template);
	$zbp->template->SetTags('comments',array());
	$zbp->template->Display();
}

function Nobird_Archiver_List() {
	global $zbp;
	
$p=new Pagebar('{%host%}index.php?archive{&page=%page%}',false);
$p->PageCount=60; #$zbp->managecount // system default str
$p->PageNow=(int)GetVars('page','GET')==0?1:(int)GetVars('page','GET');
$p->PageBarCount=$zbp->pagebarcount;
	
	
	
$where = array(array('=','log_Status','0'));
$array=$zbp->GetArticleList(
	'',
	$where,
	array('log_PostTime'=>'DESC'),
	array(($p->PageNow-1) * $p->PageCount,$p->PageCount),
	array('pagebar'=>$p),
	false
);
$s='';
foreach ($array as $article) {
$s.="<li><span>·</span><a href=\"{$article->Url}\">{$article->Title}</a></li>";

}

foreach ($p->buttons as $key => $value) {
	$s.= '<a href="'. $value .'">' . $key . '</a>&nbsp;&nbsp;' ;
}



	return $s;
}

function UninstallPlugin_Nobird_Archiver(){
	global $zbp;
	$zbp->DelItemToNavbar('item','Nobird_Archiver');
	$zbp->DelConfig('Nobird_Archiver');

}

?>