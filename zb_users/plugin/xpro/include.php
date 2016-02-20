<?php
#注册插件
RegisterPlugin("xpro","ActivePlugin_xpro");

function ActivePlugin_xpro() {
	Add_Filter_Plugin('Filter_Plugin_Zbp_MakeTemplatetags','xpro_main');
}

function xpro_main() {
	global $zbp;
	$zbp->header .= '<script type="text/javascript" src="http://meet.xpro.im/v2/api/xmeet.api.js?xnest='.$zbp->host.'&xnest_name='.$zbp->host.'"></script>' . "\r\n";
}

function InstallPlugin_xpro() {

}

function UninstallPlugin_xpro() {

}