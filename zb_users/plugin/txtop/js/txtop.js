function b(){
	h = $(window).height();
	t = $(document).scrollTop();
	if(t > h){
		$('#gotop').show();
	}else{
		$('#gotop').hide();
	}
}
$(document).ready(function(e) {
	b();
	$('#gotop').click(function(){
		$(document).scrollTop(0);	
	})
});

$(window).scroll(function(e){
	b();		
})

$(document).ready(function() {

            $(".signin").click(function(e) {          
				e.preventDefault();
                $("div#signin_menu").toggle();
				$(".signin").toggleClass("menu-open");
            });
			
			$("div#signin_menu").mouseup(function() {
				return false
			});
			$(document).mouseup(function(e) {
				if($(e.target).parent("a.signin").length==0) {
					$(".signin").removeClass("menu-open");
					$("div#signin_menu").hide();
				}
			});			
			
        });
