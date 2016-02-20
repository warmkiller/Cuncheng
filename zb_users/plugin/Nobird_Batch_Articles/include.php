<?php
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'NBA_config.php';   //Default config

#注册插件
RegisterPlugin("Nobird_Batch_Articles","ActivePlugin_Nobird_Batch_Articles");

function ActivePlugin_Nobird_Batch_Articles() {
	Add_Filter_Plugin('Filter_Plugin_Admin_ArticleMng_SubMenu','Nobird_Batch_Articles_Main');
}


function Nobird_Batch_Articles_Main(){
	global $zbp;
	Redirect('../../zb_users/plugin/Nobird_Batch_Articles/main.php');

}




function InstallPlugin_Nobird_Batch_Articles(){ 
	global $zbp;
		if(!$zbp->Config('Nobird_Batch_Articles')->HasKey('Version')){
		$zbp->Config('Nobird_Batch_Articles')->Version = '1.0';
		$zbp->config('Nobird_Batch_Articles')->num = '20';
		$zbp->SaveConfig('Nobird_Batch_Articles');
}

}

function UninstallPlugin_Nobird_Batch_Articles() {
	global $zbp;
	$zbp->DelConfig('Nobird_Batch_Articles');

}




