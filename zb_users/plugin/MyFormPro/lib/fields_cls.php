<?php
$table['myform_pro_fields'] = '%pre%myform_pro_fields';
$datainfo['myform_pro_fields'] = array(
	'ID'				=>	array('fileds_ID','integer','',0),		//ID  key
	'Form_ID'		  	=>	array('Form_ID','integer','',0),		// form ID
	//'Name'		  	=>	array('fileds_Name','string','',''),		// fileds name 
	'Desc'		  	=>	array('fileds_Description','string','',''),		// fileds_Description
	'Content'		  	=>	array('fileds_Content','string','',''),		// fileds_Content  for radio/checkbox
	'Order'	  	=>	array('fileds_Order','integer','',0),		//Order
	
	#'SqlType'	  	=>	array('fileds_SqlType','integer','',0),		//type 1¡¢int 2¡¢bool 3¡¢string
	'Length'	  	=>	array('fileds_Length','integer','',0),		//Length

	'Type'	  	=>	array('fileds_Type','integer','',0),		//type 1¡¢name 2¡¢age 3¡¢m or f 4¡¢text 5¡¢text must content chinese¡­¡­
	'Check'	  	=>	array('fileds_Check','boolean','',false),		//check or not

	'ShowType'		  	=>	array('fileds_ShowType','string','',''),		// ShowType
	'Show'		=>	array('fileds_Show','boolean','',true),		//front,show or not
	//'BackList'		=>	array('fileds_BackList','boolean','',true),		//back ,list or not
	'Time'	  	=>	array('fileds_Time','integer','',0),		//creat time
	'Meta'			=>	array('fileds_Meta','string','',''),		//meta
);



class myform_pro_fields extends Base {

	function __construct()
	{
		global $zbp;
		parent::__construct($zbp->table['myform_pro_fields'],$zbp->datainfo['myform_pro_fields']);
		
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
    $feildid=$this->ID;
		$sql = $zbp->db->sql->Delete($zbp->table['myform_pro_contents'],array(array('=','Field_ID',$feildid)));
		$zbp->db->Delete($sql);
		
		return parent::Del();
	}
}


