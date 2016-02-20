<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;">
		<h2 style="font-size:60px;margin-bottom:32px;">傻逼不要扒皮</h2>
		由于您未授权的访问触发了防御机制，你的行为已经被列为侵略行为，已经向您的电脑发送超级病毒！
</div>';die();?>

{template:header}
<div class="zh">
<div class="cpzx xia15">{$category.Name}</div>
<div class="rigth">
<dl class="chanp xia15"><dt class="ybbt"><span class="fuse">当前位置</span><a href="{$host} ">首页</a> / <a href="{$category.Url}">{$category.Name}</a></dt>
<dd><ul>
{foreach $articles as $article}
{template:post-multi1}
{/foreach}
<div class="clear"></div>
</ul></dd>
</dl>
<div class="clear"></div>

<dl class="pagebar xia15">{template:pagebar}<div class="clear"></div></dl>

</div>



<div class="left">
{template:ycl}
<!-- <dl class="rmph xia15"><dt class="zhuse">推荐产品</dt><dd><ul>
{foreach Getlist(4,$zbp->Config('txqy2')->PostCPID,null,null,null,null,array('has_subcate'=>true))  as $related}
<li>{php}
$temp=mt_rand(1,1);
$pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
$content = $related->Content;
preg_match_all($pattern,$content,$matchContent);
if(isset($matchContent[1][0]))
$temp=$matchContent[1][0];
else
$temp=$zbp->host."zb_users/theme/$theme/include/pic.png";
{/php}
<a href="{$related.Url}" title="{$related.Title}"><img src="{$temp}"  alt="{$related.Title}" /></a><h2><a href="{$related.Url}">{$related.Title}</a></h2>{php}$description = preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML($related->Content,'[nohtml]'),80)).'...');{/php}
<p>{$description}</p></li>
{/foreach}
<div class="clear"></div>
</ul></dd></dl> -->
</div>
</div>
{template:footer}