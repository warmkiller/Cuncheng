

<?php  include $this->GetTemplate('header');  ?>
<div class="zh">
<div class="nrbt xia15"><?php if ($type=='article') { ?><?php  echo $article->Category->Name;  ?><?php }else{  ?><?php  echo $title;  ?><?php } ?></div>

<div class="rigth">
<?php if ($article->Type==ZC_POST_TYPE_ARTICLE) { ?>
<?php  include $this->GetTemplate('post-single1');  ?>
<?php }else{  ?>
<?php  include $this->GetTemplate('post-page');  ?>
<?php } ?>
<div class="clear"></div>
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