<?php
//创建数据库
function MyFormPro_CreateTable() {
	global $zbp;
	if ($zbp->db->ExistTable($GLOBALS['table']['myform_pro_form']) == false) {
		$s = $zbp->db->sql->CreateTable($GLOBALS['table']['myform_pro_form'], $GLOBALS['datainfo']['myform_pro_form']);
		$zbp->db->QueryMulit($s);
	}
	if ($zbp->db->ExistTable($GLOBALS['table']['myform_pro_fields']) == false) {
		$s = $zbp->db->sql->CreateTable($GLOBALS['table']['myform_pro_fields'], $GLOBALS['datainfo']['myform_pro_fields']);
		$zbp->db->QueryMulit($s);
	}	
		if ($zbp->db->ExistTable($GLOBALS['table']['myform_pro_contents']) == false) {
		$s = $zbp->db->sql->CreateTable($GLOBALS['table']['myform_pro_contents'], $GLOBALS['datainfo']['myform_pro_contents']);
		$zbp->db->QueryMulit($s);
	}	
		if ($zbp->db->ExistTable($GLOBALS['table']['myform_pro_info']) == false) {
		$s = $zbp->db->sql->CreateTable($GLOBALS['table']['myform_pro_info'], $GLOBALS['datainfo']['myform_pro_info']);
		$zbp->db->QueryMulit($s);
	}		
}
	
function MyFormPro_DelTable() {
	global $zbp;
	
	if ($zbp->db->ExistTable($zbp->table['myform_pro_form']) == true) {
		$s = $zbp->db->sql->DelTable($zbp->table['myform_pro_form']);
		$zbp->db->QueryMulit($s);
  }
	if ($zbp->db->ExistTable($zbp->table['myform_pro_fields']) == true) {
		$s = $zbp->db->sql->DelTable($zbp->table['myform_pro_fields']);
		$zbp->db->QueryMulit($s);
  }	
  
	if ($zbp->db->ExistTable($zbp->table['myform_pro_contents']) == true) {
		$s = $zbp->db->sql->DelTable($zbp->table['myform_pro_contents']);
		$zbp->db->QueryMulit($s);
  }	
	if ($zbp->db->ExistTable($zbp->table['myform_pro_info']) == true) {
		$s = $zbp->db->sql->DelTable($zbp->table['myform_pro_info']);
		$zbp->db->QueryMulit($s);
  }	
}