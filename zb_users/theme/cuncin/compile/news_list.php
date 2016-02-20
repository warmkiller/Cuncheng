
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php  echo $name;  ?>-<?php  echo $title;  ?></title>
<link rel="stylesheet" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/base.css" />
<link rel="stylesheet" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/images/2013_mainbusiness.css" />




</head>

<body>

<?php  include $this->GetTemplate('c_header');  ?>

<!--end header-->

<div class="other-topimg" id="featured">
    <div id="slider">
        <ul id="sliderContent">
          <li  class="sliderImage"><em class="img-top-bg"></em><img src="/img/bg.jpg" alt="村城集团" /><span></span></li>    
        </ul>
   </div> 
   
   
   </div><!--end other-topimg--><div  id="overlay">  
  <div class="otherswrap" id="discover">
      <div class="layout">
          
<div class="othersmenu fl" >
              <div class="other-titles">
<h2>新闻中心</h2>
</div>
                <div class="menu" >
                  <ul>
                        <li><a href="/category-1.html" class='tit'>村城资讯</a></li>
                        <li><a href="/category-11.html" class='tit'>集团动态</a></li>
                        <li><a href="/category-14.html" class='tit'>视频中心</a></li>
                        <li><a href="/category-25.html" class='tit'>媒体报道</a></li>
                        <li><a href="/category-15.html" class='tit'>行业新闻</a></li>
                    </ul>
                </div><!--end menu-->
            </div>


      
      <!--end othersmenu-->
        <div class="othersmain newsmain fr">
          <div class="other-titles">
            <h2><?php  echo $title;  ?></h2>
            <div class="fr location"><a href="<?php  echo $host;  ?>" class="CurrChnlCls">首页</a>&nbsp;–&nbsp;<a href="../" class="CurrChnlCls">新闻中心</a>&nbsp;–&nbsp;<a href="#" class="CurrChnlCls"><?php  echo $name;  ?></a></div>  
          </div>
          <div class="newslist">
                    <ul>
<?php  foreach ( $articles as $article) { ?>
                      <li>
                          <div class="time"><span class="day"><?php  echo $article->Time('d');  ?></span><span class="date" ><?php  echo $article->Time('Y-m');  ?></span></div>
                            <div class="conts">                        
<h3><a href="<?php  echo $article->Url;  ?>" target="_blank"><?php  echo $article->Title;  ?></a></h3>
                                <p><?php  echo $article->Intro;  ?>...<a class="more" href="<?php  echo $article->Url;  ?>" target="_blank"><img src="http://www.cuncin.com/zb_users/theme/cuncin/style/images/i08.gif" alt="更多" /></a></p>
                            </div>
                        </li>
<?php }   ?>
            
                    </ul>
                   </div><!--end newslist-->
                <div class="pages">
                                <span class="box btnpre"><?php  include $this->GetTemplate('pagebar');  ?> </span>
                </div><!--end pages-->
            </div><!--end othersmain-->
        </div>
    </div><!--end otherswrap-->
    <?php  include $this->GetTemplate('footer');  ?>
<script src="http://dma.crc.com.cn/dma.js?4c22fadb84909" type="text/javascript"></script>
 
 <!--end footer-->

</div><!--end overlay-->
<div class="gotopbox">
  <div style="display: none" id="goTopBtn">
      <a class="iconbg btn-gotohome" href="<?php  echo $host;  ?>">返回到首页</a>
      <a class="iconbg btn-gototop"  id="btn-gototop">回到顶部</a>
    </div>
</div>
</body>
</html>
<script src="../../images/2013_jianfan.js" type="text/javascript"></script>