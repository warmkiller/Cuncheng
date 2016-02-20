<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Qzone')) {$zbp->ShowError(48);die();}

if (GetVars('action', 'GET') == 'save') {
	$zbp->Config('Qzone')->UserName = GetVars('UserName', 'POST');
	$zbp->Config('Qzone')->UserPass = GetVars('UserPass', 'POST');
	$zbp->SaveConfig('Qzone');
	$zbp->SetHint('good');
	Redirect('main.php');
	exit;
}

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<div id="divMain">
  <div class="divHeader">同步发布到QQ空间日志配置：</div>
  <div class="SubMenu"></div>
  <div id="divMain2">
	<form method="post" id="form2" name="form2" action="?action=save">  
		<table width="75%"  class="tableBorder">
			<tr>
				<th width="15%"><p align="center">配置名称</p></th>
				<th width="20%"><p align="center">配置内容</p></th>
				<th width='25%'><p align="center">配置说明</p></th>
			</tr>	
			<tr>
				<td><label for="UserName"><p align="center">QQ邮箱账户</p></label></td>
				<td><p align="left"><input id="UserName" size="40" name="UserName" type="text" value="<?php echo $zbp->Config('Qzone')->UserName;?>"/></p></td>
				<td><p align="left">只需输入QQ账户，无需+ @qq.com</p></td>
			</tr>
			<tr>
				<td><label for="UserPass"><p align="center">QQ二级邮箱密码</p></label></td>
				<td><p align="left"><input id="UserPass" size="40" name="UserPass" type="password" value="<?php echo $zbp->Config('Qzone')->UserPass;?>"/></p></td>
				<td><p align="left"></p></td>
			</tr>	
			<tr>
				<td colspan="3">
				<p align="center">本插件原理是通过QQ邮箱为中转站，想QQ空间写入日志。</p>
				</td>
			</tr>
			<tr>
				<td colspan="3"><p align="center"><input style="float: right;margin-top: -5px;" type="submit" class="button" value="保存"/></p></td>
			</tr>						
		</table>
	</form>
  </div>
</div>


<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>