
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$name}-{$title}</title>
<link rel="stylesheet" href="{$host}zb_users/theme/{$theme}/style/base.css" />
<link rel="stylesheet" href="{$host}zb_users/theme/{$theme}/style/images/2013_mainbusiness.css" />




</head>

<body>

{template:c_header}

<!--end header-->

<div class="other-topimg" id="featured">
    <div id="slider">
        <ul id="sliderContent">
          <li  class="sliderImage"><em class="img-top-bg"></em><img src="/img/bg.jpg" /><span></span></li>    
        </ul>
   </div> 
   
   
   </div><!--end other-topimg--><div  id="overlay">  
  <div class="otherswrap" id="discover">
      <div class="layout">
          
<div class="othersmenu fl" >
              <div class="other-titles">
<h2>人才发展</h2>
</div>
                <div class="menu" >
                  <ul>
                        <li><a href="/hrconcept/" class='tit'>人才理念</a></li>
                        <li><a href="/category-33.html" class='tit'>人才引进</a></li>
                    </ul>
                </div><!--end menu-->
            </div>


      
      <!--end othersmenu-->
        <div class="othersmain newsmain fr">
          <div class="other-titles">
            <h2>人才发展</h2>
            <div class="fr location"><a href="{$host}" class="CurrChnlCls">首页</a>&nbsp;–&nbsp;<a href="/category-33.html" class="CurrChnlCls">人才招聘</a></div>  
          </div>
          <div class="newslist">
                    <ul>
{foreach $articles as $article}
                      <li>
                          <div class="time"><span class="day">{$article.Time('d')}</span><span class="date" >{$article.Time('Y-m')}</span></div>
                            <div class="conts">                        
<h3><a href="{$article.Url}" target="_blank">{$article.Title}</a></h3>
                                <p>{$article.Intro}...<a class="more" href="{$article.Url}" target="_blank"><img src="http://www.cuncin.com/zb_users/theme/cuncin/style/images/i08.gif" alt="更多" /></a></p>
                            </div>
                        </li>
{/foreach}
            
                    </ul>
                   </div><!--end newslist-->
                <div class="pages">
                                <span class="box btnpre">{template:pagebar} </span>
                </div><!--end pages-->
            </div><!--end othersmain-->
        </div>
    </div><!--end otherswrap-->
    {template:footer}
<script src="http://dma.crc.com.cn/dma.js?4c22fadb84909" type="text/javascript"></script>
 
 <!--end footer-->

</div><!--end overlay-->
<div class="gotopbox">
  <div style="display: none" id="goTopBtn">
      <a class="iconbg btn-gotohome" href="{$host}">返回到首页</a>
      <a class="iconbg btn-gototop"  id="btn-gototop">回到顶部</a>
    </div>
</div>
</body>
</html>
<script src="../../images/2013_jianfan.js" type="text/javascript"></script>