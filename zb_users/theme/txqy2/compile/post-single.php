

<dl class="info xia15"><dt class="ybbt"><span class="fuse">当前位置</span><a href="<?php  echo $host;  ?> ">首页</a> / <a href="<?php  echo $article->Category->Url;  ?>"><?php  echo $article->Category->Name;  ?></a> / 正文</dt>
<dd class="title"><h1><?php  echo $article->Title;  ?></h1><small class="huix">发布时间：<?php  echo $article->Time('Y年m月d日');  ?> | 分类:<?php  echo $article->Category->Name;  ?> | 浏览:<?php  echo $article->ViewNums;  ?> | 评论:<?php  echo $article->CommNums;  ?></small></dd>

<dd class="zi huix"><?php  echo $article->Content;  ?><?php  echo $zbp->Config('txqy2')->PostFX;  ?></dd>

<!-- <dd class="sx huix"><p><strong>上一篇：</strong><?php if ($article->Prev) { ?>
<a href="<?php  echo $article->Prev->Url;  ?>" title="<?php  echo $article->Prev->Title;  ?>"><?php  echo $article->Prev->Title;  ?></a>
<?php } ?> </p><p class="sx-r"><strong>下一篇：</strong><?php if ($article->Next) { ?>
<a href="<?php  echo $article->Next->Url;  ?>" title="<?php  echo $article->Next->Title;  ?>"><?php  echo $article->Next->Title;  ?></a>
<?php } ?></p><div class="clear"></div></dd> -->
</dl>

<?php if (!$article->IsLock) { ?>
<?php  include $this->GetTemplate('comments');  ?>
<?php } ?>