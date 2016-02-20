<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('MyFormPro')) {$zbp->ShowError(48);die();}
require $blogpath . 'zb_system/admin/admin_header.php';

	$fid = (int)GetVars('fid', 'GET');
	$form = new myform_pro_form();
	$form->LoadInfoByID($fid);
	
  $wherefields = array(
                      array('=','Form_ID',$form->ID),
                      );
  $orderfields = array('fileds_Order'=>'ASC','fileds_ID'=>'ASC');
  $sql= $zbp->db->sql->Select($zbp->table['myform_pro_fields'],'*',$wherefields,$orderfields,	null,null);
  $arrayfields=$zbp->GetListCustom($zbp->table['myform_pro_fields'],$GLOBALS['datainfo']['myform_pro_fields'],$sql);

  $str='';
    $str.='	<form name="hidfieldform" id="hidfieldform" action="#" method="post">

    <table border="1" class="tableFull tableBorder tableBorder-thcenter">
            <tbody>';
    $str.='<tr>
    <th>是否需要隐藏?</th><th>字段</th>
            </tr>';
  foreach ($arrayfields as $key=>$field){
      if(stristr($form->BackList,$field->ID)){
        $str.='<tr>
                  <td class="td50"><input name="hidfields[]" checked value="'.$field->ID.'" type="checkbox"/></td>
                  <td class="td50">'.$field->Desc.'</td>
              </tr>';
      }else{
        $str.='<tr>
                  <td><input name="hidfields[]" value="'.$field->ID.'" type="checkbox"/></td>
                  <td>'.$field->Desc.'</td>
              </tr>';
      }
  }
  $str.='			<tr>
				<td><input type="hidden" value="'.$form->ID.'" name="fid"/></td>
				<td><input type="button" class="submithidfield" onclick="mfp_hidfieldsave()" name="submit" value="提 交" /></td>
			</tr>
		</table>
	</form>';
  
  echo $str;
?>

<script type="text/javascript">
function mfp_hidfieldsave(fieldid){
    $('input.submithidfield').val('保存中……');
    $.post(ajaxurl + "mfp_hidfieldsave",
        $("#hidfieldform").serialize(),
        function(data){
            $('input.submithidfield').val('提 交');
        }, "json");
    return false;
}
</script>

<?php  
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();