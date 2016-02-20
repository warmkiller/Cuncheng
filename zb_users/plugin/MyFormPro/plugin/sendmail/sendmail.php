<?php
require_once dirname(__FILE__).'/class/class.smtp.php';
require_once dirname(__FILE__).'/class/class.phpmailer.php';

function MyFormPro_Mail($form,$info) {
	global $zbp;
	$MAIL_SMTP = $zbp->Config('MyFormPro')->MAIL_SMTP;
	$MAIL_PORT = $zbp->Config('MyFormPro')->MAIL_PORT;
	$MAIL_SENDEMAIL = $zbp->Config('MyFormPro')->MAIL_SENDEMAIL;
	$MAIL_PASSWORD = $zbp->Config('MyFormPro')->MAIL_PASSWORD;
	$MAIL_TOEMAIL = $zbp->Config('MyFormPro')->MAIL_TOEMAIL;
	$MAIL_SENDTYPE = $zbp->Config('MyFormPro')->MAIL_SENDTYPE;
	$IS_SEND_MAIL = $form->NeedMail;
	
	$subject = "表单『{$form->Name}』收到了新的提交信息";

if($form->MailTemplate){

  $content=MyFormPro_SubmitReplace($form,$info,$form->MailTemplate);

}else{
  $content="表单『{$form->Name}』收到了新的提交信息，请登录查看：".$zbp->host;
}

   
	if($IS_SEND_MAIL) {
      MyFormPro_Mail_Do($MAIL_SMTP, $MAIL_PORT, $MAIL_SENDEMAIL, $MAIL_PASSWORD, $MAIL_TOEMAIL, $subject, $content, $zbp->name);
	}
	
}

function MyFormPro_Mail_Do($mailserver, $port, $mailuser, $mailpass, $mailto, $subject,  $content, $fromname) {
	$mail = new MyFormPro_PHPMailer();
	$mail->CharSet = "UTF-8";
	$mail->Encoding = "base64";
	$mail->Port = $port;

	if($MAIL_SENDTYPE = '1') {
		$mail->IsSMTP();
	}
	else {
		$mail->IsMail();
	}
	$mail->Host = $mailserver;
	$mail->SMTPAuth = true;
	$mail->Username = $mailuser;
	$mail->Password = $mailpass;
	$mail->From = $mailuser;
	$mail->FromName = $fromname;
	$mail->AddAddress($mailto);
	$mail->WordWrap = 500;
	$mail->IsHTML(true);
	$mail->Subject = $subject;
	$mail->Body = $content;
	$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
	if($mail->Host == 'smtp.gmail.com') $mail->SMTPSecure = "ssl";
	if(!$mail->Send()) {
		echo $mail->ErrorInfo;
		return false;
	}
	else {
		return true;
	}
}

