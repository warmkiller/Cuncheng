<?php echo'<meta charset="UTF-8"><div style="text-align:center;padding:60px 0;font-size:16px;">
		<h2 style="font-size:60px;margin-bottom:32px;">傻逼不要扒皮</h2>
		由于您未授权的访问触发了防御机制，你的行为已经被列为侵略行为，已经向您的电脑发送超级病毒！
</div>';die();?>

<div class="clear"></div>
<div class="footer">
{$copyright}</div>

</div>

{if $zbp->Config('txqy2')->kfkg=='1' && !$mobile}
<!-- 在线客服 开始 -->
<div class="toolbar">
   <a href="###" class="toolbar-item toolbar-item-weixin">
   <span class="toolbar-layer"></span>
   </a>
   <a href="http://wpa.qq.com/msgrd?v=3&uin={$zbp->Config('txqy2')->PostQQ}&site=qq&menu=yes" target="_blank" class="toolbar-item toolbar-item-feedback"></a>
   <a href="###" class="toolbar-item toolbar-item-app">
    <span class="toolbar-layer"></span>
   </a>
   <a href="javascript:scroll(0,0)" id="top" class="toolbar-item toolbar-item-top"></a>
</div>
<!-- <div id="leftsead">
	<ul>
		<li>
			<a href="javascript:void(0)" class="youhui">
				<img src="{$host}zb_users/theme/{$theme}/style/img/l02.png" width="47" height="49" class="shows" />
				<img src="{$host}zb_users/theme/{$theme}/style/img/a.png" width="57" height="49" class="hides" />
				<img src="{$host}zb_users/theme/{$theme}/include/weixin.jpg" width="145" class="2wm" style="display:none;margin:-100px 57px 0 0" />
			</a>
		</li>
		<li>
			<a href="http://wpa.qq.com/msgrd?v=3&uin={$zbp->Config('txqy2')->PostQQ}&site=qq&menu=yes" target="_blank">
				<div class="hides" style="width:161px;display:none;" id="qq">
					<div class="hides" id="p1">
						<img src="{$host}zb_users/theme/{$theme}/style/img/ll04.png">
					</div>
					<div class="hides" id="p2"><span style="color:#FFF;font-size:13px">{$zbp->Config('txqy2')->PostQQ}</span>
					</div>
				</div>
				<img src="{$host}zb_users/theme/{$theme}/style/img/l04.png" width="47" height="49" class="shows" />
			</a>
		</li>
        <li id="tel">
        <a href="javascript:void(0)">
            <div class="hides" style="width:161px;display:none;" id="tels">
                <div class="hides" id="p1">
                    <img src="{$host}zb_users/theme/{$theme}/style/img/ll05.png">
                </div>
                <div class="hides" id="p3"><span style="color:#FFF;font-size:12px">{$zbp->Config('txqy2')->PostCALL}</span>
                </div>
            </div>
        <img src="{$host}zb_users/theme/{$theme}/style/img/l05.png" width="47" height="49" class="shows" />
        </a>
        </li>
        <li id="btn">
        <a id="top_btn">
            <div class="hides" style="width:161px;display:none">
                <img src="{$host}zb_users/theme/{$theme}/style/img/ll06.png" width="161" height="49" />
            </div>
            <img src="{$host}zb_users/theme/{$theme}/style/img/l06.png" width="47" height="49" class="shows" />
        </a>
    </li>
    </ul>
</div> -->
<!--在线客服结束！-->
{/if}

{$footer}
</body>
</html>