

<div class="clear"></div>
<div class="footer">
<?php  echo $copyright;  ?></div>

</div>

<?php if ($zbp->Config('txqy2')->kfkg=='1' && !$mobile) { ?>
<!-- 在线客服 开始 -->
<div class="toolbar">
   <a href="###" class="toolbar-item toolbar-item-weixin">
   <span class="toolbar-layer"></span>
   </a>
   <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php  echo $zbp->Config('txqy2')->PostQQ;  ?>&site=qq&menu=yes" target="_blank" class="toolbar-item toolbar-item-feedback"></a>
   <a href="###" class="toolbar-item toolbar-item-app">
    <span class="toolbar-layer"></span>
   </a>
   <a href="javascript:scroll(0,0)" id="top" class="toolbar-item toolbar-item-top"></a>
</div>
<!-- <div id="leftsead">
	<ul>
		<li>
			<a href="javascript:void(0)" class="youhui">
				<img src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/img/l02.png" width="47" height="49" class="shows" />
				<img src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/img/a.png" width="57" height="49" class="hides" />
				<img src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/include/weixin.jpg" width="145" class="2wm" style="display:none;margin:-100px 57px 0 0" />
			</a>
		</li>
		<li>
			<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php  echo $zbp->Config('txqy2')->PostQQ;  ?>&site=qq&menu=yes" target="_blank">
				<div class="hides" style="width:161px;display:none;" id="qq">
					<div class="hides" id="p1">
						<img src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/img/ll04.png">
					</div>
					<div class="hides" id="p2"><span style="color:#FFF;font-size:13px"><?php  echo $zbp->Config('txqy2')->PostQQ;  ?></span>
					</div>
				</div>
				<img src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/img/l04.png" width="47" height="49" class="shows" />
			</a>
		</li>
        <li id="tel">
        <a href="javascript:void(0)">
            <div class="hides" style="width:161px;display:none;" id="tels">
                <div class="hides" id="p1">
                    <img src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/img/ll05.png">
                </div>
                <div class="hides" id="p3"><span style="color:#FFF;font-size:12px"><?php  echo $zbp->Config('txqy2')->PostCALL;  ?></span>
                </div>
            </div>
        <img src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/img/l05.png" width="47" height="49" class="shows" />
        </a>
        </li>
        <li id="btn">
        <a id="top_btn">
            <div class="hides" style="width:161px;display:none">
                <img src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/img/ll06.png" width="161" height="49" />
            </div>
            <img src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/img/l06.png" width="47" height="49" class="shows" />
        </a>
    </li>
    </ul>
</div> -->
<!--在线客服结束！-->
<?php } ?>

<?php  echo $footer;  ?>
</body>
</html>