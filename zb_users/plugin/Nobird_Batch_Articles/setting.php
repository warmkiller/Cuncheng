<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='ArticleMng';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Nobird_Batch_Articles')) {$zbp->ShowError(48);die();}

$blogtitle='批量文章管理插件 -  设置';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

	
if (isset($_POST['num']) && $_POST['num'] != '') {
	$zbp->config('Nobird_Batch_Articles')->num = trim($_POST['num']);
	$zbp->SaveConfig('Nobird_Batch_Articles');
	$zbp->ShowHint('good', "保存成功！");
}
?>
<div id="divMain">

  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu">
<?php Nobird_Batch_Articles_SubMenu();?>
</div>
  <div id="divMain2">
	<form id="edit" name="edit" method="post" action="#">
<input id="reset" name="reset" type="hidden" value="" />
<table border="1" class="tableFull tableBorder">
	<td class="td30"><p align='left'><b>单页展示数量</b></p></td>
	<td><input type="text" name="num" value="<?php echo htmlspecialchars($zbp->Config('Nobird_Batch_Articles')->num);?>" style="width:89%;" /></td>
</tr>
</table>
	  <hr/>
	  <p>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />

	</form>
<?php echo '<a href="'.$bloghost.'zb_users/plugin/Nobird_Batch_Articles/output.php"><span class="m-right" style="color:#F00">导出全部文章列表到excel[Beta]</span></a>';?>
<p>这只是个简单的导出功能，并不能替代数据库的备份</p>
	<script type="text/javascript">ActiveLeftMenu("aArticleMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/Nobird_Batch_Articles/logo.png';?>");</script>	
  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>