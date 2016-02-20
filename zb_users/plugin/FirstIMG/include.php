<?php
#注册插件
RegisterPlugin("FirstIMG","ActivePlugin_FirstIMG");

function ActivePlugin_FirstIMG() {

}
/*
function ActivePlugin_FirstIMG() {
	Add_Filter_Plugin('Filter_Plugin_ViewList_Template','FirstIMG_ViewList_Template');
}

function FirstIMG_ViewList_Template(&$template){
	global $zbp;
	$tag = &$template->GetTagsAll();
	if( isset($tag['articles']) ){
		foreach($tag['articles'] as $l){
			if( !isset($l->Img) ){
			
				$randnum=rand(1,20);
				$pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
				$content = $l->Content;
				preg_match_all($pattern,$content,$matchContent);

				if(isset($matchContent[1][0])) {
					$temp=$matchContent[1][0];
				}else{
					$temp=$zbp->host . "zb_users/plugin/FirstIMG/noimg/" . $randnum . ".jpg";
				}

				$l->Img=$temp;
			
			}
		}
		//die;
	}
}
*/
class FirstIMG extends ZBlogPHP {

	/**
	 * 获取全部置顶文章（优先从cache里读数组）
	 */
	function GetTopArticle(){
		if(!is_object($this->cache))return array();
		$articles_top_notorder_idarray = unserialize($this->cache->top_post_array);
		if(!is_array($articles_top_notorder_idarray)){
			CountTopArticle(null,null);
			$articles_top_notorder_idarray = unserialize($this->cache->top_post_array);
		}
	//	$articles_top_notorder=$this->GetPostByArray($articles_top_notorder_idarray);
		
//////////////////////////
		$list=array();
		//var_dump($articles_top_notorder_idarray);die();
	foreach ($articles_top_notorder_idarray as $a) {
			$l=new Post();
			$l->LoadInfoByID($a);

			$randnum=rand(1,20);
			$pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.jpeg|\.png]))[\'|\"].*?[\/]?>/";
			$content = $l->Content;
			preg_match_all($pattern,$content,$matchContent);

			if(isset($matchContent[1][0])) {
				$temp=$matchContent[1][0];
			}else{
				$temp=$this->host . "zb_users/plugin/FirstIMG/noimg/" . $randnum . ".jpg";
			}

			$l->Img=$temp;
			$list[]=$l;
		}
				return $list;
//////////////////////////		
		//return $articles_top_notorder;
	}

	function GetImgList($type,$sql){

		$array=null;
		$list=array();
		$array=$this->db->Query($sql);
		if(!isset($array)){return array();}
		foreach ($array as $a) {
			$l=new $type();
			$l->LoadInfoByAssoc($a);

			$randnum=rand(1,20);
			$pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.jpeg|\.png]))[\'|\"].*?[\/]?>/";
			$content = $l->Content;
			preg_match_all($pattern,$content,$matchContent);

			if(isset($matchContent[1][0])) {
				$temp=$matchContent[1][0];
			}else{
				$temp=$this->host . "zb_users/plugin/FirstIMG/noimg/" . $randnum . ".jpg";
			}

			$l->Img=$temp;
			$list[]=$l;
		}
		return $list;
	}

	function GetArticleList($select=null,$where=null,$order=null,$limit=null,$option=null,$readtags=true){

		if(empty($select)){$select = array('*');}
		if(empty($where)){$where = array();}
		if(is_array($where))array_unshift($where,array('=','log_Type','0'));
		$sql = $this->db->sql->Select($this->table['Post'],$select,$where,$order,$limit,$option);
		$array = $this->GetImgList('Post',$sql);

		if($readtags){
			$tagstring = '';
			foreach ($array as $a) {
				$tagstring .= $a->Tag;
				$this->posts[$a->ID]=$a;
			}
			$this->LoadTagsByIDString($tagstring);
		}

		return $array;

	}

	function GetPostList($select=null,$where=null,$order=null,$limit=null,$option=null){

		if(empty($select)){$select = array('*');}
		if(empty($where)){$where = array();}
		$sql = $this->db->sql->Select($this->table['Post'],$select,$where,$order,$limit,$option);
		return $this->GetImgList('Post',$sql);

	}
}

$zbp=new FirstIMG();
$zbp->Initialize();

//$zbp=ZBlogPHP::GetInstance();
//$zbp->Initialize();

function InstallPlugin_FirstIMG() {

}

function UninstallPlugin_FirstIMG() {

}