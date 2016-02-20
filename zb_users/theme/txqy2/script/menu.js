$(function(){
  var menuwidth  = 200; // 边栏宽度
  var menuspeed  = 400; // 边栏滑出耗费时间
  
  var $bdy       = $('body');
  var $container = $('#pgcontainer');
  var $burger    = $('#hamburgermenu');
  var negwidth   = "-"+menuwidth+"px";
  var poswidth   = menuwidth+"px";
  
  $('.menubtn').on('click',function(e){
    if($bdy.hasClass('openmenu')) {
      jsAnimateMenu('close');
    } else {
      jsAnimateMenu('open');
    }
  });
  
  $('.overlay').on('click', function(e){
    if($bdy.hasClass('openmenu')) {
      jsAnimateMenu('close');
    }
  });
  
  function jsAnimateMenu(tog) {
    if(tog == 'open') {
      $bdy.addClass('openmenu');
      
      $container.animate({marginRight: negwidth, marginLeft: poswidth}, menuspeed);
      $burger.animate({width: poswidth}, menuspeed);
      $('.overlay').animate({left: poswidth}, menuspeed);
    }
    
    if(tog == 'close') {
      $bdy.removeClass('openmenu');
      
      $container.animate({marginRight: "0", marginLeft: "0"}, menuspeed);
      $burger.animate({width: "0"}, menuspeed);
      $('.overlay').animate({left: "0"}, menuspeed);
    }
  }
});


//导航高亮
jQuery(document).ready(function($){ 
var datatype=$("#hamburgermenu").attr("data-type");
    $(".dhgl>li ").each(function(){
        try{
            var myid=$(this).attr("id");
            if("index"==datatype){
                if(myid=="nvabar-item-index"){
                    $("#nvabar-item-index a:first-child").addClass("on");
                }
            }else if("category"==datatype){
                var infoid=$("#hamburgermenu").attr("data-infoid");
                if(infoid!=null){
                    var b=infoid.split(' ');
                    for(var i=0;i<b.length;i++){
                        if(myid=="navbar-category-"+b[i]){
                            $("#navbar-category-"+b[i]+" a:first-child").addClass("on");
                        }
                    }
                }
            }else if("article"==datatype){
                var infoid=$("#hamburgermenu").attr("data-infoid");
                if(infoid!=null){
                    var b=infoid.split(' ');
                    for(var i=0;i<b.length;i++){
                        if(myid=="navbar-category-"+b[i]){
                            $("#navbar-category-"+b[i]+" a:first-child").addClass("on");
                        }
                    }
                }
            }else if("page"==datatype){
                var infoid=$("#hamburgermenu").attr("data-infoid");
                if(infoid!=null){
                    if(myid=="navbar-page-"+infoid){
                        $("#navbar-page-"+infoid+" a:first-child").addClass("on");
                    }
                }
            }else if("tag"==datatype){
                var infoid=$("#hamburgermenu").attr("data-infoid");
                if(infoid!=null){
                    if(myid=="navbar-tag-"+infoid){
                        $("#navbar-tag-"+infoid+" a:first-child").addClass("on");
                    }
                }
            }
        }catch(E){}
    });
});




//在线客服
$(document).ready(function(){
    
    $("#leftsead a").hover(function(){
        if($(this).prop("className")=="youhui"){
            $(this).children("img.hides").show();
        }else{
            $(this).children("div.hides").show();
            $(this).children("img.shows").hide();
            $(this).children("div.hides").animate({marginRight:'0px'},'0'); 
        }
    },function(){ 
        if($(this).prop("className")=="youhui"){
            $(this).children("img.hides").hide();
        }else{
            $(this).children("div.hides").animate({marginRight:'-163px'},0,function(){$(this).hide();$(this).next("img.shows").show();});
        }
    });

    $("#top_btn").click(function(){if(scroll=="off") return;$("html,body").animate({scrollTop: 0}, 600);});

	    //右侧导航 - 二维码
        $(".youhui").mouseover(function(){
            $(this).children(".2wm").show();
        })
        $(".youhui").mouseout(function(){
            $(this).children(".2wm").hide();
        });


});