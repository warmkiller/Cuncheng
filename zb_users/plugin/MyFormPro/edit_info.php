<?php
require '../../../zb_system/function/c_system_base.php';

require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('MyFormPro')) {$zbp->ShowError(48);die();}

$blogtitle='MyFormPro - 表单编辑';

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

	$infoid = (int)GetVars('info', 'GET');
	$info = new myform_pro_info();
	$info->LoadInfoByID($infoid);

  $form = new myform_pro_form();
  $fid=$info->Form_ID;
	$form->LoadInfoByID($fid);


if(GetVars('act','GET') == 'infosave') {

  $where = array(array('=','Form_ID',$form->ID));
  $order = array('fileds_Order'=>'ASC','fileds_ID'=>'DESC');//POST DATA REVERSE 
  $sql= $zbp->db->sql->Select($zbp->table['myform_pro_fields'],'*',$where,$order,null,null);
  $arrayfields=$zbp->GetListCustom($zbp->table['myform_pro_fields'],$GLOBALS['datainfo']['myform_pro_fields'],$sql);

///////////////////////////////////////////////////////////DOUBI STUDIO。。。。
foreach ($arrayfields as $key=>$field){
        $wherecontents=array(
        array('=','Form_ID',$form->ID),
        array('=','Field_ID',$field->ID),
        array('=','Info_ID',$info->ID),
        );
        $sql= $zbp->db->sql->Select($zbp->table['myform_pro_contents'],'*',$wherecontents,null,null,null);
        #var_dump($sql);
        $editcontent=$zbp->GetListCustom($zbp->table['myform_pro_contents'],$GLOBALS['datainfo']['myform_pro_contents'],$sql);

//1、后台提交允许留空
  if(($field->Check==true)&&(!isset($_POST['mfp_'.$field->ID])||($_POST['mfp_'.$field->ID]==''))){
      $_POST['mfp_'.$field->ID]=='';
  }
	$arraycontent=array();

//2、内容为空处理
      if($field->ShowType==4){       // 多选处理
        if (!isset($_POST['mfp_'.$field->ID])){
          $_POST['mfp_'.$field->ID]=array('未填写');	
        }  
        $string=implode('|',$_POST['mfp_'.$field->ID]);
        $arraycontent[$field->ID]=$string;	
      }else{
        if (!isset($_POST['mfp_'.$field->ID])){
          $_POST['mfp_'.$field->ID]='未填写';	
        }      
        $arraycontent[$field->ID]=trim($_POST['mfp_'.$field->ID]);	
	    }
	    if($field->ShowType==5){
	    if($arraycontent[$field->ID]=='0'){
	      $arraycontent[$field->ID]='off';	
	      }else{
	      $arraycontent[$field->ID]='on';	
	      
	      }
	    }
 
	    $content=new myform_pro_contents();
      $content->LoadInfoByID($editcontent[0]->ID);
	    $content->Form_ID=$form->ID;
	    $content->Field_ID=$field->ID;
	    $content->Info_ID=$info->ID;
	    $content->Content=$arraycontent[$field->ID];
	   //     var_dump($content);

	    
//3、后台提交 不做类型检查和过滤
	    $content->Save();

	 
	}
///////////////////////////////////////////////////////////

	$zbp->SetHint('good');
	Redirect('./chart.php?fid='.$fid);

}


?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
  <div class="SubMenu"><?php MyFormPro_SubMenu()?>
  </div>
  <div id="divMain2">
  <style type="text/css">
table {table-layout:fixed;}
td {white-space:nowrap;overflow:hidden;}
</style> 
<?php
$str = '';
      $where = array(
                    array('=','Form_ID',$fid),
                    array('=','fileds_Show',true)
                    );
        $order = array('fileds_ID'=>'ASC','fileds_Order'=>'ASC');
        $sql= $zbp->db->sql->Select($zbp->table['myform_pro_fields'],'*',$where,$order,null,null);
        $array=$zbp->GetListCustom($zbp->table['myform_pro_fields'],$GLOBALS['datainfo']['myform_pro_fields'],$sql);
        $i =1;
        $str .= '<form action="edit_info.php?act=infosave&amp;info='.$info->ID.'" method="post">';
        $str .='<table width="100%" class="tableBorder"><tbody>';
        $str.='<tr>
       <td class="td25">第一次提交时间：</td>
				<td>'.date('Y-m-d H:i:s',$info->Time).'</td>
			</tr>';
        $str.='<tr>
       <td class="td25">IP地址</td>
				<td>'.$info->IP.'</td>
			</tr>';
        foreach ($array as $key => $fields) {
        $wherecontents=array(
        array('=','Form_ID',$form->ID),
        array('=','Field_ID',$fields->ID),
        array('=','Info_ID',$info->ID),
        );
        $sql= $zbp->db->sql->Select($zbp->table['myform_pro_contents'],'*',$wherecontents,null,null,null);
        #var_dump($sql);
        $array=$zbp->GetListCustom($zbp->table['myform_pro_contents'],$GLOBALS['datainfo']['myform_pro_contents'],$sql);
                
        
            $str .='<tr class="color2">
            <td align="left" class="td25"><b>'.$fields->Desc.'</b></td>';

		########################################################################################################
    switch ($fields->ShowType) {
		case '1':
    $str .='<td><input type="text" value="'.$array[0]->Content.'" name="mfp_'.$fields->ID.'" class="txt txt-sho"> </td>';         
		break;
		case '2':
    $str .='<td><textarea class="txt txt-lar" name="mfp_'.$fields->ID.'">'.$array[0]->Content.'</textarea></td>';         
		break;		
		case '3':
    $str .='<td>';
		$ar=explode('|',$fields->Content);
				foreach ($ar as $r) {
          if(stristr($array[0]->Content,$r)){
            $str .='<label><input name="mfp_'.$fields->ID.'" value="'.htmlspecialchars($r).'" checked type="radio"/>'.$r.'</label> ';
          }else{
            $str .='<label><input name="mfp_'.$fields->ID.'" value="'.htmlspecialchars($r).'" type="radio"/>'.$r.'</label> ';
          }
				}
    $str .='</td>';         
		break;
    case '4':
    $str .='<td>';
		$ar=explode('|',$fields->Content);
   // if(!is_array($object->Metas->$value))$object->Metas->$value=array();
				foreach ($ar as $r) {
				if(stristr($array[0]->Content,$r)){
					$str .='<label><input name="mfp_'.$fields->ID.'[]" value="'.htmlspecialchars($r).'" checked type="checkbox"/>'.$r.'</label>';
				}else{
					$str .='<label><input name="mfp_'.$fields->ID.'[]" value="'.htmlspecialchars($r).'" type="checkbox"/>'.$r.'</label>';
				}
				}
    $str .='</td>';         
		break;		
		case '5':
		if($array[0]->Content=='on'){
    $str .='<td><input type="text"  name="mfp_'.$fields->ID.'" value="1" style="width:89%;" class="checkbox"/> </td>';         
		}else{
    $str .='<td><input type="text"  name="mfp_'.$fields->ID.'" value="0" style="width:89%;" class="checkbox"/> </td>';         

		}
		break;		
		case '6':
    $str .='<td><input type="hidden" value="'.$array[0]->Content.'" name="mfp_'.$fields->ID.'" class="txt txt-sho">
    <a target="_blank" href="'.$zbp->host.'zb_users/upload/'.$array[0]->Content.'">点击下载</a>
     </td>';         
//    $str .='<td><input name="mfp_'.$fields->ID.'" type="file"/></td>';         
		break;
		case '7':
		$ar=explode('|',$fields->Content);
		$str .= '<td><select name="mfp_'.$fields->ID.'">';
        foreach($ar as $r) {
        if($array[0]->Content==$r){
       
          $str .= '<option selected value="'.htmlspecialchars($r).'">'.$r.'</option>';

        }else{
          $str .= '<option value="'.htmlspecialchars($r).'">'.$r.'</option>';
        }
        }
		$str .= '</select>';
        
    $str .='</td>';         
		break;
    case '8':
    $str .='<td><textarea id="mfp_richtext" class="txt txt-lar" name="mfp_'.$fields->ID.'">'.TransferHTML($array[0]->Content,'[html-format]').'</textarea></td>';         
		break;	
		}########################################################################################################
            
            
          $str .='</tr>';
          
          }
        
        

      echo $str;  
?>
       <tr class="color3">
				<td>&nbsp;</td>
				<td><input type="submit" value="保 存" onclick="check_editor()" name="submit">
<input type="button" onclick='location.href="<?php echo $zbp->host;?>zb_users/plugin/MyFormPro/chart.php?fid=<?php echo $fid;?>"'  value="返 回" name="返 回">
				</td>
			</tr>

		</tbody></table>
	</form>
<br />
 
  
<script type="text/javascript">ActiveLeftMenu("aMyFormPro");</script>
<script type="text/javascript">ActiveTopMenu("topmenu_MyFormPro");
function check_editor(){
var content =  tinymce.activeEditor.getContent();
//console.log(content);
$("#mfp_richtext").text(content);
}

</script>
    <script src="<?php echo $zbp->host;?>zb_users/plugin/MyFormPro/script/admin_js_add.php"></script>

	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/MyFormPro/logo.png';?>");</script>	
</div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>