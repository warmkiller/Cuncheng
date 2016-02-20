<?php
require '../../../zb_system/function/c_system_base.php';

require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('Nobird_Archiver')) {$zbp->ShowError(48);die();}

$blogtitle='Nobird_Archiver - 文章列表';

if(count($_POST)>0){

	$zbp->Config('Nobird_Archiver')->readme_text=$_POST['readme_text'];
	$zbp->Config('Nobird_Archiver')->title_text=$_POST['title_text'];	
	$zbp->SaveConfig('Nobird_Archiver');
		if(GetVars('addnavbar')){
		$zbp->AddItemToNavbar('item','Nobird_Archiver',$zbp->Config('Nobird_Archiver')->title_text,$zbp->host.'?archive');
	}else{
		$zbp->DelItemToNavbar('item','Nobird_Archiver');
	}
	
	$zbp->SetHint('good');
	Redirect('./main.php');
}


require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

?>
<div id="divMain">

  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"></div>
  <div id="divMain2">
	<form id="edit" name="edit" method="post" action="#">
<input id="reset" name="reset" type="hidden" value="" />
<table border="1" class="tableFull tableBorder">
	<td class="td30"><p align='left'><b>将文章列表链接加入导航栏(如启用伪静态，请不要使用此项，并手动将伪静态后的地址加入导航栏)</b></p></td>
	<td><input type="checkbox" name="addnavbar" value="ok" <?php if($zbp->CheckItemToNavbar('item','Nobird_Archiver')){?>checked="checked"<?php }?> /> 默认的可访问地址为：你的博客网址/index.php?archive</td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>文章列表页面标题</b></p></td>
	<td><input type="text" name="title_text" value="<?php echo htmlspecialchars($zbp->Config('Nobird_Archiver')->title_text);?>" style="width:89%;" /></td>
</tr>
<tr>
	<td class="td30"><p align='left'><b>文章列表相关说明文字</b></p></td>
	<td><textarea name="readme_text" style="width:90%;height:100px;" /><?php echo htmlspecialchars($zbp->Config('Nobird_Archiver')->readme_text);?></textarea></td>
</tr>
</table>
	  <hr/>
	  <p>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />

	</form>
	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/Nobird_Archiver/logo.png';?>");</script>	
  </div>
</div>


<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>