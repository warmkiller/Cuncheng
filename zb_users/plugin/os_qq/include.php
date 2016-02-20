<?php
#注册插件
RegisterPlugin("os_qq","ActivePlugin_os_qq");
// 挂接口
function ActivePlugin_os_qq() {
    Add_Filter_Plugin('Filter_Plugin_Zbp_MakeTemplatetags','os_qq_addheader');
    Add_Filter_Plugin('Filter_Plugin_Cmd_Begin','os_qq_login');
}
// 挂JS内容
function os_qq_addheader() {
    global $zbp;
    $zbp->header .= $zbp->Config('os_qq')->meta;
    $zbp->footer .= '<script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js" data-appid="'.$zbp->Config('os_qq')->qqappid.'" data-redirecturi="'.$zbp->host.'zb_users/plugin/os_qq/login.php" charset="utf-8"></script>';
    $zbp->footer .= '<script type="text/javascript">QC.Login({btnId:"qqLoginBtn"});</script>';
}
// 创建一个系统模块
function os_qq_news_module() {
    global $zbp;
    if (!isset($zbp->modulesbyfilename['os_qq_login'])) {
        $t = new Module();
        $t->Name = "QQ登录";
        $t->FileName = "os_qq_login";
        $t->Source = "os_qq";
        $t->SidebarID = 0;
        $t->Content = '<span id="qqLoginBtn"></span>';
        $t->IsHideTitle = false;
        $t->HtmlID = "os-qq-login";
        $t->Type = "div";
        $t->Save();
    }
}
// 数据库
$table['os_qq']='%pre%os_qq';
$dataInfo['os_qq'] = array(
	'id'            =>array('os_qq_id','integer','',0),
	'uid'           =>array('os_qq_uid','string',255,''),
	'qqid'          =>array('os_qq_qqid','string',255,''),
	'qqtoken'       =>array('os_qq_qqtoken','string',255,''),
	'qqData'        =>array('os_qq_qqData','string',999,''),
	'time'          =>array('os_qq_time','string',64,''),
);
// 拦截QQ登录绑定指令
function os_qq_login() {
    global $zbp;
    $action=GetVars('act','GET');
    if ($action=='qqBind') {
        if(isset($zbp->membersbyname[GetVars('username','POST')])){
            $m = null;
            if(!$zbp->Verify_MD5(GetVars('username', 'POST'), GetVars('password', 'POST'),$m)){
                // $zbp->SetHint('tips','用户名已存在，但密码不正确。');
                Redirect($zbp->host.'zb_users/plugin/os_qq/login.php/?qqid='.$_POST['qqid']);
            }else{
                VerifyLogin();
                if ($zbp->user->ID>0 && GetVars('redirect','COOKIE')) {
                    Redirect(GetVars('redirect','COOKIE'));
                }
                $qqid = $_POST['qqid'];
                $qqtime = time();
            
                $DataArr = array(
            		'os_qq_qqid'            => $qqid,
            		'os_qq_uid'             => $zbp->user->ID,
            	    'os_qq_time'            => $qqtime,
                );
                $sql= $zbp->db->sql->Insert($GLOBALS['table']['os_qq'],$DataArr);
                $zbp->db->Insert($sql);
                $zbp->SetHint('good','QQ成功绑定');
                Redirect($zbp->host.'zb_system/admin/?act=admin');
            }
        } else {
            // var_dump($_POST);die();
            $member=new Member;
            $member->Name=GetVars('username','POST');
            $member->Password=md5(GetVars('password','POST'));
            $member->PostTime=time();
            $member->IP=GetGuestIP();
            $member->Save();
            
            VerifyLogin();
                if ($zbp->user->ID>0 && GetVars('redirect','COOKIE')) {
                    Redirect(GetVars('redirect','COOKIE'));
                }
                $qqid = $_POST['qqid'];
                $qqtime = time();
            
                $DataArr = array(
                    'os_qq_qqid'            => $qqid,
                    'os_qq_uid'             => $zbp->user->ID,
                    'os_qq_time'            => $qqtime,
                );
                $sql= $zbp->db->sql->Insert($GLOBALS['table']['os_qq'],$DataArr);
                $zbp->db->Insert($sql);
                $zbp->SetHint('good','QQ成功绑定');
                Redirect($zbp->host.'zb_system/admin/?act=admin');
            
        }
    } else if ($action=='qqlogin') {
        $qqid = $_POST['qqid'];
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
                $m=$zbp->members[$zbpuid];
                $un=$m->Name;
                if($blogversion>131221){
                    $ps=md5($m->Password . $zbp->guid);
                }else{
                    $ps=md5($m->Password . $zbp->path);
                }
                setcookie("username", $un,0,$zbp->cookiespath);
                setcookie("password", $ps,0,$zbp->cookiespath);
                echo '200';
                die();
            } else {
                echo 'error';
                die();
            }
        } else {
            Redirect($zbp->host);
        }
        
    }
}
//创建数据库
function os_qq_CreateTable(){
    global $zbp;
    if ($zbp->db->ExistTable($GLOBALS['table']['os_qq']) == false) {
    $s=$zbp->db->sql->CreateTable($GLOBALS['table']['os_qq'],$GLOBALS['dataInfo']['os_qq']);
    $zbp->db->QueryMulit($s);
    }
}
//删除数据库
function os_qq_DelTable() {
    global $zbp;
    if ($zbp->db->ExistTable($zbp->table['os_qq']) == true) {
        $s = $zbp->db->sql->DelTable($zbp->table['os_qq']);
        $zbp->db->QueryMulit($s);
    }
}
// 激活插件
function InstallPlugin_os_qq() {
    global $zbp;
    os_qq_news_module();
    if(!isset($zbp->Config('os_qq')->qqappid)){
        $array = array(
            'qqappid'        =>  '',
            'qqappkey'       =>  '',
            'meta'           =>  '',
        );
        foreach ($array as $value => $intro) {
            $zbp->Config('os_qq')->$value = $intro;
        }
        $zbp->SaveConfig('os_qq');
    }
    os_qq_CreateTable();
    $zbp->SetHint('good','插件启动成功，请及时配置插件，保证功能正常使用');
}
function UninstallPlugin_os_qq() {
    global $zbp;
    $zbp->DelConfig('os_qq');
    os_qq_DelTable();
}