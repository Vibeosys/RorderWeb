<?php

use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Table List');
    $this->assign('heading', 'Table List');
    //$this->assign('script','var loading=\'<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>\';$(".table-list").html(loading),$.ajax({url:"/gettables",type:"POST",contentType:!1,cache:!1,processData:!1,success:function(e,t,a){if(e){var s="";$.each(e,function(e,t){s=t.isOccupied?s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(247, 0, 0, 0.48);">\'+t.tableNo+" </div>":s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(0, 128, 0, 0.55);">\'+t.tableNo+" </div>",$(".table-list").html(s)})}else{var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}},error:function(e,t,a){var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}});');
?>
<?php $this->start('breadcrum');?>
<ol class="breadcrumb">
    <li><a href="../" class="red">Dashboard</a></li>
    <li><a href="../reports" class="red">Restaurent 1</a></li>
    <li class="active">Tables</li>
</ol>
<?php $this->end('breadcrum'); ?>           

<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Table List</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a href="rtables/addnewtables"><i class="fa fa-plus-circle"></i> Add New Table</a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <table id="menu" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Table No</th>
                            <th>Capacity</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($tables)){ ?>
                        <?php foreach($tables as $table){ ?>
                        <tr>
                           <form action="rtables/edittable" method="post">
                            
                            <td>
                                <input style="display:none" type="text" name="tid" value="<?= $table->tableId ?>">
                            <?= $table->tableNo ?><input style="display:none" type="text" name="tno" value="<?= $table->tableNo ?>">
                            </td>
                            <td>
                            <?= $table->capacity ?><input style="display:none" type="text" name="cpty" value="<?= $table->capacity ?>">    
                            </td>
                            <td>
                            <input class="roleId" style="display:none" type="text" name="tcid" value="<?= $table->tableCategoryId ?>">
                                                <?php $key = $table->tableCategoryId; echo $category->$key; ?>
                            </td>
                            <td> 
                                 <?php 
                                              if($table->isOccupied){
                                                  echo '<a class="btn btn-danger btn-circle"><i class="fa fa-check"></i> </a>Occupied';
                                                 }else{
                                                    echo '<a class="btn btn-success btn-circle"><i class="fa fa-times"></i> </a>Unoccupied';
                                                }
                                                ?>
                                                <input style="display:none" type="text" name="iopd" value="<?= $table->isOccupied ?>">
                                </td>
                            <td>
                                <button type="submit" name="edit" class="btn btn-success btn-circle btn-lg" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-square-o fa-size"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-circle btn-lg" data-toggle="tooltip" data-placement="right" title="Delete"><i class="fa fa-trash fa-size"></i>
                                </button>
                            </td>
                           </form>
                        </tr>
                    <?php } } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>






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