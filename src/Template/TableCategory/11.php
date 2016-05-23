<?php

use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Table Category List');
    $this->assign('heading', 'Table Category List');
    //$this->assign('script','var loading=\'<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>\';$(".table-list").html(loading),$.ajax({url:"/gettables",type:"POST",contentType:!1,cache:!1,processData:!1,success:function(e,t,a){if(e){var s="";$.each(e,function(e,t){s=t.isOccupied?s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(247, 0, 0, 0.48);">\'+t.tableNo+" </div>":s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(0, 128, 0, 0.55);">\'+t.tableNo+" </div>",$(".table-list").html(s)})}else{var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}},error:function(e,t,a){var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}});');
?>
<?php $this->start('breadcrum');?>
    <li class="active">Table Category</li>
<?php $this->end('breadcrum'); ?>           


<?php $this->start('head_title');?>
            <div class="x_title">
                <h2>Table List</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a href="rtables/addnewtables"><i class="fa fa-plus-circle"></i> Add New Table</a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
 <?php $this->end('head_title'); ?>        
            <div class="x_content">

               <table id="table-category" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Title</th>
                              <th>Image</th>
                              <th>Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>General</td>
                              <td><img src="images/sad.png" class="img-responsive menu-img"></td>
                              <td>
                                     <button type="button" class="btn btn-success btn-circle btn-lg" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-square-o fa-size"></i>
                            </button>
                                  <button type="button" class="btn btn-danger btn-circle btn-lg" data-toggle="tooltip" data-placement="right" title="Delete"><i class="fa fa-trash fa-size"></i>
                            </button>
                                </td>
                             
                            </tr>
                            <tr>
                              <td>Outside Seeting</td>
                              <td><img src="images/sad.png" class="img-responsive menu-img"></td>
                              <td>
                                    <button type="button" class="btn btn-success btn-circle btn-lg" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-square-o fa-size"></i>
                            </button>
                                  <button type="button" class="btn btn-danger btn-circle btn-lg" data-toggle="tooltip" data-placement="right" title="Delete"><i class="fa fa-trash fa-size"></i>
                            </button>
                                </td>
                            </tr>
                            <tr>
                              <td>Top Floor</td>
                              <td><img src="images/sad.png" class="img-responsive menu-img"></td>
                              
                            <td>
                                       <button type="button" class="btn btn-success btn-circle btn-lg" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-square-o fa-size"></i>
                            </button>
                                  <button type="button" class="btn btn-danger btn-circle btn-lg" data-toggle="tooltip" data-placement="right" title="Delete"><i class="fa fa-trash fa-size"></i>
                            </button>
                          
                                </td>
                            </tr>
                          </tbody>
                        </table>
            </div>
        
<?php $this->start('script');?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({
            keys: true
        });
        $('#menu').DataTable();
        $('#datatable-scroller').DataTable({
            //ajax: "js/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });
        var table = $('#datatable-fixed-header').DataTable({
            fixedHeader: true
        });
    });

</script>

<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<?php $this->end('script'); ?>