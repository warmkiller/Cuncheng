<?php


function Nobird_Spider_Get_Spider(){
	global $zbp;
	$agent=$_SERVER['HTTP_USER_AGENT'];
	$domain=$_SERVER['HTTP_HOST'];
	$url=$_SERVER['REQUEST_URI'];
	$ip=GetGuestIP();
	$dateline=time();
	$baidu=stristr($agent,"Baiduspider");
	$google=stristr($agent,"Googlebot");
	$soso=stristr($agent,"Sosospider");
	$youdao=stristr($agent,"YoudaoBot");
	$bing=stristr($agent,"bingbot");
	$sogou=stristr($agent,"Sogou web spider");
	$yahoo=stristr($agent,"Yahoo! Slurp");
	$Alexa=stristr($agent,"Alexa");
	$so=stristr($agent,"360Spider");
	if($baidu){
		$agent="baidu";
	}elseif($google){
		$agent="Google";
	}elseif($soso){
		$agent="soso";
	}elseif($youdao){
		$agent="youdao";
	}elseif($bing){
    $agent="bing";
	}elseif($sogou){
		$agent="sogou";
	}elseif($yahoo){
		$agent="yahoo";
	}elseif($Alexa){
		$agent="Alexa";
	}elseif($so){
		$agent="360Spider";
	}else{
		$agent=null;
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

function Nobird_Spider_uninstall(){
	global $zbp;
	$s=$zbp->db->sql->Delete($GLOBALS['Nobird_Spider_Table'],'');
	$zbp->db->QueryMulit($s);
}


?>