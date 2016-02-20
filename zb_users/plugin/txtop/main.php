<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('txtop')) {$zbp->ShowError(48);die();}

$blogtitle='天兴工作室--自定义色彩+自适应的返回顶部';
require $blogpath . 'zb_system/admin/admin_header.php';
?>
<script src="source/jscolor.js" type="text/javascript"></script>
<style type="text/css">.tableBorder td{padding:10px}</style>
<?php
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
  <div class="SubMenu">
 	<a href="main.php" ><span class="m-left">设置首页</span></a>
    <a href="http://www.txcstx.cn/" target="_blank"><span class="m-right">帮助</span></a>
  </div>
  <div id="divMain2">
<!--代码-->
    <?php
	if(isset($_POST['qqhm'])){
        $zbp->Config('txtop')->qqhm = $_POST['qqhm'];
		$zbp->Config('txtop')->yxdz = $_POST['yxdz'];
		$zbp->Config('txtop')->mrys = $_POST['mrys'];
		$zbp->Config('txtop')->hgys = $_POST['hgys'];
		$zbp->Config('txtop')->ybj = $_POST['ybj'];
		$zbp->Config('txtop')->xbj = $_POST['xbj'];
		$zbp->Config('txtop')->sybj = $_POST['sybj'];
		$zbp->Config('txtop')->sxbj = $_POST['sxbj'];
		$zbp->Config('txtop')->wxkg = $_POST['wxkg'];
		$zbp->Config('txtop')->yxkg = $_POST['yxkg'];
		$zbp->Config('txtop')->qqkg = $_POST['qqkg'];
		$zbp->SaveConfig('txtop');
		$zbp->SetHint('good');
		Redirect('./main.php');
	}
	?>
	
<form enctype="multipart/form-data" method="post" action="save.php?type=zfb">  
<table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
  <tr>
    <td width="25%"><label for="zfb.png"><p align="left">微信二维码图片</p></label></td>
    <td width="35%"><p align="left"><input name="zfb.png" type="file"/>   <input name="" type="Submit" class="button" value="保存"/></p></td>
    </form>	

<form action="main.php" method="post">
    <td width="15%">微信图标是否显示</td>
    <td width="25%"><input name="wxkg" type="text" value="<?php echo $zbp->Config('txtop')->wxkg; ?>" class="checkbox"  /></td>
</tr>

   <tr>
    <td width="25%">QQ号码</td>
    <td width="35%"><input type="text" class="txt txt-sho" name="qqhm" value="<?php echo $zbp->Config('txtop')->qqhm; ?>"  style="width:95%;"/></td>
    <td width="15%">QQ图标是否显示</td>
    <td width="25%"><input name="qqkg" type="text" value="<?php echo $zbp->Config('txtop')->qqkg; ?>" class="checkbox" style="display:none;" />
    </td>
  </tr>	
  
    <tr>
    <td width="25%">邮箱地址或者网站留言本地址<br>注意：填写邮箱地址前面要加mailto:  正确格式：mailto:admin@txcstx.cn</td>
    <td width="35%"><input type="text" class="txt txt-sho" name="yxdz" value="<?php echo $zbp->Config('txtop')->yxdz; ?>"  style="width:95%;"/> </td>
    <td width="15%">邮箱图标是否显示</td>
    <td width="25%"><input name="yxkg" type="text" value="<?php echo $zbp->Config('txtop')->yxkg; ?>" class="checkbox"  />
    </td>
  </tr>	
  

   <tr>
    <td width="25%">默认显示颜色</td>
    <td width="35%"><input name="mrys" type="text" class="color"  style="width:160px" value="#<?php echo $zbp->Config('txtop')->mrys;?>" /></input></td>
    <td width="15%">鼠标滑过颜色</td>
    <td width="25%"><input name="hgys" type="text" class="color"  style="width:160px" value="#<?php echo $zbp->Config('txtop')->hgys;?>" /></input>    </td>
  </tr>
  
  <tr>
    <td width="25%">电脑端右边距</td>
    <td width="35%"><input type="text" class="txt txt-sho" name="ybj" value="<?php echo $zbp->Config('txtop')->ybj; ?>" /> px</td>
    <td width="15%">电脑端下边距</td>
    <td width="25%"><input type="text" class="txt txt-sho" name="xbj" value="<?php echo $zbp->Config('txtop')->xbj; ?>" /> px</td>
  </tr>
  
  <tr>
    <td width="25%">手机端右边距</td>
    <td width="35%"><input type="text" class="txt txt-sho" name="sybj" value="<?php echo $zbp->Config('txtop')->sybj; ?>" /> px</td>
    <td width="15%">手机端下边距</td>
    <td width="25%"><input type="text" class="txt txt-sho" name="sxbj" value="<?php echo $zbp->Config('txtop')->sxbj; ?>" /> px</td>
  </tr>

    <tr>
    <td colspan="3">
        <input type="submit" name="submit" value="保存" />
    </td>
  </tr>

		</table>
	</form>

  </div>
</div>
<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/txtop/logo.png';?>");</script>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>