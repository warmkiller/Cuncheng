

<?php  include $this->GetTemplate('header');  ?>





<!-- <div class="xwzx xia15"><?php  echo $category->Name;  ?></div> -->
<br>

<div class="zh">
<div class="rigth">
<dl class="xinw xia15"><dt class="ybbt"><span class="fuse">当前位置</span><a href="<?php  echo $host;  ?> ">首页</a> / <a href="<?php  echo $category->Url;  ?>"><?php  echo $category->Name;  ?></a></dt>
<dd><ul>
<?php  foreach ( $articles as $article) { ?>

<?php if ($article->IsTop) { ?>
<?php  include $this->GetTemplate('post-istop');  ?>
<?php }else{  ?>
<?php  include $this->GetTemplate('post-multi');  ?>
<?php } ?>

<?php }   ?>
<div class="clear"></div>
</ul></dd>
</dl>
<div class="clear"></div>

<dl class="pagebar xia15"><?php  include $this->GetTemplate('pagebar');  ?><div class="clear"></div></dl>

</div>



<div class="left">
<?php  include $this->GetTemplate('ycl');  ?>
<!-- <dl class="rmph xia15"><dt class="zhuse">推荐产品</dt><dd><ul>
<?php  foreach ( Getlist(4,$zbp->Config('txqy2')->PostCPID,null,null,null,null,array('has_subcate'=>true))  as $related) { ?>
<li><?php 
$temp=mt_rand(1,1);
$pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
$content = $related->Content;
preg_match_all($pattern,$content,$matchContent);
if(isset($matchContent[1][0]))
$temp=$matchContent[1][0];
else
$temp=$zbp->host."zb_users/theme/$theme/include/pic.png";
 ?>
<a href="<?php  echo $related->Url;  ?>" title="<?php  echo $related->Title;  ?>"><img src="<?php  echo $temp;  ?>"  alt="<?php  echo $related->Title;  ?>" /></a><h2><a href="<?php  echo $related->Url;  ?>"><?php  echo $related->Title;  ?></a></h2><?php $description = preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML($related->Content,'[nohtml]'),80)).'...'); ?>
<p><?php  echo $description;  ?></p></li>
<?php }   ?>
<div class="clear"></div>
</ul></dd></dl> -->
</div>
    </div>
<?php  include $this->GetTemplate('footer');  ?>