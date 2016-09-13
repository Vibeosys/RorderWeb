<?php

use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Delivery');
    $this->assign('heading', 'Delivery List');
    //$this->assign('script','var loading=\'<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>\';$(".table-list").html(loading),$.ajax({url:"/gettables",type:"POST",contentType:!1,cache:!1,processData:!1,success:function(e,t,a){if(e){var s="";$.each(e,function(e,t){s=t.isOccupied?s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(247, 0, 0, 0.48);">\'+t.tableNo+" </div>":s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(0, 128, 0, 0.55);">\'+t.tableNo+" </div>",$(".table-list").html(s)})}else{var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}},error:function(e,t,a){var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}});');
?>
<?php $this->start('breadcrum');?>

                            <li class="red">Delivery List</li>
                            <li style="text-transform: capitalize" class="active"><?= $option ?></li>
<?php $this->end('breadcrum'); ?>

<section class="table-list">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a  href="#all" data-toggle="tab">All Delivery</a>
                    </li>
                    <li><a href="#reserved" data-toggle="tab">Active</a>
                    </li>
                    <li><a href="#free" data-toggle="tab">Close</a>
                    </li>
                     <?php if(isset($addNew)){ ?>
                    <li><a href="#new" data-toggle="tab">New Add</a>
                    </li>
                     <?php } ?>     
                </ul>
                <div class="tab-content ">       
                    <div class="tab-pane active" id="all">
                        <div class="x_panel">
                            <div class="x_content" id="all-delivery">


                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="reserved">
                        <div class="x_panel">
                            <div class="x_content" id="active-delivery">

                            </div>
                        </div>
                    </div>
                      <div class="tab-pane" id="free">
                        <div class="x_panel">
                            <div class="x_content" id="close-delivery">
                            
                            </div>
                        </div>
                    </div>
                     <?php if(isset($addNew)){ ?>
                    <div class="tab-pane" id="new">
                        <div class="x_panel">
                            <div class="x_content" id="new-delivery">
                                 <form id="takeaway" data-parsley-validate class="form-horizontal form-label-left" method="post" action="">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="dname" name="takeawayname" required="required" class="form-control col-md-7 col-xs-12" value="" placeholder="Name">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="daddress" name="address" required="required" class="form-control col-md-7 col-xs-12" placeholder="Address"></textarea>
                      </div>
                    </div>
                  <div class="form-group">
                      <label for="ingredients" class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="dphone" class="form-control col-md-7 col-xs-12" type="text" name="phone" value="" placeholder="Phone no">
                      </div>
                    </div>
                      
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                             <select id="dsource" name="category" class="select2_source form-control">
                                    <option disabled selected>Source</option>
                                    <option>option 1 </option>
                                    <option>option 2 </option>
                                    <option>option 3 </option>
                                    <option>option 4 </option>
                                    <option>option 5 </option>
                                    <option>option 6 </option>
                        </select>
                        </div>
                    </div>
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="discount" name="discount" required="required" class="form-control col-md-7 col-xs-12" value="8%" disabled>
                      </div>
                    </div>
                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="delivercharge" name="delivercharge" required="required" class="form-control col-md-7 col-xs-12" value="" placeholder="Delivery Charge">
                      </div>
                    </div>
                   
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button name="save" value="true" type="submit" class="btn btn-success">Submit</button>
                           <button type="button" value="cancel" class="btn btn-primary" onclick="window.history.back();">Cancel</button>
                      </div>
                    </div>

                  </form>           
                                    
                            </div>
                        </div>
                    </div>
                     <?php } ?>     
                </div>
            </div>
        </div>
    </div>
</section>
<div id="popup" class="modal animated zoomin"> 
    <div class="modal-dialog mail" >
        <div class="modal-content" id="show">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="heading" id="head" style="padding: 20px 20px">
            </div>
            <div class="message" id="msg" style="padding: 20px 20px">
            </div>
        </div>
    </div>
</div>
<div id="myPayment" class="modal animated zoomin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">MakePayment</h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <label for="payment"> Payment By</label>
                    <div class="contact-form" style="padding: 0px 5px;">
                        <div id="select" class="form-group has-feedback">

                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <label for="payment"> Add Discount</label>
                    <div class="contact-form" style="padding: 0px 5px;">
                        <div id="select" class="form-group has-feedback">
                            <input class="form-control" type="number" id="discount"> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group text-center">
                        <input type="button" class="form-control center-block submitbtn btn btn-primary" name="submit" value="Submit">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="delivery-view-error" style="display: none">
    <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" >                    
        <div class="error-msg1">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 border-bottom">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <img src="../img/error-fix.png" class="img-responsive error-fix">
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <span class="error-heading">Active Delivery not Found! </span>
                    </div>
                </div> 
            </div>
            <div class="msg-text">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-3 ">                  
                    <p class="error-p1">The content not found</p>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  col-lg-offset-2 col-md-offset-3">
                    <p class="error-msg2">Here are some suggestions:</p>
                    <ul class="error-list1">
                        <!--<li> <a href="../deliveryView/printbill">Back</a> </li>-->
                        <li> <a href="../reports">Home</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> </div> 
<div id="table_data_popup" class="modal animated zoomin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-down" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Table No :- <span id="table_heading"> </span></h4>

            </div>
            <div class="scrollbar" id="style-1">
            <div class="modal-body">
                <div class="row" id="popup_list">
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="order">
                                    <div class="order-no">
                                        <span class="text-1">Order No: <span id="c_on">231</span></span> <br>
                                        <span class="text-2">Table No : <span id="c_tn">101 </span></span>
                                    </div>
                                    <div class="order-detail ">
                                        <span class="text-1">Served By: <span id="c_sb">231</span></span><br>
                                        <span class="text-2">Date:<span id="c_d">231</span></span>
                                    </div>
                                    <div class="print">
                                      <div class="order-detail ">
                                          <select name="reasion">
                                              <option>Select One</option>
                                              <option>Change My mind.</option>
                                              <option>Customer mind changed.</option>
                                              <option>Menu was not available.</option>
                                          </select>
                                           </div>
                                        <a class="btn-print">
                                            <i class="fa fa-print fa-icon"></i> Print Bill
                                        </a> 
                                    </div>
                           
                        </div>                       
                      </div>
                
               
            </div>
                    <div id="m_foot" class="modal-footer">
                        <div id="please_wait" >  
                       <img src="../img/quickserve-big-loading.gif" alt="Loading...">
                       <p>Please Wait</p>
                        </div>
                    </div>
        </div>
    </div>
</div>
    
    </div> 
    </div>
<div id="cancel_order_popup" class="modal animated zoomin" style="z-index: 1100;background: rgba(0, 0, 0, 0.54);">
    <div class="modal-dialog" style="width: 500px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-up" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Cancel Order<span id="table_heading"> </span></h4>

            </div>
            <div class="scrollbar" id="style-1">
            <div class="modal-body">
                <div class="row" id="popup_list">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="order">
                                    <div class="order-no">
                                        <span class="text-1">Order No: <span id="c_on"></span></span> <br>
                                        <span class="text-2">Table No : <span id="c_tn"> </span></span>
                                    </div>
                                    <div class="order-detail ">
                                        <span class="text-1">Served By: <span id="c_sb"></span></span><br>
                                        <span class="text-2">Date:<span id="c_d"></span></span>
                                    </div>
                                    <div class="print">
                                        <label>Please select reason to cancel order</label><br>
                                        <select id="reason" name="reasion" class="form-control">
                                              <option>Select One</option>
                                              <option>Change My mind.</option>
                                              <option>Customer mind changed.</option>
                                              <option>Menu was not available.</option>
                                          </select>
                                    </div>    
                            <div class="print" id="c_c_div">
                                        <a class="btn-print" id="c_conform">
                                            <i class="fa fa-cancel fa-icon"></i> Conform
                                        </a> 
                                    </div>
                           
                        </div>                
                      </div>
                    <div class="modal-footer" >
                        
                    </div>
               
            </div>
        </div>
    </div>
</div>
    
    </div> 
    </div>
<input type="text" class="hidden" id="option" value="<?= $option ?>">
<?php $this->start('script');?>
<script>
    var loading = '<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>'
    $('#all-delivery').html(loading);
    $('#active-delivery').html(loading);
    $('#close-delivery').html(loading);
    $.ajax({
        url: "/getdelivery",
        type: "POST",
        contentType: false,
        cache: false,
        processData: false,
        success: function (result, jqXHR, textStatus) {
            if (result) {
                var delivery = '';
                var active = '';
                var close = '';
                $.each(result, function (idx, obj) {
                    if (obj.status) {
                        delivery = delivery + '<a class="btn btn-app red" onclick="perform(0,0,' + obj.tno + ',' + obj.disPer + ',' + obj.tdc + ')"><i class="fa fa-motorcycle"></i>#' + obj.tno + '</a>';
                        close = close + '<a class="btn btn-app red" onclick="perform(0,0,' + obj.tno + ',' + obj.disPer + ',' + obj.tdc + ')"><i class="fa fa-motorcycle"></i>#' + obj.tno + '</a>';
                    } else {
                        delivery = delivery + '<a class="btn btn-app green" onclick="perform(0,0,' + obj.tno + ',' + obj.disPer + ',' + obj.tdc + ')"><i class="fa fa-motorcycle"></i>#' + obj.tno + '</a>';
                        active = active + '<a class="btn btn-app green" onclick="perform(0,0,' + obj.tno + ',' + obj.disPer + ',' + obj.tdc + ')"><i class="fa fa-motorcycle"></i>#' + obj.tno + '</a>';
                    }
                });
                $('#all-delivery').html(delivery);
                $('#active-delivery').html(active);
                $('#close-delivery').html(close);
            } else {
                var printhtml = $('#delivery-view-error').html();
                $('#all-delivery').html(printhtml);
                $('#active-delivery').html(printhtml);
                $('#close-delivery').html(printhtml);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            var printhtml = $('#delivery-view-error').html();
            $('#all-delivery').html(printhtml);
            $('#active-delivery').html(printhtml);
            $('#close-delivery').html(printhtml);
        }});
$(document).ready(function() {
      $(".select2_source").select2({
        placeholder: "Select a Source",
        allowClear: true
      });
     
});
</script>

<?php $this->end('script'); ?>