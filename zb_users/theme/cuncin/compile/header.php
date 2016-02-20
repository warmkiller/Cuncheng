<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta property="qc:admins" content="134042252163563166375" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/images/favicon.ico" REL="shortcut icon" />

<title><?php  echo $name;  ?>-<?php  echo $title;  ?></title>
	<?php if ($type) { ?><?php  echo $Nobird_Seo_KeyAndDes;  ?><?php } ?>
  <meta name="Keywords" content="村城、河南省村城企业管理、资源流配置">
  <meta name="description" content="河南省村城企业管理有限公司倾力打造“村城”互联平台,致力于发展先下线上农村&城市资源流的配置,以 “村商及项目” 孵化为核心,铺设“村创空间”">
  <meta name="author" content="<?php  echo $zbp->members[1]->Name;  ?>">


<link rel="stylesheet" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/base.css" />
<link rel="stylesheet" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/images/index_new.css" />
<script src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/script/jquery-1.7.1.min.js"></script>
<script src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/script/main.js"></script>
<script src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/script/jquery.SuperSlide.js"></script>
<script src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/script/swfobject.js"></script>
<script type="text/javascript" src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/script/scrollZt.js"></script>
<?php  echo $header;  ?>
<?php if ($type=='index'&&$page=='1') { ?>
	<link rel="alternate" type="application/rss+xml" href="<?php  echo $feedurl;  ?>" title="<?php  echo $name;  ?>" />
	<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php  echo $host;  ?>zb_system/xml-rpc/?rsd" />
	<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php  echo $host;  ?>zb_system/xml-rpc/wlwmanifest.xml" /> 
<?php } ?>
</head> 