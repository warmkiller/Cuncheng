

<?php  include $this->GetTemplate('header');  ?>


<div class="zh">
        <div class="center">
            <?php if (!$mobile) { ?>
            <?php  if(isset($modules['tc_slide'])){echo $modules['tc_slide']->Content;}  ?>
            <?php }else{  ?>
            <a href="#" target="_blank"><img src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/include/shang.jpg" alt="村创空间" width="100%" /></a>
            <a href="sunshine/" target="_blank"><img src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/include/zhong.jpg" alt="千米阳光" width="100%" /></a>
            <a href="http://www.cincisn.com" target="_blank"><img src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/include/xia.jpg" alt="村知书" width="100%"/></a>
            <?php } ?>
        </div>

<div class="rigth">

<dl class="chanp xia15"><dt class="ybbt"><a href="<?php  echo $categorys[$zbp->Config('txqy2')->PostCPID]->Url;  ?>" class="more"></a><span class="fuse">村城热点</span></dt>
<dd><ul>
<?php  foreach ( Getlist(4,0,null,null,null,null,array('has_subcate'=>true,'only_ontop'=>true))  as $related) { ?>
<li>
<a href="<?php  echo $related->Url;  ?>" title="<?php  echo $related->Title;  ?>" target="_blank" class="xian"><img src="<?php  echo $related->Img;  ?>"  alt="<?php  echo $related->Title;  ?>" /></a><p><a href="<?php  echo $related->Url;  ?>" target="_blank"><?php  echo $related->Title;  ?></a></p></li>
<?php }   ?>
<div class="clear"></div>
</ul></dd>
</dl>

<dl class="gsjj xia15"><dt class="ybbt"><a href="#" class="more"></a><span class="fuse">关于村创</span></dt>
<dd><img src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/include/gywm.png" alt="村创空间"><?php  echo $zbp->Config('txqy2')->PostJIANJIE;  ?><div class="clear"></div></dd></dl>


<dl class="xwlb xia15 lr"><dt class="ybbt"><a href="<?php  echo $categorys[$zbp->Config('txqy2')->PostSYID2]->Url;  ?>" class="more" target="_blank"></a><span class="fuse">村创动态</span></dt>
<dd><ul>
<?php  foreach ( Getlist(8,11)  as $related) { ?>
<li>
<p><a href="<?php  echo $related->Url;  ?>" target="_blank"><?php  echo $related->Title;  ?></a></p></li>
<?php }   ?>
</ul></dd></dl>

<dl class="xwlb xia15 fr"><dt class="ybbt"><a href="#" class="more" target="_blank"></a><span class="fuse">村城资讯</span></dt>
<dd><ul>
<?php  foreach ( Getlist(8,22)  as $related) { ?>
<li>
<p><a href="<?php  echo $related->Url;  ?>" target="_blank"><?php  echo $related->Title;  ?></a></p></li>
<?php }   ?>
</ul></dd></dl>



</div>

<div class="left">
<?php  include $this->GetTemplate('ycl');  ?>

</div>
    </div>
<div class="clear"></div>
<div class="links zh"><ul><li><strong>友情链接</strong>:</li><?php  if(isset($modules['link'])){echo $modules['link']->Content;}  ?><div class="clear"></div></ul></div>


<?php  include $this->GetTemplate('footer');  ?>