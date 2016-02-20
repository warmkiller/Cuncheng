<?php  include $this->GetTemplate('header');  ?>
<body>

<?php  include $this->GetTemplate('c_header');  ?>

<!--end header-->

<div class="home-foc">
    <div class="bd">
        <ul>
            <li class="changephoto change-col01">
                <div class="photo"><img src="/img/banner1.jpg" alt="村城村城互联平台" /></div>     
            </li><!--end changephoto-->
            
            <li class="changephoto change-col02">   
                <div class="photo"><img src="/img/banner2.jpg" alt="2+N配置平台" /></div>    
            </li><!--end changephoto-->
            
            <li class="changephoto change-col03">
                <div class="photo"><img src="/img/banner3.jpg"  alt="村知书产业信息文化平台" /></div>    

            </li><!--end changephoto-->
            

        </ul>
   </div>

</div><!--end home-foc-->
<script> jQuery(".home-foc").slide({ mainCell:".bd ul",effect: "fade",autoPlay:"ture"});</script>

<div class="corebusiness">

    <?php  echo $zbp->GetModuleByID(16)->Content;  ?>
  </div>





<div class="homemain">


 <div class="layout">
    <div class="homenews fl">
      <div class="titels">
        <h2 class="fl title1"><a href='<?php  echo $categorys[11]->Url;  ?>'><?php  echo $categorys[11]->Name;  ?></a></h2>
        <div class="fr more"> <a class="a-more iconbg" href="<?php  echo $categorys[11]->Url;  ?>"> 更多</a></div>
      </div>
      <?php  $array=Getlist(1,null,null,null,array($zbp->GetTagByID(5)));;  ?>
      <?php  foreach ( $array as $related) { ?>

      <div class="homemain-conts homenews-conts" style="border:none;">
        <dl>
          <dt class="pic"> <img src="/img/ad.png" alt="<?php  echo $related->Title;  ?>" width="160" height="103"/> </dt>
          <dd class="cont">
            <h3><a href="<?php  echo $related->Url;  ?>" target="_blank"><?php  echo $related->Title;  ?></a></h3>
            <p> <?php  echo $related->Intro;  ?></p>
          </dd>
        </dl>
        <?php }   ?>
      
        <div class="homenews-list">
            <ul class="two_col_list">
            <?php  $array=GetList(3,11,null,null,null,null,array('has_subcate'=>true));;  ?>
            <?php  foreach ( $array as $related) { ?>
            <li> <a href="<?php  echo $related->Url;  ?>" target="_blank"><?php  echo $related->Title;  ?></a> </li>
            <?php }   ?>
                </ul>
            </div>
        <!--end homenews-list--> 
      </div>
    </div>

        <div class="homenews fl">
      <div class="titels">
        <h2 class="fl title2"><a href='<?php  echo $categorys[5]->Url;  ?>'><?php  echo $categorys[5]->Name;  ?></a></h2>
        <div class="fr more"> <a class="a-more iconbg" href="<?php  echo $categorys[5]->Url;  ?>"> 更多</a></div>
      </div>

      <div class="homemain-conts homenews-conts" style="border:none;">
        <div class="homenews-list">
            <ul class="two_col_list" style="margin-top: 12px;">
            <?php  $array=GetList(7,5,null,null,null,null,array('has_subcate'=>true));;  ?>
            <?php  foreach ( $array as $related) { ?>
            <li> <a href="<?php  echo $related->Url;  ?>" target="_blank"><?php  echo $related->Title;  ?></a> </li>
            <?php }   ?>
                </ul>
            </div>
        <!--end homenews-list--> 
      </div>
    </div>


        <div class="homenews fl" style="text-align: center;">
      <div class="titels">
        <h2 class="fl title3"><a href='http://www.cuncin.com/category-14.html'>视频中心</a></h2>
      </div>
      <a href='http://www.cuncin.com/post/118.html' target="_blank">
        <video width="340" height="210" controls="">
  <source src="IMG_1458.mp4" type="video/mp4">

     </video>

    </a>
        <!--end homenews-list--> 
      </div>
    </div>
    <!--end homemedia-->
  </div>


 <div class="homebtm layout" id="js_allBtm">
    <div class="leftBtn" id="js_prevImg"><a href="javascript:void(0);"></a></div>
            <div class="rightBtn" id="js_nextImg"><a href="javascript:void(0);"></a></div>

    <div class="mainCont" id="js_scrollBox">
        <ul>
             <li>
                <span class="pic"><a href="http://www.cuncin.com/post/161.html" target="_blank"><img src="http://www.cuncin.com/zb_users/upload/2016/02/201602031454485517312566.jpg" alt="村城聚势融合 ，互联共创" original="http://www.cuncin.com/zb_users/upload/2016/02/201602031454485517312566.jpg"></a></span>
            </li>
            <li>
                <span class="pic"><a href="http://www.cuncin.com/post/161.html" target="_blank"><img src="http://www.cuncin.com/zb_users/upload/2016/02/201602031454485502213347.jpg" alt="村城臻享创业浪潮，做客《阳光对话》" original="http://www.cuncin.com/zb_users/upload/2016/02/201602031454485502213347.jpg" ></a></span>
            </li>
            <li>
                <span class="pic"><a href="http://www.cuncin.com/post/153.html" target="_blank"><img src="http://www.cuncin.com/zb_users/upload/2016/02/201602021454376206690890.jpg"alt="村城臻享创业浪潮，做客《阳光对话》" original="http://www.cuncin.com/zb_users/upload/2016/02/201602021454376206690890.jpg" ></a></span>
            </li>
            <li>
                <span class="pic"><a href="http://www.cuncin.com/post/155.html" target="_blank"><img src="http://www.cuncin.com/zb_users/upload/2016/02/201602021454380425290975.jpg" alt="村城激情未泯，顾盼依稀如昨" original="http://www.cuncin.com/zb_users/upload/2016/02/201602021454380425290975.jpg" ></a></span>
            </li>
            <li>
                <span class="pic"><a href="http://www.cuncin.com/post/155.html" target="_blank"><img src="http://www.cuncin.com/zb_users/upload/2016/02/201602021454380541389717.jpg" >alt="村城创业自助烧烤 团结难忘今宵" original="http://www.cuncin.com/post/155.html" target="_blank"><img src="http://www.cuncin.com/zb_users/upload/2016/02/201602021454380541389717.jpg" ></a></span>
            </li>
            <li>
                <span class="pic"><a href="http://www.cuncin.com/post/9.html" target="_blank"><img src="http://www.cuncin.com/zb_users/upload/2015/11/201511111447221220267118.jpg" alt="村城创业自助烧烤 团结难忘今宵" original="http://www.cuncin.com/zb_users/upload/2015/11/201511111447221220267118.jpg" ></a></span>
            </li>
           
        </ul>
</div>
    </div><!--end homebtm-->

</div><!--end homemain--> 
<?php  include $this->GetTemplate('footer');  ?>

<script type="text/javascript">
function xx(){
var container=document.getElementById("gonggao");
container.appendChild(container.firstChild);
}
setInterval("xx()",3000);

//$("#js_index_float").css("opacity",0.95);
$("#js_xx_close").click(function(){
$("#js_index_float").hide("fast");
})
</script>
</body>
</html>
