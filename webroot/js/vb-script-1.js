
//hide sections

$(document).ready(function(){
  var loading = '<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>';
  var text = $('#dinein').text();
  if(text === 'Dine-In'){
      $('.table-list').html(loading);
      printtable();
  }
  
  //onclick on dine-in tab to retrive table
  $('#dinein').on('click', function(){
      $('.table-list').html(loading);
        printtable();
});
//onclick on takeaway tab to retrive takeaway
  $('#takeaway').on('click', function(){
      $('.table-list').html(loading);
        printtakeaway();
});  
    
 $('show-edit-section').hide();
 
 $('view-edit-btn').on('click', function(){
     $('show-rest-section').css('display','none');
     $('show-edit-section').css('display','block');
 });
 //dynamically upload restaurant logo image using ajax
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
  //pagination button validation
  $('.previous').mouseover(function(){
     
      var value = $('#prev-page').val();
      if(!value){
          $('.previous').css('cursor','not-allowed');
          $('.previous > li > a').css('cursor','not-allowed');
      }else{
           $('.previous > li > a').css('color','#fff');
      }
  });
   $('.next').mouseover(function(){
   
      var value = $('#next-page').val();
      if(!value){
          $(this).css('cursor','not-allowed');
          $('.next > li > a').css('cursor','not-allowed');
      }else{
          $('.next > li > a').css('color','#fff');
      }
  });
   $('.previous').mouseout(function(){
      $('.previous > li > a').css('color','orangered');
  });
  $('.next').mouseout(function(){
      $('.next > li > a').css('color','orangered');
  });
  
  //stock upload menu management
  
  // change the button text 
  
  $('.open-stock-btn').on('click',function(){
      var value = $.cookie("stocko");
      if(value){
            $('.notice-message').text('Please save before perform any operation');
            $('.notification').css('display','block');
             $('.notice').css('display','block');
      }else{
       openstockCheck();
   }
  });
  $('.close-stock-btn').on('click',function(){
      var value = $.cookie("stockc");
      if(value){
          $('.notice-message').text('Please save before perform any operation');
            $('.notification').css('display','block');
             $('.notice').css('display','block');
      }else{
      closestockCheck();
   }
  });
  $('.stock-save').on('click',function(){
      $(this).text('PLEASE WAIT..');
      var os = $.cookie("stocko");
      var cs = $.cookie("stockc");
      var count = $('#count').val();
      var saveResult = false;
      if(os || cs){  
          if(os){
             var i = 0;
             var itemIdList = [];
             var stockList  = [];
             var unitList  = [];
             while(i < count){
              itemIdList.push($('.ItemId'+i).val());
              stockList.push($('.qty'+i).val());
              unitList.push($('.unit'+i).val());
              i++;
            }
            $.post("saveopenstock", {item: itemIdList, stock: stockList, unit: unitList}, function(result){
                if(result === 1){
                    $('.stock-save').text('SAVE');
                    $.cookie("stocko", null, { expires : -1 });
                    $('.stock').addClass('hidden')    
                    $('.stock-value').removeClass('hidden');
                    
                    $('.status-message').text('Stock was open for ');
                    $('.success-message').text('Stock opened for current day');
                    $('.notification').css('display','block');
                    $('.success').css('display','block');
                }else{
                        $('.stock-save').text('SAVE');
                         $('.notice-message').text('Error in stock operation please try again');
                         $('.notification').css('display','block');
                          $('.notice').css('display','block');
                }
               
            });
          }else{
             var i = 0;
             var itemIdList = [];
             var stockList  = [];
                var unitList  = [];
             while(i < count){
              itemIdList.push($('.ItemId'+i).val());
              stockList.push($('.qty'+i).val());
              unitList.push($('.unit'+i).val());
              i++;
             }
             $.post("saveclosestock", {item: itemIdList, stock: stockList,unit: unitList}, function(result){
               
                 if(result === 1){
                    $('.stock-save').text('SAVE');
                    $.cookie("stockc", null, { expires : -1 });
                    $('.stock').addClass('hidden')    
                    $('.stock-value').removeClass('hidden');
                    $('.status-message').text('Stock was close for ');
                    $('.success-message').text('Stock closed for current day');
                    $('.notification').css('display','block');
                    $('.success').css('display','block');
                }else{
                        $('.stock-save').text('SAVE');
                        $('.notice-message').text('Error in stock operation please try again');
                        $('.notification').css('display','block');
                        $('.notice').css('display','block');
                        
                }
                
            });
         }
    }else {
        $(this).text('SAVE');
        $('.notice-message').text('Please open or close stock before save.');
        $('.notification').css('display','block');
         $('.notice').css('display','block');
    }
    return false;
  });
  
 //notice message hide on click
  $('.notice > a').on('click',function(){
      $('.notification').css('display','none');
       $('.notice').css('display','none');
  });
  $('.success > a').on('click',function(){
      $('.notification').css('display','none');
       $('.success').css('display','none');
       window.location.reload(); 
  });
  
   blink(".operation-status", -1, 1000); 
  
    //get recipe items 
    var itemcheck =   $('.recipe-item-select').length;

    if(itemcheck === 1){
      $.get('/getrecipeitem',{},function(result){
          var html = '';
          itemcheck = false;
         $.each(result,function(index,obj){
             html = html + '<option value="'+ obj.itemId + '">'+ obj.itemName + '</option>';
         });
         $('.recipe-item-select').append(html);
      });
  }
  //get units
  var fullcheck =  $('.item-unit-select').length;
  
    if(fullcheck === 1){
      $.get('/getunits',{},function(result){
          var html = '';
          fullcheck = false;
         $.each(result,function(index,obj){
             html = html + '<option value="'+ obj.unitId + '">'+ obj.unitTitle + '</option>';
         });
         $('.item-unit-select').append(html);
      });
  }
 
  // edit single recipe menu
  $('.recipe-edit-row-btn').on('click',function(){
      var btntext = $(this).text();
    if( btntext === 'Edit'){
        $(this).text('SAVE');
     var btnId = $(this).attr('id');
     $('.recipe-qty-fix' + btnId).addClass('hidden');
     $('.recipe-qty-text' + btnId).removeClass('hidden');
     return false;
    }
  });
  $('#menu_toggle').on('click',function(){
      $('.content-wrapper').toggleClass('margin');
  });
  
  
  
});
//blink effect
function blink(elem, times, speed) {
    if (times > 0 || times < 0) {
        if ($(elem).hasClass("blink")) 
            $(elem).removeClass("blink");
        else
            $(elem).addClass("blink");
    }

    clearTimeout(function () {
        blink(elem, times, speed);
    });

    if (times > 0 || times < 0) {
        setTimeout(function () {
            blink(elem, times, speed);
        }, speed);
        times -= .5;
    }
}

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
                                                        +  obj.tableNo +'<br><div class="order-button col-xs-5" onclick="tableorder(' + obj.tableId + ')">Orders</div><div class="bill-button col-xs-5" onclick="tablebill(' + obj.tableId + ')">Bills</div> </div>'; 
                                   }else{
                                  
                                    printhtml = printhtml + '<div class="print-table-button col-xs-2"  style="border-bottom: 8px solid rgba(0, 128, 0, 0.55);">'
                                                      +  obj.tableNo +'<br><div class="order-button col-xs-5" onclick="tableorder(' + obj.tableId + ')">Orders</div><div class="bill-button col-xs-5" onclick="tablebill(' + obj.tableId + ')">Bills</div> </div>';    
                                   }
                               $('.table-list').html(printhtml);
                               });
                            } else {
                                var printhtml = '<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>';
                            $('.table-list').html(printhtml);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            var printhtml = '<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>';
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
                                   
                                    printhtml = printhtml + '<div class="print-table-button col-xs-2">'
                                                     + '#' +  obj.tno +' <br><div class="order-button col-xs-5" onclick="takeawayorder(' + obj.tno + ')">Orders</div><div class="bill-button col-xs-5" onclick="takeawaybill(' + obj.tno + ')">Bills</div></div>'; 
                               });
                               $('.table-list').html(printhtml);
                               
                            } else {
                                var printhtml = '<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span><a href="../managedata" > << Back </a></div>';
                            $('.table-list').html(printhtml);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            var printhtml = '<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span><a href="../managedata" > << Back </a></div>';
                            $('.table-list').html(printhtml);
                        }});
}

function tableorder(id){
    $.cookie("cti", id, { expires : 1 });
    $.cookie("ctn", 0, { expires : 1 });
    window.location.assign("tableorders");
}

function tablebill(id){
    $.cookie("cti", id, { expires : 1 });
    $.cookie("ctn", 0, { expires : 1 });
    window.location.assign("tablebills");
}
function takeawayorder(id){
    $.cookie("ctn", id, { expires : 1 });
    $.cookie("cti", 0, { expires : 1 });
    window.location.assign("takeawayorders");
}

function takeawaybill(id){
    $.cookie("ctkno", id, { expires : 1 });
    $.cookie("cti", 0, { expires : 1 });
    window.location.assign("takeawaybills");
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

function kotprint(id,cono,ctno,ctkno,csb,cot) {
    $.cookie("coi", id, { expires : 1 });
    $.cookie("cono", cono, { expires : 1 });
    $.cookie("ctno", ctno, { expires : 1 });
    $.cookie("ctkno", ctkno, { expires : 1 });
    $.cookie("csb", csb, { expires : 1 });
    $.cookie("cot", cot, { expires : 1 });
    window.open("orderprintpreview", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=300, width=700, height=400");
}

function errorpopup(){
    alert('Invalid option');
    return false;
}


function openstockCheck(){
      $.ajax({
                        url: "/stockopencheck",
                        type: "POST",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (result, jqXHR, textStatus) {
                            if (result) {
                                $('.notice-message').text('Stock Already Open');
                                $('.notification').css('display','block');
                                 $('.notice').css('display','block');
                            }else{
                                $.cookie("stocko", true, { expires : 1 });
                                 $('.stock-value').addClass('hidden')   
                                 $('.stock').removeClass('hidden');
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            $('.notice-message').text(textStatus);
                                $('.notification').css('display','block');
                                 $('.notice').css('display','block');
                        }});
}

function closestockCheck(){
      $.ajax({
                        url: "/stockclosecheck",
                        type: "POST",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (result, jqXHR, textStatus) {
                            if (result) {
                                 $('.notice-message').text('Stock Already Closed');
                                $('.notification').css('display','block');
                                 $('.notice').css('display','block');
                            }else{
                                 $.cookie("stockc", true, { expires : 1 });
                                 $('.stock-value').addClass('hidden')   
                                 $('.stock').removeClass('hidden');
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                             $('.notice-message').text(textStatus);
                             $('.notification').css('display','block');
                              $('.notice').css('display','block');
                            
                        }});
}

