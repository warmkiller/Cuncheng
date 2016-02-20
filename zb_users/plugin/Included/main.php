<?php
require '../../../zb_system/function/c_system_base.php';

require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('Included')) {$zbp->ShowError(48);die();}

$blogtitle='收录情况生成器';

if(count($_POST)>0){

$tccategory='<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8 \>';

if(GetVars('category')){
    foreach ($zbp->categorys as $c) {
        $tccategory=$tccategory.$c->Name.'---------'.$c->Url.'---------'.baidu_check($c->Url).'<br>';
    }
}

file_put_contents($zbp->path . 'zb_users/plugin/Included/tc/category.php',$tccategory);

$xx='<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8 \>';

if(GetVars('article')){
    $array=$zbp->GetArticleList(
        null,
        array(array('=','log_Status',0)),
        null,
        null,
        null,
        false
        );
    foreach ($array as $key => $value) {
        $xx=$xx.$value->Title.'---------'.$value->Url.'---------'.baidu_check($value->Url).'<br>';
    }
}

file_put_contents($zbp->path . 'zb_users/plugin/Included/tc/article.php',$xx);


$xx='<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8 \>';
if(GetVars('page')){
    $array=$zbp->GetPageList(
        null,
        array(array('=','log_Status',0)),
        null,
        null,
        null
        );

    foreach ($array as $key => $value) {
        $xx=$xx.$value->Title.'---------'.$value->Url.'---------'.baidu_check($value->Url).'<br>';
    }
}

file_put_contents($zbp->path . 'zb_users/plugin/Included/tc/page.php',$xx);


$xx='<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8 \>';
if(GetVars('tag')){
    $array=$zbp->GetTagList();

    foreach ($array as $key => $value) {
        $xx=$xx.$value->Name.'---------'.$value->Url.'---------'.baidu_check($value->Url).'<br>';
    }
}
file_put_contents($zbp->path . 'zb_users/plugin/Included/tc/tag.php',$xx);

	$zbp->SetHint('good');
	Redirect($_SERVER["HTTP_REFERER"]);
}

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
  <div class="SubMenu">

  </div>
  <div id="divMain2">
	<form id="edit" name="edit" method="post" action="#">
<input id="reset" name="reset" type="hidden" value="" />
<table border="1" class="tableFull tableBorder tableBorder-thcenter">
<tr>
	<th class="td20"></th>
	<th>收录情况内容组成</th>
</tr>
<tr>
    <td>选项</td>
    <td>
<p>分类<input type="text" name="category" class="checkbox" value="1" /></p>
<p>文章<input type="text" name="article" class="checkbox" value="1" /></p>
<p>页面<input type="text" name="page" class="checkbox" value="1" /></p>
<p>标签<input type="text" name="tag" class="checkbox" value="1" /></p>
    </td>
</tr>
</table>
	  <hr/>
	  <p><input type="submit" class="button" value="生成收录情况文档" /></p>
	  <hr/>


<table border="1" class="tableFull tableBorder">
<tr>
    <td class="td20">分类收录情况：</td>
    <td><p><a href="<?php echo $zbp->host;?>zb_users/plugin/Included/tc/category.php" target="_blank">点击查看</a></p></td>
</tr>
<tr>
    <td class="td20">文章收录情况：</td>
    <td><p><a href="<?php echo $zbp->host;?>zb_users/plugin/Included/tc/article.php" target="_blank">点击查看</a></p></td>
</tr>
<tr>
    <td class="td20">页面收录情况：</td>
    <td><p><a href="<?php echo $zbp->host;?>zb_users/plugin/Included/tc/page.php" target="_blank">点击查看</a></p></td>
</tr>
<tr>
    <td class="td20">标签收录情况：</td>
    <td><p><a href="<?php echo $zbp->host;?>zb_users/plugin/Included/tc/tag.php" target="_blank">点击查看</a></p></td>
</tr>
</table>

	</form>
	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/Included/logo.png';?>");</script>	
  </div>
</div>


<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>