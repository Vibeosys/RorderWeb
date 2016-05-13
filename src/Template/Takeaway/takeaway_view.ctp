    <?php
        use Cake\Cache\Cache;
        use Cake\Core\Configure;
        use Cake\Datasource\ConnectionManager;
        use Cake\Error\Debugger;
        use Cake\Network\Exception\NotFoundException;
        use App\Controller;

        $this->layout = false;
        $this->layout = 'rorder_layout';
        $this->assign('title', 'Takeaway');
        $this->assign('heading', 'Takeaway List');
        
        //$this->assign('script','var loading=\'<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>\';$(".table-list").html(loading),$.ajax({url:"/gettables",type:"POST",contentType:!1,cache:!1,processData:!1,success:function(e,t,a){if(e){var s="";$.each(e,function(e,t){s=t.isOccupied?s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(247, 0, 0, 0.48);">\'+t.tableNo+" </div>":s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(0, 128, 0, 0.55);">\'+t.tableNo+" </div>",$(".table-list").html(s)})}else{var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}},error:function(e,t,a){var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}});');
    ?>
<?php $this->start('breadcrum');?>
     <ol class="breadcrumb">
                             <li><a href="../" class="red">Dashboard</a></li>
                            <li><a href="../reports" class="red">Restaurent 1</a></li>
                            <li class="active">Takeaway List</li>
                            <li style="text-transform: capitalize" class="active"><?= $option ?></li>
                    </ol>
<?php $this->end('breadcrum'); ?>

<section class="table-list">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a  href="#all" data-toggle="tab">All Takeaway</a>
                    </li>
                    <li><a href="#reserved" data-toggle="tab">Active</a>
                    </li>
                    <li><a href="#free" data-toggle="tab">Close</a>
                    </li>
                </ul>
                <div class="tab-content ">       
                    <div class="tab-pane active" id="all">
                        <div class="x_panel">
                            <div class="x_content" id="all-takeaway">

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="reserved">
                        <div class="x_panel">
                            <div class="x_content" id="active-takeaway">

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="free">
                        <div class="x_panel">
                            <div class="x_content" id="close-takeaway">

                            </div>
                        </div>
                    </div>
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
                                    <input class="form-control" type="text" id="discount"> 
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
 <div id="takeaway-view-error" style="display: none">
    <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" >                    
                       <div class="error-msg1">
                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 border-bottom">
                               <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        <img src="../img/error-fix.png" class="img-responsive error-fix">
                                   </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <span class="error-heading">Takeaway not Found! </span>
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
                                                        <li> <a onclick="window.history.back()">Back</a> </li>
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
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Table No :- <span id="table_heading"> </span></h4>

            </div>
            <div class="scrollbar" id="style-1">
            <div class="modal-body">
                <div class="row" id="popup_list">
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="order">
                                    <div class="order-no">
                                        <span class="text-1">Bill No: 231</span> <br>
                                        <span class="text-2">Table No : 101</span>
                                    </div>
                                    <div class="order-detail ">
                                        <span class="text-1">Served By: abcdef</span><br>
                                        <span class="text-2">Date: 3-5-2016</span>
                                    </div>
                                    <div class="print">
                                        <a class="btn-print">
                                            <i class="fa fa-print fa-icon"></i> Print Bill
                                        </a> 
                                    </div>
                           
                        </div>                       
                      </div>
                    <div class="modal-footer">
                        
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
    $('#all-takeaway').html(loading);
    $('#active-takeaway').html(loading);
    $('#close-takeaway').html(loading);
    $.ajax({
        url: "/gettakeaway",
        type: "POST",
        contentType: false,
        cache: false,
        processData: false,
        success: function (result, jqXHR, textStatus) {
            if (result) {
                var takeaway = '';
                var active = '';
                var close = '';
                $.each(result, function (idx, obj) {
                    if (obj.status) {
                        takeaway = takeaway + '<a class="btn btn-app red" onclick="perform(0,' + obj.tno + ',0,' + obj.disPer + ')"><i class="fa fa-male"></i>#' + obj.tno + '</a>';
                        close = close + '<a class="btn btn-app red" onclick="perform(0,' + obj.tno + ',0,' + obj.disPer + ')"><i class="fa fa-male"></i>#' + obj.tno + '</a>';
                    }else{
                        takeaway = takeaway + '<a class="btn btn-app green" onclick="perform(0,' + obj.tno + ',0,' + obj.disPer + ')"><i class="fa fa-male"></i>#' + obj.tno + '</a>';
                        active = active + '<a class="btn btn-app green" onclick="perform(0,' + obj.tno + ',0,' + obj.disPer + ')"><i class="fa fa-male"></i>#' + obj.tno + '</a>';
                    }
                });
               $('#all-takeaway').html(takeaway);
               $('#active-takeaway').html(active);
               $('#close-takeaway').html(close);

            } else {
                var printhtml = $('#takeaway-view-error').html();
                 $('#all-takeaway').html(printhtml);
               $('#active-takeaway').html(printhtml);
               $('#close-takeaway').html(printhtml);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            var printhtml = $('#takeaway-view-error').html();
            $('#all-takeaway').html(printhtml);
               $('#active-takeaway').html(printhtml);
               $('#close-takeaway').html(printhtml);
        }});

</script>

    <?php $this->end('script'); ?>