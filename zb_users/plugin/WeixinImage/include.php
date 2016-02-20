<?php
#注册插件
RegisterPlugin("WeixinImage","ActivePlugin_WeixinImage");

function ActivePlugin_WeixinImage() {
	Add_Filter_Plugin('Filter_Plugin_PostArticle_Core','WeixinImage_Main');
}

function WeixinImage_Main(&$article) {
	global $zbp;

	set_time_limit(0);
	ZBlogException::ClearErrorHook();
	$content = $article->Content;
	$pattern = "/data-src=\"(.*)\"/iU";
	$pattern1 = "/ src=\"(.*)\"/iU";
	/*
	$pattern = "/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
	*/
	preg_match_all($pattern,$content,$matchContent);
	preg_match_all($pattern1,$content,$matchContent1);
	$picArray = $matchContent[1];
	$srcArray = $matchContent1[1];
	if ($picArray){		
		foreach($picArray as $key=>$rurl){			
			if(substr($rurl,0,strlen($zbp->host))!=$zbp->host) {
				$path=$zbp->usersdir.'upload/'.date('Y').'/'.date('m');			
				if(!file_exists($path)) mkdir($path,0755,true);
			//	$picname=date('YmdHis').'_'.rand(10000,99999).'.'.pathinfo($rurl,PATHINFO_EXTENSION);
				$picname=date('YmdHis').'_'.rand(10000,99999).'.'.WeixinImage_pictype($rurl);
				$pic=$path.'/'.$picname;
				$getpic=WeixinImage_Save($rurl,$pic,$picname);
				$picUrl=str_replace($zbp->path,$zbp->host,$pic);
				$article->Content=str_replace($srcArray[$key],$picUrl,$article->Content);
				$article->Content=str_replace($rurl,$picUrl,$article->Content);
			}
		}
	}

}


function WeixinImage_pictype ($file){
	global $zbp;

$img=GetHttpContent($file);
$filename=$zbp->usersdir.'cache/WeixinImage.dat';
$fp2=@fopen($filename, "w");
fwrite($fp2,$img);
fclose($fp2);

$info = getimagesize($filename);
$info=$info['mime'];
$info=explode('/', $info);
    $str = $info[1];
    return $str;

} 

function WeixinImage_Save($url,$filename="",$name) {
	global $zbp;

	if($url=="") return false;

	//if($filename=="") { //为毛文件名会空?
		$ext=strrchr($name,".");
	//$ext=WeixinImage_pictype($url);
		if($ext!=".gif" && $ext!=".jpeg" && $ext!=".png") return false;
	//	$filename=date("YmdHis").$ext;
	//}

//	ob_start();
//	readfile($url);
	$img = GetHttpContent($url);
//	ob_end_clean();
	$size = strlen($img);

	$fp2=@fopen($filename, "a");
	fwrite($fp2,$img);
	fclose($fp2);

	$upload = new Upload;
	$upload->Name = $name;
	$upload->SourceName = $name;
	$upload->MimeType = "";
	$upload->Size = $size;
	$upload->AuthorID = $zbp->user->ID;
	$upload->Save();

	return true; 

}

function InstallPlugin_WeixinImage() {

}

function UninstallPlugin_WeixinImage() {

}
