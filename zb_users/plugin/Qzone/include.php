<?php

include_once(dirname(__FILE__) . '/email.class.php');
#注册插件
RegisterPlugin("Qzone","ActivePlugin_Qzone");

function ActivePlugin_Qzone() {
    Add_Filter_Plugin('Filter_Plugin_PostArticle_Core','Qzone_Main');
}

function Qzone_Main(&$article){
    global $zbp;
    set_time_limit(0);
    ZBlogException::ClearErrorHook();
    $title="[".$article->Category->Name."]".$article->Title;
    $content = $article->Content;
        $smtpserver = "smtp.qq.com";//SMTP服务器
        $smtpserverport =25;//SMTP服务器端口
        $smtpusermail = $zbp->Config('Qzone')->UserName."@qq.com";//SMTP服务器的用户邮箱
        $smtpemailto = $zbp->Config('Qzone')->UserName."@qzone.qq.com";//发送给谁
        $smtpuser = $zbp->Config('Qzone')->UserName."@qq.com";//SMTP服务器的用户帐号
        $smtppass = $zbp->Config('Qzone')->UserPass;//SMTP服务器的用户密码
        $mailtitle = $title;//邮件主题
        $mailcontent = "本文由【".$article->Author->StaticName."】首发在【".$zbp->name."】，网站地址：".$zbp->host."<br>".$content;//邮件内容
        $mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
        //************************ 配置信息 ****************************
        $smtp = new tc_smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
        $smtp->debug = false;//是否显示发送的调试信息
        $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
}

function InstallPlugin_Qzone() {

}

function UninstallPlugin_Qzone() {

    

}