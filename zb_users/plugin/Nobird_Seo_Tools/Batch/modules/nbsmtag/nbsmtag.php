<?php
class nbsmtag extends nbseo_batch {

	/**
	 * Build queue
	 * @return null
	 */
	public function get_queue() {
		
		global $zbp;
	$sql = $zbp->db->sql->Select(
		$zbp->table['Tag'],
		array("MIN(tag_ID)","MAX(tag_ID)"),
		null,
		array('tag_ID'=>'ASC'),
		null,
		null
	);
	$array = $zbp->db->Query($sql);
	
	$minid=$array[0]["MIN(tag_ID)"];
	$maxid=$array[0]["MAX(tag_ID)"];
	$i=0;$j=1;
for ($i=$minid;$i<=$maxid;){
			$this->set_queue('buildsitemap', $i.'|'.$j.'|'.$maxid);
      $i=$i+$zbp->Config('Nobird_Sitemap')->BigDataPer;

}
	}
	
	/**
	 * Check BOM
	 * @param string $param 
	 * @return null
	 */
	public function buildsitemap($param) {
	global $zbp;

$array=explode('|',$param); 
$param=$array[0];
$j=$array[1];		
$maxid=$array[2];		
if (!$zbp->CheckPlugin('Pad')) {
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><?xml-stylesheet type="text/xsl" href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/Sitemap/sitemap.xsl"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0" />');
}else{
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><?xml-stylesheet type="text/xsl" href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/Sitemap/sitemap.xsl"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />');

}

$where=array();
$b=$param;
$e=$param+$zbp->Config('Nobird_Sitemap')->BigDataPer;
$where[] = array('between','tag_ID',$b,$e);
			$array=$zbp->GetTagList(
		null,
		$where,
		array('tag_ID'=>'ASC'),
		null,
		null,
		false
		);


	foreach ($array as $key => $value) {
		$url = $xml->addChild('url');
		$url->addChild('loc', $value->Url);
if (!$zbp->CheckPlugin('Pad')) {
  $mobileurl = $url->addChild('mobile:mobile');
  $mobileurl->addAttribute('type', 'pc,mobile');
}
		$url->addChild('lastmod',date('c'));	
		$url->addChild('changefreq', 'weekly');
        $url->addChild('priority', $zbp->Config('Nobird_Sitemap')->TagPercent);
	$zbp->Config('Nobird_Sitemap')->TagLimit = $value->ID;
	$zbp->SaveConfig('Nobird_Sitemap');
	if($maxid==$value->ID){
		$boolok=true;
	}	
	}
	
file_put_contents($zbp->path . 'sitemap_tag_'.$j.'.xml',$xml->asXML());
$file = ZBP_PATH.'sitemap.xml';
$newxml = simplexml_load_file($file);        //读取xml文件
$sitemap = $newxml->addChild('sitemap');
$sitemap->addChild('loc', $zbp->host.'sitemap_tag_'.$j.'.xml');
$sitemap->addChild('lastmod',date('c',time()));	
file_put_contents($file,$newxml->asXML());


		
			$this->output('success', '队列:'.$j . ' - 创建完成!');
if($boolok){
			$this->output('success', '标签sitemap - 创建完成!');	
      $zbp->SetHint('good','全站Sitemap创建完成!');

			$this->output('success', '全部创建完成 ：<script language="javascript" type="text/javascript">
           window.location.href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/Sitemap/sitemap_large.php";
    </script>');
}


	}
	
	

	

	
}
