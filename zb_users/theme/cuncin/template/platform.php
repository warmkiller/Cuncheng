<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/images/favicon.ico" REL="shortcut icon" />
<title>{$name}-{$title}</title>
<link rel="stylesheet" href="{$host}zb_users/theme/{$theme}/style/base.css" />
<link rel="stylesheet" href="http://www.crc.com.cn/images/about.css" />
<link rel="stylesheet" href="http://www.crc.com.cn/images/business.css" />
<link rel="stylesheet" href="{$host}zb_users/theme/{$theme}/style/images/investor.css" />

</head>

<body>
{template:c_header}



<div class="other-topimg" id="featured">
    <div id="slider">
        <ul>
            <li  class="sliderImage"><em class="img-top-bg"></em>
                <img src="/img/bg.jpg" /> <span></span>
            </li>
        </ul>
   </div> 
  </div><!--end other-topimg-->
<div  id="overlay">  
	<div class="otherswrap" id="discover">
    	<div class="layout">
            
<div class="othersmenu fl" >
            	<div class="other-titles">
<h2>平台介绍</h2>
</div>
                <div class="menu" >
                	<ul>
                        <li><a href="/cuncin/" class='tit'>村城互联平台</a></li>
                        <li><a href="/2n/" class='tit'>2+N配置平台</a></li>
                        <li><a href="/cincisn/" class='tit'>村知书产业信息文化平台</a></li>
                    </ul>
                </div><!--end menu-->
            </div>



        <!--end othersmenu-->
            <div class="othersmain business-brandactiv fr">
            	<div class="other-titles">
                	<h2>{$article.Title}</h2>
                    <div class="fr location"><a href="/" class="CurrChnlCls">首页</a>&nbsp;–&nbsp;<a href="#" class="CurrChnlCls">关于村城</a></div>
                </div>
                 
                    <DIV class='TRS_Editor'>
<div class="about-honormain">
    <div class="tckg"></div>
{$article.Content}</div>
</DIV>
                                               
            </div><!--end othersmain-->
        </div>
    </div><!--end otherswrap-->
    {template:footer}
<script src="http://dma.crc.com.cn/dma.js?4c22fadb84909" type="text/javascript"></script>
</div><!--end overlay-->
<div class="gotopbox">
	<div style="display: none" id="goTopBtn">
    	<a class="iconbg btn-gotohome" href="../../../">返回到首页</a>
    	<a class="iconbg btn-gototop"  id="btn-gototop">回到顶部</a>
    </div>
</div>


</body>
</html>
<script src="../../../images/jianfan.js"></script>