<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='ArticleMng';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Nobird_Batch_Articles')) {$zbp->ShowError(48);die();}

$blogtitle='批量文章管理插件';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';


?>
<div id="divMain">
<?php Nobird_Batch_Admin_ArticleMng();?>
</div>
<script language="JavaScript" type="text/javascript">

function BatchDelEnabled() {
	var checkBatchDel=document.getElementById('BatchDel');

	if(checkBatchDel.checked==true){
		document.getElementById('edtcategory').disabled=true;
		document.getElementById('edtstatus').disabled=true;
		document.getElementById('edtIsTop').disabled=true;
		document.getElementById('edtauthor').disabled=true;
		document.getElementById('addtag').disabled=true;
		document.getElementById('deltag').disabled=true;
		alert("注意: 您选择了批量删除功能, 此操作不可恢复, 请小心提交!");
	}
	else{
		document.getElementById('edtcategory').disabled=false;
		document.getElementById('edtstatus').disabled=false;
		document.getElementById('edtIsTop').disabled=false;
		document.getElementById('edtauthor').disabled=false;
		document.getElementById('addtag').disabled=false;
		document.getElementById('deltag').disabled=false;
	}
}



</script>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>