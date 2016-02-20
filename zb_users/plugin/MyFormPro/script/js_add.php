<?php
/**
 * Z-Blog with PHP
 * @author 中文
 * @copyright (C) RainbowSoft Studio
 * @version 2.0 2013-06-14
 */
require '../../../../zb_system/function/c_system_base.php';

ob_clean();
?>
var bloghost = "<?php echo $zbp->host; ?>";
var ajaxurl = "<?php echo $zbp->ajaxurl; ?>";
var mfpusesimplecode = "<?php echo $zbp->Config('MyFormPro')->Use_simplecode; ?>";

function bmx2table(){
	var class_=new Array("color2","color3","color4");
	var j=$("table[class!='nobmx'] tr:has(th)").addClass("color1");
    $("table[class!='nobmx']").each(function(){
 		if(j.length==0){class_[1]="color2";class_[0]="color3";}
		$(this).find("tr:not(:has(th)):even").removeClass(class_[0]).addClass(class_[1]);
		$(this).find("tr:not(:has(th)):odd").removeClass(class_[1]).addClass(class_[0]);
	})
	$("table[class!='nobmx']").find("tr:not(:has(th))").mouseover(function(){$(this).addClass(class_[2])}).mouseout(function(){$(this).removeClass(class_[2])});
};
//*********************************************************




//*********************************************************
// 目的：    CheckBox
// 输入：    无
// 返回：    无
//*********************************************************
function ChangeCheckValue(obj){

	$(obj).toggleClass('imgcheck-on');

	if($(obj).hasClass('imgcheck-on')){
		$(obj).prev('input').val('1');
		$(obj).next('.off-hide').show();
	}else{
		$(obj).prev('input').val('0');
		$(obj).next('.off-hide').hide();
	}

}
//*********************************************************



$(document).ready(function(){


	//斑马线化表格
	bmx2table();

	//checkbox
	$('input.checkbox').css("display","none");
	$('input.checkbox[value="1"]').after('<span class="imgcheck imgcheck-on"></span>');
	$('input.checkbox[value!="1"]').after('<span class="imgcheck"></span>');


	$('span.imgcheck').click(function(){ChangeCheckValue(this)})

});


<?php
MyFormPro_Richtext_Load();
?>
