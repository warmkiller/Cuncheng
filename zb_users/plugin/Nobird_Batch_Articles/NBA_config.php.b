<?php

function Nobird_Batch_Articles_SubMenu(){
	global $zbp,$bloghost;
		echo '<a href="'.$bloghost.'zb_users/plugin/Nobird_Batch_Articles/main.php"><span class="m-left m-now">批量管理文章</span></a>';
		echo '<a href="'.$bloghost.'zb_users/plugin/Nobird_Batch_Articles/help.php"><span class="m-right" style="color:#F00">帮助</span></a>';
		echo '<a href="http://www.birdol.com/" target="_blank"><span class="m-right" style="color:#F00">作者网站</span></a>';
}


################################################################################################################
/**
 * 后台文章管理
 */
function Nobird_Batch_Admin_ArticleMng(){

	global $zbp;
	
		$array=$zbp->GetTagList();
		foreach ($array as $t) {
			$zbp->tags[$t->ID]=$t;
			$zbp->tagsbyname[$t->Name]=&$zbp->tags[$t->ID];
		}// 从zbp类里面抄来的 不知道为什么tagsbyname是空的


	echo '<div class="divHeader">批量文章管理 - Nobird为您精彩呈现</div>';
	echo '<div class="SubMenu">';
	 Nobird_Batch_Articles_SubMenu();
	echo '</div>';
	echo '<div id="divMain2">';
	echo '<form class="search" id="search" method="post" action="#">';
	echo '<p>' . $zbp->lang['msg']['search'] . ':&nbsp;&nbsp;' . $zbp->lang['msg']['category'] . ' <select class="edit" size="1" name="category" style="width:150px;" ><option value="">' . $zbp->lang['msg']['any'] . '</option>';
	foreach ($zbp->categorysbyorder as $id => $cate) {
	  echo '<option value="'. $cate->ID .'">' . $cate->SymbolName . '</option>';
	}
	echo'</select>&nbsp;&nbsp;&nbsp;&nbsp;' . $zbp->lang['msg']['type'] . ' 
	<select class="edit" size="1" name="status" style="width:80px;" >
	<option value="">' . $zbp->lang['msg']['any'] . '</option> 
	<option value="0" >' . $zbp->lang['post_status_name']['0'] . '</option>
	<option value="1" >' . $zbp->lang['post_status_name']['1'] . '</option>
	<option value="2" >' . $zbp->lang['post_status_name']['2'] . '</option>
	</select>&nbsp;&nbsp;&nbsp;&nbsp;
	<label><input type="checkbox" name="istop" value="True"/>&nbsp;' . $zbp->lang['msg']['top'] . '</label>&nbsp;&nbsp;&nbsp;&nbsp;
	<select class="edit" size="1" name="author" id="author" style="width:150px;" ><option value="">用户</option>';
	foreach ($zbp->membersbyname as $id => $member) {
	  echo '<option value="'. $member->ID .'">' . $member->Name . '</option>';
	}
	echo'</select>&nbsp;&nbsp;&nbsp;&nbsp;
	<select class="edit" size="1" name="tag" id="tag" style="width:150px;" ><option value="">TAG</option>';
	foreach ($zbp->tagsbyname as $id => $tag) {
	  echo '<option value="'. $tag->ID .'">' . $tag->Name . '</option>';
	}
	echo'</select><br /><br />
	<input name="search" style="width:250px;" type="text" value="" /> &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="button" value="' . $zbp->lang['msg']['submit'] . '"/></p>';
	echo '</form>';
	echo '<form class="search" id="edtfrm" method="get" action="mng.php">';
	echo '<table border="1" class="tableFull tableBorder tableBorder-thcenter">';
	echo '<tr>
	<th>' . $zbp->lang['msg']['id'] . '</th>
	<th>' . $zbp->lang['msg']['category'] . '</th>
	<th>' . $zbp->lang['msg']['author'] . '</th>
	<th>' . $zbp->lang['msg']['title'] . '</th>
	<th>置顶</th>
	<th>' . $zbp->lang['msg']['date'] . '</th>
	<th>' . $zbp->lang['msg']['comment'] . '</th>
	<th>' . $zbp->lang['msg']['status'] . '</th>
	<th>编辑/删除</th>
	<th><a href="" onclick="BatchSelectAll();return false;">' . $zbp->lang['msg']['select_all'] . '</a></th>
	</tr>';

$p=new Pagebar('{%host%}zb_users/plugin/Nobird_Batch_Articles/main.php?act=ArticleMng{&page=%page%}{&status=%status%}{&istop=%istop%}{&category=%category%}{&author=%author%}{&tag=%tag%}{&search=%search%}',false);
$p->PageCount=20; #$zbp->managecount // system default str
$p->PageNow=(int)GetVars('page','GET')==0?1:(int)GetVars('page','GET');
$p->PageBarCount=$zbp->pagebarcount;

$p->UrlRule->Rules['{%category%}']=GetVars('category');
$p->UrlRule->Rules['{%search%}']=urlencode(GetVars('search'));
$p->UrlRule->Rules['{%status%}']=GetVars('status');
$p->UrlRule->Rules['{%istop%}']=(boolean)GetVars('istop');
$p->UrlRule->Rules['{%author%}']=GetVars('author');
$p->UrlRule->Rules['{%tag%}']=GetVars('tag');
$w=array();
if(!$zbp->CheckRights('ArticleAll')){
	$w[]=array('=','log_AuthorID',$zbp->user->ID);
}
if(GetVars('search')){
	$w[]=array('search','log_Content','log_Intro','log_Title',GetVars('search'));
}
if(GetVars('istop')){
	$w[]=array('=','log_Istop','1');
}
if(GetVars('status')){
	$w[]=array('=','log_Status',GetVars('status'));
}
if(GetVars('category')){
	$w[]=array('=','log_CateID',GetVars('category'));
}
if(GetVars('author')){
	$w[]=array('=','log_AuthorID',GetVars('author'));
}
if(GetVars('tag')){
	$w[]=array('like','log_Tag','{'.GetVars('tag').'}');
}
$array=$zbp->GetArticleList(
	'',
	$w,
	array('log_PostTime'=>'DESC'),
	array(($p->PageNow-1) * $p->PageCount,$p->PageCount),
	array('pagebar'=>$p),
	false
);

foreach ($array as $article) {
	echo '<tr>';
	echo '<td class="td5">' . $article->ID .  '</td>';
	echo '<td class="td10"><a href="main.php?category='.$article->Category->ID.'">' . $article->Category->Name . '</a></td>';
	echo '<td class="td10"><a href="main.php?author='.$article->Author->ID.'">' . $article->Author->Name . '</a></td>';
	echo '<td><a href="'.$article->Url.'" target="_blank"><img src="../../../zb_system/image/admin/link.png" alt="" title="" width="16" /></a> ' . $article->Title . '</td>';
	$IsTop='';
	if  ($article->IsTop){
	$IsTop='<a href="main.php?istop=True"><b>&nbsp;√&nbsp;</b></a>';
	}
	
	echo '<td>'.$IsTop.'</td>';
	echo '<td class="td20">' .$article->Time() . '</td>';
	echo '<td class="td5">' . $article->CommNums . '</td>';
	echo '<td class="td5"><a href="main.php?status='.$article->Status.'">' .$article->StatusName . '</td>';
	echo '<td class="td10 tdCenter">';
	echo '<a href="../../../zb_system/cmd.php?act=ArticleEdt&amp;id='. $article->ID .'"><img src="../../../zb_system/image/admin/page_edit.png" alt="'.$zbp->lang['msg']['edit'] .'" title="'.$zbp->lang['msg']['edit'] .'" width="16" /></a>';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;';
	echo '<a onclick="return window.confirm(\''.$zbp->lang['msg']['confirm_operating'] .'\');" href="../../../zb_system/cmd.php?act=ArticleDel&amp;id='. $article->ID .'&amp;token='. $zbp->GetToken() .'"><img src="../../../zb_system/image/admin/delete.png" alt="'.$zbp->lang['msg']['del'] .'" title="'.$zbp->lang['msg']['del'] .'" width="16" /></a>';
	echo '</td>';
	echo '<td class="td5 tdCenter">' . '<input type="checkbox" id="id'.$article->ID.'" name="id[]" value="'.$article->ID.'"/>' . '</td>';
	echo '</tr>';
}
	echo '</table>';
	
	///////////////////////////////////批量操作部分
	echo '<p>注意: 批量执行会消耗一定时间, 请耐心等候. 一次执行文章数量过多还可能导致系统资源过载, 请谨慎使用.</p>';
	echo '<p>操作:&nbsp;&nbsp; <select class="edit" size="1" name="edtcategory" id="edtcategory" style="width:150px;" ><option value="">转移到分类...</option>';
	foreach ($zbp->categorysbyorder as $id => $cate) {
	  echo '<option value="'. $cate->ID .'">' . $cate->SymbolName . '</option>';
	}
	echo'</select>&nbsp;&nbsp;&nbsp;&nbsp;
	<select class="edit" size="1" name="edtstatus" id="edtstatus" style="width:150px;" >
	<option value="">类型设置为...</option> 
	<option value="0" >' . $zbp->lang['post_status_name']['0'] . '</option>
	<option value="1" >' . $zbp->lang['post_status_name']['1'] . '</option>
	<option value="2" >' . $zbp->lang['post_status_name']['2'] . '</option>
	</select>&nbsp;&nbsp;&nbsp;&nbsp;
	<select class="edit" size="1" name="edtIsTop" id="edtIsTop" style="width:150px;" >
	<option value="">置顶设置为...</option> 
	<option value="1" >置顶</option>
	<option value="0" >取消置顶</option>
	</select>	&nbsp;&nbsp;&nbsp;&nbsp;
  <select class="edit" size="1" name="edtauthor" id="edtauthor" style="width:150px;" ><option value="">转移到用户...</option>';
	foreach ($zbp->membersbyname as $id => $member) {
	  echo '<option value="'. $member->ID .'">' . $member->Name . '</option>';
	}
	echo'</select>
		<select class="edit" size="1" name="addtag" id="addtag" style="width:150px;" ><option value="">增加TAG</option>';
	foreach ($zbp->tagsbyname as $id => $tag) {
	  echo '<option value="'. $tag->ID .'">' . $tag->Name . '</option>';
	}
	echo'</select>
		<select class="edit" size="1" name="deltag" id="deltag" style="width:150px;" ><option value="">删除TAG</option>';
	foreach ($zbp->tagsbyname as $id => $tag) {
	  echo '<option value="'. $tag->ID .'">' . $tag->Name . '</option>';
	}
	echo'</select>
	&nbsp;删除:<input type="checkbox" name="BatchDel" id="BatchDel" value="True" onclick="BatchDelEnabled();return true"/>
&nbsp;&nbsp;&nbsp;&nbsp;<br /><br /><input type="submit" class="button" onclick="BatchDeleteAll(""edtBatch"")" value="将所选文章提交批量执行"/></p>';
	echo '</form>';
	
	///////////////////////////////////
	
	echo '<hr/><p class="pagebar">';

foreach ($p->buttons as $key => $value) {
	echo '<a href="'. $value .'">' . $key . '</a>&nbsp;&nbsp;' ;
}

	echo '</p></div>';
	echo '<script type="text/javascript">ActiveLeftMenu("aArticleMng");</script>';
	echo '<script type="text/javascript">AddHeaderIcon("'. $zbp->host . 'zb_users/plugin/Nobird_Batch_Articles/logo.png' . '");</script>';

}

################################################################################################################
/**
* NB_GetVars, set a default value for request
 */
function NB_GetVars($name, $type = 'REQUEST') {
	$array = &$GLOBALS[strtoupper("_$type")];

	if (isset($array[$name])) {
		return $array[$name];
	} else {
		return null;
	}
}

################################################################################################################
/**
 * 文章删除
 */
function NB_DelArticle($id) {
	global $zbp;

	$article = new Post();
	$article->LoadInfoByID($id);
	if ($article->ID > 0) {

		if (!$zbp->CheckRights('ArticleAll') && $article->AuthorID != $zbp->user->ID)
			$zbp->ShowError(6, __FILE__, __LINE__);

		$pre_author = $article->AuthorID;
		$pre_tag = $article->Tag;
		$pre_category = $article->CateID;

		$article->Del();

		DelArticle_Comments($article->ID);

		CountTagArrayString($pre_tag);
		CountMemberArray(array($pre_author));
		CountCategoryArray(array($pre_category));
		CountNormalArticleNums();

		$zbp->AddBuildModule('previous');
		$zbp->AddBuildModule('calendar');
		$zbp->AddBuildModule('comments');
		$zbp->AddBuildModule('archives');
		$zbp->AddBuildModule('tags');
		$zbp->AddBuildModule('authors');

		foreach ($GLOBALS['Filter_Plugin_DelArticle_Succeed'] as $fpname => &$fpsignal)
			$fpname($article);
	} else {

	}

	return true;
}




?>