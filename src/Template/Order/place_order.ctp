<?php

use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Place an Order');
?>
<?php $this->start('breadcrum');?>
<li class="red"><a class="red" href="../../<?= $option ?>/placeorder"><?php if($option=="tableview"){echo 'Table List';}
elseif($option=="takeawayview"){echo 'Takeaway List';}
elseif($option=="deliveryview"){echo 'Delivery List';}?></a></li>
<li class="active">Place Order</li>
                   
<?php $this->end('breadcrum'); ?>

          <div class="">
            <div class="clearfix">
            </div>
            <div class="row pop-margin">
             
              <!-- Menu List -->
              <div class="col-md-8 col-sm-8 col-xs-12 order-cate">
                <div class="main-menu" id="menu-center">
                  <div class="x_panel category-item">
                    <div class="x_content">
                   
                      <div class="x_title">
                          <div class="select_user">
                              <select id="select_user" class="select2_user form-control">
                          <?php if(isset($users)){ foreach ($users as $user){ if($user->roleId == 1){ ?>   
                              <option value="<?= $user->userId ?>"><?= $user->userName ?>                           
                              </option>
                          <?php } }}?>       
                        </select>
                                <?php if(isset($users)){ foreach ($users as $user){ if($user->roleId == 1){ ?>
                               <input type="hidden" id="urest_<?= $user->userId ?>" value="<?= $user->restaurantId ?>">
                              <input type="hidden" id="upass_<?= $user->userId ?>" value="<?= $user->password ?>">
                               <?php } }}?>  
                          </div>
                          
                        <input type="text" class="form-control search filterinput" placeholder="Search by dishes.." id="filter">
                          
                        <div class="clearfix">
                        </div>
                      </div>
                      <ul class="nav menu-list">
                      <?php if(isset($categories)){ $i = 0; foreach ($categories as $cate){ ?>    
                        <li >
                            <a <?php if(!$i){ echo 'class="active-menu"'; } ?>  href="#<?= $cate->categoryTitle ?>" class="page-scroll all-cate"><?= $cate->categoryTitle ?>
                          </a>
                        </li>
                      <?php $i++; }} ?>
                       
                      </ul>
                    </div>  
                  </div>
                </div>
                <div class="x_panel category-item sub-cat scrollbar" id="style-1">
                  <div class="x_content" id="menu-item">
                    <div class="sub-item-list">
                      <div class="x_panel">
                        <div class="x_content">
                          <!-- Stat All Category -->
                        <ul id="contents" class="inner-list">
                        <?php if(isset($categories)){ $i = 0; foreach ($categories as $cate){ ?>         
                            <li>
                          <section id="<?= $cate->categoryTitle ?>">
                            <div class="item-title">
                              <span><?= $cate->categoryTitle ?>
                              </span>
                            </div>
                            <div class="item-view">
                              <ul>
                       <?php if(isset($menus)){ $i = 0; foreach ($menus as $menu){ if($cate->categoryId == $menu->categoryId){ ?> 
                                  
                                <li> 
                                    <div class="details <?php if($menu->fbTypeId == 3){ echo 'submenu_items';} ?>">
                                    <div class="veg-tag">
                                     <?= $this->Html->image('defualt_menu.png', ['class' => 'veg','alt' => '...'])?>     
                                  
                                        <input type="hidden" id="type_<?= $menu->menuId ?>" value="<?= $menu->fbTypeId ?>">    
                                    </div>
                                      <span id="title_<?= $menu->menuId ?>" class="dish-name">
                                     <?= $menu->menuTitle ?>
                                    </span>
                                       <?php if($menu->fbTypeId == 1){ ?>    
                                      <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                                    <?php }elseif($menu->fbTypeId == 2){ ?> 
                                         <?= $this->Html->image('menu/non_veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                                    <?php }elseif($menu->fbTypeId == 3){ ?>
                                         <?= $this->Html->image('beverages.png', ['class' => 'veg','alt' => '...'])?>
                                    <?php } ?>   
                                        <?php if($menu->fbTypeId == 3){ 
                                       echo $this->Html->image('loading1.gif',['class'=>'menu_loader', 'id' => 'm_load_'.$menu->menuId]);
                                        
                                    } ?>
                                       <?php if($menu->fbTypeId == 3){ ?>  
                                        <div onclick="explore(<?= $menu->menuId ?>);" id="price_<?= $menu->menuId ?>" class="item-price ">
                                     
                                             <span class="submenu_text"> Click for submenu</span>
                                      </div>
                                      <?php } else {?>  
                                        <div id="price_<?= $menu->menuId ?>" class="price item-price ">
                                    <?= $menu->price ?>
                                      <button mysubid="0" myid="<?= $menu->menuId ?>" type="button" class="btn btn-item btn-price">
                                        <i class="fa fa-plus" aria-hidden="true">
                                        </i>
                                      </button>
                                     
                                    </div> <?php } ?>
                                  </div>
                                  <?php if($menu->fbTypeId == 3){ ?>
                                    <div class="sub_content_<?= $menu->menuId ?>">
                                        <ul></ul>
                                    </div>   
                                  <?php } ?>
                                </li>
                       <?php $i++;} } if(!$i)echo 'Unavailable';} ?> 
                                 
                              </ul>
                            </div>
                          </section>
                            </li>
                         <?php $i++; }} ?>
                            </ul>
                          <!-- End chinese Category -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
         
              <!-- OrderList-->
              <div class="col-md-4 col-sm-4 col-xs-12 place-order">
                <div class="order-list">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Your Order
                      </h2>
                      <div class="clearfix">
                      </div>
                    </div>
                    <div class="x_content">
                      <div class="order-inner">
                        <ul class="order-items scrollbar" id="style-1"></ul>
                        <ul class="totals clear">
                          <li class="subtotal2 clear">
                            <div class="total">
                              <span class="name">Subtotal
                              </span>
                              <span class="total-price"><span class="grand_total">00</span>
                              </span>
                            </div>
                          </li>
                        </ul>
                      </div>
                      <button type="button" class="checkout place_my_order">Place Order
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>




      
       
          <!-- /page content -->
    <footer class="footer">
      <div class="container-fluid pop-padding">
          <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <div class="total-item">
                    <i class="fa fa-wpforms"></i> <span class="total_itm_span"></span>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 pop-padding">
                <div class="total-price-footer text-center">
                    Total :  <span class="grand_total">00</span>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pop-padding">
            <button type="button" class="checkout" data-toggle="modal" data-target="#myModal">Checkout</button>  
            </div>
          </div>
        
      </div>
    </footer>

<div id="myModal" class="modal animated zoomin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Your Order</h4>

            </div>
           
            <div class="modal-body">
               <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                       <div class="order-inner">
                        <ul class="order-items modal-height scrollbar" id="style-1"></ul>
                      </div> 
                        <button type="button" class="checkout place_my_order">Place Order
                      </button>
                    </div>
                 <div class="modal-footer">
                 </div>
                </div>
               </div>
            </div>
         </div>
        </div> 
<?= $this->start('placeorder_popup') ?>
        <div class='popup'>
            <div class='popup-inner'>
            <!--<img src='images/close.png' alt='quit' class='x' id='x' />-->
                <h3>Table No :<?php if(isset($tableNo)) echo $tableNo; elseif($takeawayNo) echo $takeawayNo; elseif($takeawayNo) echo $takeawayNo; ?></h3>
                <input type="hidden" id="cur_table" value="<?= $tableId ?>">
                <input type="hidden" id="cur_takeaway" value="<?= $takeawayNo ?>">
                <input type="hidden" id="cur_delivery" value="<?= $deliveryNo ?>">
                <hr>
                <input id="customer" class="form-control col-md-12 col-xs-12" type="text" name="customer" value="" placeholder="Customer Name">
                <div class="center-block text-center btn-popup"> 
                    <button name="reserve" value="true" id="reserve_table" type="submit" class="btn btn-success">Reserve</button>
                    <button type="button" value="cancel" class="btn btn-primary close-btn">Cancel</button></div>
            </div>
        </div>    
<?= $this->end('placeorder_popup') ?>
<?= $this->start('script') ?>
 <script>
 <?php if(isset($isOccupied)) {?>
var isOccupied = <?= $isOccupied ?>;
 <?php } ?>
var kot = <?= $kot_permission ?>;    
var cur_table = <?= $tableId ?>;    
var cur_takeaway = <?= $takeawayNo ?>;    
var cur_delivery = <?= $deliveryNo ?>;
var cur_time = <?= date('d-m-Y');?>;
var cur_cust_id = '<?= $custId ?>';  
var order_type = 1;
if(cur_takeaway != 0){
    order_type = 2;
}else if(cur_delivery != 0){
     order_type = 3;
}
var total_itm = 0;
var webmacid = 'WEB:MAC:ADDRESS';
var minOrder = new Array();
var menuObj = {'menuId':0,'orderQty':0,'subMenuId':0};
  function increase(id){
      
       $('.total_itm_span').text(++total_itm);
       var no = $(".no_item_"+id).text();//alert(no);alert(id);
       no = no.substring(0,no.length/2);
    no++;
    var up = $('.up_'+id).val();
    $(".no_item_"+id).text(no);
    $(".item_price_"+id).text(up*no);
    var gt = $('.grand_total').text();
    gt = gt.substring(0,gt.length/2);
    $('.grand_total').text(parseInt(gt) + parseInt(up));
  }
  function decrease(id){
       var no = $(".no_item_"+id).text();
       no = no.substring(0,no.length/2);
    no--;
     if(no == 0){
        remove_oitem(id);return;
    }
     var up = $('.up_'+id).val();
     var gt = $('.grand_total').text();
    gt = gt.substring(0,gt.length/2);
    $('.grand_total').text(parseInt(gt) - parseInt(up));
     $('.total_itm_span').text(--total_itm);
   
   
    $(".no_item_"+id).text(no);
    $(".item_price_"+id).text(up*no);
     
  }
  function remove_oitem(id){
      var titmp = $('.item_price_'+id).text();
      titmp = titmp.substring(0,titmp.length/2);;
       var gt = $('.grand_total').text();
    gt = gt.substring(0,gt.length/2);
    $('.grand_total').text(gt-titmp);
    $('.oitm_'+id).remove();  
  }
  
  function explore(id){
      var clas = '.sub_content_'+id+' ul';
      if($(clas).children().length){ return false;}
      $('.m_load_'+id).css('display','block');
      $.post('/getsubmenu',{menuId:id},function(result){
        var submenu = '';  
        if(!result){
            submenu = '<li> MENU NOT AVAILABLE </li>';
        }else{
        $.each(result,function(key,menu){
           var type = $('#type_'+menu.menuId).val(); 
            var img = "";//alert(type);
            if(type == 1){
                img = '/img/menu/veg_icon.jpg';
            }else if(type == 2){ 
                img = '/img/menu/non_veg_icon.jpg'; 
            }else if(type == 3){
                 img = '/img/beverages.png'; 
            }else{
                 img = '/img/defualt_menu.png'; 
            }
             submenu += '<li><div class="details"><div class="veg-tag">'+
                        '<img src="'+img+'" class="veg" alt="..."><input type="hidden" id="type" value="'+type+'"></div>'+                        
                        '<span id="title_sub_'+menu.subMenuId+'" class="dish-name">'+menu.subMenuTitle+'</span>'+
                        '<div id="price_sub_'+menu.subMenuId+'" class="price item-price ">'+menu.price+'<button myid="'+menu.menuId+'" mysubid="'+menu.subMenuId+'" type="button" id="sub_'+menu.menuId+'-'+menu.subMenuId+'" onclick="addsubmenu(\'sub_'+menu.menuId+'-'+menu.subMenuId+'\');" class="btn btn-item has_sub btn-price">'+
                        '<i class="fa fa-plus" aria-hidden="true"></i></button></div></div></li>';
          });
          } 
          //alert(clas);
         // alert(submenu);
       $(clas).html(submenu);  
      });
  }
  
  function addsubmenu(idat){
  //alert(idat);
     var id = $('#'+idat).attr('myid');
      var subid = $('#'+idat).attr('mysubid');//alert(subid);
      var ch = '.up_'+id+'-'.subid;//alert(ch);
      if($('.up_'+id+'-'+subid).val()){increase(id+'-'+subid); return;};
    
    var title = $('#title_'+id).text();
    var price = $('#price_'+id).text();
    var type = $('#type_'+id).val();
    var img = '/img/beverages.png';
       var core = id;
      if(subid){
        var price = $('#price_sub_'+subid).text();
        var subtitle = $('#title_sub_'+subid).text();
        title = title+''+subtitle;id = id+'-'+subid;
        $(".order-items").append(" <li mid="+core+" sid="+subid+" class='oitm_"+id+"'><div class='details'><div class='veg-tag'><img src='"+ img +"' class='veg'></div><span class='dish-name'>"+ title +"</span><button type='button' onclick='remove_oitem(\""+id+"\");' class='btn btn-item-close btn-dis' ><i class='fa fa-times-circle' aria-hidden='true'></i> </button></div><div class='count'><div class='number'><div class='dec'><button onclick='decrease(\""+id+"\");' type='button' class='btn btn-item btn_dec'><i class='fa fa-minus' aria-hidden='true'></i> </button></div><span class='no-tem no_item_"+id+"'>1</span><div class='inc'><button onclick='increase(\""+id+"\");' type='button' class='btn btn-item btn_inc'><i class='fa fa-plus' aria-hidden='true'></i></button></div></div><div  class='quantity'>x "+ price +"</div></div><div class='item_price_"+id+" price item-price'>"+ price.trim() +"</div><input type='hidden' value='"+price.trim()+"' class='up_"+id+"'><div class='clear'></div></li>");
   var gt = $('.grand_total').text();
    gt = gt.substring(0,gt.length/2);
    $('.grand_total').text(parseInt(gt) + parseInt(price));
    $('.total_itm_span').text(++total_itm);
      }else{
          return false;
      }
  }
  function generateUUID() {
    var d = new Date().getTime();
    var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = (d + Math.random()*16)%16 | 0;
        d = Math.floor(d/16);
        return (c=='x' ? r : (r&0x3|0x8)).toString(16);
    });
    return uuid;
};
function getCustId(){
    cur_cust_id = generateUUID();
}
 $(document).ready(function(){
    $("#filter").keyup(function(){
 
        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val();
 
        // Loop through the comment list
        $("#contents li").each(function(){
 
            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
 
            // Show the list item if the phrase matches
            } else {
                $(this).show();
            }
        });
 
    });
});

$(".btn-price").click(function(){
    //alert('click');
    var id = $(this).attr('myid');
    if($('.up_'+id).val()){increase(id); return;};
    var title = $('#title_'+id).text();
    var price = $('#price_'+id).text();
    var type = $('#type_'+id).val();
    var img = "";
    var subid = 0;
    if(type == 1){
        img = '/img/menu/veg_icon.jpg';
    }else if(type == 2){ 
        img = '/img/menu/non_veg_icon.jpg';
    }else if(type == 3){
         subid = $(this).attr('mysubid');
      if(subid){
        var price = $('#price_sub_'+subid).text();
        var subtitle = $('#title_sub_'+subid).text();
        title = title+''+subtitle;id = id+'-'+subid;
      }
    }else{
                 img = '/img/defualt_menu.png'; 
            }
    $(".order-items").append(" <li mid='"+id+"' sid='0' class='oitm_"+id+"'><div class='details'><div class='veg-tag'><img src='"+ img +"' class='veg'></div><span class='dish-name'>"+ title +"</span><button type='button' onclick='remove_oitem("+id+");' class='btn btn-item-close btn-dis' ><i class='fa fa-times-circle' aria-hidden='true'></i> </button></div><div class='count'><div class='number'><div class='dec'><button onclick='decrease("+id+");' type='button' class='btn btn-item btn_dec'><i class='fa fa-minus' aria-hidden='true'></i> </button></div><span class='no-tem no_item_"+id+"'>1</span><div class='inc'><button onclick='increase("+id+");' type='button' class='btn btn-item btn_inc'><i class='fa fa-plus' aria-hidden='true'></i></button></div></div><div  class='quantity'>x "+ price +"</div></div><div class='item_price_"+id+" price item-price'>"+ price.trim() +"</div><input type='hidden' value='"+price.trim()+"' class='up_"+id+"'><div class='clear'></div></li>");
   var gt = $('.grand_total').text();
    gt = gt.substring(0,gt.length/2);
    $('.grand_total').text(parseInt(gt) + parseInt(price));
    $('.total_itm_span').text(++total_itm);
   
});
$(".order-items").load;
$(document).ready(function() {
    $('.place_my_order').on('click',function(){
        if(!$(".order-items").children().length){alert('Please select item to proceed.'); return false;}
        var nochild = $(".order-items li").size()/2;
        minOrder = [];
        for(var i=0;i < nochild;i++){
                var n = parseInt(i) + 1;
                  var mid = $(".order-items li:nth-child("+n+")").attr('mid');
                  var sid = $(".order-items li:nth-child("+n+")").attr('sid');
                  var noid = '';
                  if(sid == 0){
                    noid = '.no_item_'+mid;
                  }else{
                      noid = '.no_item_'+mid+'-'+sid;
                  }    
                  var noitem = $(noid).text();
                   noitem = noitem.substring(0,noitem.length/2);
                  var newm =  {'menuId':mid,'orderQty':noitem,'subMenuId':sid};
                   minOrder.push(newm);
        } 
        var str = JSON.stringify(minOrder);
        var operationData = {'custId':cur_cust_id,'orderDetails':minOrder,'orderId':''+generateUUID()+'','deliveryNo':cur_delivery,'takeawayNo':cur_takeaway,'tableId':cur_table,'orderType':order_type};          
        var operation = {'operation':'placeOrder','operationData':JSON.stringify(operationData)}; 
        //var data = JSON.stringify(data);
        var data = [operation];
        var uid = $('#select_user').val();
        var upass = $('#upass_'+uid).val();
        var urest = $('#urest_'+uid).val();
        var user = {'userId':uid,'macId':webmacid,'password':upass,'restaurantId':urest};
        var request = {'user':user,'data':data};
        request = JSON.stringify(request);
        $.ajax({
        url: "../../api/v1/upload", 
        type:"POST",
        data:request,
        contentType: 'application/json',
        cache: false,
        processData:false, 
        success: function(result, jqXHR, textStatus){
          if(result.errorCode == 0){
              alert('Order has been placed.');
              window.location.replace('../../tableview/printkot');
          }else{
             alert('Error:'+result.message); 
            }
         },
        error : function(jqXHR, textStatus, errorThrown) {
                alert('An error occurred! ' + textStatus + jqXHR + errorThrown);
        }});
        //alert(request);
    });
    
    // to reserve table
    $('#reserve_table').on('click',function(){
      
         $.post('/getwebuser',{},function(result){
            var user = {'userId':result.userId,'macId':webmacid,'password':result.password,'restaurantId':result.restaurantId};
              var cust_name = $('.customer').val();
              getCustId();
            var operationData = {'custId':cur_cust_id,'custName':cust_name};
            var operationData1 = {'isOccupied':'1','tableId':cur_table};
            var operationData2 = {'arrivalTime':cur_time,'custId':cur_cust_id,'isWaiting':'0','occupancy':'0','tableId':cur_table,'userId':result.userId};
            var operation = {'operation':'addCustomer','operationData':JSON.stringify(operationData)};
            var operation1 = {'operation':'tableOccupy','operationData':JSON.stringify(operationData1)};
            var operation2 = {'operation':'addWaitingCustomer','operationData':JSON.stringify(operationData2)};
            var data = [operation,operation1,operation2];
             var request = {'user':user,'data':data};
             request = JSON.stringify(request);
            // alert(request);
             $.ajax({
        url: "../../api/v1/upload", 
        type:"POST",
        data:request,
        contentType: 'application/json',
        cache: false,
        processData:false, 
        success: function(result, jqXHR, textStatus){
          if(result.errorCode == 0){
             alert('Success:'+result.message); 
             $('.popup').hide();
             $('#overlayquick').remove();
          }else{
             alert('Error:'+result.message); 
            }
         },
        error : function(jqXHR, textStatus, errorThrown) {
                alert('An error occurred! ' + textStatus + jqXHR + errorThrown);
        }});
         });  
    });
    
      $(".select2_user").select2({
        placeholder: "Select a user",
        allowClear: true
      });
      
});
     
  $(".submenu_items").click(function () {

    $header = $(this);
    
    $content = $header.next();
    //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
    $content.slideToggle(500, function () {
        //execute this after slideToggle is done
        //change text of header based on visibility of content div
       
    });

});

</script>

   <?php if(isset($isOccupied))if(!$isOccupied) echo $this->Html->script('design/popup.js'); ?> 
<?= $this->end('script') ?>