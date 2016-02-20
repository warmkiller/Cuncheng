<?php


/**
 *  验证字符串是否符合正则表达式
 * @param string $source 字符串
 * @param string $para 正则表达式，可用[username]|[password]|[email]|[homepage]或自定义表达式
 * @return bool 
*/
function MyFormPro_Check($source, $para) {
	if (strpos($para, '[username]') !== false) {
		$para = "/^[\.\_A-Za-z0-9·\x{4e00}-\x{9fa5}]+$/u";
	}
	elseif (strpos($para, '[password]') !== false) {
		$para = "/^[A-Za-z0-9`~!@#\$%\^&\*\-_]+$/u";
	}
	elseif (strpos($para, '[email]') !== false) {
		$para = "/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*\.)+[a-zA-Z]*)$/u";
	}
	elseif (strpos($para, '[homepage]') !== false) {
		$para = "/^[a-zA-Z]+:\/\/[a-zA-Z0-9\_\-\.\&\?\/:=#\x{4e00}-\x{9fa5}]+$/u";
	}
	elseif (!$para)
		return false;

	return (bool)preg_match($para, $source);
}

/**
* 
*/
function MyFormPro_Submit_PregReplace($matches) { //callback
	global $zbp,$myformpro_global_infoid;
/*	$contentid=$matches[1];
	$content=new myform_pro_contents;
	$content->LoadInfoByID($contentid);
  return $content->Content;
  */
  	$feildid=$matches[1];
	$where=array(
          array('=','Field_ID',$matches[1]),
          array('=','Info_ID',$myformpro_global_infoid),
          );
    $sql = $zbp->db->sql->Select($zbp->table['myform_pro_contents'],array('*'),$where,null,null,null);
    $data=$zbp->GetListType('myform_pro_contents',$sql);
	return $data[0]->Content;
  
}
$myformpro_global_infoid=0;//声明一个全局变量储存infoid
function MyFormPro_SubmitReplace($form,$info,$content){
    global $zbp,$myformpro_global_infoid;
    $myformpro_global_infoid=$info->ID;
    $arraytpl=array(
                  '[form_title]'=>$form->Name,
                  '[zbpname]'=>$zbp->name,
                  '[zbphost]'=>$zbp->host,
                  '[ip]'=>$info->IP,
                  '[date_ymd]'=>date('Y-m-d H:i:s',$info->Time),
                  '[form_id]'=>$form->ID,
                  '[user_agent]'=>$info->Agent,
                  );

foreach ($arraytpl as $key=>$value){
  $content=str_replace($key,$value,$content);
}

	$pattern="\[input=(.+?)\](.+?)\[\/input\]";
  $content=preg_replace_callback('/'.$pattern.'/is',"MyFormPro_Submit_PregReplace",$content);
   // var_dump($content);die();

  return $content;

}