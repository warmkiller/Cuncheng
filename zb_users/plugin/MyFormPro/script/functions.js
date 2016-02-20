//SUBMIT
function mfp_submit(){
if(null != tinymce.activeEditor){
var content =  tinymce.activeEditor.getContent();
//console.log(content);
$("#mfp_richtext").text(content);
}
$("#mfp_submitbtn").attr("disabled","disabled");
$("#mfp_submitbtn").text("内容提交中，请稍等……");
    $.post(ajaxurl + "mfp_submit",
        $("#mfp-form").serialize(),
        function(data){
            if(data.uid){
                  $('<div class="alert alert-danger" role="alert">'+data.msg+'</div>').prependTo('#mfp-form');
              }else{
                  $('<div class="alert alert-success" role="alert">'+data.msg+'</div>').prependTo('#mfp-form');
                  if(data.redirect_url){
                  setTimeout(function () {
                        window.location=data.redirect_url;
                    }, 1000);
                  }
            }
            mfp_code_reload(mfpusesimplecode);
            $("#mfp_submitbtn").removeAttr("disabled");
            $("#mfp_submitbtn").text("提 交");
            setTimeout('$(".alert").slideUp()',5000);
        }, "json");
    return false;
}



function mfp_submit_alert(){

if(null != tinymce.activeEditor){
var content =  tinymce.activeEditor.getContent();
//console.log(content);
$("#mfp_richtext").text(content);
}
$("#mfp_submitbtn").attr("disabled","disabled");
$("#mfp_submitbtn").text("内容提交中，请稍等……");
//return false;
    $.post(ajaxurl + "mfp_submit",
        $("#mfp-form").serialize(),
        function(data){
            if(data.uid){
                  alert(data.msg);
              }else{
                  alert(data.msg);
                  if(data.redirect_url){
                  setTimeout(function () {
                        window.location=data.redirect_url;
                    }, 1000);
                  }
            }
            mfp_code_reload(mfpusesimplecode);
            $("#mfp_submitbtn").removeAttr("disabled");
            $("#mfp_submitbtn").text("提 交");

        }, "json");
    return false;
}

function mfp_code_reload(mfpusesimplecode){
	// id="mfpcode"
  var objImageValid=$("#mfpcode");
  if(mfpusesimplecode){
      objImageValid.attr("src",bloghost+"zb_users/plugin/MyFormPro/plugin/simplecode/mfp_validcode.php?id=MyFormPro&tm="+Math.random());
  }else{
      objImageValid.attr("src",bloghost+"zb_system/script/c_validcode.php?id=MyFormPro&tm="+Math.random());
   
  } 

}
