
$(document).ready( function(){
	if ($('.mobile-menu-trigger').length > 0){
	    $('.mobile-menu-trigger').click( function(){
	    	$(this).toggleClass('open');
	        $('.main-menu').slideToggle();
	    });
	}
});
