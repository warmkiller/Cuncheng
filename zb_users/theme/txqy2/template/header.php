{$regex = '/android|adr|iphone|ipad|windows\sphone|kindle|gt\-p|gt\-n|rim\stablet|opera|meego/i';
$mobile = false}
{if GetVars('alwaystheme', 'COOKIE') == 'mobile'} 
    {$mobile = true}
{/if}
{if preg_match($regex, GetVars('HTTP_USER_AGENT', 'SERVER'))} 
    {$mobile = true}
{/if}
{if GetVars('alwaystheme', 'COOKIE') == 'pc'} 
    {$mobile = false}
{/if}


<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;">
		<h2 style="font-size:60px;margin-bottom:32px;">傻逼不要扒皮</h2>
		由于您未授权的访问触发了防御机制，你的行为已经被列为侵略行为，已经向您的电脑发送超级病毒！
</div>';die();?>

<!DOCTYPE html>
<html>
<head>
     <meta name="viewport" content="width=device-width,initial-scale=1.33,minimum-scale=1.0,maximum-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="Content-Language" content="{$language}" />
{if $type=='article'}
    <title>{$title}-{$article.Category.Name}-{$name}</title>
    <meta name="keywords" content="{foreach $article.Tags as $tag}{$tag.Name},{/foreach}" />
    <meta name="description" content="{$article.Title}是{$name}中一篇关于{foreach $article.Tags as $tag}{$tag.Name}{/foreach}的文章，欢迎您阅读和评论,{$name}" />
{elseif $type=='page'}
    <title>{$title}-{$name}</title>
    <meta name="keywords" content="{$title},{$name}"/>
    {php}$description = preg_replace('/[\r\n\s]+/', ' ', trim(SubStrUTF8(TransferHTML($article->Content,'[nohtml]'),135)).'...');{/php}
    <meta name="description" content="{$description}"/>
    <meta name="author" content="{$article.Author.StaticName}">
{elseif $type=='index'}
    <title>{$name}{if $page>'1'}-第{$pagebar.PageNow}页{/if}-{$subname}</title>
    <meta name="Keywords" content="{$zbp->Config('txqy2')->PostGJC}">
    <meta name="description" content="{$zbp->Config('txqy2')->PostMS}">
{elseif $type=='category'}
    <title>{$title}-{$name}-第{$pagebar.PageNow}页</title>
    <meta name="Keywords" content="{$title},{$name}">
    <meta name="description" content="{$category.Intro}">
{else}
    <title>{$title}-{$name}</title>
{/if}
	<meta name="generator" content="{$zblogphp}" />
	<link rel="stylesheet" rev="stylesheet" href="{$host}zb_users/theme/{$theme}/style/{$style}.css" type="text/css" media="all"/>
	<script src="{$host}zb_system/script/common.js" type="text/javascript"></script>
	<script src="{$host}zb_system/script/c_html_js_add.php" type="text/javascript"></script>
    <script src="{$host}zb_users/theme/{$theme}/script/menu.js" type="text/javascript"></script>
    <script src="{$host}zb_users/theme/{$theme}/script/responsiveslides.min.js" type="text/javascript"></script>
    <script src="{$host}zb_users/theme/{$theme}/script/slide.js" type="text/javascript"></script>
{$header}
{if $type=='index'&&$page=='1'}
	<link rel="alternate" type="application/rss+xml" href="{$feedurl}" title="{$name}" />
	<link rel="EditURI" type="application/rsd+xml" title="RSD" href="{$host}zb_system/xml-rpc/?rsd" />
	<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="{$host}zb_system/xml-rpc/wlwmanifest.xml" /> 
{/if}

<style type="text/css">
body{color:#{$zbp->Config('txqy2')->wzys};}
a{color:#{$zbp->Config('txqy2')->ljys};}
a:hover{color:#{$zbp->Config('txqy2')->hdys};}
.hong,.sj-call strong{ color:#{$zbp->Config('txqy2')->hong};}
.cpxq{border-bottom:solid 1px #{$zbp->Config('txqy2')->fuse};}
.cpin li{border-bottom:solid 1px #{$zbp->Config('txqy2')->zhuse};}
.zhuse,.left .cpin li a,#hamburgermenu li ul,.cpin li a:hover,#navbar,#hamburgermenu{background-color:#{$zbp->Config('txqy2')->zhuse};}
.fuse,#hamburgermenu li a.on,.pagebar a:hover,.pagebar .now-page,.cpin dt{background-color:#{$zbp->Config('txqy2')->fuse};}
#hamburgermenu li a:hover,.lxwm dt,#hamburgermenu li ul a:hover,.dzs{background-color:#{$zbp->Config('txqy2')->hong}}
#comments h3,#comments h4{border-left-color: #{$zbp->Config('txqy2')->fuse};}
.chanp li .xian:hover,.rmph li img:hover{border:solid 1px #{$zbp->Config('txqy2')->hong};}

{if $zbp->Config('txqy2')->clkg=='0'}
@media screen and (max-width: 767px){.zh .left{display:none;}}
{/if}

{if $zbp->Config('txqy2')->hdpkg=='0'}
@media screen and (max-width: 767px){.zh .flash{display:none;}}
{/if}

</style>

</head>

<body>
<div >
<div class="head zh">
{if $type=='article'}
<h2 class="logo"><a href="{$host}" title="{$name}"><img src="{$host}zb_users/theme/{$theme}/include/logo.png" alt="{$name}"/></a></h2>
{else}
<h1 class="logo"><a href="{$host}" title="{$name}"><img src="{$host}zb_users/theme/{$theme}/include/logo.png" alt="{$name}"/></a></h1>
{/if}
{if !$mobile}
<span class="call">联系电话：<strong class="c34 hong">{$zbp->Config('txqy2')->PostCALL}</strong></span>
{/if}
<div class="clear"></div>
</div>

  <header>
    <div id="navbar" class="xia15 zh">
<span class="sj-call">联系电话：<strong>{$zbp->Config('txqy2')->PostCALL}</strong></span>

      <a href="#" class="menubtn"><span></span><span></span><span></span><span></span></a>
      <!-- use captain icon for toggle menu -->
      <div id="hamburgermenu"  data-type="{if $type=='article'}article{elseif $type=='page'}page{elseif $type=='index'}index{else}category{/if}"  data-infoid="{if $type=='article'}{$article.Category.ID} {elseif $type=='page'}{$article.ID}{elseif $type=='index'} {else}{$category.ID}{/if}">
        <ul class="dhgl">{module:navbar}<div class="clear"></div></ul>
      </div>
    </div>
    <div class="overlay"></div>
  </header>
<div class="clear"></div>


