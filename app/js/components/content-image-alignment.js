/* 
In conjunction with .ss-htmleditorfield-file.image styling in /app/scss/global/_layout.scss 
*/

$(document).ready(function () {
    
    if ($('.ss-htmleditorfield-file.image').length > 0) {
        addClearFix();
    }
});

// apply a clear: both to the trailing element if image is set by itself (with and without a caption)
function addClearFix() {
    $('.ss-htmleditorfield-file.image').each(function () {

        if ($(this).parent().hasClass('captionImage')) {
            if ($(this).parent().hasClass('leftAlone') || $(this).hasClass('center') || $(this).hasClass('rightAlone')) {
                $(this).parent().next().css('clear', 'both');
            }
        } else {
            if ($(this).hasClass('leftAlone') || $(this).hasClass('center') || $(this).hasClass('rightAlone')) {
                $(this).parent().next().css('clear', 'both');
            }
        }
    }); 
}