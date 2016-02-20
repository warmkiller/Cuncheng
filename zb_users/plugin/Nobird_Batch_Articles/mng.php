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
$edtauthor=GetVars('edtauthor','GET');
$addtag=GetVars('addtag','GET');
$deltag=GetVars('deltag','GET');

echo $edtcategory.'<br />';
echo $edtstatus.'<br />';
echo $edtIsTop.'<br />';
echo $edtauthor.'<br />';
echo $addtag.'<br />';
echo $deltag.'<br />';
$array = array();
$array = 	$_GET['id'];
    global $zbp;
if ($array!=null){
	var_dump($array);
  
    
#1、change cate\status\istop
if ($edtcategory!=null){
echo '即将被操作的分类ID：'.$edtcategory.'<br />';

foreach ($array as $id){
$sql = $zbp->db->sql->Update(
    $zbp->table['Post'],
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
    $zbp->table['Post'],
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
    $zbp->table['Post'],
    array('log_IsTop'=>$edtIsTop),
    array(array('=','log_ID',$id))
    );
$zbp->db->Query($sql);
} 



}else{ 
echo '无置顶状态<br />';
}

if ($edtauthor!=null){
echo '即将被操作的用户ID：'.$edtauthor.'<br />';

foreach ($array as $id){
$sql = $zbp->db->sql->Update(
    $zbp->table['Post'],
    array('log_AuthorID'=>$edtauthor),
    array(array('=','log_ID',$id))
    );
$zbp->db->Query($sql);
} 

}else{ 
echo '未设置操作用户<br />';
}




if ($addtag!=null){
echo '即将被增加的tagID：'.$addtag.'<br />';

foreach ($array as $id){
	$sql = $zbp->db->sql->Select(
       $zbp->table['Post'], 
       array('log_Tag'), 
       array(array('=','log_ID',$id)),
       array('log_PostTime' => 'DESC'), 
       '', 
       null
       );
	$array = $zbp->db->Query($sql);
#  $arraylittle=$array;
	$array2=$array[0];
	$tmptag=$array2['log_Tag'];// 终于得到字符串... 坑爹啊...
	$sql = $zbp->db->sql->Update(
    $zbp->table['Post'],
    array('log_Tag'=>$tmptag.'{'.$addtag.'}'),
    array(array('=','log_ID',$id))
    );
  $zbp->db->Query($sql);
#CountTagArrayString($tmptag.'{'.$addtag.'}');
CountTagArrayString('{'.$addtag.'}');
}

}else{ 
echo '未设置增加tag<br />';
}

if ($deltag!=null){
echo '即将被删减的tagID：'.$deltag.'<br />';

foreach ($array as $id){
	$sql = $zbp->db->sql->Select(
       $zbp->table['Post'], 
       array('log_Tag'), 
       array(array('=','log_ID',$id)),
       array('log_PostTime' => 'DESC'), 
       '', 
       null
       );
	$array = $zbp->db->Query($sql);
#  $arraylittle=$array;
	$array2=$array[0];
	$tmptag=$array2['log_Tag'];// 终于得到字符串... 坑爹啊...
  $tmptag2=str_replace('{'.$deltag.'}',"",$tmptag);
	$sql = $zbp->db->sql->Update(
    $zbp->table['Post'],
    array('log_Tag'=>$tmptag2),
    array(array('=','log_ID',$id))
    );
  $zbp->db->Query($sql);
#CountTagArrayString($tmptag2);
CountTagArrayString('{'.$deltag.'}');

}

}else{ 
echo '未设置删减tag<br />';
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
}  
#3、 if debug
Redirect('main.php');


?>