<?php

use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = 'rorder_layout';
    $this->assign('title', 'Table View');
    $this->assign('heading', 'Dine In Table List');
    ?>
<?php $this->start('breadcrum');?>
<li class="red">Table List</li>
<li style="text-transform: capitalize" class="active"><?= $option ?></li>
                   
<?php $this->end('breadcrum'); ?>
<section class="table-list">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a  href="#all" data-toggle="tab">All Table</a>
                    </li>
                    <li><a href="#reserved" data-toggle="tab">Reserved</a>
                    </li>
                    <li><a href="#free" data-toggle="tab">Free</a>
                    </li>
                </ul>
                <div class="tab-content ">       
                    <div class="tab-pane active" id="all">
                        <div class="x_panel">
                            <div class="x_content" id="all-table">


                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="reserved">
                        <div class="x_panel">
                            <div class="x_content" id="reserved-table">


                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="free">
                        <div class="x_panel">
                            <div class="x_content" id="free-table">


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="table_data_popup" class="modal animated zoomin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-down" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="table_heading_h4">Table No :- <span id="table_heading"> </span></h4>

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
                                        <select id="reason" name="reasion" class="select2_source form-control">
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
<input type="text" style="display: none" class="hidden" id="option" value="<?= $option ?>">
<?php $this->start('placeorder_popup');?>
<div  id="notify" class="ui-pnotify stack_top_right" style="display: none;width: 100%">
    <ul>
        
    </ul>
    
</div> 
<?php $this->end('placeorder_popup');?>
<?php $this->start('script');?>
<?= $this->Html->script('design/notify.js') ?>
<script>  
var loading = '<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>';
//$('#m_foot').html(loading);
      $('#all-table').html(loading);
 $.ajax({
                        url: "/gettables",
                        type: "POST",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (result, jqXHR, textStatus) {
                            if (result) {
                                  var alltables = '';
				  var reservedtables = '';
				  var freetables = '';
                               $.each(result, function(idx, obj){
                                   if(obj.isOccupied){
                                alltables = alltables + '<a class="btn btn-app red" onclick="perform(' + obj.tableId + ',0,0);" ><i class="fa fa-table "></i>' +  obj.tableNo + '</a>';
				reservedtables = reservedtables + '<a class="btn btn-app red" onclick="perform(' +obj.tableId +',0,0);" ><i class="fa fa-table "></i>' +  obj.tableNo + '</a>';
                                   }else{
                                alltables = alltables + '<a class="btn btn-app green" onclick="perform(' +obj.tableId +',0,0);" ><i class="fa fa-table "></i>' +  obj.tableNo + '</a>';
				freetables = freetables + '<a class="btn btn-app green" onclick="perform(' +obj.tableId +',0,0);" ><i class="fa fa-table "></i>' +  obj.tableNo + '</a>';
                                   }
                                $('#all-table').html(alltables);
				$('#reserved-table').html(reservedtables);
				$('#free-table').html(freetables);
                               });
                            } else {
                                var alltables = '<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>';
                            $('#all-table').html(alltables);
				$('#reserved-table').html(alltables);
				$('#free-table').html(alltables);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            var alltables = '<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>';
                            $('#all-table').html(alltables);
							$('.reserved-table').html(alltables);
							$('.free-table').html(alltables);
                        }});
                    
</script>

<?php $this->end('script'); ?>