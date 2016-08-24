 $(function(){
var overlay = $('<div id="overlayquick"></div>');
overlay.show();
overlay.appendTo(document.body);
$('.popup').show();
        
     
$('.close-btn').click(function(){
  window.location.replace('../placeorder');  
return false;
});


$('.x').click(function(){
$('.popup').hide();
overlay.appendTo(document.body).remove();
return false;
});
});