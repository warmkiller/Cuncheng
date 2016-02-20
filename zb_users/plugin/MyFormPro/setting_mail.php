<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('MyFormPro')) {$zbp->ShowError(48);die();}
$blogtitle='MyFormPro - 邮件设置';

	if(count($_POST)>0){
		$zbp->Config('MyFormPro')->MAIL_SMTP = $_POST['MAIL_SMTP'];
		$zbp->Config('MyFormPro')->MAIL_PORT = $_POST['MAIL_PORT'];
		$zbp->Config('MyFormPro')->MAIL_SENDEMAIL = $_POST['MAIL_SENDEMAIL'];
		$zbp->Config('MyFormPro')->MAIL_PASSWORD = $_POST['MAIL_PASSWORD'];
		$zbp->Config('MyFormPro')->MAIL_TOEMAIL = $_POST['MAIL_TOEMAIL'];
		$zbp->Config('MyFormPro')->MAIL_SENDTYPE = $_POST['MAIL_SENDTYPE'];
	
		$zbp->SaveConfig('MyFormPro');
		$zbp->SetHint('good','配置已保存，请勿忘记测试发送邮件');
		Redirect('./setting_mail.php');
	}

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
  <div class="SubMenu"><?php MyFormPro_SubMenu()?>
  </div>
  <div id="divMain2">
	<!--代码-->

	<form  name="form1" id="mfp_savemail" method="post"> 
		<table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
			<tr>
				<th width="15%"><p align="center">配置名称</p></th>
				<th width="50%"><p align="center">配置内容</p></th>
				<th width="35%"><p align="center">测试发送</p></th>
			</tr>
			<tr>
				<td><div align="center">SMTP服务器</div></td>
				<td><input name="MAIL_SMTP" type="text" id="MAIL_SMTP" value="<?php echo $zbp->Config('MyFormPro')->MAIL_SMTP;?>"/>如:smtp.163.com</td>
				<td><span>测试发送:<font color="red">（请先在左边设置好相关信息<b>保存</b>后测试）</font></span></td>
			</tr>
			<tr>
				<td><div align="center">SMTP端口</div></td>
				<td><input name="MAIL_PORT" type="text" id="MAIL_PORT" value="<?php echo $zbp->Config('MyFormPro')->MAIL_PORT;?>"/>一般默认为:25</td>
				<td><input id="testsend" type="button" value="发送一封测试邮件" /></td>
			</tr>
			<tr>
				<td><div align="center">发信邮箱</div></td>
				<td><input name="MAIL_SENDEMAIL" type="text" id="MAIL_SENDEMAIL" value="<?php echo $zbp->Config('MyFormPro')->MAIL_SENDEMAIL;?>"/></td>
				<td><span>测试结果:</span></td>
			</tr>
			<tr>
				<td><div align="center">发信密码</div></td>
				<td><input type="password" name="MAIL_PASSWORD" value="<?php echo $zbp->Config('MyFormPro')->MAIL_PASSWORD;?>"/></td>
				<td rowspan="3"><div id="testresult" style="height:64px; padding:10px; border:1px dashed #ccc; overflow:auto;background-color:#bbd9e2;"></div></td>
			</tr>
			<tr>
				<td><div align="center">收信邮箱</div></td>
				<td><input name="MAIL_TOEMAIL" type="text" id="MAIL_TOEMAIL" value="<?php echo $zbp->Config('MyFormPro')->MAIL_TOEMAIL;?>"/></td>
			</tr>
			<tr>
				<td><div align="center">发送方式</div></td>
				<td><label>
				<input type="radio" name="MAIL_SENDTYPE" value="0" <?php if($zbp->Config('MyFormPro')->MAIL_SENDTYPE == '0') echo 'checked'; ?> />Mail方式</label> 
				<label>
				<input type="radio" name="MAIL_SENDTYPE" value="1" <?php if($zbp->Config('MyFormPro')->MAIL_SENDTYPE == '1') echo 'checked'; ?> />SMTP方式</label></td>
			</tr>
			<tr>
				<td colspan="3">
					<div style="padding:5px; height:26px; border:1px dashed #CCC">
						<font color="green"><b>温馨提示：</b></font>发送方式设置为SMTP方式时,发信邮箱必须支持smtp并且开启smtp服务才能发送成功。
					</div>
				</td>
			</tr>
			<tr>
				<td><div align="center">配置保存</div></td>
				<td colspan="2"><input type="button" id="savemail" class="button" value="<?php echo $lang['msg']['submit']?>" />
</td>
			</tr>
		</table>
	</form>
  </div>
</div>

<script type="text/javascript">
    jQuery(function($) {
    
          $('#savemail').click(function() {
          $('#savemail').val('保存中......');
           $.post(ajaxurl + "mfp_savemail",
              $("#mfp_savemail").serialize(),
              function(data){
                  $('#savemail').val('提 交');

              }, "json");
            return false;
        });
        
      $('#testsend').click(function() {
            $('#testresult').html('邮件发送中..');
            $.get(bloghost + 'zb_users/plugin/MyFormPro/plugin/sendmail/MyFormPro_test_do.php', {
                sid: Math.random()
            },
            function(result) {
                if ($.trim(result) != '') {
                    $('#testresult').html(result);
                } else {
                    $('#testresult').html('发送失败！');
                }
            });
        });
        
        
    });
    //setTimeout(hideActived, 2600);
</script>


<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/MyFormPro/logo.png';?>");</script>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>