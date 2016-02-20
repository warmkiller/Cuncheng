<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('TcSlide')) {$zbp->ShowError(48);die();}

if($_GET['type'] == 'flash' ){
	global $zbp;
	
	if(!$_POST["title"] or !$_POST["img"] or !$_POST["url"]){
		$zbp->SetHint('bad','标题或图片或链接不能为空');
		Redirect('./main.php');
		exit();
	}
	
	$DataArr = array(
		'sean_Title'=>$_POST["title"],
		'sean_Img'=>$_POST["img"],
		'sean_Url'=>$_POST["url"],
		'sean_Code'=>$_POST["code"],
		'sean_Order'=>$_POST["order"],
		'sean_IsUsed'=>$_POST["IsUsed"]
	);

	if($_POST["editid"]){
		$where = array(array('=','sean_ID',$_POST["editid"]));
		$sql= $zbp->db->sql->Update($TcSlide_Table,$DataArr,$where);
		$zbp->db->Update($sql);
	}else{
		$sql= $zbp->db->sql->Insert($TcSlide_Table,$DataArr);
		$zbp->db->Insert($sql);
	}
	TcSlide_Get_Flash($TcSlide_Table,$TcSlide_DataInfo);
	$zbp->SetHint('good','幻灯保存成功');
	Redirect('./main.php');
}

if($_GET['type'] == 'flashdel' ){
	global $zbp;
	$where = array(array('=','sean_ID',$_GET['id']));
	$sql= $zbp->db->sql->Delete($TcSlide_Table,$where);
	$zbp->db->Delete($sql);
	TcSlide_Get_Flash($TcSlide_Table,$TcSlide_DataInfo);
	$zbp->SetHint('good','删除成功');
	Redirect('./main.php');
}

if($_GET['type'] == 'clearmoudle' ){
	global $zbp;
	$sql = $zbp->db->sql->Delete($zbp->table['Module'],array(array('=','mod_Source',"theme")));
	$zbp->db->Delete($sql);
	$zbp->SetHint('good','清除成功');
	Redirect('./main.php');
}

?>