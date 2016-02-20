<?php
require '../../../zb_system/function/c_system_base.php';

require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('MyFormPro')) {$zbp->ShowError(48);die();}

$blogtitle='MyFormPro - 字段设计';

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

	$fid = (int)GetVars('fid', 'GET');
	#if(!$fid){die('参数错误 !');}
	$form = new myform_pro_form();
	$form->LoadInfoByID($fid);


if(GetVars('act','GET') == 'fieldssave') {
  $id=(int)GetVars('ID', 'POST');
	$field = new myform_pro_fields();
	$field->LoadInfoByID($id);
	foreach ($zbp->datainfo['myform_pro_fields'] as $key => $value) {
		if (isset($_POST[$key])) {
			$field->$key = GetVars($key, 'POST');
		}
	}
$field->Save();
	$zbp->SetHint('good');
	Redirect('./edit_fields.php?fid='.$field->Form_ID);

}elseif(GetVars('act','GET') == 'fieldsdel'){
  $id=(int)GetVars('id', 'GET');
	$field = new myform_pro_fields();
	$field->LoadInfoByID($id);
  $field->Del();
	$zbp->SetHint('good');
	Redirect('./edit_fields.php?fid='.$fid);
}


?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle.' - '.$form->Name;?></div>
  <div class="SubMenu"><?php MyFormPro_SubMenu()?>
  </div>
  <div id="divMain2">
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
<form action="edit_fields.php?act=fieldssave" method="post">
                <table width="100%" border="1" class="tableBorder" id="fieldlist">
                <tr>
                    <th scope="col" width="2%" height="32" nowrap="nowrap">序号</th>
                    <th scope="col" width="5%">描述</th>
                    <th scope="col" width="9%">单选/多选项</th>
                    <th scope="col" width="2%">长度限制</th>
                    <th scope="col" width="2%">排序</th>
                    <th scope="col" width="2%">是否检查</th>
                    <th scope="col" width="5%">检查类型</th>
                    <th scope="col" width="6%">显示类型</th>
                    <th scope="col" width="2%">是否显示</th>
                    <th scope="col" width="8%">操作</th>
                </tr>
<tr>
<td align="center">0</td>
<td><input type="text" class="sedit"  name="Desc" value=""></td>
<td><input type="text" class="sedit"  name="Content" value=""></td>
<td><input type="text" class="sedit"  name="Length" value="20" ></td>
<td><input type="text" class="sedit"  name="Order" value="0" ></td>
<td><input type="text" class="checkbox" name="Check" value="0" /></td>
<td>
<select name="Type">
						<option value="1">用户名</option>
						<option value="2">密码</option>
						<option value="3">电子邮箱</option>
						<option value="4">网址</option>
						<option value="5">必须包含中文</option>
						<option value="6">纯中文</option>
						<option value="7">纯数字</option>
						<option value="8">纯英文</option>
						<option value="9">单纯必填项</option>
					</select>
</td>
<td>
<select name="ShowType">
						<option value="1">单行文本框</option>
						<option value="2">多行文本框</option>
						<option value="3">单选框</option>
						<option value="4">多选框</option>
						<option value="5">ON/OFF按钮</option>
						<option value="6">上传附件</option>
						<option value="7">下拉菜单</option>
						<option value="8">多行文本框(富文本)</option>
					</select>


</td>
<td><input type="text" class="checkbox" name="Show" value="1" /></td>
<td><input type="hidden" class="sedit" name="ID" value="">
<input type="hidden" name="Form_ID" value="<?php echo $fid;?>">

<input name="add" type="submit" class="button" value="增加"/></td>
</tr>
</form>
<?php
$str = '';
      $where = array(array('=','Form_ID',$fid));
        $order = array('fileds_Order'=>'ASC','fileds_ID'=>'ASC');
        $sql= $zbp->db->sql->Select($zbp->table['myform_pro_fields'],'*',$where,$order,null,null);
        $array=$zbp->GetListCustom($zbp->table['myform_pro_fields'],$GLOBALS['datainfo']['myform_pro_fields'],$sql);
        $i =1;
        foreach ($array as $key => $fields) {
            $str .= '<form action="#" method="post" id="fieldform'.$fields->ID.'">';
            $str .= '<tr>';
            $str .= '<td align="center">'.$i.'</td>
                    <td><input type="text" class="sedit"  name="Desc" value="'.$fields->Desc.'"></td>
                    <td><input type="text" class="sedit"  name="Content" value="'.$fields->Content.'"></td>';
           $str .= '<td><input type="text" class="sedit"  name="Length" value="'.$fields->Length.'" ></td>
                    <td><input type="text" class="sedit"  name="Order" value="'.$fields->Order.'" ></td>';
           $str.='<td><input type="text" class="checkbox" name="Check" value="'.$fields->Check.'" /></td>';
           $str.='<td><select name="Type">
                  <option value="1" '.(($fields->Type=="1")?"selected":"").'>用户名</option>
                  <option value="2" '.(($fields->Type=="2")?"selected":"").'>密码</option>
                  <option value="3" '.(($fields->Type=="3")?"selected":"").'>电子邮箱</option>
                  <option value="4" '.(($fields->Type=="4")?"selected":"").'>网址</option>
                  <option value="5" '.(($fields->Type=="5")?"selected":"").'>必须包含中文</option>
                  <option value="6" '.(($fields->Type=="6")?"selected":"").'>纯中文</option>
                  <option value="7" '.(($fields->Type=="7")?"selected":"").'>纯数字</option>
                  <option value="8" '.(($fields->Type=="8")?"selected":"").'>纯英文</option>
                  <option value="9" '.(($fields->Type=="9")?"selected":"").'>单纯必填项</option>
                  </select>
                  </td>';
          $str.='<td>
          <select name="ShowType">
                      <option value="1" '.(($fields->ShowType=="1")?"selected":"").'>单行文本框</option>
                      <option value="2" '.(($fields->ShowType=="2")?"selected":"").'>多行文本框</option>
                      <option value="3" '.(($fields->ShowType=="3")?"selected":"").'>单选框</option>
                      <option value="4" '.(($fields->ShowType=="4")?"selected":"").'>多选框</option>
                      <option value="5" '.(($fields->ShowType=="5")?"selected":"").'>ON/OFF按钮</option>
                      <option value="6" '.(($fields->ShowType=="6")?"selected":"").'>上传附件</option>
                      <option value="7" '.(($fields->ShowType=="7")?"selected":"").'>下拉菜单</option>
                      <option value="8" '.(($fields->ShowType=="8")?"selected":"").'>多行文本框(富文本)</option>

                    </select></td>';
            $str.='<td><input type="text" class="checkbox" name="Show" value="'.$fields->Show.'" /></td>';
            $str .= '<td nowrap="nowrap">
                        <input type="hidden" name="ID" value="'.$fields->ID.'">
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <span id="change'.$fields->ID.'" style="width:45%">
                        <img style="cursor:pointer;" onclick="mfp_changefield('.$fields->ID.')"  src="../../../zb_users/plugin/MyFormPro/images/arrow_refresh.png" alt="修改" title="修改" width="16" /></span>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <span id="delete'.$fields->ID.'" style="width:45%">
                        <img style="cursor:pointer;" onclick="mfp_fielddel('.$fields->ID.')"  src="../../../zb_system/image/admin/delete.png" alt="'.$zbp->lang['msg']['del'] .'" title="'.$zbp->lang['msg']['del'] .'" width="16" /></span>
                    </td>';
            $str .= '</tr>';
            $str .= '</form>';
            $i++;
        }
        $str .='</table>';
        echo $str;
?>




<br />
 <table class="tableBorder" width="100%">
<tbody><tr class="color2"><td colspan="5"><a class="ias_trigger" target="_blank" href="<?php echo $zbp->host;?>zb_users/plugin/MyFormPro/view.php?fid=<?php echo $fid;?>" href="#">点击这里预览表单</a></td></tr>
</tbody></table>
  
<script type="text/javascript">ActiveLeftMenu("aMyFormPro");</script>
<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/MyFormPro/logo.png';?>");</script>	
<script type="text/javascript">
function mfp_changefield(fieldid){
    $('span#change'+fieldid).html('<img src="../../../zb_system/image/admin/loading.gif" alt="更改中……" title="更改中……" width="16" />');
    $.post(ajaxurl + "mfp_changefield",
        $("#fieldform"+fieldid).serialize(),
        function(data){
          $('span#change'+fieldid).html('<img style="cursor:pointer;" onclick="mfp_changefield('+fieldid+')"  src="../../../zb_users/plugin/MyFormPro/images/arrow_refresh.png" alt="修改" title="修改" width="16" />');
        }, "json");
    return false;
}

function mfp_fielddel(fieldid){
if(confirm("确认删除?")){
    $.post(ajaxurl + "mfp_fielddel",
        {fieldid:fieldid},
        function(data){
            $('span#delete'+fieldid).parent().parent().fadeOut(1500);
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