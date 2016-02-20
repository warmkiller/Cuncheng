<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('MyFormPro')) {$zbp->ShowError(48);die();}

$blogtitle='MyFormPro - 通用设置';


if(count($_POST)>0){
    $zbp->Config('MyFormPro')->Use_simplecode=$_POST['Use_simplecode'];
    $zbp->Config('MyFormPro')->Upload_Type=$_POST['Upload_Type'];	
    $zbp->Config('MyFormPro')->Upload_Size=$_POST['Upload_Size'];
    
    $zbp->SaveConfig('MyFormPro');
    $zbp->SetHint('good');
    Redirect('./setting_common.php');
}


require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
  <div class="SubMenu">
<?php
MyFormPro_SubMenu();
?>  
  </div>
  <div id="divMain2">
<!--代码-->
<form id="edit" name="edit" method="post" action="#">
<input id="reset" name="reset" type="hidden" value="" />
<table border="1" class="tableFull tableBorder">
	<tr>
	<td class="td30"><p align='left'><b>使用 简单 验证码</b></p></td>
	<td><input type="text"  name="Use_simplecode" value="<?php echo $zbp->Config('MyFormPro')->Use_simplecode;?>" style="width:89%;" class="checkbox"/> <br />比系统自带验证码要简单 容易输入 </td>
	</tr>
<tr>
	<td class="td30"><p align='left'><b>允许附件上传的类型</b></p></td>
	<td><input type="text" name="Upload_Type" value="<?php echo htmlspecialchars($zbp->Config('MyFormPro')->Upload_Type);?>" style="width:89%;" /></td>
</tr>

<tr>
	<td class="td30"><p align='left'><b>允许附件上传的大小(单位MB)</b></p></td>
	<td><input type="text" name="Upload_Size" value="<?php echo htmlspecialchars($zbp->Config('MyFormPro')->Upload_Size);?>" style="width:89%;" /></td>
</tr>

</table>
	  <hr/>
	  <p>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />

	</form>
<div style="color: #c09853;background-color: #fcf8e3;border: 1px solid #fbeed5;border-radius: 2px;margin-bottom: 20px;padding: 10px 35px 10px 14px;text-align:right;">
<input style=" background: #f7f7f7 none repeat scroll 0 0;border: 1px solid #cfadb3;border-radius: 5px;box-sizing: border-box;color: #832525;" type="button" onclick="mfp_uninstall()"  value="彻底卸载本插件" /><br /><br />
<p>警告：此操作将彻底删除所有数据，包括表单和已经提交的项目。并且此操作不可逆！</p>
</div>	
	<script type="text/javascript">ActiveLeftMenu("aMyFormPro");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/MyFormPro/logo.png';?>");
	
function mfp_uninstall(){
if(confirm("警告！所有数据将被删除，此操作不可逆！")){
    $.post(ajaxurl + "mfp_uninstall",
        '',
        function(data){   
                  alert("卸载成功！");
                  setTimeout(function () {
                        window.location="<?php echo $zbp->host;?>zb_system/cmd.php?act=PluginMng";
                    }, 1000);
        }, "json");
    return false;
}
}	
	
	
	</script>	
 
  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>