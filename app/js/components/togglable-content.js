
$(document).ready( function(){

	// Only instanciate this functionality if our relevant DOM element(s) exist
	// For functions, make sure you wrap them in a component-specific function to
	// essentially namespace them. This prevents problematic overlapping function names.
	if ($('.togglable').length > 0){
	    $('.toggle-button').click(function(e){

	        $(this).parent('.togglable').children('.togglable-content').slideToggle(100);
	        $(this).toggleClass('open');

	        if( $(this).children('.fa').length ){
	        	$(this).children('.fa').toggleClass('fa-plus');
	        	$(this).children('.fa').toggleClass('fa-minus');
	        }
	    });
	}
});
