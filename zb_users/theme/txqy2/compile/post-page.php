

<dl class="info xia15"><dt class="ybbt"><span class="fuse">当前位置</span><a href="<?php  echo $host;  ?> ">首页</a> / <?php  echo $article->Title;  ?></dt>
<dd class="title"><h1><?php  echo $article->Title;  ?></h1><small class="huix">发布时间：<?php  echo $article->Time('Y年m月d日');  ?> | 浏览:<?php  echo $article->ViewNums;  ?> | 评论:<?php  echo $article->CommNums;  ?></small></dd>

<dd class="zi huix"><?php  echo $article->Content;  ?><?php  echo $zbp->Config('txqy2')->PostFX;  ?></dd>

</dl>

<?php if (!$article->IsLock) { ?>
<?php  include $this->GetTemplate('comments');  ?>
<?php } ?>