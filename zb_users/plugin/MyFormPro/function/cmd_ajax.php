<?php
/***********************************************************
* Ajax 
*/

function MyFormPro_Filter_Plugin_Cmd_Ajax(){
	global $zbp;
	$action=GetVars('src','GET');


	$array=array();

switch ($action) {
#{"uid":"-3","redirect_url":"http:\/\/u.zblogcn.com\/login"}
	case "mfp_submit":

	$formid=GetVars('mfp_formid','POST');
	$form = new myform_pro_form();
	$form->LoadInfoByID($formid);
  $formdisable=false;

//1 NeedLogin
if($form->NeedLogin&&$zbp->user->ID==0){
  $formdisable=true;
}
//2 ScheduleTime
$now=time();
if($form->Schedule&&($now<$form->Schedule_StartTime||$now>$form->Schedule_EndTime)){
  $formdisable=true;
}
//3 Use_Limit
if($form->Use_Limit){

  switch($form->Limit_Type){
    case 1://total
      $all_num = GetValueInArrayByCurrent($zbp->db->Query('SELECT COUNT(*) AS num FROM ' . $GLOBALS['table']['myform_pro_info'] . ' WHERE Form_ID='.$form->ID), 'num');
    break;

    case 2:// day mktime(hour,minute,second,month,day,year,is_dst)
      $b = mktime(0,0,0,date('m'),date('d'),date('Y'));
      $e = time();
      $all_num = GetValueInArrayByCurrent($zbp->db->Query('SELECT COUNT(*) AS num FROM ' . $GLOBALS['table']['myform_pro_info'] . ' WHERE Form_ID='.$form->ID.' AND Time between '.$b .' AND '.$e), 'num');
    break;

    case 3://week
      $b = mktime(0,0,0,date('m'),date('d')-7,date('Y'));
      $e = time();
      $all_num = GetValueInArrayByCurrent($zbp->db->Query('SELECT COUNT(*) AS num FROM ' . $GLOBALS['table']['myform_pro_info'] . ' WHERE Form_ID='.$form->ID.' AND Time between '.$b .' AND '.$e), 'num');
    break;
    
    case 4://month
      $b = mktime(0,0,0,date('m')-1,date('d'),date('Y'));
      $e = time();
      $all_num = GetValueInArrayByCurrent($zbp->db->Query('SELECT COUNT(*) AS num FROM ' . $GLOBALS['table']['myform_pro_info'] . ' WHERE Form_ID='.$form->ID.' AND Time between '.$b .' AND '.$e), 'num');
    break;
    
    case 5://year
      $b = mktime(0,0,0,date('m'),date('d'),date('Y')-1);
      $e = time();
      $all_num = GetValueInArrayByCurrent($zbp->db->Query('SELECT COUNT(*) AS num FROM ' . $GLOBALS['table']['myform_pro_info'] . ' WHERE Form_ID='.$form->ID.' AND Time between '.$b .' AND '.$e), 'num');
    break;
  }
  
  if($all_num>=$form->Limit_Num){
    $formdisable=true;
  }
}

if($formdisable){
          $array['uid']='error';
          $array['msg']='非法提交!';
          echo json_encode($array);
          die();
}




	
	
  $where = array(array('=','Form_ID',$form->ID));
  $order = array('fileds_Order'=>'ASC','fileds_ID'=>'ASC');//POST DATA REVERSE 
  $sql= $zbp->db->sql->Select($zbp->table['myform_pro_fields'],'*',$where,$order,null,null);
  $arrayfields=$zbp->GetListCustom($zbp->table['myform_pro_fields'],$GLOBALS['datainfo']['myform_pro_fields'],$sql);
//VAR_DUMP($arrayfields);




if($form->Validatecode){
  if(!isset($_POST['verifycode'])){
          $array['uid']='error';
          $array['msg']='验证码错误！';
          break;
  }
}

if($form->Validatecode&&!$zbp->Config('MyFormPro')->Use_simplecode){
    $verifycode=trim($_POST['verifycode']);
    if(!$zbp->CheckValidCode($verifycode,'MyFormPro')){
          $array['uid']='error';
          $array['msg']='验证码错误！';
          break;
    } 
}elseif($form->Validatecode&&$zbp->Config('MyFormPro')->Use_simplecode){
    $verifycode=trim($_POST['verifycode']);
    if(!MyFormPro_CheckValidCode($verifycode,'MyFormPro')){
          $array['uid']='error';
          $array['msg']='验证码错误！';
          break;
    }  
}



	$arraycontent=array();
	
	$info=new myform_pro_info();
	$info->Time=time();
	$info->Form_ID=$form->ID;
	$info->IP=GetGuestIP();
	$info->Agent = GetGuestAgent();
	$info->Save();
	
	foreach ($arrayfields as $key=>$field){
	//VAR_DUMP($field->Check);
     //if (isset($_POST['mfp_'.$field->ID])){
//1、必须输入
  if(($field->Check==true)&&(!isset($_POST['mfp_'.$field->ID])||($_POST['mfp_'.$field->ID]==''))){
      $array['uid']='error';
      $array['msg']='“'.$field->Desc.'"：为必填项！';
      $info->Del();break;
  }
//2、内容为空处理
      if($field->ShowType==4){       // 多选处理
        if (!isset($_POST['mfp_'.$field->ID])){
          $_POST['mfp_'.$field->ID]=array('未填写');	
        }  
        $string=implode('|',$_POST['mfp_'.$field->ID]);
        $arraycontent[$field->ID]=$string;	
      }else{
        if (!isset($_POST['mfp_'.$field->ID])){
          $_POST['mfp_'.$field->ID]='未填写';	
        }      
        $arraycontent[$field->ID]=trim($_POST['mfp_'.$field->ID]);	
        
       // preg_replace('/[\r\n\s]+/', '', TransferHTML($STR,'[nohtml]'));
      if(mb_strlen(TransferHTML($_POST['mfp_'.$field->ID],'[nohtml]'))>$field->Length){
          $array['uid']='error';
          $array['msg']='“'.$field->Desc.'"：超出长度限制！';
          $info->Del();break;
      }
	    }
	    
	    if($field->ShowType==5){
        if($arraycontent[$field->ID]=='未填写'||$arraycontent[$field->ID]=='0'){
          $arraycontent[$field->ID]='off';	
	      }
	      if($arraycontent[$field->ID]=='1'){
          $arraycontent[$field->ID]='on';	
	      }
	    }


	    if($arraycontent[$field->ID]==''){
	    }	    
	    $content=new myform_pro_contents();
	    $content->Form_ID=$form->ID;
	    $content->Field_ID=$field->ID;
	    $content->Info_ID=$info->ID;
	    $content->Content=$arraycontent[$field->ID];
	   //     var_dump($content);

	    
//3、类型检查
  if($field->Check==true){

      if ($field->Type==1 && !MyFormPro_Check($content->Content, '[username]')) {
        $array['uid']='error';
        $array['msg']='“'.$field->Desc.'"：用户名格式不正确，可能过长或为空！';
        $info->Del();break;
      }
      if ($field->Type==2 && !MyFormPro_Check($content->Content, '[password]')) {
        $array['uid']='error';
        $array['msg']='“'.$field->Desc.'"：密码只能由A-Za-z0-9`~!@#$%^&*-_字符组成，且不能小于8位、大于20位。';
        $info->Del();break;
      }
      if ($field->Type==3 && (!MyFormPro_Check($content->Content, '[email]'))) {
        $array['uid']='error';
        $array['msg']='“'.$field->Desc.'"：邮箱格式不正确，可能过长或为空';
        $info->Del();break;      
      }
      if ($field->Type==4 ){
        if (!preg_match('/^http:\/\//', $content->Content)) {
          $content->Content = "http://" . $content->Content;
        }
       }
      if ($field->Type==4 && (!MyFormPro_Check($content->Content, '[homepage]'))) {
        $array['uid']='error';
        $array['msg']='“'.$field->Desc.'"：网址格式不正确，可能过长或为空';
        $info->Del();break;     
      }
      if ($field->Type==5) {
        $para='/^[\x{4e00}-\x{9fa5}]+$/u';
        if(!MyFormPro_Check($content->Content, $para))
        $array['uid']='error';
        $array['msg']='“'.$field->Desc.'"：必须包含中文字符！';
        $info->Del();break;     
      }
      if ($field->Type==6) {
        $para='/^[\x{4e00}-\x{9fa5}]+$/u';
        if(!MyFormPro_Check($content->Content, $para))
        $array['uid']='error';
        $array['msg']='“'.$field->Desc.'"：必须全是中文字符！';
        $info->Del();break;     
      }
      if ($field->Type==7) {
        $para='/^\d+$/';
        if(!MyFormPro_Check($content->Content, $para))
        $array['uid']='error';
        $array['msg']='“'.$field->Desc.'"：必须全是数字！';
        $info->Del();break;     
      }
      if ($field->Type==8) {
        $para='/^[a-zA-Z\s]+$/';
        if(!MyFormPro_Check($content->Content, $para))
        $array['uid']='error';
        $array['msg']='“'.$field->Desc.'"：必须全是英文字符！';
        $info->Del();break;     
      }
  }	   
  
      //4、以防万一
      if($field->ShowType!=8){       // not richtext
        $content->Content = TransferHTML($content->Content, '[nohtml]');
	    }else{
        $content->Content = MyFormPro_Richtext_AntiXss($content->Content);
	    }
	    $content->Save();
	 // }  


	}
// End aftersubmit	
if(!isset($array['uid'])){
  switch($form->AfterSubmitDo){
    case 1://text
      $content=$form->AfterSubmitText;
      $content=MyFormPro_SubmitReplace($form,$info,$content);
      $array['msg']=$content;
    break;

    case 2:// page
      $array['msg']='提交成功！';
      $page=new Post;
      $page->LoadInfoByID($form->AfterSubmitPage);
      $array['redirect_url']=$page->Url;
    break;

    case 3://redirect
      $array['msg']='提交成功！';
      if($form->AfterSubmitUrlUseGetStr){
      
      $getstr=MyFormPro_SubmitReplace($form,$info,$form->AfterSubmitUrlGetStr);
      
        $array['redirect_url']=$form->AfterSubmitUrl.$getstr;
      }else{
        $array['redirect_url']=$form->AfterSubmitUrl;
      }
    break;
  }
  
  
}else{
  break;
}

MyFormPro_Mail($form,$info);
	


    break;
  
	case "mfp_setinfomark":
  if (!$zbp->CheckRights('root')){
  	break;
  }
	$infoid=$_POST['infoid'];
	$info = new myform_pro_info();
	$info->LoadInfoByID($infoid);
  if($info->Confirm){
    $info->Confirm=false;
    $info->Save();
    $array['uid']='0';
  }else{
    $info->Confirm=true;
    $info->Save();
    $array['uid']='1';
  }
	
  break;
  
	case "mfp_changefield":
  if (!$zbp->CheckRights('root')){
  	break;
  }
  $id=(int)GetVars('ID', 'POST');
	$field = new myform_pro_fields();
	$field->LoadInfoByID($id);
	foreach ($zbp->datainfo['myform_pro_fields'] as $key => $value) {
		if (isset($_POST[$key])) {
			$field->$key = GetVars($key, 'POST');
		}
	}
$field->Save();

	
  break;


	case "mfp_infodel":
  if (!$zbp->CheckRights('root')){
  	break;
  }
	$infoid=$_POST['infoid'];
	$info = new myform_pro_info();
	$info->LoadInfoByID($infoid);
  $info->Del();
  $array['uid']='0';

	
  break;

	case "mfp_fielddel":
  if (!$zbp->CheckRights('root')){
  	break;
  }
	$id=$_POST['fieldid'];
	$field = new myform_pro_fields();
	$field->LoadInfoByID($id);
  $field->Del();

	
  break;
  
	case "mfp_savemail":
  if (!$zbp->CheckRights('root')){
  	break;
  }
		$zbp->Config('MyFormPro')->MAIL_SMTP = $_POST['MAIL_SMTP'];
		$zbp->Config('MyFormPro')->MAIL_PORT = $_POST['MAIL_PORT'];
		$zbp->Config('MyFormPro')->MAIL_SENDEMAIL = $_POST['MAIL_SENDEMAIL'];
		$zbp->Config('MyFormPro')->MAIL_PASSWORD = $_POST['MAIL_PASSWORD'];
		$zbp->Config('MyFormPro')->MAIL_TOEMAIL = $_POST['MAIL_TOEMAIL'];
		$zbp->Config('MyFormPro')->MAIL_SENDTYPE = $_POST['MAIL_SENDTYPE'];
	
		$zbp->SaveConfig('MyFormPro');
  break;
  
	case "mfp_hidfieldsave":
  if (!$zbp->CheckRights('root')){
  	break;
  }
  $fid = (int)GetVars('fid', 'POST');
	$form = new myform_pro_form();
	$form->LoadInfoByID($fid);
	
  if(isset($_POST['hidfields'])){
  $strhidfields=implode('|',$_POST['hidfields']);
	$form->BackList=$strhidfields;
	}else{
	$form->BackList='';
	}
	$form->Save();
//		echo $strhidfields;
	
  break;
	case "mfp_uninstall":
  if (!$zbp->CheckRights('root')){
  	break;
  }
    MyFormPro_DelTable();
    $zbp->DelConfig('MyFormPro');
		UninstallPlugin('MyFormPro');
		DisablePlugin('MyFormPro');
    $array['uid']='0';

	
  break;
  default:
  #code...
    break;
    }
if($array){
	echo json_encode($array);
}
}

