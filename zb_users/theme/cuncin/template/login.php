{php}
$host = '10.66.150.219';
$user = 'root';
$pass = 'songyang@0';
$db = 'cuncin';

mysql_connect($host,$user,$pass) or die('error connection');
mysql_select_db($db) or die('error database selection');

$query=mysql_query("select * from `tc_member`");
$fd = array();
 while($row=mysql_fetch_field($query)){
 $fd[]=str_pad(" ",2).$row->name;
 }
 if(!in_array('qq_openid',$fd)){

    mysql_query("ALTER TABLE `tc_member` ADD qq_openid varchar(50)");
 }




if(!empty($_GET) && isset($_GET['code']) && $_GET['state']==1){
    $url="https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id=101268874&client_secret=e02e01c33d434651551f2ef0f342d2a3&code=".$_GET['code']."&redirect_uri=http%3a%2f%2fwww.cuncin.com%2flogin%2f";  
    $return = file_get_contents($url);
    
    $return_ar = explode('&',$return);
    $token_ar = explode('=',$return_ar[0]);
    $access_token = $token_ar[1];

    $url1="https://graph.qq.com/oauth2.0/me?access_token=".$access_token;
    $return1 = file_get_contents($url1);
    
    $client_id = substr($return1,24,9);
    $openid = substr($return1,-38,32);
    
    $url2 = "https://graph.qq.com/user/get_user_info?access_token=".$access_token."&oauth_consumer_key=101268874&openid=".$openid;
    $return2 = file_get_contents($url2);

    var_dump($return2);exit();
}

{/php}

{template:header}
<body>
{template:c_header}

<!-- <span id="qqLoginBtn"></span> -->

<a href="https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=101268874&redirect_uri=http%3a%2f%2fwww.cuncin.com%2fzb_users%2fplugin%2fos_qq%2flogin.php&state=1&scope=get_user_info"><img src="http://qzonestyle.gtimg.cn/qzone/vas/opensns/res/img/Connect_logo_7.png"></a>





{template:footer}
</body>
</html>