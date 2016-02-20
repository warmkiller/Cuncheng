<?php
class nbsmarticle extends nbseo_batch {

	/**
	 * Build queue
	 * @return null
	 */
	public function get_queue() {
		
		global $zbp;
	$sql = $zbp->db->sql->Select(
		$zbp->table['Post'],
		array("MIN(log_ID)","MAX(log_ID)"),
		array(
			array('=', 'log_Type', '0'),
			array('=', 'log_Status', '0'),
		),
		array('log_ID' => 'ASC'),
		null,
		null
	);
	$array = $zbp->db->Query($sql);
	
	$minid=$array[0]["MIN(log_ID)"];
	$maxid=$array[0]["MAX(log_ID)"];
	$i=0;$j=1;


$xmlhold = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><?xml-stylesheet type="text/xsl" href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/Sitemap/sitemap.xsl"?><sitemapindex />');
$xmlhold->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');


$sitemap = $xmlhold->addChild('sitemap');
$sitemap->addChild('loc', $zbp->host.'sitemap_new.xml');
$sitemap->addChild('lastmod',date('c',time()));	

file_put_contents(ZBP_PATH.'sitemap.xml',$xmlhold->asXML());	
	
	
for ($i=$minid;$i<=$maxid;){
			$this->set_queue('buildsitemap', $i.'|'.$j.'|'.$maxid);
      $i=$i+$zbp->Config('Nobird_Sitemap')->BigDataPer;
      $j++;

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
		
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><?xml-stylesheet type="text/xsl" href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/Sitemap/sitemap.xsl"?><urlset />');
$xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
$where=array();
$b=$param;
$e=$param+$zbp->Config('Nobird_Sitemap')->BigDataPer;
$where[] = array('between','log_ID',$b,$e);
$where[]=array('=','log_Status',0);
			$array=$zbp->GetArticleList(
		null,
		$where,
		array('log_ID' => 'ASC'),
		null,
		null,
		false
		);
$boolok=false;
	foreach ($array as $key => $value) {
		$url = $xml->addChild('url');
		$url->addChild('loc', $value->Url);
		$url->addChild('lastmod',date('c',$value->PostTime));	
		$url->addChild('changefreq', 'monthly');
        $url->addChild('priority', $zbp->Config('Nobird_Sitemap')->ArticlePercent);

	$zbp->Config('Nobird_Sitemap')->ArticleLimit = $value->ID;
	$zbp->SaveConfig('Nobird_Sitemap');
	if($maxid==$value->ID){
		$boolok=true;
	}
	$lasttime=$value->PostTime;
		}
file_put_contents($zbp->path . 'sitemap_article_'.$j.'.xml',$xml->asXML());

$file = ZBP_PATH.'sitemap.xml';
$newxml = simplexml_load_file($file);        //读取xml文件
$sitemap = $newxml->addChild('sitemap');
$sitemap->addChild('loc', $zbp->host.'sitemap_article_'.$j.'.xml');
$sitemap->addChild('lastmod',date('c',$lasttime));	
file_put_contents($file,$newxml->asXML());

		
			$this->output('success', '队列:'.$j . ' - 创建完成!');
if($boolok){
			$this->output('success', '文章sitemap - 创建完成!');
			$this->output('success', '跳转到下一个任务：<script language="javascript" type="text/javascript">
           window.location.href="'.$zbp->host.'zb_users/plugin/Nobird_Seo_Tools/Batch/nbseo_batch_main.php?module=nbsmcate";
    </script>');
}

	}
	
	

	

	
}
