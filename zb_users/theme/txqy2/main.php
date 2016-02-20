<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('txqy2')) {$zbp->ShowError(48);die();}
$blogtitle='主题配置';

$act = "";
if ($_GET['act']){
$act = $_GET['act'] == "" ? 'config' : $_GET['act'];
}

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

if(isset($_POST['PostMS'])){
  $zbp->Config('txqy2')->PostMS = $_POST['PostMS'];
  $zbp->Config('txqy2')->PostGJC = $_POST['PostGJC'];
  $zbp->Config('txqy2')->PostFX = $_POST['PostFX'];
  $zbp->SaveConfig('txqy2');
  $zbp->ShowHint('good');
}
  
if(isset($_POST['PostFLASH'])){  
  $zbp->Config('txqy2')->PostFLASH = $_POST['PostFLASH'];
  $zbp->Config('txqy2')->hdpkg = $_POST['hdpkg'];
  $zbp->Config('txqy2')->PostCALL = $_POST['PostCALL'];
  $zbp->Config('txqy2')->PostJIANJIE = $_POST['PostJIANJIE'];
  $zbp->Config('txqy2')->PostCPID = $_POST['PostCPID'];
  $zbp->Config('txqy2')->PostCPSL = $_POST['PostCPSL'];
  $zbp->Config('txqy2')->PostSYID1 = $_POST['PostSYID1'];
  $zbp->Config('txqy2')->PostSYID2 = $_POST['PostSYID2'];
  $zbp->SaveConfig('txqy2');
  $zbp->ShowHint('good');
}

if(isset($_POST['PostCPLB'])){  
  $zbp->Config('txqy2')->PostCPLB = $_POST['PostCPLB'];
  $zbp->Config('txqy2')->PostLXWM = $_POST['PostLXWM'];
  $zbp->Config('txqy2')->clkg = $_POST['clkg'];
  $zbp->Config('txqy2')->PostQQ = $_POST['PostQQ'];
  $zbp->Config('txqy2')->kfkg = $_POST['kfkg'];
  $zbp->SaveConfig('txqy2');
  $zbp->ShowHint('good');
}

if(isset($_POST['zhuse'])){   
  $zbp->Config('txqy2')->zhuse = $_POST['zhuse'];
  $zbp->Config('txqy2')->fuse = $_POST['fuse'];
  $zbp->Config('txqy2')->hong = $_POST['hong'];
  $zbp->Config('txqy2')->wzys = $_POST['wzys'];
  $zbp->Config('txqy2')->ljys = $_POST['ljys'];
  $zbp->Config('txqy2')->hdys = $_POST['hdys'];
  $zbp->SaveConfig('txqy2');
  $zbp->ShowHint('good');
}

?>

<script src="source/jscolor.js" type="text/javascript"></script>
<style>
input.text{background:#FFF;border:1px double #aaa;font-size:1em;padding:0.25em;}
p{line-height:1.5em;padding:0.5em 0;}
</style>
<div id="divMain">
  <div class="divHeader">村创空间 -<?php echo $blogtitle;?></div>
    <div class="SubMenu">
        <?php txqy2_SubMenu($act);?>
    </div>

    <div id="divMain2">
	
	 <?php
    if ($act == 'logo'){
    ?>
  
    <form enctype="multipart/form-data" method="post" action="save.php?type=logo">  
    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
  <tr>
    <td width="15%"><label for="logo.png"><p align="center">网站LOGO（大小为300*80）</p></label></td>
    <td width="50%"><p align="center"><input name="logo.png" type="file"/></p></td>
  <td width="25%"><p align="center"><input name="" type="Submit" class="button" value="保存"/></p></td>
  </tr>
</table>
    </form>

<form enctype="multipart/form-data" method="post" action="save.php?type=gywm">  
    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
    <tr>
    <td width="15%"><label for="gywm.png"><p align="center">首页关于我们介绍的右侧图片，大小为150*100</p></label></td>
    <td width="50%"><p align="center"><input name="gywm.png" type="file"/></p></td>
  <td width="25%"><p align="center"><input name="" type="Submit" class="button" value="保存"/></p></td>
  </tr>
</table>
</form>

<form enctype="multipart/form-data" method="post" action="save.php?type=pic">  
    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
    <tr>
    <td width="15%"><label for="bg.png"><p align="center">产品列表页中文章内无图默认显示的图片</p></label></td>
    <td width="50%"><p align="center"><input name="pic.png" type="file"/></p></td>
  <td width="25%"><p align="center"><input name="" type="Submit" class="button" value="保存"/></p></td>
  </tr>
</table>
    </form>
	
<form enctype="multipart/form-data" method="post" action="save.php?type=xw">  
    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
    <tr>
    <td width="15%"><label for="xwzx.png"><p align="center">新闻列表导航栏下barner图片，大小为1100*120</p></label></td>
    <td width="50%"><p align="center"><input name="xwzx.png" type="file"/></p></td>
  <td width="25%"><p align="center"><input name="" type="Submit" class="button" value="保存"/></p></td>
  </tr>
</table>
    </form>
	
<form enctype="multipart/form-data" method="post" action="save.php?type=cp">  
    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
    <tr>
    <td width="15%"><label for="cpzx.png"><p align="center">产品列表导航栏下barner图片，大小为1100*120</p></label></td>
    <td width="50%"><p align="center"><input name="cpzx.png" type="file"/></p></td>
  <td width="25%"><p align="center"><input name="" type="Submit" class="button" value="保存"/></p></td>
  </tr>
</table>
</form>

<form enctype="multipart/form-data" method="post" action="save.php?type=ban">  
    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
    <tr>
    <td width="15%"><label for="banner.jpg"><p align="center">内容页导航栏下barner图片，大小为1100*120</p></label></td>
    <td width="50%"><p align="center"><input name="banner.jpg" type="file"/></p></td>
  <td width="25%"><p align="center"><input name="" type="Submit" class="button" value="保存"/></p></td>
  </tr>
</table>
</form>

<form enctype="multipart/form-data" method="post" action="save.php?type=weixin">  
    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
    <tr>
    <td width="15%"><label for="weixin.jpg"><p align="center">右侧在线客服里面的微信二维码图片</p></label></td>
    <td width="50%"><p align="center"><input name="weixin.jpg" type="file"/></p></td>
  <td width="25%"><p align="center"><input name="" type="Submit" class="button" value="保存"/></p></td>
  </tr>
</table>
</form>
<form enctype="multipart/form-data" method="post" action="save.php?type=three">  
    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
    <tr>
    <td width="15%"><label for="zuoyi.jpg"><p align="center">导航下左一村城集团图片</p></label></td>
    <td width="50%"><p align="center"><input name="zuoyi.jpg" type="file"/></p></td>
  <td width="25%"><p align="center"><input name="" type="Submit" class="button" value="保存"/></p></td>
  </tr>
</table>
</form>
<form enctype="multipart/form-data" method="post" action="save.php?type=three">  
    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
    <tr>
    <td width="15%"><label for="zuoer.jpg"><p align="center">导航下左二村城资源平台2+N图片</p></label></td>
    <td width="50%"><p align="center"><input name="zuoer.jpg" type="file"/></p></td>
  <td width="25%"><p align="center"><input name="" type="Submit" class="button" value="保存"/></p></td>
  </tr>
</table>
</form>
<form enctype="multipart/form-data" method="post" action="save.php?type=three">  
    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
    <tr>
    <td width="15%"><label for="youyi.jpg"><p align="center">导航下右一村城文化平台图片</p></label></td>
    <td width="50%"><p align="center"><input name="youyi.jpg" type="file"/></p></td>
  <td width="25%"><p align="center"><input name="" type="Submit" class="button" value="保存"/></p></td>
  </tr>
</table>
</form>


<form enctype="multipart/form-data" method="post" action="save.php?type=three2">  
    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
    <tr>
    <td width="15%"><label for="shang.jpg"><p align="center">导航下手机村城集团图片</p></label></td>
    <td width="50%"><p align="center"><input name="shang.jpg" type="file"/></p></td>
  <td width="25%"><p align="center"><input name="" type="Submit" class="button" value="保存"/></p></td>
  </tr>
</table>
</form>
<form enctype="multipart/form-data" method="post" action="save.php?type=three2">  
    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
    <tr>
    <td width="15%"><label for="zhong.jpg"><p align="center">导航下手机村城资源平台2+N图片</p></label></td>
    <td width="50%"><p align="center"><input name="zhong.jpg" type="file"/></p></td>
  <td width="25%"><p align="center"><input name="" type="Submit" class="button" value="保存"/></p></td>
  </tr>
</table>
</form>
<form enctype="multipart/form-data" method="post" action="save.php?type=three2">  
    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
    <tr>
    <td width="15%"><label for="xia.jpg"><p align="center">导航下手机村城文化平台图片</p></label></td>
    <td width="50%"><p align="center"><input name="xia.jpg" type="file"/></p></td>
  <td width="25%"><p align="center"><input name="" type="Submit" class="button" value="保存"/></p></td>
  </tr>
</table>
</form>
        <?php
    }
  ?>
  
  
    <?php
    if ($act == 'seo'){
    ?>
<form id="form1" name="form1" method="post">
    <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
  <tr>
    <th width="15%"><p align="center">配置名称</p></th>
    <th width="50%"><p align="center">配置内容</p></th>
  <th width="25%"><p align="center">配置说明</p></th>
  </tr>

        <tr>
    <td><label for="PostMS"><p align="center">网站描述</p></label></td>
    <td><p align="left"><textarea name="PostMS" type="text" id="PostMS" style="width:98%;"><?php echo $zbp->Config('txqy2')->PostMS;?></textarea></p></td>
  <td><p align="left">请在这里填写你的网站描述</p></td>
  </tr>
  
 <tr>
    <td><label for="PostGJC"><p align="center">网站关键词</p></label></td>
    <td><p align="left"><textarea name="PostGJC" type="text" id="PostGJC" style="width:98%;"><?php echo $zbp->Config('txqy2')->PostGJC;?></textarea></p></td>
  <td><p align="left">请在这里填写你的网站关键词</p></td>
  </tr>

<tr>
    <td><label for="PostFX"><p align="center">在线分享</p></label></td>
    <td><p align="left"><textarea name="PostFX" type="text" id="PostFX" style="width:98%; height:100px;"><?php echo $zbp->Config('txqy2')->PostFX;?></textarea></p></td>
     <td><p align="left">请在这里粘贴你的在线分享代码，将会出现在每一篇文章的正文下面，可以增加访客粘度。</p></td>
</tr>

    <tr>
	
    <td colspan="3">
        <input name="" type="Submit" class="button" value="保存"/>
    </td>
  </tr>
  </table>
  
  
  
    <?php
    }
    if ($act == 'sy'){
     ?>
<form id="form1" name="form1" method="post">
<table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
  
  <tr>
    <th width="15%"><p align="center">配置名称</p></th>
    <th width="50%"><p align="center">配置内容</p></th>
  <th width="25%"><p align="center">配置说明</p></th>
  </tr>

    <tr>
    <td><label for="PostFLASH"><p align="center">首页幻灯片设置</p></label></td>
    <td><p align="left"><textarea name="PostFLASH" type="text" id="PostFLASH" style="width:98%;height:160px"><?php echo $zbp->Config('txqy2')->PostFLASH;?></textarea></p></td>	
  <td><p align="left">请输入幻灯片图片代码,图片大小为1100*300</p></td>
  </tr>

<tr>      
    <td><p align="center">手机端幻灯片开关</p></td>
	<td><input name="hdpkg" type="text" value="<?php echo $zbp->Config('txqy2')->hdpkg; ?>" class="checkbox" style="display:none;" /></td>    <td>很多手机浏览器会屏蔽掉幻灯片js，所以推荐关闭调用手机端的幻灯片。当然也可以开启。</td>
</tr>

<tr>
    <td><label for="PostCALL"><p align="center">联系电话</p></label></td>
    <td><p align="left"><textarea name="PostCALL" type="text" id="PostCALL" style="width:98%;"><?php echo $zbp->Config('txqy2')->PostCALL;?></textarea></p></td>
     <td><p align="left">填写你的联系电话，将会出现在网站logo的右侧的醒目位置。</p></td>
</tr>

<tr>
    <td><label for="PostJIANJIE"><p align="center">关于我们</p></label></td>
    <td><p align="left"><textarea name="PostJIANJIE" type="text" id="PostJIANJIE" style="width:98%; height:200px;"><?php echo $zbp->Config('txqy2')->PostJIANJIE;?></textarea></p></td>
     <td><p align="left">首页关于我们文字说明。</p></td>
</tr>

<tr>
    <td><label for="PostCPID"><p align="center">产品列表栏目ID</p></label></td>
    <td><p align="left"><textarea name="PostCPID" type="text" id="PostCPID" style="width:98%;"><?php echo $zbp->Config('txqy2')->PostCPID;?></textarea></p></td>
     <td><p align="left">请在这里填写你网站的产品列表的栏目ID号，PS:在后台--分类管理里面可以看到分类的ID号。</p></td>
</tr>

<tr>
    <td><label for="PostCPSL"><p align="center">首页产品列表数量</p></label></td>
    <td><p align="left"><textarea name="PostCPSL" type="text" id="PostCPSL" style="width:98%;"><?php echo $zbp->Config('txqy2')->PostCPSL;?></textarea></p></td>
     <td><p align="left">请在这里填写首页推荐产品版块调用产品的数量，PS：必须是4的倍数，例如4、8、16之类的。</p></td>
</tr>


<tr>
    <td><label for="PostSYID1"><p align="center">首页调用栏目左</p></label></td>
    <td><p align="left"><textarea name="PostSYID1" type="text" id="PostSYID1" style="width:98%;"><?php echo $zbp->Config('txqy2')->PostSYID1;?></textarea></p></td>
     <td><p align="left">首页产品推荐产品下所调用的两个区块的左侧，请在这里填写栏目ID号，PS:在后台--分类管理里面可以看到分类的ID号。</p></td>
</tr>

<tr>
    <td><label for="PostSYID2"><p align="center">首页调用栏目右</p></label></td>
    <td><p align="left"><textarea name="PostSYID2" type="text" id="PostSYID2" style="width:98%;"><?php echo $zbp->Config('txqy2')->PostSYID2;?></textarea></p></td>
     <td><p align="left">首页产品推荐产品下所调用的两个区块的右侧，请在这里填写栏目ID号，PS:在后台--分类管理里面可以看到分类的ID号。</p></td>
</tr>

  <tr>
    <td colspan="3">
        <input name="" type="Submit" class="button" value="保存"/>
    </td>
  </tr>
  </table>
 </form>
	
    <?php
    }
    if ($act == 'lx'){
    ?>
<form id="form1" name="form1" method="post">
<table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
  <tr>
    <th width="15%"><p align="center">配置名称</p></th>
    <th width="50%"><p align="center">配置内容</p></th>
  <th width="25%"><p align="center">配置说明</p></th>
  </tr>
<tr>
    <td><label for="PostCPLB"><p align="center">产品名称列表</p></label></td>
    <td><p align="left"><textarea name="PostCPLB" type="text" id="PostCPLB" style="width:98%; height:120px;"><?php echo $zbp->Config('txqy2')->PostCPLB;?></textarea></p></td>
     <td><p align="left">左侧栏的产品列表</p></td>
</tr>
  
<tr>
    <td><label for="PostLXWM"><p align="center">联系方式</p></label></td>
    <td><p align="left"><textarea name="PostLXWM" type="text" id="PostLXWM" style="width:98%;height:100px;"><?php echo $zbp->Config('txqy2')->PostLXWM;?></textarea></p></td>
     <td><p align="left">左侧栏的联系我们，可以填写联系电话、地址等等。</p></td>
</tr>

<tr>      
    <td><p align="center">左侧栏手机端开关</p></td>
	<td><input name="clkg" type="text" value="<?php echo $zbp->Config('txqy2')->clkg; ?>" class="checkbox" style="display:none;" /></td>    <td>关闭后手机端将不显示左侧栏的内容</td>
</tr>

<tr>
    <td><label for="PostQQ"><p align="center">在线QQ</p></label></td>
    <td><p align="left"><textarea name="PostQQ" type="text" id="PostQQ" style="width:98%;"><?php echo $zbp->Config('txqy2')->PostQQ;?></textarea></p></td>
     <td><p align="left">右侧栏在线客服中的QQ客服，仅填写QQ号码即可</p></td>
</tr>

<tr>      
    <td><p align="center">右侧在线客服开关</p></td>
	<td><input name="kfkg" type="text" value="<?php echo $zbp->Config('txqy2')->kfkg; ?>" class="checkbox" style="display:none;" /></td>    <td>关闭后将不显示在线客服</td>
</tr>

    <tr>
    <td colspan="3">
        <input name="" type="Submit" class="button" value="保存"/>
    </td>
  </tr>

  
  </table>
    </form>
	

 
     <?php
    }
    if ($act == 'peis'){
     ?>
<form id="form1" name="form1" method="post">
 <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
    
  <tr>
    <th colspan="4"><p align="center">网站配色（如果觉得自己改的很难看了，建议按照初始颜色改回来吧...）</p></th>
    </tr>
  <tr>
    <td width="25%">导航栏颜色（初始颜色000000）</td>
    <td width="25%"><input name="zhuse" type="text" class="color"  style="width:50%" value="#<?php echo $zbp->Config('txqy2')->zhuse;?>" /></input></td>
    <td width="25%">网站主色调（初始颜色44BC8F）</td>
    <td width="25%"><input name="fuse" type="text" class="color"  style="width:50%" value="#<?php echo $zbp->Config('txqy2')->fuse;?>" /></input></td>
  </tr>
  <tr>
    <td width="25%">点缀颜色（初始颜色E41752）</td>
    <td width="25%"><input name="hong" type="text" class="color"  style="width:50%" value="#<?php echo $zbp->Config('txqy2')->hong;?>" /></input></td>
    <td width="25%">文字颜色（初始颜色333333）</td>
    <td width="25%"><input name="wzys" type="text" class="color"  style="width:50%" value="#<?php echo $zbp->Config('txqy2')->wzys;?>" /></input></td>
  </tr>
    <tr>
    <td width="25%">链接颜色（初始颜色222222）</td>
    <td width="25%"><input name="ljys" type="text" class="color"  style="width:50%" value="#<?php echo $zbp->Config('txqy2')->ljys;?>" /></input></td>
    <td width="25%">链接鼠标滑过颜色（初始颜色cc0000）</td>
    <td width="25%"><input name="hdys" type="text" class="color"  style="width:50%" value="#<?php echo $zbp->Config('txqy2')->hdys;?>" /></input></td>
  </tr>

  <tr>
    <td colspan="3">
        <input name="" type="Submit" class="button" value="保存"/>
    </td>
  </tr>
  </table>
 </form>
 
 
    <?php
    }
    if ($act == 'config'){
     ?>
<form id="form3" name="form3" method="post">
<table style="padding:0;margin:0;" class="tableBorder" width="100%" cellpadding="0" cellspacing="0">
     <tbody><tr class="color2" height="32"><td>主题配置说明：</td></tr>
     <tr class="color3" height="32"><td style="color:#F00">注意：本页面是主题插件设置页面，请仔细阅读各项配置项的配置说明，然后按照配置说明要求设置，错误的html代码会导致错位等问题；</td></tr>
     <tr class="color2" height="32"><td><strnog>主题使用说明</strong>：</td></tr>
	 <tr class="color3" height="32"><td>
	 <p  style="color:#0099cc;font-weight:600;">1、产品页模板选择：请去后台--分类管理--编辑分类--模板选择，产品列表页模板选择“index-tu”; 产品内容页选择“single-cp”模板。</p>
	 </td></tr>

  
</tbody></table>


        <?php
    }
  ?>
    

	
	
    </div>
</div></div>

<script type="text/javascript">ActiveTopMenu("topmenu_txqy2");</script> 

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>