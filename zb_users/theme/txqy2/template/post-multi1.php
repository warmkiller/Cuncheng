<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;">
		<h2 style="font-size:60px;margin-bottom:32px;">傻逼不要扒皮</h2>
		由于您未授权的访问触发了防御机制，你的行为已经被列为侵略行为，已经向您的电脑发送超级病毒！
</div>';die();?>
<li>{php}
$temp=mt_rand(1,1);
$pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
$content = $article->Content;
preg_match_all($pattern,$content,$matchContent);
if(isset($matchContent[1][0]))
$temp=$matchContent[1][0];
else
$temp=$zbp->host."zb_users/theme/$theme/include/pic.png";
{/php}
<a href="{$article.Url}" title="{$article.Title}" class="xian"><img src="{$temp}"  alt="{$article.Title}" /></a><p><a href="{$article.Url}">{$article.Title}</a></p></li>
