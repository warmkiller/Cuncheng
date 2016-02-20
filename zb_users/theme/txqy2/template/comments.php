{if $socialcomment}
<div id="comments">	
<span class="icon icon_comment" title="comment"></span>
{$socialcomment}
</div>
{else}

<div id="comments">	
<span class="icon icon_comment" title="comment"></span>
{if $article.CommNums==0}
<h5>额 本文暂时没人评论 来添加一个吧</h5>
{/if}
{if $article.CommNums>0}
<h3>已有{$article.CommNums}位网友发表了看法：</h3>
<!--评论输出-->
{foreach $comments as $key => $comment}
{template:comment}
{/foreach}

<!--评论翻页条输出-->
<div class="pagebar commentpagebar">
{template:pagebar}
</div>
{/if}





<!--评论框-->
{if !$article.IsLock}
{template:commentpost}
{/if}
</div>

{/if}