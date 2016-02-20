<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='ArticleMng';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Nobird_Batch_Articles')) {$zbp->ShowError(48);die();}


$edtcategory=GetVars('edtcategory','GET');
$edtstatus=GetVars('edtstatus','GET');
$edtIsTop=GetVars('edtIsTop','GET');
echo $edtcategory.'<br />';
echo $edtstatus.'<br />';
echo $edtIsTop.'<br />';
	$array = array();
	$array = $_GET['id'];
    global $zbp;
#1、change cate\status\istop
if ($edtcategory!=null){
echo '即将被操作的分类ID：'.$edtcategory.'<br />';

foreach ($array as $id){
$sql = $zbp->db->sql->Update(
    '%pre%post',
    array('log_CateID'=>$edtcategory),
    array(array('=','log_ID',$id))
    );
$zbp->db->Query($sql);
}  // 在此对不锈钢猪猪表示强烈的敬意。。。BY Nobird

}else{ 
echo '无分类ID<br />';
}
if ($edtstatus!=null){
echo '即将被操作文章状态：'.$edtstatus.'<br />';

foreach ($array as $id){
$sql = $zbp->db->sql->Update(
    '%pre%post',
    array('log_Status'=>$edtstatus),
    array(array('=','log_ID',$id))
    );
$zbp->db->Query($sql);
} 


}else{ 
echo '无文章状态<br />';
}
if ($edtIsTop!=null){
echo '即将被操作置顶状态：'.$edtIsTop.'<br />';

foreach ($array as $id){
$sql = $zbp->db->sql->Update(
    '%pre%post',
    array('log_IsTop'=>$edtIsTop),
    array(array('=','log_ID',$id))
    );
$zbp->db->Query($sql);
} 



}else{ 
echo '无置顶状态<br />';
}




#2、NB_DelArticle() &  DelArticle_Comments()
if (isset($_GET['BatchDel'])) {
		$type = 'BatchDel';

echo $type.'<br />';
	$array = array();
	$array = $_GET['id'];
  var_dump($array);

	foreach ($array as $id) 
	{
		NB_DelArticle($id);
	}


}

#3、 if debug
Redirect('main.php');


?>