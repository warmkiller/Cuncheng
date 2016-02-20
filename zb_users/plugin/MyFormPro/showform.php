<?php
/*
* 显示表单主函数
* int $type 表单类型 0、默认 不加载css  ,ajax post+alert ，1、加载table.css ajax post+alert  2、加载bootstrap.css  ajax post+append
* 0、1用于文章内发布。2、用于独立发布。防止css 干扰
* add 3、不加boottstrap 但是append
* int $fid  表单ID 
*/
function MyFormPro_ShowForm($fid,$type){
  global $zbp;
	$form = new myform_pro_form();
	$form->LoadInfoByID($fid);
  $str='';
  $formdisable='';
  $strdisable=' disabled="disabled"';
//1 NeedLogin
if($form->NeedLogin&&$zbp->user->ID==0){
$str.= $form->NeedLogin_Hint;
$formdisable=$strdisable;
}
//2 ScheduleTime
$now=time();
if($form->Schedule&&($now<$form->Schedule_StartTime||$now>$form->Schedule_EndTime)){
$str.= $form->Schedule_End_Hint;
$formdisable=$strdisable;
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
    $str.= $form->Limit_Out_Hint;
    $formdisable=$strdisable;
  }
}
	
  switch($type){
//////////////////////////////////////////////////////////////////////////////////////////////////////////////  
    case 0:
    $str.='<div id="mfpdiv" class="mfpcls">
    <script src="'.$zbp->host.'zb_users/plugin/MyFormPro/script/js_add.php" type="text/javascript"></script>
    <link href="'.$zbp->host.'zb_users/plugin/MyFormPro/css/checkbox.css" rel="stylesheet" type="text/css" />

        <script src="'.$zbp->host.'zb_users/plugin/MyFormPro/script/functions.js"></script>';
          $where = array(
                        array('=','Form_ID',$fid),
                        array('=','fileds_Show',true)
                        );
        $order = array('fileds_Order'=>'ASC','fileds_ID'=>'ASC');
            $sql= $zbp->db->sql->Select($zbp->table['myform_pro_fields'],'*',$where,$order,null,null);
            $array=$zbp->GetListCustom($zbp->table['myform_pro_fields'],$GLOBALS['datainfo']['myform_pro_fields'],$sql);
            $i =1;
            $str .= '<form action="#mfp-post" method="POST" id="mfp-form">
                  <input'.$formdisable.'  type="hidden" class="form-control" name="mfp_formid" value="'.$form->ID.'">

            ';
            $str .='<table width="100%" class="tableBorder"><tbody>';
            foreach ($array as $key => $fields) {
              $sign_required='';
              if ($fields->Check){
              $sign_required='(*)';
              }
                $str .='<tr class="color2">
                <td align="left" class="td25"><b>'.$fields->Desc.$sign_required.'</b></td>';
                switch ($fields->ShowType) {
                    case '1':
                    $str .='<td><input'.$formdisable.'  type="text" value="" name="mfp_'.$fields->ID.'" class="txt txt-sho"> </td>';         
                    break;
                    case '2':
                    $str .='<td><textarea'.$formdisable.'  class="txt txt-lar" name="mfp_'.$fields->ID.'"></textarea></td>';         
                    break;		
                    case '3':
                    $str .='<td>';
                    $ar=explode('|',$fields->Content);
                        foreach ($ar as $r) {
                          $str .='<label><input'.$formdisable.'  name="mfp_'.$fields->ID.'" value="'.htmlspecialchars($r).'" type="radio"/>'.$r.'</label> ';
                        }
                    $str .='</td>';         
                    break;
                    case '4':
                    $str .='<td>';
                    $ar=explode('|',$fields->Content);
                   // if(!is_array($object->Metas->$value))$object->Metas->$value=array();
                        foreach ($ar as $r) {
                          $str .='<label><input'.$formdisable.'  name="mfp_'.$fields->ID.'[]" value="'.htmlspecialchars($r).'" type="checkbox"/>'.$r.'</label>';
                        }
                    $str .='</td>';         
                    break;		
                    case '5':
                    $str .='<td><input'.$formdisable.'  type="text"  name="mfp_'.$fields->ID.'" value="0" style="width:89%;" class="checkbox"/> </td>';         
                    break;		
                    case '6':
                    $str .='<td><input'.$formdisable.'  id="valueimg" name="mfp_'.$fields->ID.'" type="hidden"/>'.MyFormPro_Upload_Load().'</td>';         
                    break;
                    case '7':
                    $ar=explode('|',$fields->Content);
                    $str .= '<td><select name="mfp_'.$fields->ID.'">';
                        foreach($ar as $r) {
                          $str .= '<option'.$formdisable.'  value="'.htmlspecialchars($r).'">'.$r.'</option>';
                        }
                    $str .= '</select>';
                        
                    $str .='</td>';         
                    break;
                    case '8':
                    $str .='<td><textarea'.$formdisable.'  id="mfp_richtext" class="txt txt-lar" name="mfp_'.$fields->ID.'"></textarea></td>';         
                    break;	
                }
                
                
              $str .='</tr>';
              
              }
if($form->Validatecode&&!$zbp->Config('MyFormPro')->Use_simplecode){
    $str .='<tr class="color3">
            <td>验证码 (*)</td>
            <td><img id="mfpcode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=MyFormPro" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=MyFormPro&amp;tm=\'+Math.random();"/>
                <input'.$formdisable.'  type="text" class="form-control"  name="verifycode" placeholder="验证码"></td>
          </tr>';   
}elseif($form->Validatecode&&$zbp->Config('MyFormPro')->Use_simplecode){
    $str .='<tr class="color3">
            <td>验证码 (*)</td>
            <td><img id="mfpcode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->host . 'zb_users/plugin/MyFormPro/plugin/simplecode/mfp_validcode.php?id=MyFormPro" alt="" title="" onclick="javascript:this.src=\'' . $zbp->host . 'zb_users/plugin/MyFormPro/plugin/simplecode/mfp_validcode.php?id=MyFormPro&amp;tm=\'+Math.random();"/>
                <input'.$formdisable.'  type="text" class="form-control"  name="verifycode" placeholder="验证码"></td>
          </tr>';   
}
            
            $str.='			<tr class="color3">
            <td>&nbsp;</td>
            <td>              <button'.$formdisable.'  id="mfp_submitbtn" type="button" onclick="mfp_submit_alert()" >'.$form->SubmitButtonText.'</button>
</td>
          </tr>';

        $str.='	</tbody></table>
      </form>
      </div>';
    break;
//////////////////////////////////////////////////////////////////////////////////////////////////////////////    
    case 1:
    $str.='<div id="mfpdiv" class="mfpcls">';
    $str.='<link href="'.$zbp->host.'zb_users/plugin/MyFormPro/css/table.css" rel="stylesheet" type="text/css" />
        <script src="'.$zbp->host.'zb_users/plugin/MyFormPro/script/js_add.php" type="text/javascript"></script>

    ';
    $str.='<script src="'.$zbp->host.'zb_users/plugin/MyFormPro/script/functions.js"></script>';
      $where = array(
                    array('=','Form_ID',$fid),
                    array('=','fileds_Show',true)
                    );
        $order = array('fileds_Order'=>'ASC','fileds_ID'=>'ASC');
        $sql= $zbp->db->sql->Select($zbp->table['myform_pro_fields'],'*',$where,$order,null,null);
        $array=$zbp->GetListCustom($zbp->table['myform_pro_fields'],$GLOBALS['datainfo']['myform_pro_fields'],$sql);
        $i =1;
        $str .= '<form action="#mfp-post" method="POST" id="mfp-form">
              <input'.$formdisable.'  type="hidden" class="form-control" name="mfp_formid" value="'.$form->ID.'">

        ';
        $str .='<table width="100%" class="tableBorder"><tbody>';
        foreach ($array as $key => $fields) {
              $sign_required='';
              if ($fields->Check){
              $sign_required='(*)';
              }
            $str .='<tr class="color2">
            <td align="left" class="td25"><b>'.$fields->Desc.$sign_required.'</b></td>';
            switch ($fields->ShowType) {
                case '1':
                $str .='<td><input'.$formdisable.'  type="text" value="" name="mfp_'.$fields->ID.'" class="txt txt-sho"> </td>';         
                break;
                case '2':
                $str .='<td><textarea'.$formdisable.'  class="txt txt-lar" name="mfp_'.$fields->ID.'"></textarea></td>';         
                break;		
                case '3':
                $str .='<td>';
                $ar=explode('|',$fields->Content);
                    foreach ($ar as $r) {
                      $str .='<label><input'.$formdisable.'  name="mfp_'.$fields->ID.'" value="'.htmlspecialchars($r).'" type="radio"/>'.$r.'</label> ';
                    }
                $str .='</td>';         
                break;
                case '4':
                $str .='<td>';
                $ar=explode('|',$fields->Content);
               // if(!is_array($object->Metas->$value))$object->Metas->$value=array();
                    foreach ($ar as $r) {
                      $str .='<label><input'.$formdisable.'  name="mfp_'.$fields->ID.'[]" value="'.htmlspecialchars($r).'" type="checkbox"/>'.$r.'</label>';
                    }
                $str .='</td>';         
                break;		
                case '5':
                $str .='<td><input'.$formdisable.'  type="text"  name="mfp_'.$fields->ID.'" value="0" style="width:89%;" class="checkbox"/> </td>';         
                break;		
                case '6':
                $str .='<td><input'.$formdisable.'  id="valueimg" name="mfp_'.$fields->ID.'" type="hidden"/>'.MyFormPro_Upload_Load().'</td>';         
                break;
                case '7':
                $ar=explode('|',$fields->Content);
                $str .= '<td><select name="mfp_'.$fields->ID.'">';
                    foreach($ar as $r) {
                      $str .= '<option'.$formdisable.'  value="'.htmlspecialchars($r).'">'.$r.'</option>';
                    }
                $str .= '</select>';
                    
                $str .='</td>';         
                break;
                case '8':
                $str .='<td><textarea'.$formdisable.'  id="mfp_richtext" class="txt txt-lar" name="mfp_'.$fields->ID.'"></textarea></td>';         
                break;	
            }
            
            
          $str .='</tr>';
          
          }
          
if($form->Validatecode&&!$zbp->Config('MyFormPro')->Use_simplecode){
    $str .='<tr class="color3">
            <td>验证码 (*)</td>
            <td><img id="mfpcode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=MyFormPro" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=MyFormPro&amp;tm=\'+Math.random();"/>
                <input'.$formdisable.'  type="text" class="form-control"  name="verifycode" placeholder="验证码"></td>
          </tr>';   
}elseif($form->Validatecode&&$zbp->Config('MyFormPro')->Use_simplecode){
    $str .='<tr class="color3">
            <td>验证码 (*)</td>
            <td><img id="mfpcode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->host . 'zb_users/plugin/MyFormPro/plugin/simplecode/mfp_validcode.php?id=MyFormPro" alt="" title="" onclick="javascript:this.src=\'' . $zbp->host . 'zb_users/plugin/MyFormPro/plugin/simplecode/mfp_validcode.php?id=MyFormPro&amp;tm=\'+Math.random();"/>
                <input'.$formdisable.'  type="text" class="form-control"  name="verifycode" placeholder="验证码"></td>
          </tr>';   
}
        
        $str.='			<tr class="color3">
				<td>&nbsp;</td>
				<td>
              <button'.$formdisable.'  id="mfp_submitbtn" type="button" onclick="mfp_submit_alert()" >'.$form->SubmitButtonText.'</button>
				
				</td>
			</tr>';

    $str.='	</tbody></table>
	</form>
	</div>';
    break;

//////////////////////////////////////////////////////////////////////////////////////////////////////////////  
    case 2:
    $str.='<div id="mfpdiv" class="mfpcls">
    <script src="'.$zbp->host.'zb_users/plugin/MyFormPro/script/js_add.php" type="text/javascript"></script>
    <link href="'.$zbp->host.'zb_users/plugin/MyFormPro/css/checkbox.css" rel="stylesheet" type="text/css" />

        <script src="'.$zbp->host.'zb_users/plugin/MyFormPro/script/functions.js"></script>';
          $where = array(
                        array('=','Form_ID',$fid),
                        array('=','fileds_Show',true)
                        );
            $order = array('fileds_Order'=>'ASC','fileds_ID'=>'ASC');
            $sql= $zbp->db->sql->Select($zbp->table['myform_pro_fields'],'*',$where,$order,null,null);
            $array=$zbp->GetListCustom($zbp->table['myform_pro_fields'],$GLOBALS['datainfo']['myform_pro_fields'],$sql);
            $i =1;
            $str .= '<form action="#mfp-post" method="POST" id="mfp-form">
                  <input'.$formdisable.'  type="hidden" class="form-control" name="mfp_formid" value="'.$form->ID.'">

            ';
            $str .='<table width="100%" class="tableBorder"><tbody>';
            foreach ($array as $key => $fields) {
              $sign_required='';
              if ($fields->Check){
              $sign_required='(*)';
              }
                $str .='<tr class="color2">
                <td align="left" class="td25"><b>'.$fields->Desc.$sign_required.'</b></td>';
                switch ($fields->ShowType) {
                    case '1':
                    $str .='<td><input'.$formdisable.'  type="text" value="" name="mfp_'.$fields->ID.'" class="txt txt-sho"> </td>';         
                    break;
                    case '2':
                    $str .='<td><textarea'.$formdisable.'  class="txt txt-lar" name="mfp_'.$fields->ID.'"></textarea></td>';         
                    break;		
                    case '3':
                    $str .='<td>';
                    $ar=explode('|',$fields->Content);
                        foreach ($ar as $r) {
                          $str .='<label><input'.$formdisable.'  name="mfp_'.$fields->ID.'" value="'.htmlspecialchars($r).'" type="radio"/>'.$r.'</label> ';
                        }
                    $str .='</td>';         
                    break;
                    case '4':
                    $str .='<td>';
                    $ar=explode('|',$fields->Content);
                   // if(!is_array($object->Metas->$value))$object->Metas->$value=array();
                        foreach ($ar as $r) {
                          $str .='<label><input'.$formdisable.'  name="mfp_'.$fields->ID.'[]" value="'.htmlspecialchars($r).'" type="checkbox"/>'.$r.'</label>';
                        }
                    $str .='</td>';         
                    break;		
                    case '5':
                    $str .='<td><input'.$formdisable.'  type="text"  name="mfp_'.$fields->ID.'" value="0" style="width:89%;" class="checkbox"/> </td>';         
                    break;		
                    case '6':
                    $str .='<td><input'.$formdisable.'  id="valueimg" name="mfp_'.$fields->ID.'" type="hidden"/>'.MyFormPro_Upload_Load().'</td>';         
                    break;
                    case '7':
                    $ar=explode('|',$fields->Content);
                    $str .= '<td><select name="mfp_'.$fields->ID.'">';
                        foreach($ar as $r) {
                          $str .= '<option'.$formdisable.'  value="'.htmlspecialchars($r).'">'.$r.'</option>';
                        }
                    $str .= '</select>';
                        
                    $str .='</td>';         
                    break;
                    case '8':
                    $str .='<td><textarea'.$formdisable.'  id="mfp_richtext" class="txt txt-lar" name="mfp_'.$fields->ID.'"></textarea></td>';         
                    break;	
                    }
                
                
              $str .='</tr>';
              
              }
            
if($form->Validatecode&&!$zbp->Config('MyFormPro')->Use_simplecode){
    $str .='<tr class="color3">
            <td>验证码 (*)</td>
            <td><img id="mfpcode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=MyFormPro" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=MyFormPro&amp;tm=\'+Math.random();"/>
                <input'.$formdisable.'  type="text" class="form-control"  name="verifycode" placeholder="验证码"></td>
          </tr>';   
}elseif($form->Validatecode&&$zbp->Config('MyFormPro')->Use_simplecode){
    $str .='<tr class="color3">
            <td>验证码 (*)</td>
            <td><img id="mfpcode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->host . 'zb_users/plugin/MyFormPro/plugin/simplecode/mfp_validcode.php?id=MyFormPro" alt="" title="" onclick="javascript:this.src=\'' . $zbp->host . 'zb_users/plugin/MyFormPro/plugin/simplecode/mfp_validcode.php?id=MyFormPro&amp;tm=\'+Math.random();"/>
                <input'.$formdisable.'  type="text" class="form-control"  name="verifycode" placeholder="验证码"></td>
          </tr>';   
}

            $str.='			<tr class="color3">
            <td>&nbsp;</td>
            <td><button'.$formdisable.'  id="mfp_submitbtn" type="button"  onclick="mfp_submit()" >'.$form->SubmitButtonText.'</button>
</td>
          </tr>';

        $str.='	</tbody></table>
      </form>
      </div>';
    break;
//////////////////////////////////////////////////////////////////////////////////////////////////////////////    
    case 3:
    $str.='
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-CN" lang="zh-CN">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
  <link href="'.$zbp->host.'zb_users/plugin/MyFormPro/plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="'.$zbp->host.'zb_users/plugin/MyFormPro/plugin/bootstrap/switch/css/bootstrap-switch.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
    <script src="'.$zbp->host.'zb_users/plugin/MyFormPro/plugin/bootstrap/js/bootstrap.min.js"></script>
    <script src="'.$zbp->host.'zb_users/plugin/MyFormPro/script/js_add.php"></script>
    <script src="'.$zbp->host.'zb_users/plugin/MyFormPro/script/functions.js"></script>
<title>'.$form->Name.'-'.$zbp->name.'</title>
</head>
<body>
<div id="mfpdiv" class="mfpcls">
<div class="container">';
      $where = array(
                    array('=','Form_ID',$fid),
                    array('=','fileds_Show',true)
                    );
        $order = array('fileds_Order'=>'ASC','fileds_ID'=>'ASC');
        $sql= $zbp->db->sql->Select($zbp->table['myform_pro_fields'],'*',$where,$order,null,null);
        $array=$zbp->GetListCustom($zbp->table['myform_pro_fields'],$GLOBALS['datainfo']['myform_pro_fields'],$sql);
        $i =1;
        $str .= '<form class="form-horizontal" role="form" action="#mfp-post" method="POST" id="mfp-form">
    <fieldset>
    
    
      <div id="legend" class="">
        <legend class="">'.$form->Name.'</legend>
      </div>
      
<div class="form-group">
              <div class="col-sm-12">
                '.$form->Desc.'
                
              </div>
             </div>
      <input'.$formdisable.'  type="hidden" class="form-control" name="mfp_formid" value="'.$form->ID.'">

      ';
        foreach ($array as $key => $fields) {
        $class_required='';
        $sign_required='';
        if ($fields->Check){
        $class_required=' required';
        $sign_required='(*)';
        }

		########################################################################################################
    switch ($fields->ShowType) {
		case '1':
    $str .='<div class="form-group">
              <label for="mfp_'.$fields->ID.'" class="col-sm-2 control-label">'.$fields->Desc.$sign_required.'</label>
              <div class="col-sm-10">
                <input'.$formdisable.'  type="text" class="form-control'.$class_required.'" data-mfp-requiredtype="'.$fields->Type.'" name="mfp_'.$fields->ID.'" placeholder="'.$fields->Desc.'">
                
              </div>
             </div>';         
		break;
		case '2':
    $str .='<div class="form-group">
              <label for="mfp_'.$fields->ID.'" class="col-sm-2 control-label">'.$fields->Desc.$sign_required.'</label>
              <div class="col-sm-10">
                 <textarea'.$formdisable.'  class="form-control'.$class_required.'" data-mfp-requiredtype="'.$fields->Type.'" rows="3" name="mfp_'.$fields->ID.'">'.$fields->Desc.'</textarea>
              </div>
             </div>';         
		break;		
		case '3':
    $str .='<div class="form-group">
              <label for="mfp_'.$fields->ID.'" class="col-sm-2 control-label">'.$fields->Desc.$sign_required.'</label>
              <div class="col-sm-10">';
		$ar=explode('|',$fields->Content);
   // if(!is_array($object->Metas->$value))$object->Metas->$value=array();
				foreach ($ar as $r) {
					$str .='
                <div class="radio"><label>
              <input'.$formdisable.'  class="'.$class_required.'" data-mfp-requiredtype="'.$fields->Type.'" value="'.htmlspecialchars($r).'" type="radio"   name="mfp_'.$fields->ID.'" > '.$r.'
            </label>   </div> ';
				}                
                  
     $str .=' 
            </div>
             </div>';      
		break;
    case '4':
    $str .='<div class="form-group">
              <label for="mfp_'.$fields->ID.'" class="col-sm-2 control-label">'.$fields->Desc.$sign_required.'</label>
              <div class="col-sm-10">';
		$ar=explode('|',$fields->Content);
   // if(!is_array($object->Metas->$value))$object->Metas->$value=array();
				foreach ($ar as $r) {
					$str .='
                <div class="checkbox"><label>
              <input'.$formdisable.'   class="'.$class_required.'" data-mfp-requiredtype="'.$fields->Type.'"  value="'.htmlspecialchars($r).'" data-switch-no-init type="checkbox"  name="mfp_'.$fields->ID.'[]" > '.$r.'
            </label>   </div> ';
				}                
                  
     $str .=' 
            </div>
             </div>';          
		break;		
		case '5':
    $str .='<div class="form-group">
              <label for="mfp_'.$fields->ID.'"  class="col-sm-2 control-label">'.$fields->Desc.$sign_required.'</label>
                <div class="col-sm-10">
                  <div class="switch" tabindex="0">
                  <input'.$formdisable.'  class="form-control'.$class_required.'" data-mfp-requiredtype="'.$fields->Type.'"   name="mfp_'.$fields->ID.'"  type="checkbox" data-size="mini">
            </div>
                </div>
              </div>';   		
  //  $str .='<td><input'.$formdisable.'  type="text"  name="mfp_'.$fields->ID.'" value="0" style="width:89%;" class="checkbox"/> </td>';         
		break;		
		case '6':
    $str .='<div class="form-group">
              <label for="mfp_'.$fields->ID.'"  class="col-sm-2 control-label">'.$fields->Desc.$sign_required.'</label>
                <div class="col-sm-10">
                  <input'.$formdisable.'  id="valueimg" class="'.$class_required.'" data-mfp-requiredtype="'.$fields->Type.'"  type="hidden" name="mfp_'.$fields->ID.'">'.MyFormPro_Upload_Load(true).'
                </div>
              </div>';         
		break;
		case '7':
		$ar=explode('|',$fields->Content);
    $str .='<div class="form-group">
              <label for="mfp_'.$fields->ID.'" class="col-sm-2 control-label">'.$fields->Desc.$sign_required.'</label>
              <div class="col-sm-10">
              <select class="form-control'.$class_required.'" data-mfp-requiredtype="'.$fields->Type.'" name="mfp_'.$fields->ID.'">';
		$ar=explode('|',$fields->Content);
   // if(!is_array($object->Metas->$value))$object->Metas->$value=array();
   

   
				foreach ($ar as $r) {
					$str .='<option'.$formdisable.'  value="'.htmlspecialchars($r).'">'.$r.'</option>';
				}                
                  
     $str .=' </select>
            </div>
             </div>';     
		break;
		case '8':
    $str .='<div class="form-group">
              <label for="mfp_'.$fields->ID.'" class="col-sm-2 control-label">'.$fields->Desc.$sign_required.'</label>
              <div class="col-sm-10">
                 <textarea'.$formdisable.'  id="mfp_richtext" class="form-control'.$class_required.'" data-mfp-requiredtype="'.$fields->Type.'" rows="3" name="mfp_'.$fields->ID.'">'.$fields->Desc.'</textarea>
              </div>
             </div>';         
		break;		
    }########################################################################################################
            
            
          
          }
if($form->Validatecode&&!$zbp->Config('MyFormPro')->Use_simplecode){
    $str .='<div class="form-group">
              <label for="verifycode" class="col-sm-2 control-label">验证码 (*)</label>
              <div class="col-sm-10">
              <img id="mfpcode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->validcodeurl . '?id=MyFormPro" alt="" title="" onclick="javascript:this.src=\'' . $zbp->validcodeurl . '?id=MyFormPro&amp;tm=\'+Math.random();"/>
                <input'.$formdisable.'  type="text" class="form-control"  name="verifycode" placeholder="验证码">
                
              </div>
             </div>';   
}elseif($form->Validatecode&&$zbp->Config('MyFormPro')->Use_simplecode){
    $str .='<div class="form-group">
              <label for="verifycode" class="col-sm-2 control-label">验证码 (*)</label>
              <div class="col-sm-10">
              <img id="mfpcode" style="border:none;vertical-align:middle;width:'.$zbp->option['ZC_VERIFYCODE_WIDTH']. 'px;height:' . $zbp->option['ZC_VERIFYCODE_HEIGHT'] . 'px;cursor:pointer;" src="' .$zbp->host . 'zb_users/plugin/MyFormPro/plugin/simplecode/mfp_validcode.php?id=MyFormPro" alt="" title="" onclick="javascript:this.src=\'' . $zbp->host . 'zb_users/plugin/MyFormPro/plugin/simplecode/mfp_validcode.php?id=MyFormPro&amp;tm=\'+Math.random();"/>
                <input'.$formdisable.'  type="text" class="form-control"  name="verifycode" placeholder="验证码">
                
              </div>
             </div>';   
}


        
        $str.='<div class="form-group">
        <label class="col-sm-2 control-label"></label>
              <div class="col-sm-10">
              <button'.$formdisable.'  id="mfp_submitbtn" type="button" class="btn btn-primary"  onclick="mfp_submit()" >'.$form->SubmitButtonText.'</button>
              </div>
        </div>

    </fieldset>
  </form>
</div>
</div>

    <script src="'.$zbp->host.'zb_users/plugin/MyFormPro/plugin/bootstrap/switch/js/bootstrap-switch.min.js"></script>

</body>
</html>';


    break;
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

    default:
    break;
  }
  
  return $str;
}




