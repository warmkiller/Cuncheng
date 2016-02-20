<?php
require '../../../../zb_system/function/c_system_base.php';

require '../../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

$blogtitle='蜘蛛来访查询 - '.$Nobird_Plugin_Name.$Nobird_Plugin_Title;

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
if(count($_POST)>0){
	$zbp->Config('Nobird_Spider')->UseSpider = $_POST['UseSpider'];//插件是否启用

	$zbp->SaveConfig('Nobird_Spider');
	$zbp->SetHint('good','参数已保存，更新缓存后可以查看是否生效');
	Redirect('./spider.php');
}
?>

<div id="divMain">

  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"><?php Nobird_Seo_Tools_SubMenu();?></div>
<div class="SubMenu"><?php
echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Spider/spider_error.php"><span class="m-left m-now">蜘蛛抓取错误查看</span></a>';
echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Spider/output.php"><span class="m-left m-now">导出到CSV文件</span></a>';
echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Spider/clear.php"><span class="m-left m-now">清空数据</span></a>';
?></div>

<style type="text/css">
table {table-layout:fixed;}
td {white-space:nowrap;overflow:hidden;}
</style> 
  <div id="divMain2">
<form method="post">
	<table border="1" class="tableFull tableBorder">
<tr>
	<td class="td30"><p align='left'><b>是否启用蜘蛛记录功能？</b></p></td>
	<td><input type="text"  name="UseSpider" value="<?php echo $zbp->Config('Nobird_Spider')->UseSpider;?>" style="width:89%;" class="checkbox"/>对于使用静态化或者缓存插件的用户，本功能无效</td>


</td>
</tr>

</table>
	  <p>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
	  </p>
	</form>
<?php
        $str = '<table width="100%" border="1" class="tableBorder" id="spider">
                <tr>
                    <th scope="col" width="5%" height="32" nowrap="nowrap">序号</th>
                    <th scope="col" width="5%">蜘蛛名称</th>
                    <th scope="col" width="10%">来路IP</th>
                    <th scope="col" width="45%">抓取链接</th>
                    <th scope="col" width="10%">抓取结果</th>
                    <th scope="col" width="15%">来访时间</th>
                </tr>';
$p=new Pagebar('{%host%}zb_users/plugin/Nobird_Seo_Tools/Spider/spider.php?{page=%page%}',false);
$p->PageCount=60; #$zbp->managecount // system default str
$p->PageNow=(int)GetVars('page','GET')==0?1:(int)GetVars('page','GET');
$p->PageBarCount=$zbp->pagebarcount;

        $where = '';
        $order = array('t_ID'=>'DESC');
        $sql= $zbp->db->sql->Select(
        $Nobird_Spider_Table,
        '*',
        $where,
        $order,
	array(($p->PageNow-1) * $p->PageCount,$p->PageCount),
	array('pagebar'=>$p)
        );
        $array=$zbp->GetListCustom($Nobird_Spider_Table,$Nobird_Spider_DataInfo,$sql);
        foreach ($array as $key => $spider) {
            $str .= '<tr>';
            $str .= '<td align="center">'.$spider->ID.'</td>';
            $str .= '<td>'.$spider->spidername.'</td>';
            $str .= '<td>'.$spider->spiderip.'</td>';
            $str .= '<td>'.$spider->url.'</td>';
            $str .= '<td>'.$spider->status.'</td>';
            $str .= '<td>'.date('Y-m-d H:i:s',$spider->dateline).'</td>';
            $str .= '</tr>';
        }
        $str .='</table>';



$str.=  '<p class="pagebar">';

foreach ($p->buttons as $key => $value) {
	$str.= '<a href="'. $value .'">' . $key . '</a>&nbsp;&nbsp;' ;
}

$str.=  '</p>';





        echo $str;
?>




	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/logo.png';?>");</script>	
  </div>
</div>


<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>