<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;">
        <h2 style="font-size:60px;margin-bottom:32px;">傻逼不要扒皮</h2>
        由于您未授权的访问触发了防御机制，你的行为已经被列为侵略行为，已经向您的电脑发送超级病毒！
</div>';die();?>

{template:header}

<br>

<style type="text/css">
#banner { position: relative; width: 100%; height: 600px; border: 1px solid #666; overflow: hidden; display:inline-block;}
#banner_list img { border: 0px; }
#banner_bg { position: absolute; bottom: 0; background-color: #000; height: 30px; filter: Alpha(Opacity=30); opacity: 0.3; z-index: 1000; cursor: pointer; width: 478px; }
#banner_info { position: absolute; bottom: 0; left: 5px; height: 22px; color: #fff; z-index: 1001; cursor: pointer }
#banner_text { position: absolute; width: 120px; z-index: 1002; right: 3px; bottom: 3px; }
#banner ul { position: absolute; list-style-type: none; filter: Alpha(Opacity=80); opacity: 0.8; z-index: 1002; margin: 0; padding: 0; bottom: 3px; right: 5px; }
#banner ul li { padding: 0px 8px; float: left; display: block; color: #FFF; background: #6f4f67; cursor: pointer; border: 1px solid #333; }
#banner ul li.on { background-color: #000; }
#banner_list a { position: absolute; }
</style>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js"></script>
<script src="{$host}zb_users/theme/{$theme}/script/sunshine.js" type="text/javascript"></script>


<div class="zh">
{if !$mobile}
    <div id="hamburgermenu"  data-type="{if $type=='article'}article{elseif $type=='page'}page{elseif $type=='index'}index{else}category{/if}"  data-infoid="{if $type=='article'}{$article.Category.ID} {elseif $type=='page'}{$article.ID}{elseif $type=='index'} {else}{$category.ID}{/if}" style="background-color:#aaa;">
            <ul class="dhgl">{$zbp->Config('txqy2')->PostCPLB}<div class="clear"></div></ul>
          </div>
{else}
<div class="left">
    <dl class="cpin"><dt><span>S</span><h2>千米阳光</h2><small>unshine</small></dt>
<dd><ul>
{$zbp->Config('txqy2')->PostCPLB}</ul></dd></dl>
</div><br>
{/if}
      <br>

<div id="banner">
  <div id="banner_bg"></div>
  <!--标题背景-->
  <div id="banner_info"></div>
  <!--标题-->
  <ul>
    <li class="on">1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
  </ul>
  <div id="banner_list"> 
    <a href="#" target="_blank"><img id="img1" src="{$host}zb_users/theme/{$theme}/include/1.jpg" title="千米阳光" alt="千米阳光"/></a> 
    <a href="#" target="_blank"><img src="{$host}zb_users/theme/{$theme}/include/2.jpg" title="千米阳光" alt="千米阳光"/></a> 
    <a href="#" target="_blank"><img src="{$host}zb_users/theme/{$theme}/include/3.jpg" title="千米阳光" alt="千米阳光"/></a> 
    <a href="#" target="_blank"><img src="{$host}zb_users/theme/{$theme}/include/4.jpg" title="千米阳光" alt="千米阳光"/></a> 
 </div>
</div>
    </div>
<div class="clear"></div>
<br>
<div class="links zh"><ul><li><strong>友情链接</strong>:</li>{module:link}<div class="clear"></div></ul></div>


{template:footer}