<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('os_qq')) {$zbp->ShowError(48);die();}


if($_GET['id']){
	global $zbp;
	$where = array(array('=','os_qq_id',$_GET['id']));
	$sql= $zbp->db->sql->Delete($table['os_qq'],$where);
	$zbp->db->Delete($sql);
	$zbp->SetHint('good','成功解除绑定');
	Redirect('./main.php');
} else {
    Redirect($zbp->host);
}

?>