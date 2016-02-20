<?php
#注册插件
RegisterPlugin("LazyLoad","ActivePlugin_LazyLoad");

function ActivePlugin_LazyLoad() {
	Add_Filter_Plugin('Filter_Plugin_Zbp_MakeTemplatetags','LazyLoad_Main');
}

function LazyLoad_Main(&$template){
	global $zbp;
	$zbp->header .= "<script type=\"text/javascript\" src=\"{$zbp->host}zb_users/plugin/LazyLoad/js/lazyload.js\"></script>\r\n";
	$zbp->header .= "<script type=\"text/javascript\">
	$(function() {          
    	$(\"{$zbp->Config('LazyLoad')->LazyLoadImg}\").lazyload({
			placeholder:\"{$zbp->host}zb_users/plugin/LazyLoad/img/grey.gif\",
            effect:\"fadeIn\",
			failurelimit : 30
          });
    	});
</script>\r\n";
}

function InstallPlugin_LazyLoad() {
	global $zbp;
	if(!$zbp->Config('LazyLoad')->HasKey('Version'))
	{
		//版本
		$zbp->Config('LazyLoad')->Version = '1.0';
		//建立博客时间
		$zbp->Config('LazyLoad')->LazyLoadImg = 'img';
		$zbp->SaveConfig('LazyLoad');
	}
}

function UninstallPlugin_LazyLoad() {
	global $zbp;
	//额，就不删了吧？？？删了您的配置咋办？
#	$zbp->DelConfig('LazyLoad');
}