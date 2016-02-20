<?php


function BaiduSitemap_Get_BaiduSitemap(){
	global $zbp;

$xml_root = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>".
            '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />';

$xml = new SimpleXMLElement($xml_root);

$url = $xml->addChild('url');
$url->addChild('loc', $zbp->host);
$url->addChild('lastmod',date('c'));	
$url->addChild('changefreq', 'daily');
$url->addChild('priority', '1.0');

	foreach ($zbp->categorys as $c) {
		$url = $xml->addChild('url');
		$url->addChild('loc', $c->Url);
		$url->addChild('lastmod',date('c'));	
        $url->addChild('changefreq', 'weekly');
        $url->addChild('priority', '0.8');

	}


	$array=$zbp->GetArticleList(
		null,
		array(array('=','log_Status',0)),
		null,
		null,
		null,
		false
		);

	foreach ($array as $key => $value) {
		$url = $xml->addChild('url');
		$url->addChild('loc', $value->Url);
		$url->addChild('lastmod',date('c',$value->PostTime));	
		$url->addChild('changefreq', 'monthly');
        $url->addChild('priority', '0.5');

		}



	$array=$zbp->GetPageList(
		null,
		array(array('=','log_Status',0)),
		null,
		null,
		null
		);

	foreach ($array as $key => $value) {
		$url = $xml->addChild('url');
		$url->addChild('loc', $value->Url);
		$url->addChild('lastmod',date('c',$value->PostTime));	
		$url->addChild('changefreq', 'monthly');
        $url->addChild('priority', '0.6');

	}



	$array=$zbp->GetTagList();

	foreach ($array as $key => $value) {
		$url = $xml->addChild('url');
		$url->addChild('loc', $value->Url);
		$url->addChild('lastmod',date('c'));	
		$url->addChild('changefreq', 'weekly');
        $url->addChild('priority', '0.8');

	}



file_put_contents($zbp->path . 'sitemap_baidu.xml',$xml->asXML());

}



?>