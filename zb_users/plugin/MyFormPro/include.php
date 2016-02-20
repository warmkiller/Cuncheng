<?php
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'myform_pro_config.php';   //show page/template
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'showform.php';   //show page/template
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR .'form_cls.php';   
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR .'fields_cls.php';   
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR .'content_cls.php';   
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR .'info_cls.php';   
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'function' . DIRECTORY_SEPARATOR .'cmd_ajax.php';   
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'function' . DIRECTORY_SEPARATOR .'data.php';   
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'function' . DIRECTORY_SEPARATOR .'common.php';   
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'plugin'.DIRECTORY_SEPARATOR.'simplecode'.DIRECTORY_SEPARATOR.'simplecode_cls.php';
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'plugin'.DIRECTORY_SEPARATOR.'sendmail'.DIRECTORY_SEPARATOR.'sendmail.php';
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'plugin'.DIRECTORY_SEPARATOR.'editor'.DIRECTORY_SEPARATOR.'showeditor.php';
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'plugin'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'showupload.php';



#注册插件
RegisterPlugin("MyFormPro","ActivePlugin_MyFormPro");

function ActivePlugin_MyFormPro() {
  Add_Filter_Plugin('Filter_Plugin_Cmd_Ajax','MyFormPro_Filter_Plugin_Cmd_Ajax');
  Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','MyFormPro_CheckPost');
  Add_Filter_Plugin('Filter_Plugin_Admin_LeftMenu','MyFormPro_Plugin_Admin_LeftMenu');
  Add_Filter_Plugin('Filter_Plugin_Admin_TopMenu','MyFormPro_Admin_TopMenu');

}

function MyFormPro_Plugin_Admin_LeftMenu(&$m){
    global $zbp;
        $w=array();
        $order = array('form_Time'=>'DESC');
        $sql= $zbp->db->sql->Select(
        $zbp->table['myform_pro_form'],
        '*',
        $w,
        $order,
        null,
        null
        );
        $formlist=$zbp->GetListCustom($zbp->table['myform_pro_form'],$GLOBALS['datainfo']['myform_pro_form'],$sql);
        foreach ($formlist as $form){
          if($form->ShortCut=='2'){
            $m[]=MakeLeftMenu("root",$form->Name,$zbp->host . "zb_users/plugin/MyFormPro/chart.php?fid=".$form->ID,"","topmenu_MyFormPro_".$form->ID);
          }
        }

}


function MyFormPro_Admin_TopMenu(&$m){
	global $zbp;
	//$m=array();
        $w=array();
        $order = array('form_Time'=>'DESC');
        $sql= $zbp->db->sql->Select(
        $zbp->table['myform_pro_form'],
        '*',
        $w,
        $order,
        null,
        null
        );
        $formlist=$zbp->GetListCustom($zbp->table['myform_pro_form'],$GLOBALS['datainfo']['myform_pro_form'],$sql);
        foreach ($formlist as $form){
          if($form->ShortCut=='3'){
              $m[]=MakeTopMenu("root",$form->Name,$zbp->host . "zb_users/plugin/MyFormPro/chart.php?fid=".$form->ID,"","topmenu_MyFormPro_".$form->ID);

          }
        }
        
}

function MyFormPro_CheckPost($template){
	global $zbp;
  $article = $template->GetTags('article');
	$pattern="<p[^>]*>[^<]*\[MyFormPro=(.+?)\](.+?)\[\/MyFormPro\][^<]*<\/p>";
		
  $article->Content=preg_replace_callback('/'.$pattern.'/is','MyFormPro_forReplace',$article->Content);
	$zbp->template->SetTags('article',$article);
}

function MyFormPro_forReplace($matches) { //callback
	global $zbp;
	  return MyFormPro_ShowForm($matches[2],$matches[1]);

}



function InstallPlugin_MyFormPro() {
          global $zbp;
          MyFormPro_CreateTable();
	if(!$zbp->Config('MyFormPro')->HasKey('Version')){
		$zbp->Config('MyFormPro')->Version = '1.0';


    $zbp->Config('MyFormPro')->Use_simplecode= 1;
    $zbp->Config('MyFormPro')->Upload_Type = 'jpg|gif|png|jpeg|rar|doc|docx|ppt|pptx|xls|xlsx';	
    $zbp->Config('MyFormPro')->Upload_Size = '20';

		$zbp->Config('MyFormPro')->MAIL_SMTP = 'smtp.exmail.qq.com';
		$zbp->Config('MyFormPro')->MAIL_PORT = '25';
		$zbp->Config('MyFormPro')->MAIL_SENDEMAIL = 'admin@birdol.com';
		$zbp->Config('MyFormPro')->MAIL_PASSWORD = '123456';
		$zbp->Config('MyFormPro')->MAIL_TOEMAIL = 'admin@birdol.com';
		$zbp->Config('MyFormPro')->MAIL_SENDTYPE = '1';

		$zbp->SaveConfig('MyFormPro');
	}
}

function UninstallPlugin_MyFormPro() {
          global $zbp;
        //  MyFormPro_DelTable();
        //  $zbp->DelConfig('MyFormPro');

}






