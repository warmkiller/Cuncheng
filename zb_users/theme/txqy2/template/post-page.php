<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;">
		<h2 style="font-size:60px;margin-bottom:32px;">傻逼不要扒皮</h2>
		由于您未授权的访问触发了防御机制，你的行为已经被列为侵略行为，已经向您的电脑发送超级病毒！
</div>';die();?>

<dl class="info xia15"><dt class="ybbt"><span class="fuse">当前位置</span><a href="{$host} ">首页</a> / {$article.Title}</dt>
<dd class="title"><h1>{$article.Title}</h1><small class="huix">发布时间：{$article.Time('Y年m月d日')} | 浏览:{$article.ViewNums} | 评论:{$article.CommNums}</small></dd>

<dd class="zi huix">{$article.Content}{$zbp->Config('txqy2')->PostFX}</dd>

</dl>

{if !$article.IsLock}
{template:comments}
{/if}