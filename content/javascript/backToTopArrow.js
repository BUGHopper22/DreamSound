// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#backToTop').fadeIn(200);    // Fade in the arrow
    } else {
        $('#backToTop').fadeOut(200);   // Else fade out the arrow
    }
});
$('#backToTop').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});