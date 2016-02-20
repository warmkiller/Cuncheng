<?php
function Nobird_Spider_Get_Spider(){
	global $zbp;
	
	$arrayspider=array(
          'Baiduspider' => '百度',
          'Googlebot' => '谷歌',
          'Sosospider' => '搜搜',
          'YoudaoBot' => '有道',
          'bingbot' => '必应',
          'Sogou web spider' => '搜狗',
          'Yahoo! Slurp' => '雅虎',
          'Alexa' => 'Alexa',
          '360Spider' => '360'          
              );
	$agent="";
	$domain=$_SERVER['HTTP_HOST'];
	$url=$_SERVER['REQUEST_URI'];
	$ip=GetGuestIP();
	$dateline=time();
	$regex = '/Baiduspider|Googlebot|Sosospider|YoudaoBot|bingbot|Sogou web spider|Yahoo! Slurp|Alexa|360Spider/i';

		if (preg_match($regex, GetVars('HTTP_USER_AGENT', 'SERVER'),$match)){
		//var_dump($match);
		 $agent = $arrayspider[$match[0]];
//var_dump($arrayspider);
		}
		


	$url='http://'.$domain.$url;
	if($url&&$agent){
		$DataArr = array(
		't_spidername'=>$agent,
		't_spiderip'=>$ip,
		't_dateline'=>$dateline,
		't_url'=>$url,
	#	't_status'=>'1'
		't_status'=>Nobird_check_url_exists($url)
	);
	
		$sql= $zbp->db->sql->Insert($GLOBALS['Nobird_Spider_Table'],$DataArr);
		$zbp->db->Insert($sql);
	

	}
	return '';
}


function Nobird_check_url_exists($url) {
	$ajax = Network::Create();
	$ajax->open('GET', $url);
	$ajax->send();
	return ($ajax->status);
}



$Nobird_Spider_Table='%pre%Nobird_Spider';
$Nobird_Spider_DataInfo=array(
    'ID'=>array('t_ID','integer','',0),
    'spidername'=>array('t_spidername','string',200,''),
    'spiderip'=>array('t_spiderip','string',200,''),
    'dateline'=>array('t_dateline','integer','','0'),
    'url'=>array('t_url','string',255,''),
    'status'=>array('t_status','string',255,'1'),
);


function Nobird_Spider_CreateTable(){
	global $zbp;
	$s=$zbp->db->sql->CreateTable($GLOBALS['Nobird_Spider_Table'],$GLOBALS['Nobird_Spider_DataInfo']);
	$zbp->db->QueryMulit($s);
	
}

function Nobird_Spider_Uninstall(){
	global $zbp;
	$s=$zbp->db->sql->DelTable($GLOBALS['Nobird_Spider_Table']);
	$zbp->db->QueryMulit($s);
	$zbp->DelConfig('Nobird_Spider');

}


function Nobird_Spider_Install(){
	global $zbp;
	Nobird_Spider_CreateTable();
	if(!$zbp->Config('Nobird_Spider')->HasKey('Version')) {
	$zbp->Config('Nobird_Spider')->Version = '1.0';
	$zbp->Config('Nobird_Spider')->UseSpider = 1;//默认启用

	$zbp->SaveConfig('Nobird_Spider');
	}
	
}
?>