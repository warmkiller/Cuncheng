<?php
require dirname(__FILE__) . DIRECTORY_SEPARATOR  .'baidu_sitemap_config.php';   //Sitemap config

RegisterPlugin("BaiduSitemap","ActivePlugin_BaiduSitemap");

function ActivePlugin_BaiduSitemap() {
	Add_Filter_Plugin('Filter_Plugin_PostArticle_Succeed','BaiduSitemap_Get_BaiduSitemap');// Sitemap 生成接口

	Add_Filter_Plugin('Filter_Plugin_Index_Begin','BaiduSitemap_Main');
}

function InstallPlugin_BaiduSitemap(){
	global $zbp;
		if(!$zbp->Config('BaiduSitemap')->title_text){
		$zbp->Config('BaiduSitemap')->title_text='存档';
		$zbp->Config('BaiduSitemap')->readme_text='<p>本页面由<a href="http://www.beactivenc.com/">电脑知识学习网</a>提供技术支持</p>';
		$zbp->SaveConfig('BaiduSitemap');
	}
		//$zbp->AddItemToNavbar('item','BaiduSitemap',$zbp->Config('BaiduSitemap')->title_text,$zbp->host.'?archive');
}

function BaiduSitemap_Main(){
	global $zbp;

	if(isset($_GET['archive'])){
	BaiduSitemap_Page();

foreach ($GLOBALS['Filter_Plugin_Index_End'] as $fpname => &$fpsignal) {$fpname();}

RunTime();
		die();
	}
	
}


function BaiduSitemap_Page(){

	global $zbp;
	$zbp->header .='<link rel="stylesheet" href="'.$zbp->host.'zb_users/plugin/BaiduSitemap/style.css" type="text/css" />' . "\r\n";

	$article = new Post;
	$article->Title=$zbp->Config('BaiduSitemap')->title_text;
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
  $article->Template='sitemap';
	$article->Content .='<div id="content">';
	$article->Content .=$zbp->Config('BaiduSitemap')->readme_text;

	$article->Content .='<h3>最新文章</h3>';
	$article->Content .='<ul class="archive">';
	$article->Content .=BaiduSitemap_ListArticle();
	$article->Content .='</ul>';
	$article->Content .='</div><div id="content">';
	
	$article->Content .='<li class="categories">分类目录<ul>';
	$article->Content .=BaiduSitemap_ListCate();
	$article->Content .='</ul>';

	$article->Content .='<li class="pagenav">页面<ul>';
	$article->Content .=BaiduSitemap_ListPage();
	$article->Content .='</ul></li></div>';

	
	$zbp->template->SetTags('title',$article->Title);
	$zbp->template->SetTags('article',$article);
	$zbp->template->SetTemplate($article->Template);
	$zbp->template->SetTags('comments',array());
	$zbp->template->Display();
}

function BaiduSitemap_ListArticle() {
	global $zbp;
	
$where = array(array('=','log_Status','0'));
$array=$zbp->GetArticleList(
	'',
	$where,
	array('log_PostTime'=>'DESC'),
  null,
  null,
	false
);
$s='';
foreach ($array as $article) {
$s.="<li><a href=\"{$article->Url}\">{$article->Title}</a></li>";

}
	return $s;
}

function BaiduSitemap_ListPage() {
	global $zbp;
	
$where = array(array('=','log_Status','0'));
$array=$zbp->GetPageList(
	'',
	$where,
	array('log_PostTime'=>'DESC'),
  null,
  null,
	false
);
$s='';
foreach ($array as $article) {
$s.='<li class="page_item page-item-'.$article->ID.'"><a href="'.$article->Title.'">'.$article->Title.'</a></li>';
}
	return $s;
}

function BaiduSitemap_ListCate() {
	global $zbp;
	
  $s='';
	foreach ($zbp->categorys as $c) {
		$s.='<li class="cat-item cat-item-'.$c->ID.'"><a href="'.$c->Url.'" title="'.$c->Name.'">'.$c->Name.'</a></li>';
	}
	return $s;
}

function UninstallPlugin_BaiduSitemap(){
	global $zbp;
	$zbp->DelItemToNavbar('item','BaiduSitemap');
	$zbp->DelConfig('BaiduSitemap');

}

?>