$(document).ready(function() {
    "use strict";

    

   

    // Stellar
    $.stellar({
        horizontalScrolling: false,
        verticalOffset: 0,
        responsive: true

    });

    

   
  

});


// Sticky Header
$(window).load(function(){
	$("header nav").sticky({ topSpacing: 0 });
});