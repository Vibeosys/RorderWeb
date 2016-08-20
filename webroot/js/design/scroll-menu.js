
$(document).ready(function () {
    
    //smoothscroll
    $('.menu-list a[href^="#"]').on('click', function () {        
        
        $('a').each(function () {
            $(this).removeClass('active-menu');
        })
        $(this).addClass('active-menu');
      
        var target = this.hash,
            menu = target;
        $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top+2
        }, 1000, 'swing', function () {
            window.location.hash = target;
            $(document).on("scroll", onScroll);
        });
    });
});