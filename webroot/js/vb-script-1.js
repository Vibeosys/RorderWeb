
//hide sections

$(document).ready(function(){
    var default_size_for_page = $('#count').val();
  var loading = '<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>' 
   //onclick on dine-in tab to retrive table
//onclick on takeaway tab to retrive takeaway
    $('.close').on('click', function(){
                            $('#table_data_popup').css('display','none');
                        });
    
 $('show-edit-section').hide();
 
 $('view-edit-btn').on('click', function(){
     $('show-rest-section').css('display','none');
     $('show-edit-section').css('display','block');
 });
 //dynamically upload restaurant logo image using ajax
 
  
   // restaurant shadow 
  
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
  
   
   
  
  //stock upload menu management
  
  // change the button text
  
 
  
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
  
    //get recipe items 
   
 
  // edit single recipe menu
 
 
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
//table view all operation
function perform(table,takwaway,delivery,discount,deliveryCharge){
    var current_option = $('#option').val();
     var cust = '';
         var billNo = null;
         var userInfo = '';
         var delivery = delivery;
         var takeaway = takwaway;
         var table = table;
    if(current_option === 'placeorder'){
          if(table){
                  window.location.replace('../../tableview/placeorder/place-an-order');
          }else if(takeaway){
                 window.location.replace('../../takeaway/placeorder/place-an-order');
          }else{
                window.location.replace('../../delivery/placeorder/place-an-order');
          }
       
    }else if(current_option === 'generatebill'){
        var s_link = '';
        var e_link = '';
        var back_link = '';
        if(table){
                  s_link = 'generatebill/generate-status';
                  e_link = 'generatebill/invalid-entry';
                  back_link = 'generatebill';
          }else if(takeaway){
                  s_link ='generatebill/generate-status';
                  e_link ='generatebill/invalid-entry';
                  back_link = 'generatebill';
          }else{
                 s_link ='generatebill/generate-status';
                 e_link ='generatebill/invalid-entry';
                 back_link = 'generatebill';
          }
  
        $.post('/getwebuser',{},function(result){
            result.macId = 'WEB:MAC:ADDRESS';
            userInfo = '{"user": {"userId":'+ result.userId +','+
                                '"password":"'+ result.password +'",' +
                                '"macId":"'+ result.macId +'",' +
                                '"restaurantId":'+ result.restaurantId +'},';
            $.post('/getlatestbill',{table:table,takeaway:takeaway,delivery:delivery},function(result){
            if(result){
                if(result.errorCode){
                    alert(result.errorCode);
                    if(result.errorCode == 104){
                        window.location.replace('../../login');
                    }else{
                     $.post('/setcookie',{name:'bg_st_msg',value:result.message},function(result){});
                     $.post('/setcookie',{name:'bg_link',value:back_link},function(result){});
                      window.location.replace(''+ e_link);
                  }
                }else{
                    $.post('/setcookie',{name:'bg_billno',value:result.BillNo},function(result){});
                    $.post('/setcookie',{name:'bg_userinfo',value:userInfo},function(result){});
                    $.post('/setcookie',{name:'bg_table',value:table},function(result){});
                    $.post('/setcookie',{name:'bg_take',value:takeaway},function(result){});
                    $.post('/setcookie',{name:'bg_deli',value:delivery},function(result){});
                    $.post('/setcookie',{name:'bg_cust',value:result.CustId},function(result){});
                    $.post('/setcookie',{name:'bg_disc',value:discount},function(result){});
                    $.post('/setcookie',{name:'bg_st_msg',value:'Bill was already generated !'},function(result){});
                    
                    window.location.replace(''+s_link);
                }
            }else{
                $.post('/getcurrenttablecustomer',{table:table,takeaway:takeaway,delivery:delivery},function(response){
                    cust = response.custId; 
                    var  request = userInfo +  ' "data": [{' +
                            '"operation": "generateBill","operationData": {\"custId\":\"'+ cust +'\",\"tableId\":'+ table +',\"takeawayNo\":'+ takeaway +',\"deliveryNo\":'+ delivery +'}}]}';
                    $.post('/api/v1/upload',request,function(result1){
                        if(result1.errorCode){
                            $.post('/setcookie',{name:'bg_st_msg',value:result1.message},function(result){});
                             $.post('/setcookie',{name:'bg_link',value:back_link},function(result){});
                      window.location.replace(''+ e_link);
                 
                            }else{
                                billNo = result1.data;
                                $.post('/setcookie',{name:'bg_billno',value:billNo},function(result){});
                                $.post('/setcookie',{name:'bg_userinfo',value:userInfo},function(result){});
                                $.post('/setcookie',{name:'bg_table',value:table},function(result){});
                                $.post('/setcookie',{name:'bg_take',value:takeaway},function(result){});
                                $.post('/setcookie',{name:'bg_deli',value:delivery},function(result){});
                                $.post('/setcookie',{name:'bg_cust',value:cust},function(result){});
                                $.post('/setcookie',{name:'bg_disc',value:discount},function(result){});
                                $.post('/setcookie',{name:'bg_st_msg',value:'Bill has generated !'},function(result){});
                             window.location.replace(''+ s_link);
                            }
                        }); 
       });
           }
        });  
        });   
    }else if(current_option === 'cancelorder'){
         if(table){
                  window.location.replace('../../tableview/cancelorder/cancel-an-order');
          }else if(takeaway){
                 window.location.replace('../../takeaway/cancelorder/cancel-an-order');
          }else{
                window.location.replace('../../delivery/cancelorder/cancel-an-order');
          }
    }else if(current_option === 'printkot'){
        $.post('/setcookie',{name:'cti',value:table},function(result){
        $.post('/setcookie',{name:'ctn',value:takeaway},function(result){
        $.post('/setcookie',{name:'cdn',value:delivery},function(result){
        if(table || takeaway || delivery){
            
      var  data = 'table='+table+'&takeaway=' +takeaway +'&delivery='+ delivery;
              $.ajax({
        url: "/tableview/tableorders?" + data, 
        type:"POST",
        contentType: 'application/json',
        cache: false,
        processData:false, 
        success: function(result, jqXHR, textStatus){
            var result_html = '';
            var table_no = ''; 
            var print_string = '';
            var next_function = '';
            var number = null;
            if(result){
                 $('#table_data_popup').css('display','block');
                if(result.message){
                result_html = result.message;     
                }else{
                    if(table){
                      print_string = 'Table No';
                    }else if(takeaway){
                      print_string = 'Takeaway No'; 
                    }else{
                      print_string = 'Delivery';  
                    }
            $.each(result,function(key, obj){
               // $('#table_data_popup').css('display','block');
               
               next_function = "kotprint('"+ obj.orderId +"',"+ obj.orderNo +","+ obj.tableId +","+ obj.takeawayNo +","+ obj.deliveryNo +",'"+ obj.user +"','"+ obj.orderTime +"')";
               if(obj.tableId){ number = obj.tableId;}else if(obj.takeawayNo){ number = obj.takeawayNo;}else{number = obj.deliveryNo;}
                result_html += '<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">' +
                        '<div class="order">'+
                                    '<div class="order-no">'+
                                       '<span class="text-1">Order No:'+ obj.orderNo + '</span> <br>'+
                                        '<span class="text-2">'+ print_string +' : '+ number + '</span>'+
                                    '</div>'+
                                    '<div class="order-detail ">'+
                                        '<span class="text-1">Served By: '+ obj.user + '</span><br>' +
                                        '<spna class="text-2">Time: '+ obj.orderTime + '</spna>'+
                                    '</div>'+
                                    '<div class="print">'+
                                        '<a class="btn-print" onclick="' + next_function +'">'+
                                            '<i class="fa fa-print fa-icon"></i> Print KOT'+
                                        '</a>'+ 
                                    '</div> </div> </div>';
            });
                }
            $('#popup_list').html(result_html);
            $('#table_heading').html(number);
           }else{
            alert('please contact on info@vibeosys.com');
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
                alert('An error occurred! ' + textStatus + jqXHR + errorThrown);
        }});
        }else{
            alert('please contact on info@vibeosys.com');
        }
        });
        });
        });
    }else if(current_option === 'managetable'){
        alert(current_option+ table);
    }else if(current_option === 'printbill'){
        
        $.post('/setcookie',{name:'cti',value:table},function(result){});
        $.post('/setcookie',{name:'ctn',value:takeaway},function(result){});
        $.post('/setcookie',{name:'cdn',value:delivery},function(result){});
        if(table || takeaway || delivery){
            
      var  data = 'table='+table+'&takeaway=' +takeaway +'&delivery='+ delivery;
              $.ajax({
        url: "/tableview/tablebills?" + data, 
        type:"POST",
        contentType: 'application/json',
        cache: false,
        processData:false, 
        success: function(result, jqXHR, textStatus){
            var result_html = '';
            var table_no = ''; 
            var print_string = '';
            var next_function = '';
            var number = null;
            if(result){
                 $('#table_data_popup').css('display','block');
                if(result.message){
                result_html = result.message;     
                }else{
                    if(table){
                      print_string = 'Table No';
                      next_function = 'tablepopup('+ table +')';
                    }else if(takeaway){
                      print_string = 'Takeaway No'; 
                      next_function = 'takeawaypopup('+ takeaway +')';
                    }else{
                      print_string = 'Delivery';  
                      next_function = 'deliverypopup('+ delivery +')';
                    }
            $.each(result,function(key, obj){
               // $('#table_data_popup').css('display','block');
               
               if(obj.tableNo){ number = obj.tableNo;}else if(obj.takeawayNo){ number = obj.takeawayNo;}else{number = obj.deliveryNo;}
                result_html += '<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">' +
                        '<div class="order">'+
                                    '<div class="order-no">'+
                                       '<span class="text-1">Bill No:'+ obj.billNo + '</span> <br>'+
                                        '<span class="text-2">'+ print_string +' : '+ number + '</span>'+
                                    '</div>'+
                                    '<div class="order-detail ">'+
                                        '<span class="text-1">Served By: '+ obj.user + '</span><br>' +
                                        '<spna class="text-2">Date: '+ obj.date + '</spna>'+
                                    '</div>'+
                                    '<div class="print">'+
                                        '<a class="btn-print" onclick="' + next_function +'">'+
                                            '<i class="fa fa-print fa-icon"></i> Print Bill'+
                                        '</a>'+ 
                                    '</div> </div> </div>';
            });
                }
            $('#popup_list').html(result_html);
            $('#table_heading').html(number);
           }else{
            alert('please contact on info@vibeosys.com');
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
                alert('An error occurred! ' + textStatus + jqXHR + errorThrown);
        }});
        }else{
            alert('please contact on info@vibeosys.com');
        }
        
    }
    
}

function makepayment(bill, userInfo, table, takeaway, delivery, cust){
    $("#loading").css('display','block');
    $('#btn_yes').attr('disabled','disabled');
    $('#btn_no').attr('disabled','disabled');
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
                  var link = ''; 
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
                    });
                    link = 'tableview/generatebill';
                }else if(takeaway){
                    link = 'takeaway/generatebill';
                }else{
                     link = 'delivery/generatebill';
                }
                $('.msg-text').css('color','green');
                $('.msg-text').addClass('msg-text-extra');
                var s_html = 'payment has been done<br>';
                s_html += '<ul class="error-list1"><li> <a href="../generatebill">OK</a> </li><li> <a href="../../reports">Home</a></li></ul>';
                    $('.msg-text').html(s_html); 
                 
             }else{
             $('.msg-text').css('color','red');
             $('.msg-text').addClass('msg-text-extra');
              var s_html = 'Payment has been failed<br>';
              s_html += '<ul class="error-list1"><li> <a href="../generatebill">Back</a> </li><li> <a href="../../reports">Home</a></li></ul>';
                    $('.msg-text').html(s_html);
         }
        });
     });
}


function tablepopup(id) {
        $.post('/setcookie',{name:'cti',value:id},function(result){
            $.post('/setcookie',{name:'ctn',value:0},function(result){
                $.post('/setcookie',{name:'cdn',value:0},function(result){
                    window.open("../billprintpreview", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=300, width=700, height=400");
                });
            });
        });
}

function takeawaypopup(id) {
        $.post('/setcookie',{name:'cti',value:0},function(result){
            $.post('/setcookie',{name:'ctn',value:id},function(result){
             $.post('/setcookie',{name:'cdn',value:0},function(result){
                 window.open("../billprintpreview", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=300, width=700, height=400");
             });
            });
        });
}
function deliverypopup(id) {
        $.post('/setcookie',{name:'cti',value:0},function(result){
            $.post('/setcookie',{name:'ctn',value:0},function(result){
                $.post('/setcookie',{name:'cdn',value:id},function(result){
                    window.open("../billprintpreview", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=300, width=700, height=400");
                });
            });
        });
}

function kotprint(id,cono,ctno,ctkno,cdno,csb,cot) {
      $.post('/setcookie',{name:'coi',value:id},function(result){
          $.post('/setcookie',{name:'cono',value:cono},function(result){
              $.post('/setcookie',{name:'ctno',value:ctno},function(result){
                  $.post('/setcookie',{name:'ctkno',value:ctkno},function(result){
                      $.post('/setcookie',{name:'cdno',value:cdno},function(result){
                          $.post('/setcookie',{name:'csb',value:csb},function(result){
                              $.post('/setcookie',{name:'cot',value:cot},function(result){
                                  window.open("../orderprintpreview", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=200, left=300, width=700, height=400");
                              });
                          });
                      });
                  });
              });
          });
      });
}

function errorpopup(){
    alert('Invalid option');
    return false;
}



