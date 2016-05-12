<?php

use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Table View');
    $this->assign('heading', 'Dine In Table List');
    ?>
<?php $this->start('breadcrum');?>
     <ol class="breadcrumb">
                            <li><a href="../" class="red">Dashboard</a></li>
                            <li><a href="../reports" class="red">Restaurent 1</a></li>
                            <li class="active">Table List</li>
                            <li style="text-transform: capitalize" class="active"><?= $option ?></li>
                    </ol>
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
<input type="text" style="display: none" class="hidden" id="option" value="<?= $option ?>">
<?php $this->start('script');?>
<script>  
var loading = '<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>' 
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
                        $('.close').on('click', function(){
                            $('#table_data_popup').css('display','none');
                        });
</script>

<?php $this->end('script'); ?>