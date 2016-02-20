

<dl class="info xia15"><dt class="ybbt"><span class="fuse">当前位置</span><a href="<?php  echo $host;  ?> ">首页</a> / <a href="<?php  echo $article->Category->Url;  ?>"><?php  echo $article->Category->Name;  ?></a> / 正文</dt>

<h1 class="cph1"><?php  echo $article->Title;  ?></h1>

<dd class="cptu lr"><?php 
$temp=mt_rand(1,1);
$pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
$content = $article->Content;
preg_match_all($pattern,$content,$matchContent);
if(isset($matchContent[1][0]))
$temp=$matchContent[1][0];
else
$temp=$zbp->host."zb_users/theme/$theme/include/pic.png";
 ?>
<a href="<?php  echo $article->Url;  ?>" title="<?php  echo $article->Title;  ?>" class="xian"><img src="<?php  echo $temp;  ?>"  alt="<?php  echo $article->Title;  ?>" /></a></dd>

<dd class="cpsm fr">
<p><strong>发布时间：</strong><?php  echo $article->Time('Y年m月d日');  ?></p>
<p><strong>产品类型：</strong><?php  echo $article->Metas->cplx;  ?></p>
<p><strong>产品特点：</strong><?php  echo $article->Metas->cptd;  ?></p>
<p class="cpjj"><strong>产品简介：</strong><?php  echo $article->Metas->cpjj;  ?></p>
<p class="cpgm"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php  echo $zbp->Config('txqy2')->PostQQ;  ?>&site=qq&menu=yes" class="anniu fuse" target="_blank">在线咨询</a> <a href="javascript:void(0)" onclick="shoucang(document.title,window.location)" class="anniu dzs">收藏产品</a></p>
</dd>
<div class="clear"></div>

<dd class="cpxq">产品详情</dd>
<dd class="zi huix"><?php  echo $article->Content;  ?><?php  echo $zbp->Config('txqy2')->PostFX;  ?></dd>

<dd class="sx huix"><p><strong>上一篇：</strong><?php if ($article->Prev) { ?>
<a href="<?php  echo $article->Prev->Url;  ?>" title="<?php  echo $article->Prev->Title;  ?>"><?php  echo $article->Prev->Title;  ?></a>
<?php } ?> </p><p class="sx-r"><strong>上一篇：</strong><?php if ($article->Next) { ?>
<a href="<?php  echo $article->Next->Url;  ?>" title="<?php  echo $article->Next->Title;  ?>"><?php  echo $article->Next->Title;  ?></a>
<?php } ?></p><div class="clear"></div></dd>
</dl>

<?php if (!$article->IsLock) { ?>
<?php  include $this->GetTemplate('comments');  ?>
<?php } ?>