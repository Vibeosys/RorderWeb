
//hide sections

$(document).ready(function(){
  var loading = '<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>';
  var text = $('#dinein').text();
  if(text === 'Dine-In'){
      $('.table-list').html(loading);
      printtable();
  }
  $('#dinein').on('click', function(){
      $('.table-list').html(loading);
        printtable();
});           
  $('#takeaway').on('click', function(){
      $('.table-list').html(loading);
        printtakeaway();
});  
 $('#close').on('click', function(){
      $('.popup-background').hide();
}); 
    
    
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
  
  $('div.manage-controls > button').click(function(){
     $(this).css('border', 'none'); 
      
  });
  
  
});

function printtable(){
     $.ajax({
                        url: "/gettables",
                        type: "POST",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (result, jqXHR, textStatus) {
                            if (result) {
                                  var printhtml = '';
                               $.each(result, function(idx, obj){
                                   if(obj.isOccupied){
                                    printhtml = printhtml + '<div class="print-table-button col-xs-2"  style="border-bottom: 8px solid rgba(247, 0, 0, 0.48);">'
                                                        +  obj.tableNo +'<br><div class="order-button col-xs-5" onclick="orderpopup(' + obj.tableId + ')">Orders</div><div class="bill-button col-xs-5" onclick="billpopup(' + obj.tableId + ')">Bills</div> </div>'; 
                                   }else{
                                  
                                    printhtml = printhtml + '<div class="print-table-button col-xs-2"  style="border-bottom: 8px solid rgba(0, 128, 0, 0.55);">'
                                                      +  obj.tableNo +'<br><div class="order-button col-xs-5" onclick="orderpopup(' + obj.tableId + ')">Orders</div><div class="bill-button col-xs-5" onclick="billpopup(' + obj.tableId + ')">Bills</div> </div>';    
                                   }
                               $('.table-list').html(printhtml);
                               });
                               
                            } else {
                                var printhtml = '<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>';
                            $('.table-list').html(printhtml);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            var printhtml = '<div class="error-message"><div class="error-img"></div><span class="error-text">Tables not found</span></div>';
                            $('.table-list').html(printhtml);
                        }});
}
function printtakeaway(){
     $.ajax({
                        url: "/gettakeaway",
                        type: "POST",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (result, jqXHR, textStatus) {
                            if (result) {
                                  var printhtml = '';
                               $.each(result, function(idx, obj){
                                   
                                    printhtml = printhtml + '<div class="print-table-button col-xs-2" onclick="takeawaypopup(' + obj.tno + ')" style="background-color: white;color: orangered;border:1px solid gainsboro;font-size: xx-large;">'
                                                     + '#' +  obj.tno +' </div>'; 
                                   
                               
                               });
                               $('.table-list').html(printhtml);
                               
                            } else {
                                var printhtml = '<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>';
                            $('.table-list').html(printhtml);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            var printhtml = '<div class="error-message"><div class="error-img"></div><span class="error-text">Tables not found</span></div>';
                            $('.table-list').html(printhtml);
                        }});
}


function orderpopup(id){
    $.cookie("cti", id, { expires : 1 });
    window.location.assign("tableorders");
}

function billpopup(id){
    $.cookie("cti", id, { expires : 1 });
    window.location.assign("tablebills");
}

function tablepopup(id) {
        $.cookie("cti", id, { expires : 1 });
        $.cookie("ctn", 0, { expires : 1 });
    window.open("billprintpreview", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=300, width=700, height=400");
}

function takeawaypopup(id) {
        $.cookie("cti", 0, { expires : 1 });
        $.cookie("ctn", id, { expires : 1 });
    window.open("billprintpreview", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=300, width=700, height=400");
}

function kotprint(id,cono,ctno,csb,cot) {
    $.cookie("coi", id, { expires : 1 });
    $.cookie("cono", cono, { expires : 1 });
    $.cookie("ctno", ctno, { expires : 1 });
    $.cookie("csb", csb, { expires : 1 });
    $.cookie("cot", cot, { expires : 1 });
    window.open("orderprintpreview", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=300, width=700, height=400");
}


