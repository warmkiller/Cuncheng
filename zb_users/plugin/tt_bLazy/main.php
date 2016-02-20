<?php
require_once '../../../zb_system/function/c_system_base.php';
require_once '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action = 'root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('tt_bLazy')) {$zbp->ShowError(48);die();}

$blogtitle = '延迟加载-相关设置';

if (count($_POST) > 0) {
	$zbp->Config('tt_bLazy')->templates=implode(",",$_POST["templates"]);
	$zbp->SaveConfig('tt_bLazy');
    $zbp->BuildTemplate();
	$zbp->SetHint('good');
	Redirect($_SERVER["HTTP_REFERER"]);
}
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<div id="divMain">

  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu">延迟加载-相关设置</div>
  <div id="divMain2">

<form method="post" action="">
  <table border="1" width="100%" cellspacing="0" cellpadding="0" class="tableBorder tableBorder-thcenter">
<tr>
      <th width='28%'>说明：</b></th>
      <th>
	  以下是你的当前使用的主题的所有模板列表，请选择你要延迟加载的模板：（一般选择post-multi和post-istop）
	  </th>
    </tr>
    <tr>
      <td><p><b>模板选择</b></p></td>
      <td><p>&nbsp;
		  <ul>	
<?php echo tt_bLazy_templates($zbp->Config('tt_bLazy')->templates,'templates')?>
			</ul>
        </p></td>
    </tr>
	  <tr>
      <td width='28%'><b>注意：</b></td>
      <td>
	  （1）请先启用模板再到该配置页面配置，一般只需要选择模板列表页重复模板为post-multi或者有post-istop，注意的模板不去刻意有根据官方模板做的这么标准，所以有些模板，这个插件无法去兼容所有的，请见谅.<br>
	  （2）选择你要准备投用的延迟加载的img图片的模板，请选择.<br>
	  （3）一般选择post-multi和post-istop，文章页面请不要选择（即single、post-single、post-page请不要选择），文章内容自动替换实施延迟加载。<br>
	  （4）更多请关注涂涂研版<a href="http://www.tusay.net" target="_blank">www.tusay.net</a>，涂涂模板为你提供模板、插件定制。谢谢.<br>
	  （5）联系方式：QQ：2283276927.
	  </td>
    </tr>
  </table>
  <p><br/>
    <input type="submit" class="button" value="提交" id="btnPost" onclick='' />
  </p>
  <p>&nbsp;</p>
</form>
  </div>
</div>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>