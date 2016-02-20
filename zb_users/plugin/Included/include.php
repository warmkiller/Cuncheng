<?php


#注册插件
RegisterPlugin("Included","ActivePlugin_Included");


function ActivePlugin_Included() {

    Add_Filter_Plugin('Filter_Plugin_Admin_SettingMng_SubMenu','Included_AddMenu');

}



function Included_AddMenu(){
    global $zbp;
    echo '<a href="'. $zbp->host .'zb_users/plugin/Included/main.php"><span class="m-left">Included生成器</span></a>';

}

function baidu_check($bdurl){
    global $wpdb;
        $url='http://www.baidu.com/s?wd='.$bdurl;
        $curl=curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        $rs=curl_exec($curl);
        curl_close($curl);
        if(!strpos($rs,'没有找到')){
            return  '<a target="_blank" title="点击查看" rel="external nofollow" href="http://www.baidu.com/s?wd='.$bdurl.'">百度已收录</a>';
        } else {
            return '<a style="color:red;" rel="external nofollow" title="点击提交，谢谢您！" target="_blank" href="http://zhanzhang.baidu.com/sitesubmit/index?sitename='.$bdurl.'">百度未收录</a>';;
        }
}

?>