
$(function () {

$('a[href^="#"]').click(function(event) {
var id = $(this).attr("href");
var offset = 20;
var target = $(id).offset().top - offset;

$('html, body').animate({scrollTop:target}, 1200);
event.preventDefault();
});

});
