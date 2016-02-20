<?php
include 'tcslide.php';
RegisterPlugin("TcSlide","ActivePlugin_TcSlide");

function ActivePlugin_TcSlide() {
   Add_Filter_Plugin('Filter_Plugin_Admin_LeftMenu','TcSlide_AddMenu');
}

function InstallPlugin_TcSlide(){
    TcSlide_CreateTable();
}
function UninstallPlugin_TcSlide(){}

function TcSlide_AddMenu(&$m){
    global $zbp;
    $m[]=MakeLeftMenu("root","幻灯片管理",$zbp->host . "zb_users/plugin/TcSlide/main.php","nav_FileSystem","aFileSystem",$zbp->host . "zb_system/image/common/file_1.png");    
}

function TcSlide_CreateTable(){
    global $zbp;
    $s=$zbp->db->sql->CreateTable($GLOBALS['TcSlide_Table'],$GLOBALS['TcSlide_DataInfo']);
    $zbp->db->QueryMulit($s);
}

?>