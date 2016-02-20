$(document).ready(function(){
	var s=document.location;
	$("#divNavBar a").each(function(){
		if(this.href==s.toString().split("#")[0]){$(this).addClass("on");return false;}
	});
});


function ReComment_CallBack(){for(var i=0;i<=ReComment_CallBack.list.length-1;i++){ReComment_CallBack.list[i]()}}
ReComment_CallBack.list=[];
ReComment_CallBack.add=function(s){ReComment_CallBack.list.push(s)};


//重写了common.js里的同名函数
function RevertComment(i){
	$("#inpRevID").val(i);
	var frm=$('#divCommentPost'),cancel=$("#cancel-reply"),temp = $('#temp-frm');


	var div = document.createElement('div');
	div.id = 'temp-frm';
	div.style.display = 'none';
	frm.before(div);


	$('#AjaxCommentEnd'+i).before(frm);

	frm.addClass("reply-frm");
	
	cancel.show();
	cancel.click(function(){
		$("#inpRevID").val(0);
		var temp = $('#temp-frm'), frm=$('#divCommentPost');
		if ( ! temp.length || ! frm.length )return;
		temp.before(frm);
		temp.remove();
		$(this).hide();
		frm.removeClass("reply-frm");
		ReComment_CallBack();
		return false;
	});
	try { $('#txaArticle').focus(); }
	catch(e) {}
	ReComment_CallBack();
	return false;
}

//重写GetComments，防止评论框消失
function GetComments(logid,page){
	$('span.commentspage').html("Waiting...");
	$.get(str00+"zb_system/cmd.asp?act=CommentGet&logid="+logid+"&page="+page, function(data){
		$("#cancel-reply").click();
		$('#AjaxCommentBegin').nextUntil('#AjaxCommentEnd').remove();
		$('#AjaxCommentEnd').before(data);
	});
}

////////// -\u5220\u9664\u7248\u6743\u5219\u65e0\u6cd5\u7ee7\u7eed\u4f7f\u7528- ///////////
var $Toyean = $("#footer").find("a[href=\u0068\u0074\u0074\u0070\u003a\u002f\u002f\u0077\u0077\u0077\u002e\u0074\u0078\u0063\u0073\u0074\u0078\u002e\u0063\u006e/]").text();
if($Toyean != "\u007a\u0062\u006c\u006f\u0067\u6a21\u677f"){
$("head").remove();	
alert("\u8bf7\u52ff\u4fee\u6539\u6216\u5220\u9664\u4e3b\u9898\u7248\u6743\u53ca\u4f5c\u8005\u4fe1\u606f\uff0c\u005c\u006e\u5426\u5219\u9875\u9762\u5c06\u65e0\u6cd5\u6b63\u5e38\u663e\u793a\uff0c\u8bf7\u91cd\u65b0\u5b89\u88c5\u4e3b\u9898");
};