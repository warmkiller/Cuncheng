<?php
require '../../../../zb_system/function/c_system_base.php';

require '../../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

$blogtitle='关键词和描述 - '.$Nobird_Plugin_Name.$Nobird_Plugin_Title;

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"><?php Nobird_Seo_Tools_SubMenu();?></div>
  <div id="divMain2">
  
<?php
if(count($_POST)>0){
	$zbp->Config('Nobird_KeyAndDes')->UseDes = $_POST['UseDes'];//插件是否启用

	$zbp->Config('Nobird_KeyAndDes')->title_keywords = $_POST['title_keywords'];
	$zbp->Config('Nobird_KeyAndDes')->title_description = $_POST['title_description'];
	$zbp->Config('Nobird_KeyAndDes')->description_num = $_POST['description_num'];
	$zbp->Config('Nobird_KeyAndDes')->isusecanonical = $_POST['isusecanonical'];
	
	$zbp->SaveConfig('Nobird_KeyAndDes');
	$zbp->SetHint('good','参数已保存，更新缓存后可以查看是否生效');
	Redirect('./keyanddes.php');
}
?>
<form method="post">
	<table border="1" class="tableFull tableBorder">
<tr>
	<td class="td30"><p align='left'><b>是否启用插件内置的关键词和描述功能？</b></p></td>
	<td><input type="text"  name="UseDes" value="<?php echo $zbp->Config('Nobird_KeyAndDes')->UseDes;?>" style="width:89%;" class="checkbox"/>此开关可以选择是否启用，不启用此开关，本页面其他设置无效</td>


</td>
</tr>
<tr>
	<td><p align='left'><b>设置首页关键词</b></p></td>
	<td><input id='title_keywords' name='title_keywords' style='width:500px;' type='text' value='<?php echo $zbp->Config('Nobird_KeyAndDes')->title_keywords;?>'>关键词使用半角逗号(,)分隔，总数不要超过100字符</td>
</tr>
<tr>
	<td><p align='left'><b>设置首页描述</b></p></td>
	<td><input id='title_description' name='title_description' style='width:500px;' type='text' value='<?php echo $zbp->Config('Nobird_KeyAndDes')->title_description;?>'>总数不要超过200字符</td>
</tr>
<tr>
	<td><p align='left'><b>内页描述字数</b></p></td>
	<td><input id='description_num' name='description_num' style='width:500px;' type='text' value='<?php echo $zbp->Config('Nobird_KeyAndDes')->description_num;?>'>总数不要超过200字符</td>
</tr>
<tr>
	<td><p align='left'><b>开启单用户canonical标签(多用户博客请勿开启)</b></p></td>
	<td><input type="text"  name="isusecanonical" value="<?php echo $zbp->Config('Nobird_KeyAndDes')->isusecanonical;?>" style="width:89%;" class="checkbox"/><b>*实验性功能</b></td>
<tr>
<tr>
	<td><p><b>说明</b></p></td>
	<td>
	<p>1、设置好后，插件会自行增加相应meta信息至页面中，但不会修改模板</p>
	<p>2、确保模板中没有其他的keyword和description标签，以免对搜索引擎不利。</p>
	<p>3、文章页的关键词为tag，描述为文章前<?php echo $zbp->Config('Nobird_KeyAndDes')->description_num;?>个字。</p>
	<p>4、分类页面的描述请到分类编辑中修改对应分类的简介。</p>
	<p>5、单用户博客的用户页面即www.domain.com/author-1.html与首页内容完全一致，开启单用户canonical标签可以让搜索引擎将权重转移至首页。</p>
	<p>6、单用户博客的用户页面分页即www.domain.com/author-1_2.html与分类内容完全一致，开启单用户canonical标签可以让搜索引擎将权重转移至分页。</p>
	<p>7、canonical现为实验性功能，仅支持伪静态，且伪静态规则形如domain.com/author-1_2.html，domain.com/page_2.html 这样的链接。</p>
	</td>
</tr>
</table>
	  <p>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
	  </p>
	</form>




	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/logo.png';?>");</script>	
  </div>
</div>


<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>