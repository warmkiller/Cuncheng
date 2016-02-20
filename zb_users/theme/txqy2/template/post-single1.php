<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;">
		<h2 style="font-size:60px;margin-bottom:32px;">傻逼不要扒皮</h2>
		由于您未授权的访问触发了防御机制，你的行为已经被列为侵略行为，已经向您的电脑发送超级病毒！
</div>';die();?>

<dl class="info xia15"><dt class="ybbt"><span class="fuse">当前位置</span><a href="{$host} ">首页</a> / <a href="{$article.Category.Url}">{$article.Category.Name}</a> / 正文</dt>

<h1 class="cph1">{$article.Title}</h1>

<dd class="cptu lr">{php}
$temp=mt_rand(1,1);
$pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
$content = $article->Content;
preg_match_all($pattern,$content,$matchContent);
if(isset($matchContent[1][0]))
$temp=$matchContent[1][0];
else
$temp=$zbp->host."zb_users/theme/$theme/include/pic.png";
{/php}
<a href="{$article.Url}" title="{$article.Title}" class="xian"><img src="{$temp}"  alt="{$article.Title}" /></a></dd>

<dd class="cpsm fr">
<p><strong>发布时间：</strong>{$article.Time('Y年m月d日')}</p>
<p><strong>产品类型：</strong>{$article.Metas.cplx}</p>
<p><strong>产品特点：</strong>{$article.Metas.cptd}</p>
<p class="cpjj"><strong>产品简介：</strong>{$article.Metas.cpjj}</p>
<p class="cpgm"><a href="http://wpa.qq.com/msgrd?v=3&uin={$zbp->Config('txqy2')->PostQQ}&site=qq&menu=yes" class="anniu fuse" target="_blank">在线咨询</a> <a href="javascript:void(0)" onclick="shoucang(document.title,window.location)" class="anniu dzs">收藏产品</a></p>
</dd>
<div class="clear"></div>

<dd class="cpxq">产品详情</dd>
<dd class="zi huix">{$article.Content}{$zbp->Config('txqy2')->PostFX}</dd>

<dd class="sx huix"><p><strong>上一篇：</strong>{if $article.Prev}
<a href="{$article.Prev.Url}" title="{$article.Prev.Title}">{$article.Prev.Title}</a>
{/if} </p><p class="sx-r"><strong>上一篇：</strong>{if $article.Next}
<a href="{$article.Next.Url}" title="{$article.Next.Title}">{$article.Next.Title}</a>
{/if}</p><div class="clear"></div></dd>
</dl>

{if !$article.IsLock}
{template:comments}
{/if}