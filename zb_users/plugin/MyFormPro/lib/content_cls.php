<?php
$table['myform_pro_contents'] = '%pre%myform_pro_contents';
$datainfo['myform_pro_contents'] = array(
	'ID'				=>	array('contents_ID','integer','',0),		//ID  key
	'Form_ID'		  	=>	array('Form_ID','integer','',0),		// Form_ID
	'Field_ID'		  	=>	array('Field_ID','integer','',0),		// Field_ID
	'Info_ID'		  	=>	array('Info_ID','integer','',0),		// Info_ID
	'Content'		  	=>	array('Content','string','',''),		//  content
	'Meta'			=>	array('contents_Meta','string','',''),		//meta
);



class myform_pro_contents extends Base {

	function __construct()
	{
		global $zbp;
		parent::__construct($zbp->table['myform_pro_contents'],$zbp->datainfo['myform_pro_contents']);
		
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
	
}


