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
    ?>



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
</script>

<?php $this->end('script'); ?>