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
              <ol class="breadcrumb mobile-show">
                <li>
                  <a href="#" class="red">Dashboard
                  </a>
                </li>
                <li>
                  <a href="#" class="red">Restaurent 1
                  </a>
                </li>
                <li class="active">Place Order
                </li>
              </ol>
              <!-- Menu List -->
              <div class="col-md-8 col-sm-8 col-xs-12 order-cate">
                <div class="main-menu" id="menu-center">
                  <div class="x_panel category-item">
                    <div class="x_content">
                   
                      <div class="x_title">
                          <div class="select_user">
                          <select class="select2_user form-control">
                          <?php if(isset($users)){ foreach ($users as $user){ ?>   
                                 <option><?= $user->userName ?></option>
                          <?php }}?>       
                        </select>
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
                                    <?php if($menu->fbTypeId == 1){ ?>    
                                      <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                                    <?php }elseif($menu->fbTypeId == 2){ ?> 
                                         <?= $this->Html->image('menu/non_veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                                    <?php }elseif($menu->fbTypeId == 3){ ?>
                                         <?= $this->Html->image('beverages.png', ['class' => 'veg','alt' => '...'])?>
                                    <?php } ?>
                                        <input type="hidden" id="type_<?= $menu->menuId ?>" value="<?= $menu->fbTypeId ?>">    
                                    </div>
                                      <span id="title_<?= $menu->menuId ?>" class="dish-name">
                                     <?= $menu->menuTitle ?>
                                    </span><?php if($menu->fbTypeId == 3){ 
                                       echo $this->Html->image('loading1.gif',['class'=>'menu_loader', 'id' => 'm_load_'.$menu->menuId]);
                                        
                                    } ?>
                                       <?php if($menu->fbTypeId == 3){ ?>  
                                        <div onclick="explore(<?= $menu->menuId ?>);" id="price_<?= $menu->menuId ?>" class="item-price ">
                                     
                                             <span class="submenu_text"> Click for submenu</span>
                                      </div>
                                      <?php } else {?>  
                                        <div id="price_<?= $menu->menuId ?>" class="price item-price ">
                                    <?= $menu->price ?>
                                      <button myid="<?= $menu->menuId ?>" type="button" class="btn btn-item btn-price">
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
                        <ul class="order-items scrollbar" id="style-1">
                         
                        </ul>
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
                      <button type="button" class="checkout">Checkout
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
                        <ul class="order-items modal-height scrollbar" id="style-1">
                          
                        </ul>
                      </div> 
                        <button type="button" class="checkout">Place Order
                      </button>
                    </div>
                 <div class="modal-footer">
                 </div>
                </div>
               </div>
            </div>
         </div>
        </div> 
<?= $this->start('script') ?>
 <script>
var total_itm = 0;
  function increase(id){
      
       $('.total_itm_span').text(++total_itm);
       var no = $(".no_item_"+id).text();
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
     var up = $('.up_'+id).val();
     var gt = $('.grand_total').text();
    gt = gt.substring(0,gt.length/2);
    $('.grand_total').text(parseInt(gt) - parseInt(up));
     $('.total_itm_span').text(--total_itm);
    if(no == 0){
        remove_oitem(id);return;
    }
   
    $(".no_item_"+id).text(no);
    $(".item_price_"+id).text(up*no);
     
  }
  function remove_oitem(id){
    $('.oitm_'+id).remove();  
  }
  function explore(id){
      $('.m_load_'+id).css('display','block');
      $.post('/getsubmenu',{menuId:id},function(result){
        var submenu = '';  
        $.each(result,function(key,menu){
              submenu += '<li><div class="details"><div class="veg-tag">'+
                        '<img src="/img/menu/veg_icon.jpg" class="veg" alt="..."><input type="hidden" id="type" value="1"></div>'+                        '<span id="title_8" class="dish-name">Mushroom cappuccino</span>'.
                        '<div id="price_8" class="price item-price ">140<button myid="8" type="button" class="btn btn-item btn-price">'+
                        '<i class="fa fa-plus" aria-hidden="true"></i></button></div></div></li>';
          });
          var class = '.sub_content_'+id+' ul';
       $(class).html(submenu);  
      });
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
    var id = $(this).attr('myid');
    if($('.up_'+id).val()){increase(id); return;};
    var title = $('#title_'+id).text();
    var price = $('#price_'+id).text();
    var type = $('#type_'+id).val();
    var img = "";
    
    if(type == 1){
        img = '/img/menu/veg_icon.jpg';
    }else if(type == 2){ img = '/img/menu/non_veg_icon.jpg'; }
    $(".order-items").append(" <li class='oitm_"+id+"'><div class='details'><div class='veg-tag'><img src='"+ img +"' class='veg'></div><span class='dish-name'>"+ title +"</span><button type='button' onclick='remove_oitem("+id+");' class='btn btn-item-close btn-dis' ><i class='fa fa-times-circle' aria-hidden='true'></i> </button></div><div class='count'><div class='number'><div class='dec'><button onclick='decrease("+id+");' type='button' class='btn btn-item btn_dec'><i class='fa fa-minus' aria-hidden='true'></i> </button></div><span class='no-tem no_item_"+id+"'>1</span><div class='inc'><button onclick='increase("+id+");' type='button' class='btn btn-item btn_inc'><i class='fa fa-plus' aria-hidden='true'></i></button></div></div><div  class='quantity'>x "+ price +"</div></div><div class='item_price_"+id+" price item-price'>"+ price.trim() +"</div><input type='hidden' value='"+price.trim()+"' class='up_"+id+"'><div class='clear'></div></li>");
   var gt = $('.grand_total').text();
    gt = gt.substring(0,gt.length/2);
    $('.grand_total').text(parseInt(gt) + parseInt(price));
    $('.total_itm_span').text(++total_itm);
   
});
$(".btn_inc").click(function(e){
    var id = $(this).attr('itmid');
    var no = $("#no_item_"+id).text();
    no++;
    var up = $('#up_'+id).val();
    $("#no_item_"+id).text(no);
    $("#item_price_"+id).text(up*no);
   
});
$(".btn_dec").on('click',function(e){
    alert('decrease');
});

 $(".order-items").load;
$(".btn-item-close").click(function() {
  $(this).parent().parent().remove();
});
         
/*
$(document).ready(function(){       
   var scroll_start = 0;
   var startchange = $('#soups');
   var offset = startchange.offset();
   alert(scroll_start);
    if (startchange.length){
        
   $(".category-item").scroll(function() { 
      
      scroll_start = $(this).scrollTop();
       //alert(scroll_start);
      if(scroll_start > 280) {
         $('a').each(function () {
            $(this).removeClass('active-menu');
        $(".soups-cat").addClass('active-menu');
        })
      
       } else {
          $(".soups-cat").removeClass('active-menu');
         
       }
   });
    }
});*/
   
    $(document).ready(function() {
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
<?= $this->end('script') ?>