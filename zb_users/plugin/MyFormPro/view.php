<?php
require '../../../zb_system/function/c_system_base.php';
$zbp->Load();
	$fid = (int)GetVars('fid', 'GET');
	$form = new myform_pro_form();
	$form->LoadInfoByID($fid);
	

echo MyFormPro_ShowForm($form->ID,3);
	
RunTime();