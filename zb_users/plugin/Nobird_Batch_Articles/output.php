<?php
require '../../../zb_system/function/c_system_base.php';
//require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Nobird_Batch_Articles')) {$zbp->ShowError(48);die();}

	$array=$zbp->GetArticleList(
		'*',
        null,
		array('log_PostTime'=>'DESC'),
		null,
		null
	);

header("Content-type:application/vnd.ms-excel");
header('Content-type: charset=GB2312');
header("Content-Type: application/force-download");
header('Pragma: no-cache');
HEADER('Expires: 0');
header("Content-Disposition:filename=文章列表".date("Ymd",time()).".xls");
$str='';
$str.= "序号\t";
$str.= "文章名\t";
$str.= "分类\t";
$str.= "文章地址\t";
//$str.= "文章内容\t";
$str.= "发布时间\t\r\n";

echo iconv("UTF-8","GB2312//IGNORE",$str);
$a='';

foreach ($array as $article) {

 $a.= $article->ID."\t";
 $a.= $article->Title."\t";
 $a.= $article->Category->Name."\t";
 $a.= $article->Url."\t";
 $a.= $article->Time('Y-m-d')."\t\r\n";
}
       
echo iconv("UTF-8","GBK",$a);












