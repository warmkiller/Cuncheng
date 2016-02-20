<?php
require '../../../zb_system/function/c_system_base.php';

require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('MyFormPro')) {$zbp->ShowError(48);die();}

$blogtitle='MyFormPro - 表单管理';

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
  <div class="SubMenu"><?php MyFormPro_SubMenu()?>
  </div>
  <div id="divMain2">
	<form class="search" id="search" method="post" action="#">
	<p>关键字: <input name="search" style="width:450px;" type="text" value="" /> &nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;
	
	<input type="submit" class="button" value="搜索"/></p>
	</form>  
<style type="text/css">
table {table-layout:fixed;}
td {white-space:nowrap;overflow:hidden;}
.sedit {
    box-sizing: border-box;
    width: 100%;
}
</style> 
<table border="1" class="tableFull tableBorder tableBorder-thcenter">
<tbody>
<tr class="color1"> 
			<th class="td5 tdCenter">ID</th> 
			<th class="td35 tdCenter">表单名称</th> 
			<th class="td15 tdCenter">创建时间</th> 
			<th class="td10 tdCenter">无CSS调用代码</th> 
			<th class="td10 tdCenter">有CSS调用代码</th> 
			<th class="td15 tdCenter">操作</th> 
</tr>
<?php
$str='';
//$array=MyFormPro_GetOrderList(1);
$p=new Pagebar('{%host%}zb_users/plugin/MyFormPro/mng_form.php?{page=%page%}{&search=%search%}',false);
$p->PageCount=60; #$zbp->managecount // system default str
$p->PageNow=(int)GetVars('page','GET')==0?1:(int)GetVars('page','GET');
$p->PageBarCount=$zbp->pagebarcount;
$w=array();
if(GetVars('search')){
	$w[]=array('search','form_Name','form_Description',GetVars('search'));
}

	$p->UrlRule->Rules['{%search%}']=urlencode(GetVars('search'));

        $order = array('form_Time'=>'DESC');
        $sql= $zbp->db->sql->Select(
        $zbp->table['myform_pro_form'],
        '*',
        $w,
        $order,
	array(($p->PageNow-1) * $p->PageCount,$p->PageCount),
	array('pagebar'=>$p)
        );
        $array=$zbp->GetListCustom($zbp->table['myform_pro_form'],$GLOBALS['datainfo']['myform_pro_form'],$sql);

foreach ($array as $form){
$str.='<tr>
<td>'.$form->ID.'</td>
<td>'.$form->Name.'</td>
<td>'.date('Y-m-d H:i:s',$form->Time).'</td>
<td><input type="text" class="sedit" name="ID" value="[MyFormPro=0]'.$form->ID.'[/MyFormPro]"></td>
<td><input type="text" class="sedit" name="ID" value="[MyFormPro=1]'.$form->ID.'[/MyFormPro]"></td>';


$str.='<td>';

$str.='&nbsp;<a href="'.$zbp->host.'zb_users/plugin/MyFormPro/edit_form.php?id='.$form->ID.'"><img src="../../../zb_system/image/admin/page_edit.png" alt="'.$zbp->lang['msg']['edit'] .'" title="'.$zbp->lang['msg']['edit'] .'" width="16" /></a>&nbsp;';
$str.='<a href="'.$zbp->host.'zb_users/plugin/MyFormPro/edit_fields.php?fid='.$form->ID.'"><img src="'.$zbp->host.'zb_users/plugin/MyFormPro/images/add.png" alt="增加字段" title="增加字段" width="16" /></a>&nbsp;';
$str.='<a target="_blank" href="'.$zbp->host.'zb_users/plugin/MyFormPro/view.php?fid='.$form->ID.'"><img src="'.$zbp->host.'zb_users/plugin/MyFormPro/images/view.png" alt="预览" title="预览" width="16" /></a>&nbsp;';
$str.='<a href="'.$zbp->host.'zb_users/plugin/MyFormPro/chart.php?fid='.$form->ID.'"><img src="'.$zbp->host.'zb_users/plugin/MyFormPro/images/chart_bar.png" alt="查看数据" title="查看数据" width="16" /></a>&nbsp;';

$str.='<a onclick="return window.confirm(\''.$zbp->lang['msg']['confirm_operating'] .'\');"  href="'.$zbp->host.'zb_users/plugin/MyFormPro/edit_form.php?act=listdel&id='.$form->ID.'"><img src="../../../zb_system/image/admin/delete.png" alt="'.$zbp->lang['msg']['del'] .'" title="'.$zbp->lang['msg']['del'] .'" width="16" /></a>';
$str.='</td>';
}
$str.='
</tr>';

echo $str;
?>

</tbody>
</table>
<p class="pagebar">
<?php
foreach ($p->buttons as $key => $value) {
	echo '<a href="'. $value .'">' . $key . '</a>&nbsp;&nbsp;' ;
}
?>
</p>
 
  
<script type="text/javascript">ActiveLeftMenu("aMyFormPro");</script>
<script type="text/javascript">ActiveTopMenu("topmenu_MyFormPro");</script>

	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/MyFormPro/logo.png';?>");</script>	
</div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>