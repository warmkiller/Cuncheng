<label id="AjaxCommentBegin"></label><?php if ($socialcomment) { ?>
<div id="comments">	
<span class="icon icon_comment" title="comment"></span>
<?php  echo $socialcomment;  ?>
</div>
<?php }else{  ?>

<div id="comments">	
<span class="icon icon_comment" title="comment"></span>
<?php if ($article->CommNums==0) { ?>
<h5>额 本文暂时没人评论 来添加一个吧</h5>
<?php } ?>
<?php if ($article->CommNums>0) { ?>
<h3>已有<?php  echo $article->CommNums;  ?>位网友发表了看法：</h3>
<!--评论输出-->
<?php  foreach ( $comments as $key => $comment) { ?>
<?php  include $this->GetTemplate('comment');  ?>
<?php }   ?>

<!--评论翻页条输出-->
<div class="pagebar commentpagebar">
<?php  include $this->GetTemplate('pagebar');  ?>
</div>
<?php } ?>





<!--评论框-->
<?php if (!$article->IsLock) { ?>
<?php  include $this->GetTemplate('commentpost');  ?>
<?php } ?>
</div>

<?php } ?><label id="AjaxCommentEnd"></label>