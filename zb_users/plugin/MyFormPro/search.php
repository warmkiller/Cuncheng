<?php
require '../../../zb_system/function/c_system_base.php';

require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('MyFormPro')) {$zbp->ShowError(48);die();}
	$fid = (int)GetVars('fid', 'GET');
	$form = new myform_pro_form();
	$form->LoadInfoByID($fid);
$blogtitle='MyFormPro - 查看数据 - '.$form->Name;

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
.ias_trigger {
    background-color: #5cb85c;
    color: #eee !important;
    display: block;
    font-size: 14px;
    line-height: 35px;
    text-align: center;
}
.tr-sort-placeholder{
width:100%;
}

</style> 

<?php
$p=new Pagebar('{%host%}zb_users/plugin/MyFormPro/chart.php?fid='.$fid.'{&page=%page%}{&search=%search%}',false);
$p->PageCount=10; #$zbp->managecount // system default str
$p->PageNow=(int)GetVars('page','GET')==0?1:(int)GetVars('page','GET');
$p->PageBarCount=10;


	$p->UrlRule->Rules['{%search%}']=urlencode(GetVars('search'));


      $str='<table border="1" class="tableFull tableBorder tableBorder-thcenter">
            <tbody>
            <tr class="color1"> ';

      $wherefields = array(array('=','Form_ID',$form->ID));
        $orderfields = array('fileds_Order'=>'ASC','fileds_ID'=>'ASC');

      $sql= $zbp->db->sql->Select($zbp->table['myform_pro_fields'],'*',$wherefields,$orderfields,	null,null);
      $arrayfields=$zbp->GetListCustom($zbp->table['myform_pro_fields'],$GLOBALS['datainfo']['myform_pro_fields'],$sql);
      $str.='<th class="tdCenter">ID</th> ';
      foreach ($arrayfields as $key=>$field){
        //if($key>5){break;}
       $str.='<th class="tdCenter">'.$field->Desc.'</th> ';
      }
       $str.='<th class="tdCenter">提交时间</th> ';
       $str.='<th class="tdCenter">Mark</th> ';
       $str.='<th class="tdCenter">操作</th> ';

      $str.='</tr>';


      $whereinfo = array(array('=','Form_ID',$form->ID));
      $orderinfo = array('Time'=>'DESC');
      $sql= $zbp->db->sql->Select($zbp->table['myform_pro_info'],
                                  '',
                                  $whereinfo,
                                  $orderinfo,
                                  array(($p->PageNow-1) * $p->PageCount,$p->PageCount),
                                  array('pagebar'=>$p)
                                  );
      $arrayinfo=$zbp->GetListCustom($zbp->table['myform_pro_info'],$GLOBALS['datainfo']['myform_pro_info'],$sql);

      foreach ($arrayinfo as $info){
            $str.='<tr>';
            $wherecontent = array(array('=','Info_ID',$info->ID));
            $ordercontent = array('Info_ID'=>'DESC');
            $sql= $zbp->db->sql->Select($zbp->table['myform_pro_contents'],'*',$wherecontent,$ordercontent,null,null);
            $arraycontent=$zbp->GetListCustom($zbp->table['myform_pro_contents'],$GLOBALS['datainfo']['myform_pro_contents'],$sql);
              $str.='<td>'.$info->ID.'</td>';
            foreach ($arraycontent as $key=>$content){
              #if($key>5){break;}
              $content->Content = TransferHTML($content->Content, '[nohtml]');

              $str.='<td>'.$content->Content.'</td>';
            }
       $str.='<td class="tdCenter">'.date('Y-m-d H:i:s',$info->Time).'</td> ';
       if($info->Confirm){
       $str.='<td class="tdCenter"><p id="confirm'.$info->ID.'"><img style="cursor:pointer;" onclick="setinfomark('.$info->ID.')" src="../../../zb_system/image/admin/tick.png" alt="已处理完成" title="已处理完成" width="16" /></p></td> ';
       }else{
       $str.='<td class="tdCenter"><p id="confirm'.$info->ID.'"><img style="cursor:pointer;" onclick="setinfomark('.$info->ID.')" src="../../../zb_system/image/admin/error.png" alt="未处理" title="未处理" width="16" /><p></td> ';

       }

$str.='<td>';

$str.='&nbsp;<a href="'.$zbp->host.'zb_users/plugin/MyFormPro/edit_info.php?info='.$info->ID.'"><img src="../../../zb_system/image/admin/page_edit.png" alt="'.$zbp->lang['msg']['edit'] .'" title="'.$zbp->lang['msg']['edit'] .'" width="16" /></a>&nbsp;';

$str.='<a onclick="return window.confirm(\''.$zbp->lang['msg']['confirm_operating'] .'\');"  href="'.$zbp->host.'zb_users/plugin/MyFormPro/edit_info.php?act=infodel&info='.$info->ID.'"><img src="../../../zb_system/image/admin/delete.png" alt="'.$zbp->lang['msg']['del'] .'" title="'.$zbp->lang['msg']['del'] .'" width="16" /></a>';
$str.='</td>';
            $str.='</tr>';
      }
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
  <table class="tableBorder" width="100%">
<tbody><tr class="color2"><td colspan="5"><a class="ias_trigger" href="<?php echo $zbp->host;?>zb_users/plugin/MyFormPro/edit_fields.php?fid=<?php echo $fid;?>" href="#">回到表单设计</a></td></tr>
</tbody></table>
  
<script type="text/javascript">ActiveLeftMenu("aMyFormPro");</script>
<script type="text/javascript">
function setinfomark(infoid){
    $.post(ajaxurl + "setinfomark",
        {infoid:infoid},
        function(data){
            switch(data.uid){
                case '0':
                  $('p#confirm'+infoid).html('<img style="cursor:pointer;" onclick="setinfomark('+infoid+')" src="../../../zb_system/image/admin/error.png" alt="未处理" title="未处理" width="16" />');
                  break;
                case '1':
                  $('p#confirm'+infoid).html('<img style="cursor:pointer;" onclick="setinfomark('+infoid+')" src="../../../zb_system/image/admin/tick.png" alt="已处理完成" title="已处理完成" width="16" />');
                  break;
            }
            setTimeout('$(".alert").slideUp()',5000);
        }, "json");
    return false;
}
</script>
<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/MyFormPro/logo.png';?>");</script>	
</div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>