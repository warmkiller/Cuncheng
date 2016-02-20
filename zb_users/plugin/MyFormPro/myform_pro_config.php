<?php



function MyFormPro_SubMenu(){
	global $zbp,$bloghost;
$url = $_SERVER['PHP_SELF'];
$filename1 = explode('/',$url);
$filename = end($filename1);
//echo $filename; // use filename ,judgment focus
echo '<a href="'.$bloghost.'zb_users/plugin/MyFormPro/mng_form.php"><span class="m-left ' . ($filename=='mng_form.php'?'m-now':'') . '">表单管理</span></a>';
echo '<a href="'.$zbp->host.'zb_users/plugin/MyFormPro/edit_form.php"><span class="m-left' . ($filename=='edit_form.php'?'m-now':'') . '">新建表单</span></a>';


echo '<a href="'.$bloghost.'zb_users/plugin/MyFormPro/setting_mail.php"><span class="m-right ' . ($filename=='setting_mail.php'?'m-now':'') . '">邮件设置</span></a>';

echo '<a href="'.$bloghost.'zb_users/plugin/MyFormPro/setting_common.php"><span class="m-right ' . ($filename=='setting_common.php'?'m-now':'') . '">通用设置</span></a>';






}



?>