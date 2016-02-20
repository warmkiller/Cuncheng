<?php
$table['myform_pro_form'] = '%pre%myform_pro_form';
$datainfo['myform_pro_form'] = array(
	'ID'				=>	array('form_ID','integer','',0),		//ID  key
	'Name'		  	=>	array('form_Name','string',50,''),		// form name // no use
	'Desc'		  	=>	array('form_Description','string','',''),		// form_Description

	'NeedLogin'		  	=>	array('NeedLogin','boolean','',false),		// NeedLogin
	'NeedLogin_Hint'		  	=>	array('NeedLogin_Hint','string','','<div style="color: #c09853;background-color: #fcf8e3;border: 1px solid #fbeed5;border-radius: 2px;margin-bottom: 20px;padding: 10px 35px 10px 14px;">需要登陆后才可以查看表单信息</div>'),		// NeedLogin_Hint
	
	'Schedule'		  	=>	array('Schedule','boolean','',false),		// Schedule
	'Schedule_StartTime'		  	=>	array('Schedule_Start','integer','',0),		// Schedule_Start
	'Schedule_EndTime'		  	=>	array('Schedule_End','integer','',0),		// Schedule_End
	'Schedule_End_Hint'		  	=>	array('Schedule_End_Hint','string','','<div style="color: #c09853;background-color: #fcf8e3;border: 1px solid #fbeed5;border-radius: 2px;margin-bottom: 20px;padding: 10px 35px 10px 14px;">表单尚未开始或已到期,无法接受新信息</div>'),		// Schedule_End_Hint

	'Use_Limit'		  	=>	array('Use_Limit','boolean','',false),		// Num_Limit
	'Limit_Num'		  	=>	array('Limit_Num','integer','',0),		// Schedule_Start
	'Limit_Type'		  	=>	array('Limit_Type','integer','',0),		// 1 total ,2 per day,3 per week, 4 per month,5 per year
	'Limit_Out_Hint'		  	=>	array('Limit_Out_Hint','string','','<div style="color: #c09853;background-color: #fcf8e3;border: 1px solid #fbeed5;border-radius: 2px;margin-bottom: 20px;padding: 10px 35px 10px 14px;">已经达到最大限额,无法接受新信息</div>'),		// Limit_Out_Hint
	'SubmitButtonText'		  	=>	array('SubmitButtonText','string','','提 交'),		// SubmitButtonText

	'AfterSubmitDo'		  	=>	array('AfterSubmitDo','integer','',1),		// 1 text,2 page,3 redirect
	'AfterSubmitText'		  	=>	array('AfterSubmitText','string','','[ip]感谢您的耐心！我们将尽快与您取得联系。[date_ymd]'),		
	'AfterSubmitPage'		  	=>	array('AfterSubmitPage','integer','',0),		// pageID
	'AfterSubmitUrl'		  	=>	array('AfterSubmitUrl','string','','http://www.birdol.com/'),		
	'AfterSubmitUrlUseGetStr'		  	=>	array('AfterSubmitUrlUseGetStr','boolean','',false),		
	'AfterSubmitUrlGetStr'		  	=>	array('AfterSubmitUrlGetStr','string','',''),		
	
	'BackList'		  	=>	array('BackList','string','',''),		//BackList fieldid1|fieldid2|fieldid3

	
	'Validatecode'		  	=>	array('form_Validatecode','boolean','',true),		// Validatecode
	'NeedMail'		  	=>	array('form_NeedMail','boolean','',false),		// Needmail
	'MailTemplate'		  	=>	array('form_MailTemplate','string','',''),		// mail template
	
	'ShortCut'		  	=>	array('form_ShortCut','integer','','1'),		// ShortCut 1 none;2 left;3 top.
	
	'Time'	  	=>	array('form_Time','integer','',0),		//creat time
	'Meta'			=>	array('form_Meta','string','',''),		//meta
);

class myform_pro_form extends Base {
	function __construct()
	{
		global $zbp;
		parent::__construct($zbp->table['myform_pro_form'],$zbp->datainfo['myform_pro_form']);
		$this->Time = time();
		$this->Schedule_StartTime = time();
		$this->Schedule_EndTime = time();
	}

	public function __set($name, $value)
	{
		parent::__set($name, $value);
	}

	public function __get($name)
	{
		return parent::__get($name);
	}


	public function Schedule_Start($s='Y-m-d H:i:s'){
		return date($s,(int)$this->Schedule_StartTime);
	}
	public function Schedule_End($s='Y-m-d H:i:s'){
		return date($s,(int)$this->Schedule_EndTime);
	}


	function Save(){
		global $zbp;
		return parent::Save();
	}
	
	function Del(){
		global $zbp;
    $formid=$this->ID;
//1、关联删除

        $wherefields = array(
                       array('=','Form_ID',$formid)
                          );

	$sql = $zbp->db->sql->Delete($zbp->table['myform_pro_fields'], $wherefields);
	$zbp->db->Delete($sql);
//2、Del info

        $wherefields = array(
                       array('=','Form_ID',$formid)
                          );

	$sql = $zbp->db->sql->Delete($zbp->table['myform_pro_info'], $wherefields);
	$zbp->db->Delete($sql);
//3、Del contents
        $wherecontents = array(
                       array('=','Form_ID',$formid)
                          );

	$sql = $zbp->db->sql->Delete($zbp->table['myform_pro_contents'], $wherecontents);
	$zbp->db->Delete($sql);
			
		return parent::Del();
	}
}


