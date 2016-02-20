<?php

RegisterPlugin("txqy2","ActivePlugin_txqy2");

function ActivePlugin_txqy2() {
Add_Filter_Plugin('Filter_Plugin_Admin_TopMenu','txqy2_AddMenu');
Add_Filter_Plugin('Filter_Plugin_Edit_Response5','txqy2_Filter_Plugin_Edit_Response5');
}



function txqy2_AddMenu(&$m){
    global $zbp;
    array_unshift($m, MakeTopMenu("root",'村城主题配置',$zbp->host . "zb_users/theme/txqy2/main.php?act=config","","topmenu_txqy2"));
}


function txqy2_Filter_Plugin_Edit_Response5(){
?>
<style>
.txziduan table {
	width: 100%;
}

.txziduan tr td {
	vertical-align: middle;
}
.ias_trigger  {
    background-color: #5cb85c;
    color: #eee !important;
    display: block;
    font-size: 14px;
    line-height: 35px;
    text-align: center;
}
</style>

<?php
		global $zbp,$article;
    echo '<!-- txgzs_diany( -->';
$arraymetasname=array();
$listi=$article->Metas->txgzsa==''?1:$article->Metas->txgzsa;

for ($i = 0; $i <= $listi; $i++)
{
$arraymetasname[]='txdiany'.$i;
} 

	echo '<div class="txziduan">';
	  echo '<table id="nbdiany"><tr>
	<td>产品类型</td>
	<td><input style="width:95%" name="meta_cplx" value="'.$article->Metas->cplx.'"/></td>
	<td  colspan="2" >产品特点</td>	
	<td><input style="width:95%" name="meta_cptd" value="'.$article->Metas->cptd.'"/></td>
	</tr>
	<tr>
	<td>产品简介</td>
	<td><textarea type="text" style="width:95%; height:100px;" name="meta_cpjj" id="meta_cpjj"/>'.$article->Metas->cpjj.'</textarea></td>
	</tr>
	';	
	echo '</table></div>';	
	
    echo '<!-- )txgzs_diany -->';
}

function txqy2_SubMenu($id){
	$arySubMenu = array(
	    0 => array('主题说明', 'config', 'left', false),
	    1 => array('图片上传', 'logo', 'left', false),
		2 => array('SEO设置', 'seo', 'left', false),
		3 => array('首页设置', 'sy', 'left', false),
		4 => array('左侧栏和在线客服', 'lx', 'left', false),
		5 => array('主题配色', 'peis', 'left', false),
	);
	foreach($arySubMenu as $k => $v){
		echo '<a href="?act='.$v[1].'" '.($v[3]==true?'target="_blank"':'').'><span class="m-'.$v[2].' '.($id==$v[1]?'m-now':'').'">'.$v[0].'</span></a>';
	}
}

function txqy2_tags_set(&$template){
	global $zbp;
    $template->SetTags('txqy2_MS',$zbp->Config('txqy2')->PostMS);
    $template->SetTags('txqy2_GJC',$zbp->Config('txqy2')->PostGJC);
	$template->SetTags('txqy2_FLASH',$zbp->Config('txqy2')->PostFLASH);
	$template->SetTags('txqy2_CALL',$zbp->Config('txqy2')->PostCALL);
	$template->SetTags('txqy2_JIANJIE',$zbp->Config('txqy2')->PostJIANJIE);
	$template->SetTags('txqy2_CPID',$zbp->Config('txqy2')->PostCPID);
	$template->SetTags('txqy2_CPSL',$zbp->Config('txqy2')->PostCPSL);
	$template->SetTags('txqy2_SYID1',$zbp->Config('txqy2')->PostSYID1);
	$template->SetTags('txqy2_SYID2',$zbp->Config('txqy2')->PostSYID2);
	$template->SetTags('txqy2_CPLB',$zbp->Config('txqy2')->PostCPLB);
	$template->SetTags('txqy2_LXWM',$zbp->Config('txqy2')->PostLXWM);
	$template->SetTags('txqy2_FX',$zbp->Config('txqy2')->PostFX);
	$template->SetTags('txqy2_clkg',$zbp->Config('txqy2')->clkg);
	$template->SetTags('txqy2_QQ',$zbp->Config('txqy2')->PostQQ);
	$template->SetTags('txqy2_kfkg',$zbp->Config('txqy2')->kfkg);
	$template->SetTags('txqy2_zhuse',$zbp->Config('txqy2')->zhuse);
	$template->SetTags('txqy2_fuse',$zbp->Config('txqy2')->fuse);
	$template->SetTags('txqy2_hong',$zbp->Config('txqy2')->hong);
	$template->SetTags('txqy2_wzys',$zbp->Config('txqy2')->wzys);
	$template->SetTags('txqy2_ljys',$zbp->Config('txqy2')->ljys);
	$template->SetTags('txqy2_hdys',$zbp->Config('txqy2')->hdys);
}

function InstallPlugin_txqy2(){
	global $zbp;
	if(!$zbp->Config('txqy2')->HasKey('Version')){
		$zbp->Config('txqy2')->Version = '1.0';
		$zbp->Config('txqy2')->PostMS = '网站描述';
		$zbp->Config('txqy2')->PostGJC = '网站关键词';
		$zbp->Config('txqy2')->PostFLASH = '<li><a href="#"><img src="{#ZC_BLOG_HOST#}zb_users/theme/txqy2/style/img/ad1.png" alt=""></a><p class="caption"><a href="#">标题1</p></li><li><a href="#"><img src="{#ZC_BLOG_HOST#}zb_users/theme/txqy2/style/img/ad2.png" alt=""></a><p class="caption"><a href="#">标题2</a></p></li>';
        $zbp->Config('txqy2')->hdpkg = '0';
        $zbp->Config('txqy2')->PostCALL = '400-400-8888';
        $zbp->Config('txqy2')->PostJIANJIE = '首页简介，请在后台--天兴主题配置--首页设置--关于我们自行修改。';
		$zbp->Config('txqy2')->PostCPID = '1';
		$zbp->Config('txqy2')->PostCPSL = '4';
		$zbp->Config('txqy2')->PostSYID1 = '1';
		$zbp->Config('txqy2')->PostSYID2 = '1';
		$zbp->Config('txqy2')->PostCPLB = '<li><a href="#">产品名称1</a></li><li><a href="#">产品名称2</a></li><li><a href="#">产品名称3</a></li><li><a href="#">产品名称4</a></li><li><a href="#">产品名称5</a></li>';
		$zbp->Config('txqy2')->PostLXWM = '<p>左侧栏 联系方式，请在后台--天兴主题配置-左侧栏里面自行修改</p>';
		$zbp->Config('txqy2')->PostFX = '在这里粘贴你的在线分享代码';
		$zbp->Config('txqy2')->clkg = '1';
		$zbp->Config('txqy2')->PostQQ = '1109856918';
		$zbp->Config('txqy2')->kfkg = '1';
		$zbp->Config('txqy2')->zhuse = '000000';
		$zbp->Config('txqy2')->fuse = '44BC8F';
		$zbp->Config('txqy2')->hong = 'E41752';
		$zbp->Config('txqy2')->wzys = '333333';
		$zbp->Config('txqy2')->ljys = '222222';
		$zbp->Config('txqy2')->hdys = 'cc0000';	
		$zbp->SaveConfig('txqy2');
	}
}

//卸载主题
function UninstallPlugin_txqy2(){
	global $zbp;
}




?>