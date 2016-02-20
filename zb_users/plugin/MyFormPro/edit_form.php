<?php
require '../../../zb_system/function/c_system_base.php';

require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('MyFormPro')) {$zbp->ShowError(48);die();}

$blogtitle='MyFormPro - 表单编辑';

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

	$id = (int)GetVars('id', 'GET');
	$form = new myform_pro_form();
	$form->LoadInfoByID($id);


if(GetVars('act','GET') == 'listsave') {


	if (isset($_POST['Schedule_StartTime'])) {
		$_POST['Schedule_StartTime'] = strtotime($_POST['Schedule_StartTime']);
	}
	if (isset($_POST['Schedule_EndTime'])) {
		$_POST['Schedule_EndTime'] = strtotime($_POST['Schedule_EndTime']);
	}
	//AfterSubmitUrlUseGetStr
	if (isset($_POST['AfterSubmitUrlUseGetStr'])) {
		$_POST['AfterSubmitUrlUseGetStr'] = true;
	}else{
	$_POST['AfterSubmitUrlUseGetStr'] = false;
	}
	foreach ($zbp->datainfo['myform_pro_form'] as $key => $value) {
		if ($key == 'ID' || $key == 'Meta')	{continue;}
		if (isset($_POST[$key])) {
			$form->$key = GetVars($key, 'POST');
		}
	}
$form->Save();





	$zbp->SetHint('good');
	Redirect('./edit_form.php?id='.$form->ID);

}elseif(GetVars('act','GET') == 'listdel'){
//1、Del form
$form->Del();
               
	$zbp->SetHint('good');
	Redirect('./mng_form.php');
}


?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
  <div class="SubMenu"><?php MyFormPro_SubMenu()?>
  </div>
  <div id="divMain2">
  <style type="text/css">
table {table-layout:fixed;}
td {white-space:nowrap;overflow:hidden;}
optgroup option{padding-left:20px;}
</style> 
<script src="<?php echo $bloghost?>zb_users/plugin/MyFormPro/script/admin_common.js" type="text/javascript"></script>

	<form name="form0" action="edit_form.php?act=listsave&amp;id=<?php echo $form->ID; ?>" method="post">
		<table class="tableBorder" width="100%">
			<tr>
				<td class="td25" align="left"><b>开启验证码 &nbsp;&nbsp;&nbsp;<a title="开启验证码可以有效的减少垃圾信息的骚扰，推荐开启" class="mfptooltip" onclick="return false;" href="#"><img src="<?php echo $zbp->host;?>zb_users/plugin/MyFormPro/images/transmit_blue.png" /></a></b></td>
				<td colspan="4"><input type="text" class="checkbox" name="Validatecode" value="<?php echo $form->Validatecode; ?>" /> </td>
			</tr>
			<tr>
				<td class="td25" align="left"><b>表单名称： &nbsp;&nbsp;&nbsp;<a title="给你的表单起个名字吧！" class="mfptooltip" onclick="return false;" href="#"><img src="<?php echo $zbp->host;?>zb_users/plugin/MyFormPro/images/transmit_blue.png" /></a></b></td>
				<td colspan="4">
				<input style="width:95%" type="text" value="<?php echo $form->Name; ?>" name="Name"   class="txt txt-sho" /></td>
			</tr>
			<tr>
				<td class="td25" align="left"><b>表单描述： &nbsp;&nbsp;&nbsp;<a title="输入表单的描述，用户会参考这些描述" class="mfptooltip" onclick="return false;" href="#"><img src="<?php echo $zbp->host;?>zb_users/plugin/MyFormPro/images/transmit_blue.png" /></a></b></td>
				<td colspan="4"><textarea  style="width: 95%;" class="txt txt-lar" name="Desc"><?php echo $form->Desc; ?></textarea></td>
			</tr>
			<tr>
				<td class="td25" align="left"><b>将此表单加入后台菜单 &nbsp;&nbsp;&nbsp;<a title="将数据查看加入到后台菜单可以快速查看想要的信息" class="mfptooltip" onclick="return false;" href="#"><img src="<?php echo $zbp->host;?>zb_users/plugin/MyFormPro/images/transmit_blue.png" /></a></b></td>
				<td colspan="4">
				        <select name="ShortCut">
                 <?php
                 echo ' <option value="1" '.(($form->ShortCut=="1")?"selected":"").'>不加入</option>
                  <option value="2" '.(($form->ShortCut=="2")?"selected":"").'>左侧菜单</option>
                  <option value="3" '.(($form->ShortCut=="3")?"selected":"").'>顶部菜单</option>';
                 ?>
                 
                  </select>
				 </td>
			</tr>
			<tr>
				<td class="td25" align="left"><b>是否需要登陆&nbsp;&nbsp;&nbsp;<a title="开启此选项后，只有登陆到ZBLOG PHP的用户才能提交这个表单。" class="mfptooltip" onclick="return false;" href="#"><img src="<?php echo $zbp->host;?>zb_users/plugin/MyFormPro/images/transmit_blue.png" /></a></b></td>
				<td><input type="text" class="checkbox" name="NeedLogin" value="<?php echo $form->NeedLogin; ?>" /> </td>
				<td colspan="3"><p>未登录时提示：</p>
        <textarea style="width:95%"  class="txt txt-lar" name="NeedLogin_Hint"><?php echo $form->NeedLogin_Hint; ?></textarea></td>
			</tr>
			<tr>
				<td class="td25" align="left"><b>是否启用表单有效期&nbsp;&nbsp;&nbsp;<a title="开启后，表单指在指定时间段内有效" class="mfptooltip" onclick="return false;" href="#"><img src="<?php echo $zbp->host;?>zb_users/plugin/MyFormPro/images/transmit_blue.png" /></a></b></td>
				<td colspan="2"><input type="text" class="checkbox" name="Schedule" value="<?php echo $form->Schedule; ?>" />
				
				<p>开始于：<input type="text" value="<?php echo $form->Schedule_Start(); ?>" name="Schedule_StartTime" id="Schedule_Start" class="txt txt-sho" /></p>
        <p>结束于：<input type="text" value="<?php echo $form->Schedule_End(); ?>" name="Schedule_EndTime" id="Schedule_End" class="txt txt-sho" /></p></td>
        <td colspan="2"><p>结束时提示：</p>
        <textarea style="width:95%" class="txt txt-lar" name="Schedule_End_Hint"><?php echo $form->Schedule_End_Hint; ?></textarea>
        </td>
			</tr>
			<tr>
				<td class="td25" align="left"><b>是否启用提交数量限制&nbsp;&nbsp;&nbsp;<a title="在下面的输入框中输入一个数字。当提交的数据量达到这个数字后表单将停止使用。" class="mfptooltip" onclick="return false;" href="#"><img src="<?php echo $zbp->host;?>zb_users/plugin/MyFormPro/images/transmit_blue.png" /></a></b></td>
				<td colspan="2"> <input type="text" class="checkbox" name="Use_Limit" value="<?php echo $form->Use_Limit; ?>" /> 
				
        <p>限制额度：<input type="text" value="<?php echo $form->Limit_Num; ?>" name="Limit_Num" class="txt txt-sho" /></p>
        <p>限制周期：
        <select name="Limit_Type">
                 <?php
                 echo ' <option value="1" '.(($form->Limit_Type=="1")?"selected":"").'>总数据</option>
                  <option value="2" '.(($form->Limit_Type=="2")?"selected":"").'>每日</option>
                  <option value="3" '.(($form->Limit_Type=="3")?"selected":"").'>每周</option>
                  <option value="4" '.(($form->Limit_Type=="4")?"selected":"").'>每月</option>
                  <option value="5" '.(($form->Limit_Type=="5")?"selected":"").'>每年</option>
';
                 ?>
                 
                  </select></p></td>
        <td colspan="2"><p>达到限额时提示：</p><textarea style="width:95%" class="txt txt-lar" name="Limit_Out_Hint"><?php echo $form->Limit_Out_Hint; ?></textarea></td>
			</tr>
			<tr>
				<td class="td25" align="left"><b>需要邮件通知&nbsp;&nbsp;&nbsp;<a title="开启后将按照插件内设置的邮件信息，将提交的表单信息发送到指定邮箱" class="mfptooltip" onclick="return false;" href="#"><img src="<?php echo $zbp->host;?>zb_users/plugin/MyFormPro/images/transmit_blue.png" /></a></b></td>
				<td colspan="4"><input type="text" class="checkbox" name="NeedMail" value="<?php echo $form->NeedMail; ?>" /> </td>
			</tr>
			<tr>
				<td class="td25" align="left"><b>邮件模板 (支持html)：</b></td>
				<td colspan="4">
	<div id="tablefieldscontainer" style="margin-bottom: 12px;">
				<p>可以使用在邮件模板中的字段标签，更多字段要在完成表单设计后才会显示</p>
<select id="MailTemplate_variable_select" style="min-width: 200px;" onchange="InsertVariable('MailTemplate', '');"

>

<?php
       echo CreatOptionOfMyFormPro_Template($form);
?>

</select>
</div>				
				
				<textarea  style="width: 95%;height:200px;" class="txt txt-lar" id="MailTemplate" name="MailTemplate"><?php echo $form->MailTemplate; ?></textarea><br />
				<p>模板范例：</p>
				<p style="color:#30849F"><?php 
				echo htmlspecialchars('<p>您好：</p><br />').'<br />';
				echo htmlspecialchars('<p> 您在[zbpname]的表单[form_title]有了新的提交信息：</p><br />').'<br />';
				echo htmlspecialchars('<p>姓名：[input=1]姓名[/input]</p><br />').'<br />';
				echo htmlspecialchars('<p>邮箱：[input=2]邮箱[/input]</p><br />').'<br />';
				echo htmlspecialchars('<p>留言内容：[input=3]留言[/input]</p><br />').'<br />';
				echo htmlspecialchars('<p>请前往：[zbpname]登陆后查看详细信息。</p><br />').'<br />';
				echo htmlspecialchars('<p>[date_ymd]</p>');
				
				?></p>
				</td>
				

			</tr>
			<tr>
				<td class="td25" align="left"><b>表单按钮文字：&nbsp;&nbsp;&nbsp;<a title="表单提交按钮上显示的文字" class="mfptooltip" onclick="return false;" href="#"><img src="<?php echo $zbp->host;?>zb_users/plugin/MyFormPro/images/transmit_blue.png" /></a></b></td>
				<td colspan="4">
				<input style="width:95%" type="text" value="<?php echo $form->SubmitButtonText; ?>" name="SubmitButtonText"   class="txt txt-sho" /></td>
			</tr>			
<tr><td><label>提交完成后的消息类型</label></td>
 <td colspan="4">
<div style="margin:4px 0;">
<input type="radio" onclick="ToggleConfirmation();" value="1" name="AfterSubmitDo" id="form_confirmation_show_message" <?php if($form->AfterSubmitDo==1){echo 'checked="checked"';}?>/>
<label class="inline" for="form_confirmation_show_message">文字 &nbsp;&nbsp;<a title="文字消息-&gt;提交完成后将显示输入的文字。" class="tooltip mfptooltip tooltip_form_confirmation_message" onclick="return false;" href="#"><img src="<?php echo $zbp->host;?>zb_users/plugin/MyFormPro/images/transmit_blue.png" /></a></label>&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" onclick="ToggleConfirmation();" value="2" name="AfterSubmitDo" id="form_confirmation_show_page" <?php if($form->AfterSubmitDo==2){echo 'checked="checked"';}?>
 />
<label class="inline" for="form_confirmation_show_page">页面 &nbsp;&nbsp;<a title="重定向到某页面-&gt;提交完成后将跳转到您制定的站内页面。" class="tooltip mfptooltip tooltip_form_redirect_to_webpage" onclick="return false;" href="#"><img src="<?php echo $zbp->host;?>zb_users/plugin/MyFormPro/images/transmit_blue.png" /></a></label>&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" onclick="ToggleConfirmation();" value="3" name="AfterSubmitDo" id="form_confirmation_redirect" <?php if($form->AfterSubmitDo==3){echo 'checked="checked"';}?>
/>
<label class="inline" for="form_confirmation_redirect">重定向 &nbsp;&nbsp;<a title="重定向到某网址-&gt;提交完成后将跳转到您制定的网址。" class="tooltip mfptooltip tooltip_form_redirect_to_url" onclick="return false;" href="#"><img src="<?php echo $zbp->host;?>zb_users/plugin/MyFormPro/images/transmit_blue.png" /></a></label>

<div style="padding-top: 10px; <?php if($form->AfterSubmitDo!=1){echo 'display: none;';}?>" id="form_confirmation_message_container">
<div  style="margin-bottom: 12px;">
<select class="gform_merge_tags" onchange="InsertVariable('form_confirmation_message', '');" id="form_confirmation_message_variable_select">
  <?php
      echo CreatOptionOfMyFormPro_Template($form);
    ?>
</select>
  </div>
<textarea style="width:400px; height:300px;" name="AfterSubmitText" id="form_confirmation_message"><?php echo $form->AfterSubmitText;?></textarea>
</div>

<div style="margin-top: 5px; <?php if($form->AfterSubmitDo!=2){echo 'display: none;';}?>" id="form_confirmation_page_container">
  <div>
    <select id="form_confirmation_page" name="AfterSubmitPage">
      <option value="">选择页面</option>
      <?php echo CreatOptionOfMyFormPro_Pages($form->AfterSubmitPage);?>
    </select>
  </div>
</div>

  <div style="margin-top: 5px; <?php if($form->AfterSubmitDo!=3){echo 'display: none;';}?>" id="form_confirmation_redirect_container">
    <div>
      <input type="text" style="width:98%;" id="form_confirmation_url" name="AfterSubmitUrl" value="<?php echo $form->AfterSubmitUrl;?>">
    </div>
    <div style="margin-top:15px;">
    <input type="checkbox" onclick="ToggleQueryString()" id="form_redirect_use_querystring" name="AfterSubmitUrlUseGetStr"
    <?php
    if($form->AfterSubmitUrlUseGetStr){echo 'checked="checked"';}
    ?>
    > <label for="form_redirect_use_querystring">通过提交的字段内容设置参数传递到URL <a title="将表单中的字符串传递到网址-&gt;可以将字段中的结果传递到确认页面，可以在下拉框中选择变量建设一个查询字符串。" class="tooltip mfptooltip tooltip_form_redirect_querystring" onclick="return false;" href="#">(?)</a></label>
    <br>
      <div <?php if(!$form->AfterSubmitUrlUseGetStr){echo 'style="display: none;"';}?>id="form_redirect_querystring_container">
          <div style="margin-top:6px;">
            <select class="gform_merge_tags" onchange="InsertVariable('form_redirect_querystring', '');" id="form_redirect_querystring_variable_select">
              <?php
                echo CreatOptionOfMyFormPro_Template($form);
              ?>
            </select>
          </div>
        <textarea style="width:98%; height:100px;" id="form_redirect_querystring" name="AfterSubmitUrlGetStr"><?php echo $form->AfterSubmitUrlGetStr;?></textarea>
        <br />
        <div class="instruction">例子: ?name=[input=1]姓名[/input]&amp;email=[input=2]邮箱[/input]</div>
      </div>
    </div>
  </div>
</div>
</td>
</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="submit" value="保 存" /></td>
			</tr>
		</table>
	</form>
<br />
 
  
<script type="text/javascript">ActiveLeftMenu("aMyFormPro");</script>
<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/MyFormPro/logo.png';?>");
$(".mfptooltip").tooltip();
</script>	
</div>
</div>

<?php

echo "<script type=\"text/javascript\" src=\"".$zbp->host."zb_system/script/jquery-ui-timepicker-addon.js\"></script>
	<script type=\"text/javascript\">
	$.datepicker.regional['zh-cn'] = {
	closeText: '完成',
	prevText: '上个月',
	nextText: '下个月',
	currentText: '现在',
	monthNames: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
	monthNamesShort: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
	dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
	dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],
	dayNamesMin: ['日','一','二','三','四','五','六'],
	weekHeader: '周',
	dateFormat: 'yy-mm-dd',
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: true,
	yearSuffix: ' 年  '
	};
	$.datepicker.setDefaults($.datepicker.regional['zh-cn']);
	$.timepicker.regional['zh-cn'] = {
	timeOnlyTitle: '时间',
	timeText: '时间',
	hourText: '小时',
	minuteText: '分钟',
	secondText: '秒钟',
	millisecText: '毫秒',
	currentText: '现在',
	closeText: '完成',
	timeFormat: 'hh:mm:ss',
	ampm: false
	};
	$.timepicker.setDefaults($.timepicker.regional['zh-cn']);
	$('#Schedule_Start,#Schedule_End').datetimepicker({
	showSecond: true
	//changeMonth: true,
	//changeYear: true
	});
	</script>";




require $blogpath . 'zb_system/admin/admin_footer.php';
function CreatOptionOfMyFormPro_Pages($pageid){
global $zbp;
$w=array();
$s='';
$or=array('log_PostTime'=>'DESC');
$l=null;
$op=null;
  $array=$zbp->GetPageList(
    $s,
    $w,
    $or,
    $l,
    $op
  );
  $str='';
  foreach ($array as $article) {
  if($pageid==$article->ID){
    $str.='<option selected="selected" value="'.$article->ID.'">'.$article->Title.'</option>'."\r\n";
  }else{
    $str.='<option value="'.$article->ID.'">'.$article->Title.'</option>'."\r\n";
  }
  }
return $str;
}
function CreatOptionOfMyFormPro_Template($form){
global $zbp;
        $str = '';
        $where = array(array('=','Form_ID',$form->ID));
        $order = array('fileds_Order'=>'ASC','fileds_ID'=>'ASC');
        $sql= $zbp->db->sql->Select($zbp->table['myform_pro_fields'],'*',$where,$order,null,null);
        $array=$zbp->GetListCustom($zbp->table['myform_pro_fields'],$GLOBALS['datainfo']['myform_pro_fields'],$sql);
        $str.='<option value="">请选择变量</option>
               <optgroup label="表单字段">';
          $str.='	<option value="[form_title]">表单标题</option>	'."\r\n";

        foreach ($array as $key => $fields) {
          $str.='<option value="[input='.$fields->ID.']'.$fields->Desc.'[/input]">'.$fields->Desc.'</option>'."\r\n";
        }
        $str.='</optgroup>';
        $str.='<optgroup label="系统参数">';
          $str.='<option value="[zbpname]">网站名称</option>'."\r\n";
          $str.='<option value="[zbphost]">网站地址</option>'."\r\n";
          $str.='	<option value="[ip]">客户端IP地址</option>	'."\r\n";
          $str.='	<option value="[form_id]">表单ID</option>	'."\r\n";
          $str.='	<option value="[date_ymd]">提交时间</option>	'."\r\n";
          $str.='	<option value="[user_agent]">UserAgent</option>	'."\r\n";
        $str.='</optgroup>';

        return $str;
}

RunTime();
?>