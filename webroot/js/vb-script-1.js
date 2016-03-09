
//hide sections

$(document).ready(function(){
 $('show-edit-section').hide();
 
 $('view-edit-btn').on('click', function(){
     $('show-rest-section').css('display','none');
     $('show-edit-section').css('display','block');
 });
 //dynamically u[load restaurant logo image using ajax
 $('.file-control').on('change', function(){
     $('.spinner').show();
     var data = new FormData($('input[name="file-upload"]'));     
      jQuery.each($('input[name="file-upload"]')[0].files, function(i, file) {
    data.append(i, file);
});
     $.ajax({
        url: "/upload", 
        type:"POST",
        data: data,
        contentType: false,
        cache: false,
        processData:false, 
        success: function(result, jqXHR, textStatus){
            $('.spinner').hide();
            if(result){
            $("#logo").attr('src',result);
           }else{
            alert('Error..!image Not Upload');
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
                alert('An error occurred! ' + textStatus + jqXHR + errorThrown);
        }});
 });
   $(window).resize(function(){
    var ww = $(window).width();
    var cw = $('.content-wrapper').width();
    var nlm = ww-cw;
    //change css according to window size
    if(ww > 767){
        if(ww < 790){
            $('#mgmt-nav').css('margin-left', 170);
        }else if(nlm){
            $('#mgmt-nav').css('margin-left',nlm - 30);
        }else{
            $('#mgmt-nav').css('margin-left', 180);
        }
     }else{
        $('#mgmt-nav').css('margin-left',0);
     }
     if(ww > 1114){
        $('.restaurant-Show').addClass('col-xs-3');
        $('#mgmt-content-wrapper').addClass('col-xs-9'); 
     }else{
        $('.restaurant-Show').removeClass('col-xs-3');
        $('#mgmt-content-wrapper').removeClass('col-xs-9'); 
     }
     if(ww < 1227){
         $('.sales-history').css('padding-left','0');
         $('.customer-visit').css('padding-left','0');
     }else{
         $('.sales-history').css('padding-left','10%');
         $('.customer-visit').css('padding-left','10%');
     }
   });
   // restaurant shadow 
   $('.mgmt-box-body').mouseover(function(){
       $(this).css('box-shadow','5px 5px 5px grey');
   });
   $('.mgmt-box-body').mouseout(function(){
       $(this).css('box-shadow','none');
   });
   //bill printing
  $('.restaurant-logo-overline').mouseover(function(){
      $('#logo-selector').css('opacity','1');
  }); 
   $('.restaurant-logo-overline').mouseout(function(){
      $('#logo-selector').css('opacity','0');
  }); 
});


function printbill(){
  window.location.assign('printbill');  
}
