<?php
require '../../../../../zb_system/function/c_system_base.php';
require '../../../../../zb_system/function/c_system_admin.php';
$zbp->Load();

/*
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('MyFormPro')) {$zbp->ShowError(48);die();}
*/
//$_FILES['file']['name'] = date('YmdHis').'_'.rand(10000,99999).'.'.GetFileExt($_FILES['file']['name']);

$picname = $_FILES['mypic']['name'];
$picsize = $_FILES['mypic']['size'];
if ($picname != "") {

	$type = GetFileExt($picname);

  $extlist=$zbp->Config('MyFormPro')->Upload_Type;
  
  $extresult=HasNameInString($extlist,$type);

	$n=1024*1024*(int)$zbp->option['ZC_UPLOAD_FILESIZE'];
  if($n>=$picsize){
  $sizeresult=true;
  }else{
  $sizeresult=false;
  }

if($extresult&&$sizeresult){

	$rand = rand(100000, 999999);
	$pics = 'mfp_'.date("YmdHis") . $rand .'.'. $type;
	//上传路径
	$pic_path = ZBP_PATH . 'zb_users/upload/' . $pics;
	move_uploaded_file($_FILES['mypic']['tmp_name'], $pic_path);

	$size = round($picsize/1024,2);
	$arr = array(
		'name'=>$picname,
		'pic'=>$pics,
		'size'=>$size
	);
}else{
	$arr = array(
		'name'=>'上传失败',
		'pic'=>'上传失败',
		'size'=>'0'
	);
}
	echo json_encode($arr);

}
