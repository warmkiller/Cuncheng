<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('os_qq')) {$zbp->ShowError(48);die();}

$blogtitle='QQ互联配置';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
if(isset($_POST['qqappid'])){
    $array = array('qqappid','qqappkey','meta');
        foreach ($array as $value) {
            $zbp->Config('os_qq')->$value = $_POST[$value];
        }
    $zbp->SaveConfig('os_qq');
    $zbp->ShowHint('good');
}

?>

<style>
.os_qq tr h3 {width:100%;display:block;font-size:16px;color:#555;}
.os_qq textarea {border:1px solid #aaa;width:97%;min-height:30px;margin:0.5%;padding:1%;font-size:14px;transition: all .3s ease-in-out;-webkit-transition: all .3s ease-in-out;-moz-transition: all .3s ease-in-out;-o-transition: all .3s ease-in-out;outline:none;}
.os_qq textarea:focus {border:1px solid #eee;-webkit-box-shadow:0 0 5px #18efdf;-moz-box-shadow:0 0 5px #18efdf;box-shadow:0 0 5px #18efdf;}
.os_qq input {border:1px solid #aaa;width:97%;margin:0.5%;padding:1%;font-size:14px;transition: all .3s ease-in-out;-webkit-transition: all .3s ease-in-out;-moz-transition: all .3s ease-in-out;-o-transition: all .3s ease-in-out;outline:none;}
.os_qq input:focus {border:1px solid #eee;-webkit-box-shadow:0 0 5px #18efdf;-moz-box-shadow:0 0 5px #18efdf;box-shadow:0 0 5px #18efdf;}
.os_qq input.button {margin:0 auto;width:80px;height:30px;line-height:0px;text-align:center;font-size:14px;background:#555;color:#fff;}
.os_qq input.button:hover {background:#f60;color#fff;}
.os_qq input.radio {width:auto;}
</style>

<div id="divMain">
    <div class="divHeader"><?php echo $blogtitle;?></div>
    <div id="divMain2">
    <div class="os_qq">
        <form method="post">
            <table width="100%" style='padding:0;margin:0;' cellspacing='0' cellpadding='0' class="tableBorder">
                <tr width="100%">
                    <th width="20%">配置项</th>
                    <th width="79%">配置内容</th>
                </tr>
                <tr width="100%">
                    <td>appid</td><td><input name="qqappid" type="text" value="<?php echo $zbp->Config('os_qq')->qqappid; ?>" /></td>
                </tr>
                <tr width="100%">
                    <td>appkey</td><td><input name="qqappkey" type="text" value="<?php echo $zbp->Config('os_qq')->qqappkey; ?>" /></td>
                </tr>
                <tr width="100%">
                    <td>Meta验证</td><td><textarea name="meta"><?php echo $zbp->Config('os_qq')->meta; ?></textarea></td>
                </tr>
            </table>
            <br />
            <input type="Submit" class="button" name="" value="保存" />
        </form>
        <br />
        <p>没有appid和appkey?去<a href="http://connect.qq.com/" target="_blank">QQ互联</a>申请吧</p>
        <p>请复制下面的回调地址放到QQ互联中的回调地址设定中,请把不带WWW和带WWW的地址都填入其中,避免回调地址不一致</p><textarea rows="1"><?php echo $zbp->host; ?>zb_users/plugin/os_qq/login.php</textarea>
        <br />
        <?php
		$str = '<table width="100%" border="1" class="tableBorder">
				<tr>
					<th scope="col" width="5%" height="32" nowrap="nowrap">序号</th>
					<th scope="col" width="10%">绑定用户</th>
					<th scope="col" width="15%">操作</th>
				</tr>';
		$sql= $zbp->db->sql->Select($table['os_qq'],'*',null,null,null,null);
		$array=$zbp->GetListCustom($table['os_qq'],$dataInfo['os_qq'],$sql);
		$i = 1;
		foreach ($array as $key => $reg) {
			$str .= '<form action="#" method="post" name="keyword">';
			$str .= '<tr>';
			$str .= '<td align="center">'.$i.'</td>';
			$userid=$reg->uid;
			if($userid==''){$username="无绑定";}
			else{$username=$zbp->members[$userid]->StaticName;}
			$str .= '<td>'.$username.'</td>';
			$str .= '<td nowrap="nowrap">
						<input name="del" type="button" class="button" value="解除绑定" onclick="if(confirm(\'您确定要进行解除操作吗？\')){location.href=\'cmd.php?id='.$reg->id.'\'}"/>
					</td>';
			$str .= '</tr>';
			$str .= '</form>';
			$i++;
		}
		$str .='</table>';
		echo $str;
        ?>
	</div>
	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>

  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>