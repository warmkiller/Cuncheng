<?php
require '../../../zb_system/function/c_system_base.php';

$zbp->CheckGzip();
$zbp->Load();
if (!$zbp->CheckPlugin('os_qq')) {$zbp->ShowError(48);die();}



if(!empty($_GET) && isset($_GET['code']) && $_GET['state']==1){
    $url="https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id=101268874&client_secret=e02e01c33d434651551f2ef0f342d2a3&code=".$_GET['code']."&redirect_uri=http%3a%2f%2fwww.cuncin.com%2flogin%2f";  
    $return = file_get_contents($url);
    
    $return_ar = explode('&',$return);
    $token_ar = explode('=',$return_ar[0]);
    $access_token = $token_ar[1];

    $url1="https://graph.qq.com/oauth2.0/me?access_token=".$access_token;
    $return1 = file_get_contents($url1);
    
    $client_id = substr($return1,24,9);
    $qqid = substr($return1,-38,32);


     if ($qqid!='') {
            $table['os_qq']='%pre%os_qq';
            $dataInfo['os_qq'] = array(
                'id'            =>array('os_qq_id','integer','',0),
                'uid'           =>array('os_qq_uid','string',255,''),
                'qqid'          =>array('os_qq_qqid','string',255,''),
                'qqtoken'       =>array('os_qq_qqtoken','string',255,''),
                'qqData'        =>array('os_qq_qqData','string',999,''),
                'time'          =>array('os_qq_time','string',64,''),
            );
            $where = array(array('=','os_qq_qqid',$qqid));
            $sql = $zbp->db->sql->Select($table['os_qq'],'*',$where,null,null,null);
            $array = $zbp->GetListCustom($table['os_qq'],$dataInfo['os_qq'],$sql);
            if (count($array)>0) {
                $zbpuid = '';
                foreach ($array as $key => $reg) {
                    $zbpuid .= $reg->uid;
                }
                if(!empty($zbpuid)){
                        $m=$zbp->members[$zbpuid];
                        $un=$m->Name;
                        if($blogversion>131221){
                            $ps=md5($m->Password . $zbp->guid);
                        }else{
                            $ps=md5($m->Password . $zbp->path);
                        }
                        setcookie("username", $un,0,$zbp->cookiespath);
                        setcookie("password", $ps,0,$zbp->cookiespath);
                        Redirect('/zb_system/admin/?act=admin');
                        die();
                }
            } else {
                $qqtime = time();
        
            $DataArr = array(
                'os_qq_qqid'            => $qqid,
                'os_qq_time'            => $qqtime,
            );
            $sql= $zbp->db->sql->Insert($GLOBALS['table']['os_qq'],$DataArr);
            $zbp->db->Insert($sql); 
            }
        } else {
            Redirect($zbp->host);
        }
    
    $url2 = "https://graph.qq.com/user/get_user_info?access_token=".$access_token."&oauth_consumer_key=101268874&openid=".$qqid;
    $return2 = file_get_contents($url2);
    $return2_ar = json_decode($return2);
    // var_dump($return2_ar->nickname);exit();
}

?>



<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if(strpos(GetVars('HTTP_USER_AGENT','SERVER'),'Trident/')){?>
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
<?php }?>
    <meta name="robots" content="none" />
    <meta name="generator" content="<?php echo $option['ZC_BLOG_PRODUCT_FULL']?>" />
    <link rel="stylesheet" href="/zb_system/css/admin.css" type="text/css" media="screen" />
    <script src="/zb_system/script/common.js" type="text/javascript"></script>
    <script src="/zb_system/script/md5.js" type="text/javascript"></script>
    <script src="/zb_system/script/c_admin_js_add.php" type="text/javascript"></script>
    <script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js" data-appid="<?php echo $zbp->Config('os_qq')->qqappid;?>" data-redirecturi="<?php echo $zbp->host; ?>zb_users/plugin/os_qq/login.php" charset="utf-8"></script>
    <title><?php echo '绑定您在本站的账户 - '.$blogname;?></title>
    <script type="text/javascript">
        if(QC.Login.check()){
            QC.Login.getMe(function('$qqid', '$accessToken'){
                $.ajax({
                    type : 'post',
                    url : '<?php echo $zbp->host; ?>zb_system/cmd.php?act=qqlogin',
                    data : 'qqid='+MD5(openId),
                    success : function(data) {
                        if (data=='200') {
                            location.href = '<?php echo $zbp->host; ?>zb_system/cmd.php?act=login';
                        } else {
                            $("#qqid").val(MD5(openId));
                        }
                    }
                });
            });
        } else {
            alert('未登录QQ，无法访问此页');
            location.href = '<?php echo $zbp->host; ?>';
        }
    </script>
<?php
foreach ($GLOBALS['Filter_Plugin_Login_Header'] as $fpname => &$fpsignal) {$fpname();}
?>
</head>
<body>
<div class="bg">
<div id="wrapper">
  <div class="logo"><img src="/zb_system/image/admin/none.gif" title="<?php echo htmlspecialchars($blogname)?>" alt="<?php echo htmlspecialchars($blogname)?>"/></div>
  <div class="login">
    <form method="post" action="#">
    <dl>
      <dt></dt>
      <dd class="username"><label for="edtUserName"><?php echo $lang['msg']['username']?></label><input type="text" id="edtUserName" name="edtUserName" size="20" value="<?php echo GetVars('username','COOKIE')?>" tabindex="1" /></dd>
      <dd class="password"><label for="edtPassWord"><?php echo $lang['msg']['password']?></label><input type="password" id="edtPassWord" name="edtPassWord" size="20" tabindex="2" /></dd>
    </dl>
    <dl>
      <dt></dt>
      <dd class="submit"><input id="btnPost" name="btnPost" type="submit" value="<?php echo $lang['msg']['login']?>" class="button" tabindex="4"/></dd>
    </dl>
    <input type="hidden" name="username" id="username" value="" />
    <input type="hidden" name="password" id="password" value="" />
    <input type="hidden" name="qqid" id="qqid" value="<?php if(isset($_GET['qqid'])){echo $_GET['qqid'];}else{echo $qqid;}?>" />
    <input type="hidden" name="savedate" id="savedate" value="0" />
    <input type="hidden" name="dishtml5" id="dishtml5" value="0" />
    </form>
    若没有账号，则填写上面两项即为注册。
    <!-- 没有账号，请点击<a href="/?reg">注册</a> -->
  </div>
</div>
</div>
<script type="text/javascript">
$("#btnPost").click(function(){

    var strUserName=$("#edtUserName").val();
    var strPassWord=$("#edtPassWord").val();
    var strSaveDate=$("#savedate").val()

    if((strUserName=="")||(strPassWord=="")){
        alert("<?php echo $lang['error']['66']?>");
        return false;
    }

    $("#edtUserName").remove();
    $("#edtPassWord").remove();

    $("form").attr("action","/zb_system/cmd.php?act=qqBind");
    $("#username").val(strUserName);
    $("#password").val(MD5(strPassWord));
    $("#savedate").val(strSaveDate);
    if (!$('#qqid').val()) {
        alert('抱歉，可能是因为网络问题，导致无法正常获取绑定');
        return false;
    }
})

$("#chkRemember").click(function(){
    $("#savedate").attr("value",$("#chkRemember").attr("checked")=="checked"?30:0);
})


if (!$.support.leadingWhitespace) {
    $("#dishtml5").val(1);
<?php
    if($option['ZC_ADMIN_HTML5_ENABLE'])
        echo 'alert("' . $lang['error']['74'] . '");';
?>
}
</script>
</body>
</html>
<?php
RunTime();
?>

