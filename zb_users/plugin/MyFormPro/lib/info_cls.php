<?php
$table['myform_pro_info'] = '%pre%myform_pro_info';
$datainfo['myform_pro_info'] = array(
	'ID'				=>	array('info_ID','integer','',0),		//ID  key

	'Form_ID'		  	=>	array('Form_ID','integer','',0),		// Time
	'Confirm'		  	=>	array('info_Confirm','boolean','',false),		// Time
	'Time'		  	=>	array('Time','integer','',0),		// Time
	'IP'		  	=>	array('IP','string',15,''),		// Time
	'Agent'		  	=>	array('Agent','string','',''),		// Time

	'Meta'			=>	array('info_Meta','string','',''),		//meta
);



class myform_pro_info extends Base {

	function __construct()
	{
		global $zbp;
		parent::__construct($zbp->table['myform_pro_info'],$zbp->datainfo['myform_pro_info']);
		
		$this->Time = time();

	}

	public function __set($name, $value)
	{
		parent::__set($name, $value);
	}

	public function __get($name)
	{
		return parent::__get($name);
	}



	function Save(){
		global $zbp;
		return parent::Save();
	}
	
	function Del(){
		global $zbp;
		//¹ØÁªÉ¾³ý
    $infoid=$this->ID;
		$sql = $zbp->db->sql->Delete($zbp->table['myform_pro_contents'],array(array('=','Info_ID',$infoid)));
		$zbp->db->Delete($sql);
		
		return parent::Del();
	}
}


