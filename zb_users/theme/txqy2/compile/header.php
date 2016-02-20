<?php  $regex = '/android|adr|iphone|ipad|windows\sphone|kindle|gt\-p|gt\-n|rim\stablet|opera|meego/i';
$mobile = false;  ?>
<?php if (GetVars('alwaystheme', 'COOKIE') == 'mobile') { ?> 
    <?php  $mobile = true;  ?>
<?php } ?>
<?php if (preg_match($regex, GetVars('HTTP_USER_AGENT', 'SERVER'))) { ?> 
    <?php  $mobile = true;  ?>
<?php } ?>
<?php if (GetVars('alwaystheme', 'COOKIE') == 'pc') { ?> 
    <?php  $mobile = false;  ?>
<?php } ?>




<!DOCTYPE html>
<html>
<head>
     <meta name="viewport" content="width=device-width,initial-scale=1.33,minimum-scale=1.0,maximum-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="Content-Language" content="<?php  echo $language;  ?>" />
<?php if ($type=='article') { ?>
    <title><?php  echo $title;  ?>-<?php  echo $article->Category->Name;  ?>-<?php  echo $name;  ?></title>
    <meta name="keywords" content="<?php  foreach ( $article->Tags as $tag) { ?><?php  echo $tag->Name;  ?>,<?php }   ?>" />
    <meta name="description" content="<?php  echo $article->Title;  ?>是<?php  echo $name;  ?>中一篇关于<?php  foreach ( $article->Tags as $tag) { ?><?php  echo $tag->Name;  ?><?php }   ?>的文章，欢迎您阅读和评论,<?php  echo $name;  ?>" />
<?php }elseif($type=='page') {  ?>
    <title><?php  echo $title;  ?>-<?php  echo $name;  ?></title>
    <meta name="keywords" content="<?php  echo $title;  ?>,<?php  echo $name;  ?>"/>
    <?php $description = preg_replace('/[\r\n\s]+/', ' ', trim(SubStrUTF8(TransferHTML($article->Content,'[nohtml]'),135)).'...'); ?>
    <meta name="description" content="<?php  echo $description;  ?>"/>
    <meta name="author" content="<?php  echo $article->Author->StaticName;  ?>">
<?php }elseif($type=='index') {  ?>
    <title><?php  echo $name;  ?><?php if ($page>'1') { ?>-第<?php  echo $pagebar->PageNow;  ?>页<?php } ?>-<?php  echo $subname;  ?></title>
    <meta name="Keywords" content="<?php  echo $zbp->Config('txqy2')->PostGJC;  ?>">
    <meta name="description" content="<?php  echo $zbp->Config('txqy2')->PostMS;  ?>">
<?php }elseif($type=='category') {  ?>
    <title><?php  echo $title;  ?>-<?php  echo $name;  ?>-第<?php  echo $pagebar->PageNow;  ?>页</title>
    <meta name="Keywords" content="<?php  echo $title;  ?>,<?php  echo $name;  ?>">
    <meta name="description" content="<?php  echo $category->Intro;  ?>">
<?php }else{  ?>
    <title><?php  echo $title;  ?>-<?php  echo $name;  ?></title>
	<?php if ($type) { ?><?php  echo $Nobird_Seo_KeyAndDes;  ?><?php } ?>
<?php } ?>
	<meta name="generator" content="<?php  echo $zblogphp;  ?>" />
	<link rel="stylesheet" rev="stylesheet" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/<?php  echo $style;  ?>.css" type="text/css" media="all"/>
	<script src="<?php  echo $host;  ?>zb_system/script/common.js" type="text/javascript"></script>
	<script src="<?php  echo $host;  ?>zb_system/script/c_html_js_add.php" type="text/javascript"></script>
    <script src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/script/menu.js" type="text/javascript"></script>
    <script src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/script/responsiveslides.min.js" type="text/javascript"></script>
    <script src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/script/slide.js" type="text/javascript"></script>
<?php  echo $header;  ?>
<?php if ($type=='index'&&$page=='1') { ?>
	<link rel="alternate" type="application/rss+xml" href="<?php  echo $feedurl;  ?>" title="<?php  echo $name;  ?>" />
	<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php  echo $host;  ?>zb_system/xml-rpc/?rsd" />
	<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php  echo $host;  ?>zb_system/xml-rpc/wlwmanifest.xml" /> 
<?php } ?>

<style type="text/css">
body{color:#<?php  echo $zbp->Config('txqy2')->wzys;  ?>;}
a{color:#<?php  echo $zbp->Config('txqy2')->ljys;  ?>;}
a:hover{color:#<?php  echo $zbp->Config('txqy2')->hdys;  ?>;}
.hong,.sj-call strong{ color:#<?php  echo $zbp->Config('txqy2')->hong;  ?>;}
.cpxq{border-bottom:solid 1px #<?php  echo $zbp->Config('txqy2')->fuse;  ?>;}
.cpin li{border-bottom:solid 1px #<?php  echo $zbp->Config('txqy2')->zhuse;  ?>;}
.zhuse,.left .cpin li a,#hamburgermenu li ul,.cpin li a:hover,#navbar,#hamburgermenu{background-color:#<?php  echo $zbp->Config('txqy2')->zhuse;  ?>;}
.fuse,#hamburgermenu li a.on,.pagebar a:hover,.pagebar .now-page,.cpin dt{background-color:#<?php  echo $zbp->Config('txqy2')->fuse;  ?>;}
#hamburgermenu li a:hover,.lxwm dt,#hamburgermenu li ul a:hover,.dzs{background-color:#<?php  echo $zbp->Config('txqy2')->hong;  ?>}
#comments h3,#comments h4{border-left-color: #<?php  echo $zbp->Config('txqy2')->fuse;  ?>;}
.chanp li .xian:hover,.rmph li img:hover{border:solid 1px #<?php  echo $zbp->Config('txqy2')->hong;  ?>;}

<?php if ($zbp->Config('txqy2')->clkg=='0') { ?>
@media screen and (max-width: 767px){.zh .left{display:none;}}
<?php } ?>

<?php if ($zbp->Config('txqy2')->hdpkg=='0') { ?>
@media screen and (max-width: 767px){.zh .flash{display:none;}}
<?php } ?>

</style>

</head>

<body>
<div >
<div class="head zh">
<?php if ($type=='article') { ?>
<h2 class="logo"><a href="<?php  echo $host;  ?>" title="<?php  echo $name;  ?>"><img src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/include/logo.png" alt="<?php  echo $name;  ?>"/></a></h2>
<?php }else{  ?>
<h1 class="logo"><a href="<?php  echo $host;  ?>" title="<?php  echo $name;  ?>"><img src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/include/logo.png" alt="<?php  echo $name;  ?>"/></a></h1>
<?php } ?>
<?php if (!$mobile) { ?>
<span class="call">联系电话：<strong class="c34 hong"><?php  echo $zbp->Config('txqy2')->PostCALL;  ?></strong></span>
<?php } ?>
<div class="clear"></div>
</div>

  <header>
    <div id="navbar" class="xia15 zh">
<span class="sj-call">联系电话：<strong><?php  echo $zbp->Config('txqy2')->PostCALL;  ?></strong></span>

      <a href="#" class="menubtn"><span></span><span></span><span></span><span></span></a>
      <!-- use captain icon for toggle menu -->
      <div id="hamburgermenu"  data-type="<?php if ($type=='article') { ?>article<?php }elseif($type=='page') {  ?>page<?php }elseif($type=='index') {  ?>index<?php }else{  ?>category<?php } ?>"  data-infoid="<?php if ($type=='article') { ?><?php  echo $article->Category->ID;  ?> <?php }elseif($type=='page') {  ?><?php  echo $article->ID;  ?><?php }elseif($type=='index') {  ?> <?php }else{  ?><?php  echo $category->ID;  ?><?php } ?>">
        <ul class="dhgl"><?php  if(isset($modules['navbar'])){echo $modules['navbar']->Content;}  ?><div class="clear"></div></ul>
      </div>
    </div>
    <div class="overlay"></div>
  </header>
<div class="clear"></div>


