$(document).ready(function() {
    
    "use strict";

    

   

    // Stellar
    $.stellar({
        horizontalScrolling: false,
        verticalOffset: 0,
        responsive: true

    });

  $('#mail-send-btn').on('click',function(){
    
   var fname = $('#input-first').val();
   var lname = $('#input-last').val();
   var restaurant = $('#input-restaurant').val();
   var email = $('#input-email').val();
   var phone = $('#input-phone').val();
   if(fname.length && lname.length && restaurant.length && email.length && phone.length){
   $(this).val('Please wait....');
   $.post('/sendmail',{fname:fname,lname:lname,restaurant:restaurant,email:email,phone:phone},function(result){
       if(result){
           $('#myContactModal').css('display','block');
           $('#mail-send-btn').val('Submit'); 
          $('#sales-form')[0].reset();
          
           return false;
       }else{
           $('#myErrorModal').css('display','block');
           $('#mail-send-btn').val('Submit');
           return false;
       }
   });
   }
  });
  
  $('.close').on('click',function(){
      $('#myContactModal').css('display','none');
      $('#myErrorModal').css('display','none');
      
      
  });

   
  

});


// Sticky Header
$(window).load(function(){
	$("header nav").sticky({ topSpacing: 0 });
});

function sendMail(){
    
}