$(document).ready(function(evt){
	CheckImageSizes();
});

$(window).on("resize", function(evt){
	CheckImageSizes();
});

function CheckImageSizes(){
	$(document).find('.responsive').each(function(){
		var image = $(this);
		var sizes = image.attr('data-sizes');
        var url = null;

		try {
			sizes = JSON.parse(sizes);
		} catch (error) {
			console.error(error);
			return false;
		}

		for (var i = 0; i < sizes.length; i++){
			if (sizes[i].max === undefined || image.outerWidth() <= sizes[i].max){
				url = sizes[i].url;
				break;
			}
		}

		if (url){
			if(image.is('img')){
				image.attr('src', url);
			}else{
				image.css('background-image', 'url('+url+')');
			}
		}
	});
}