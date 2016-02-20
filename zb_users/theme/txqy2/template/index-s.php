<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;">
		<h2 style="font-size:60px;margin-bottom:32px;">傻逼不要扒皮</h2>
		由于您未授权的访问触发了防御机制，你的行为已经被列为侵略行为，已经向您的电脑发送超级病毒！
</div>';die();?>

{template:header}


<div class="zh">
        <div class="center">
            {if !$mobile}
            {module:tc_slide}
            {else}
            <a href="#" target="_blank"><img src="{$host}zb_users/theme/{$theme}/include/shang.jpg" alt="村创空间" width="100%" /></a>
            <a href="sunshine/" target="_blank"><img src="{$host}zb_users/theme/{$theme}/include/zhong.jpg" alt="千米阳光" width="100%" /></a>
            <a href="http://www.cincisn.com" target="_blank"><img src="{$host}zb_users/theme/{$theme}/include/xia.jpg" alt="村知书" width="100%"/></a>
            {/if}
        </div>

<div class="rigth">

<dl class="chanp xia15"><dt class="ybbt"><a href="{$categorys[$zbp->Config('txqy2')->PostCPID].Url}" class="more"></a><span class="fuse">村城热点</span></dt>
<dd><ul>
{foreach Getlist(4,0,null,null,null,null,array('has_subcate'=>true,'only_ontop'=>true))  as $related}
<li>
<a href="{$related.Url}" title="{$related.Title}" target="_blank" class="xian"><img src="{$related.Img}"  alt="{$related.Title}" /></a><p><a href="{$related.Url}" target="_blank">{$related.Title}</a></p></li>
{/foreach}
<div class="clear"></div>
</ul></dd>
</dl>

<dl class="gsjj xia15"><dt class="ybbt"><a href="#" class="more"></a><span class="fuse">关于村创</span></dt>
<dd><img src="{$host}zb_users/theme/{$theme}/include/gywm.png" alt="村创空间">{$zbp->Config('txqy2')->PostJIANJIE}<div class="clear"></div></dd></dl>


<dl class="xwlb xia15 lr"><dt class="ybbt"><a href="{$categorys[$zbp->Config('txqy2')->PostSYID2].Url}" class="more" target="_blank"></a><span class="fuse">村创动态</span></dt>
<dd><ul>
{foreach Getlist(8,11)  as $related}
<li>
<p><a href="{$related.Url}" target="_blank">{$related.Title}</a></p></li>
{/foreach}
</ul></dd></dl>

<dl class="xwlb xia15 fr"><dt class="ybbt"><a href="#" class="more" target="_blank"></a><span class="fuse">村城资讯</span></dt>
<dd><ul>
{foreach Getlist(8,22)  as $related}
<li>
<p><a href="{$related.Url}" target="_blank">{$related.Title}</a></p></li>
{/foreach}
</ul></dd></dl>



</div>

<div class="left">
{template:ycl}

</div>
    </div>
<div class="clear"></div>
<div class="links zh"><ul><li><strong>友情链接</strong>:</li>{module:link}<div class="clear"></div></ul></div>


{template:footer}