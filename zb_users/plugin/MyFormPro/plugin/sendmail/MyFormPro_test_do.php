<?php
require '../../../../../zb_system/function/c_system_base.php';
require '../../../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('MyFormPro')) {$zbp->ShowError(48);die();}

$MAIL_SMTP = $zbp->Config('MyFormPro')->MAIL_SMTP;
$MAIL_PORT = $zbp->Config('MyFormPro')->MAIL_PORT;
$MAIL_SENDEMAIL = $zbp->Config('MyFormPro')->MAIL_SENDEMAIL;
$MAIL_PASSWORD = $zbp->Config('MyFormPro')->MAIL_PASSWORD;
$MAIL_TOEMAIL = $zbp->Config('MyFormPro')->MAIL_TOEMAIL;

require_once dirname(__FILE__).'/class/class.smtp.php';
require_once dirname(__FILE__).'/class/class.phpmailer.php';

$blogname = $zbp->name;
$subject = $content = 'MyFormPro 这是一封测试邮件';

if(MyFormPro_Mail_Do($MAIL_SMTP, $MAIL_PORT, $MAIL_SENDEMAIL, $MAIL_PASSWORD, $MAIL_TOEMAIL, $subject, $content, $blogname)) {
	echo '<font color="green">发送成功！请到相应邮箱查收！：）</font>';
}