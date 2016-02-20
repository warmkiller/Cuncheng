<?php
require '../../../../zb_system/function/c_system_base.php';
require '../../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

		if(isset($_POST['id'])==false)Redirect($_SERVER["HTTP_REFERER"]);
		Nobird_BatchComment();
		$zbp->BuildModule();
		$zbp->SetHint('good');
		echo 'perfect';
		Redirect($_SERVER["HTTP_REFERER"]);


/**
 * 评论批量处理（删除、通过审核、加入审核）
 */
function Nobird_BatchComment() {
	global $zbp;
	if (isset($_POST['all_rename'])) {
		$type = 'all_rename';
	}
	if (isset($_POST['all_xurl'])) {
		$type = 'all_xurl';
	}
	if (isset($_POST['all_xcomment'])) {
		$type = 'all_xcomment';
	}
		if (isset($_POST['all_xall'])) {
		$type = 'all_xall';
	}
	$array = array();
	$array = $_POST['id'];
	
if ($type == 'all_rename') {

foreach ($array as $id){
$sql = $zbp->db->sql->Update(
    $zbp->table['Comment'],
    array('comm_Name'=>'访客'),
    array(array('=','comm_ID',$id))
    );
$zbp->db->Query($sql);
}

}
if ($type == 'all_xurl')
foreach ($array as $id){
$sql = $zbp->db->sql->Update(
    $zbp->table['Comment'],
    array('comm_HomePage'=>$zbp->host),
    array(array('=','comm_ID',$id))
    );
$zbp->db->Query($sql);
}

$comment_array=array(
'我的沙发我做主，果断支持博主！',
'感谢博主的热心分享！',
'我对博主之敬仰尤如涛涛江水连绵不绝,有如黄河泛滥一发不可收拾！',
'太给力啦~博主V5！',
'非常棒的内容，值得收藏',
'来串个门，欢迎回访！',
'博主的主题不错，我很喜欢！',
'我只是路过打酱油的',
'太棒了，对我实在是很有用，感谢博主啦',
'一般般啦！对我没有什么用',
'纯为留名，一带而过'
);

if ($type == 'all_xcomment')
foreach ($array as $id){
$i=mt_rand(0,10);

$sql = $zbp->db->sql->Update(
    $zbp->table['Comment'],
    array('comm_Content'=>$comment_array[$i]),
    array(array('=','comm_ID',$id))
    );
$zbp->db->Query($sql);
}

if ($type == 'all_xall')
foreach ($array as $id){
$i=mt_rand(0,10);

$sql = $zbp->db->sql->Update(
    $zbp->table['Comment'],
    array('comm_Name'=>'匿名','comm_HomePage'=>$zbp->host,'comm_Content'=>$comment_array[$i]
    ),
    array(array('=','comm_ID',$id))
    );
$zbp->db->Query($sql);
}

}


?>