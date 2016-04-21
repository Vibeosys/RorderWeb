
//hide sections

$(document).ready(function(){
  var loading = '<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>' 
   //onclick on dine-in tab to retrive table
//onclick on takeaway tab to retrive takeaway
  
    
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
      $('.content-wrapper').toggleClass('margin-less');
      $('.content-wrapper').toggleClass('margin-more');
  });
  $('.close').on('click',function(){
      $('#popup').css('display','none');
      $('#myPayment').css('display','none');
     var text = $('#head').text();
     if('Payment Success' === text){
         reloadme();
     }
     
  });
  //make payment
 
  
});

function reloadme(){
        document.location.reload();
    }
//
function payBill(billNo, userInfo, table,takeaway, delivery, cust, discount){
     $('#myPayment').css('display','block');
     var html = '';
     $.post('/getpaymentoptions',{},function(result){
     html += '<select id="pm" name="paymentMode" class="form-control" required>';
     $.each(result,function(key,value){
     html += '<option value="'+ value.paymentMOdeId +'">'+ value.paymentModeTitle +' </option>';
     });
     html += '<select>';
     $('#select').html(html);
     if(discount){
           $('#discount').attr('disabled','disabled');
            $('#discount').val(discount);
        }
     $('.submitbtn').attr('onclick','makepayment(' + billNo +',\''+ userInfo +'\',\''+ table +'\',\''+ takeaway +'\',\''+ delivery +'\',\''+ cust +'\')');
    });
}


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
    
}
function printtakeaway(){
    
}

//table view all operation
function perform(table,takwaway,delivery,discount,deliveryCharge){
    var current_option = $('#option').val();
    if(current_option === 'placeorder'){
        alert(current_option + table);
    }else if(current_option === 'generatebill'){
         var cust = '';
         var billNo = null;
         var userInfo = '';
         var delivery = delivery;
         var takeaway = takwaway;
         var table = table;
        $.post('/getwebuser',{},function(result){
            result.macId = 'WEB:MAC:ADDRESS';
            userInfo = '{"user": {"userId":'+ result.userId +','+
                                '"password":"'+ result.password +'",' +
                                '"macId":"'+ result.macId +'",' +
                                '"restaurantId":'+ result.restaurantId +'},';
            $.post('/getlatestbill',{table:table,takeaway:takeaway,delivery:delivery},function(result){
            if(result){
                if(confirm('Bill was generated for this Table' + '\nMAKE A PAYMENT?') === true){
                     payBill(result.BillNo,userInfo,table,takeaway,delivery,result.CustId,discount);
                 }else{
                     return false;
                 }
            }else{
        $.post('/getcurrenttablecustomer',{table:table,takeaway:takeaway,delivery:delivery},function(response){
             cust = response.custId; 
        
         var  request = userInfo +  ' "data": [{' +
		 '"operation": "generateBill","operationData": {\"custId\":\"'+ cust +'\",\"tableId\":'+ table +',\"takeawayNo\":'+ takeaway +',\"deliveryNo\":'+ delivery +'}}]}';
        $.post('/api/v1/upload',request,function(result1){
             if(result1.errorCode){
                 $('#popup').css('display','block');
                 $('#head').text('Error');
                 $('#head').css('color','red');
                 $('#msg').text(result1.errorCode+': '+result1.message);
             }else{
                 billNo = result1.data;
                 if(confirm(result1.message + '\nMAKE A PAYMENT?') === true){
                     payBill(billNo,userInfo,table,takeaway,delivery,cust,discount);
                 }else{
                     return false;
                 }
             }
           }); 
       });
           }
        });  
        });   
    }else if(current_option === 'cancelorder'){
        alert(current_option+ table);
    }else if(current_option === 'printkot'){
        $.post('/setcookie',{name:'cti',value:table},function(result){});
        $.post('/setcookie',{name:'ctn',value:takeaway},function(result){});
        $.post('/setcookie',{name:'cdn',value:delivery},function(result){});
        if(table){
            window.location.replace('tableorders');
        }else if(takeaway){
            window.location.replace('takeawayorders');
        }else if(delivery){
            window.location.replace('deliveryorders');
        }
    }else if(current_option === 'managetable'){
        alert(current_option+ table);
    }else if(current_option === 'printbill'){
        $.post('/setcookie',{name:'cti',value:table},function(result){});
        $.post('/setcookie',{name:'ctn',value:takeaway},function(result){});
        $.post('/setcookie',{name:'cdn',value:delivery},function(result){});
        if(table){
            window.location.replace('tablebills');
        }else if(takeaway){
            window.location.replace('takeawaybills');
        }else if(delivery){
            window.location.replace('deliverybills');
        }
        
    }
    
}

function makepayment(bill, userInfo, table, takeaway, delivery, cust){
    $(":button").val('Please Wait....');
    var value = $('#pm').val();
    var dis = $('#discount').val();
    var disAmt = null;
     $.post('/getdiscountamount',{discount:dis,billNo:bill},function(result){
         disAmt = result;
         var payrequest = userInfo +
               ' "data": [{' +
		 '"operation": "payedBill","operationData": {\"billNo\":\"'+ bill +'\",\"isPayed\":1,\"payedBy\":'+ value +',\"discount\":'+ disAmt +'}}]}';   
         $.post('/api/v1/upload',payrequest,function(result){
             if(!result.errorCode){
                 $(":button").val('Submit');
                 if(table){
                 var closerequest = userInfo +
               ' "data": [{' +
		 '"operation": "closeTable","operationData": {\"tableId\":\"'+ table +'\",\"custId\":\"'+ cust +'\"}}]}';
                    $.post('/api/v1/upload',closerequest,function(result){
                        var tabelclose = userInfo +
               ' "data": [{' +
		 '"operation": "tableOccupy","operationData": {\"tableId\":\"'+ table +'\",\"isOccupied\":0}}]}';
                         $.post('/api/v1/upload',tabelclose,function(result){
                           $('#pcheck').val('1'); 
                         });
                    });}
                    $('#pcheck').val('1'); 
                 $('#myPayment').css('display','none');
                 $('#popup').css('display','block');
                 $('#head').text('Payment Success');
                 $('#head').css('color','green');
                 $('#msg').text(result.message);
             }else{
             alert('Error in bill Payment');
         }
        });
     });
}


function tablepopup(id) {
        $.post('/setcookie',{name:'cti',value:id},function(result){});
        $.post('/setcookie',{name:'ctn',value:0},function(result){});
        $.post('/setcookie',{name:'cdn',value:0},function(result){});
    window.open("../billprintpreview", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=300, width=700, height=400");
}

function takeawaypopup(id) {
        $.post('/setcookie',{name:'cti',value:0},function(result){});
        $.post('/setcookie',{name:'ctn',value:id},function(result){});
        $.post('/setcookie',{name:'cdn',value:0},function(result){});
    window.open("../billprintpreview", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=300, width=700, height=400");
}
function deliverypopup(id) {
        $.post('/setcookie',{name:'cti',value:0},function(result){});
        $.post('/setcookie',{name:'ctn',value:0},function(result){});
        $.post('/setcookie',{name:'cdn',value:id},function(result){});
    window.open("../billprintpreview", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=300, width=700, height=400");
}

function kotprint(id,cono,ctno,ctkno,cdno,csb,cot) {
      $.post('/setcookie',{name:'coi',value:id},function(result){});
      $.post('/setcookie',{name:'cono',value:cono},function(result){});
      $.post('/setcookie',{name:'ctno',value:ctno},function(result){});
      $.post('/setcookie',{name:'ctkno',value:ctkno},function(result){});
      $.post('/setcookie',{name:'cdno',value:cdno},function(result){});
      $.post('/setcookie',{name:'csb',value:csb},function(result){});
      $.post('/setcookie',{name:'cot',value:cot},function(result){});
    window.open("../orderprintpreview", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=300, width=700, height=400");
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

