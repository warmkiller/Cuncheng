<?php
#注册插件
RegisterPlugin("txtop","ActivePlugin_txtop");

function ActivePlugin_txtop() {
	Add_Filter_Plugin('Filter_Plugin_Zbp_MakeTemplatetags','txtop_Zbp_MakeTemplatetags');
}

function txtop_Zbp_MakeTemplatetags() {
	global $zbp;

	$config = array(
		"qqhm" => $zbp->Config('txtop')->qqhm,
		"yxdz" => $zbp->Config('txtop')->yxdz,
		"mrys" => $zbp->Config('txtop')->mrys,
		"hgys" => $zbp->Config('txtop')->hgys,
		"ybj" => $zbp->Config('txtop')->ybj,
		"xbj" => $zbp->Config('txtop')->xbj,
		"sybj" => $zbp->Config('txtop')->sybj,
		"sxbj" => $zbp->Config('txtop')->sxbj,
		"qqkg" => $zbp->Config('txtop')->qqkg,
		"wxkg" => $zbp->Config('txtop')->wxkg,
		"yxkg" => $zbp->Config('txtop')->yxkg,
	);

	$zbp->header .=  '<link rel="stylesheet" type="text/css" href="'.$zbp->host.'zb_users/plugin/txtop/style/txcstx.css"/>' . "\r\n";
	$zbp->header .=  '<style type="text/css">#tbox{bottom: ' . $config["xbj"] . 'px;right: ' . $config["ybj"] . 'px;}#pinglun,#xiangguan,#gotop,#weix{background-color: #' . $config["mrys"] . ';} #pinglun:hover,#xiangguan:hover,#gotop:hover,#weix:hover{background-color: #' . $config["hgys"] . ';}@media screen and (max-width: 720px){#tbox{bottom: ' . $config["sxbj"] . 'px;right: ' . $config["sybj"] . 'px;}}</style>' . "\r\n";
	$zbp->footer .=  '<script language="javascript" src="'.$zbp->host.'zb_users/plugin/txtop/js/txtop.js"></script>' . "\r\n";
    $zbp->footer .=  '<div id="tbox">';
    $zbp->footer .=  '<a id="gotop" href="javascript:void(0)" title="回到顶部"></a>';
if ($zbp->Config('txtop')->wxkg){
    $zbp->footer .=  '<a id="weix" class="signin" href="javascript:void(0)"></a> ';
    $zbp->footer .=  '<div style="display: none;" id="signin_menu"><img src="'.$zbp->host.'zb_users/plugin/txtop/img/zfb.png" alt="扫描即可关注我们"></div>';
}
if ($zbp->Config('txtop')->qqkg){
    $zbp->footer .=  '<a id="pinglun" href="http://wpa.qq.com/msgrd?v=3&uin=' . $config["qqhm"] . '&site=qq&menu=yes" target="_blank" title="通过QQ联系我们"  rel="nofollow"></a>';
}
if ($zbp->Config('txtop')->yxkg){
    $zbp->footer .=  '<a id="xiangguan"  href="' . $config["yxdz"] . '"  target="_blank" ></a>';
}
    $zbp->footer .=  '</div>' . "\r\n";

}

function InstallPlugin_txtop() {
    global $zbp,$obj,$bucket;
    //配置初始化
    if (!$zbp->Config('txtop')->HasKey('version')) {
        $zbp->Config('txtop')->version = '1.0';
        $zbp->Config('txtop')->qqhm = '1109856918';
		$zbp->Config('txtop')->yxdz = '#';
		$zbp->Config('txtop')->mrys = '0099cc';
		$zbp->Config('txtop')->hgys = 'ff6f3d';
		$zbp->Config('txtop')->xbj = '35';
		$zbp->Config('txtop')->ybj = '10';
		$zbp->Config('txtop')->sxbj = '10';
		$zbp->Config('txtop')->sybj = '10';
		$zbp->Config('txtop')->wxkg = '1';
		$zbp->Config('txtop')->yxkg = '1';
		$zbp->Config('txtop')->qqkg = '1';
        $zbp->SaveConfig('txtop');
    }

}

function UninstallPlugin_txtop() {
	global $zbp;
//	$zbp->DelConfig('txtop');
}