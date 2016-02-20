<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('txqy2')) {$zbp->ShowError(48);die();}

if($_GET['type'] == 'logo' ){
	global $zbp;
	foreach ($_FILES as $key => $value) {
		if(!strpos($key, "_php")){
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$tmp_name = $_FILES[$key]['tmp_name'];
				$name = $_FILES[$key]['name'];
				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'theme/txqy2/include/logo.png');

			}
		}
	}
	$zbp->SetHint('good','修改成功');
	Redirect('./main.php?act=logo');
}

if($_GET['type'] == 'gywm' ){
	global $zbp;
	foreach ($_FILES as $key => $value) {
		if(!strpos($key, "_php")){
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$tmp_name = $_FILES[$key]['tmp_name'];
				$name = $_FILES[$key]['name'];
				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'theme/txqy2/include/gywm.png');

			}
		}
	}
	$zbp->SetHint('good','修改成功');
	Redirect('./main.php?act=logo');
}

if($_GET['type'] == 'pic' ){
	global $zbp;
	foreach ($_FILES as $key => $value) {
		if(!strpos($key, "_php")){
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$tmp_name = $_FILES[$key]['tmp_name'];
				$name = $_FILES[$key]['name'];
				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'theme/txqy2/include/pic.png');

			}
		}
	}
	$zbp->SetHint('good','修改成功');
	Redirect('./main.php?act=logo');
}

if($_GET['type'] == 'xw' ){
	global $zbp;
	foreach ($_FILES as $key => $value) {
		if(!strpos($key, "_php")){
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$tmp_name = $_FILES[$key]['tmp_name'];
				$name = $_FILES[$key]['name'];
				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'theme/txqy2/include/xwzx.png');

			}
		}
	}
	$zbp->SetHint('good','修改成功');
	Redirect('./main.php?act=logo');
}

if($_GET['type'] == 'cp' ){
	global $zbp;
	foreach ($_FILES as $key => $value) {
		if(!strpos($key, "_php")){
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$tmp_name = $_FILES[$key]['tmp_name'];
				$name = $_FILES[$key]['name'];
				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'theme/txqy2/include/cpzx.png');

			}
		}
	}
	$zbp->SetHint('good','修改成功');
	Redirect('./main.php?act=logo');
}

if($_GET['type'] == 'ban' ){
	global $zbp;
	foreach ($_FILES as $key => $value) {
		if(!strpos($key, "_php")){
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$tmp_name = $_FILES[$key]['tmp_name'];
				$name = $_FILES[$key]['name'];
				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'theme/txqy2/include/banner.jpg');

			}
		}
	}
	$zbp->SetHint('good','修改成功');
	Redirect('./main.php?act=logo');
}

if($_GET['type'] == 'weixin' ){
	global $zbp;
	foreach ($_FILES as $key => $value) {
		if(!strpos($key, "_php")){
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$tmp_name = $_FILES[$key]['tmp_name'];
				$name = $_FILES[$key]['name'];
				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'theme/txqy2/include/weixin.jpg');

			}
		}
	}
	$zbp->SetHint('good','修改成功');
	Redirect('./main.php?act=logo');
}

if($_GET['type'] == 'three' ){
	global $zbp;
	foreach ($_FILES as $key => $value) {
		if(!strpos($key, "_php")){
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$tmp_name = $_FILES[$key]['tmp_name'];
				$name = $_FILES[$key]['name'];
				$rname = str_replace('_','.',$key);
				// echo $rname;exit();
				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'theme/txqy2/include/'.$rname);

			}
		}
	}
	$zbp->SetHint('good','修改成功');
	Redirect('./main.php?act=logo');
}
if($_GET['type'] == 'three2' ){
	global $zbp;
	foreach ($_FILES as $key => $value) {
		if(!strpos($key, "_php")){
			if (is_uploaded_file($_FILES[$key]['tmp_name'])) {
				$tmp_name = $_FILES[$key]['tmp_name'];
				$name = $_FILES[$key]['name'];
				$rname = str_replace('_','.',$key);
				// echo $rname;exit();
				@move_uploaded_file($_FILES[$key]['tmp_name'], $zbp->usersdir . 'theme/txqy2/include/'.$rname);

			}
		}
	}
	$zbp->SetHint('good','修改成功');
	Redirect('./main.php?act=logo');
}

?>