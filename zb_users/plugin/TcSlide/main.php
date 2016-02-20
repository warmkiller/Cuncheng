<?php

require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();

if (!$zbp->CheckRights('root')) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('TcSlide')) {$zbp->ShowError(48);die();}

$blogtitle='幻灯片';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<link href="source/evol.colorpicker.css" rel="stylesheet" />
<script src="source/evol.colorpicker.min.js" type="text/javascript"></script>
<script src="source/custom.js" type="text/javascript"></script>
<?php
if ($zbp->CheckPlugin('UEditor')) {
?>
<script type="text/javascript" src="<?php echo $zbp->host;?>zb_users/plugin/UEditor/ueditor.config.php"></script>
<script type="text/javascript" src="<?php echo $zbp->host;?>zb_users/plugin/UEditor/ueditor.all.min.js"></script>
<?php
}
?>
<div id="divMain">
<div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu">
<a href="main.php" target="_blank"><span>幻灯片管理</span></a>
        <a href="save.php?type=clearmoudle"><span class="m-left" style="color:#00F">清除多余模块</span></a>
        <a href="http://www.songzhenjiang.cn/" target="_blank"><span class="m-right">帮助</span></a>
    </div>
<?php
        $str = '<form action="save.php?type=flash" method="post">
                <table width="100%" border="1" class="tableBorder">
                <tr>
                    <th scope="col" width="5%" height="32" nowrap="nowrap">序号</th>
                    <th scope="col" width="25%">标题</th>
                    <th scope="col" width="25%">图片</th>
                    <th scope="col" width="20%">链接</th>
                    <th scope="col" width="10%">背景颜色</th>
                    <th scope="col" width="5%">排序</th>
                    <th scope="col" width="5%">显示</th>
                    <th scope="col" width="10%">操作</th>
                </tr>';
        $str .= '<tr>';
        $str .= '<td align="center">0</td>';
        $str .= '<td><input type="text" class="sedit" name="title" value=""></td>';
        $str .= '<td>
                                <input  type="hidden"  id="url_updatapic2" name="img"  value="" />
                                <img src="" width="190" height="120" border="0" alt="" id="pic_updatapic2">
                                <input type="button"  id="updatapic2" class="button" value="更换图片" />
        </td>';
        $str .= '<td><input type="text" class="sedit" name="url" value=""></td>';
        $str .= '<td><input  id="colorP1" name="code"  value="" /></td>';
        $str .= '<td><input type="text" name="order" value="99" style="width:40px"></td>';
        $str .= '<td><input type="text" class="checkbox" name="IsUsed" value="1" /></td>';
        $str .= '<td><input type="hidden" name="editid" value="">
                        <input name="add" type="submit" class="button" value="增加"/></td>';
        $str .= '</tr>';
        $str .= '</form>';
        $where = array(array('=','sean_Type','0'));
        $order = array('sean_IsUsed'=>'DESC','sean_Order'=>'ASC');
        $sql= $zbp->db->sql->Select($TcSlide_Table,'*',$where,$order,null,null);
        $array=$zbp->GetListCustom($TcSlide_Table,$TcSlide_DataInfo,$sql);
        $i =1;
        foreach ($array as $key => $reg) {
            $str .= '<form action="save.php?type=flash" method="post" name="flash">';
            $str .= '<tr>';
            $str .= '<td align="center">'.$i.'</td>';
            $str .= '<td><input type="hidden" name="title" value="'.$reg->Title.'" >'.$reg->Title.'</td>';
            $str .= '<td><input  type="hidden"  name="img"  value="'.$reg->Img.'" /><img src="'.$reg->Img.'" width="190" height="120" border="0"></td>';
            $str .= '<td><input type="hidden" name="url" value="'.$reg->Url.'" >'.$reg->Url.'</td>';
            $str .= '<td><div class="evo-colorind" style="background-color:'.$reg->Code.'"></div></td>';
            $str .= '<td><input type="text" class="sedit" name="order" value="'.$reg->Order.'" style="width:40px"></td>';
            $str .= '<td><input type="text" class="checkbox" name="IsUsed" value="'.$reg->IsUsed.'" /></td>';
            $str .= '<td nowrap="nowrap">
                        <input type="hidden" name="editid" value="'.$reg->ID.'">
                        <input name="edit" type="submit" class="button" value="修改"/>
                        <input name="del" type="button" class="button" value="删除" onclick="if(confirm(\'您确定要进行删除操作吗？\')){location.href=\'save.php?type=flashdel&id='.$reg->ID.'\'}"/>
                    </td>';
            $str .= '</tr>';
            $str .= '</form>';
            $i++;
        }
        $str .='</table>';
        echo $str;
?>

<textarea name="ueimg" id="ueimg" style="display:none"></textarea>
 <div id="divMain2">
	<script type="text/javascript">ActiveLeftMenu("aFileSystem");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_system/image/common/file_1.png';?>");</script>	
</div>
</div>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>