<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='ArticleMng';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Nobird_Batch_Articles')) {$zbp->ShowError(48);die();}

$blogtitle='帮助 - 批量文章管理插件 - Nobird为您精彩呈现';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';


?>


<div id="divMain">
	<div class="divHeader"><?php echo $blogtitle;?></div>
	<div class="SubMenu">
	<?php Nobird_Batch_Articles_SubMenu();?>
    </div>
	<div id="divMain2">

    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
     <tr height="32"><td>温馨提示：</td></tr>
     <tr height="32"><td style="color:#F00">        1、数据库未备份的情况下误删除将无法恢复，请谨慎操作；</td></tr>
     <tr height="32"><td>       2、所有操作均为即时生效；</td></tr>
     <tr height="32"><td>       3、如有宝贵意见还望提出，将在下一版中进行修订；</td></tr>
     <tr height="32"><td>       </td></tr>
     <tr height="32"><td>       </td></tr>
     <tr height="32"><td>       </td></tr>
     <tr height="32"><td>       主题作者：Nobird。主页：<a href="http://www.birdol.com" target="_blank">鸟儿博客</a></td></tr>
     <tr height="32"><td>       如果在使用过程中有什么问题，请到作者主页进行反馈。</td></tr>
     <tr height="32"><td>       本人提供主题、插件定制：联系QQ：8769298，竭诚为您服务。</td></tr> 
  </tr>
</table>
   
 <br />
	</div>
</div>
<?php
	echo '<script type="text/javascript">AddHeaderIcon("'. $zbp->host . 'zb_users/plugin/Nobird_Batch_Articles/logo.png' . '");</script>';

require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>