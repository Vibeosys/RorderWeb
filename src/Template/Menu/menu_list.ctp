<?php

    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Menu List');
    $this->assign('heading', 'Menu List');
    //$this->assign('script','var loading=\'<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>\';$(".table-list").html(loading),$.ajax({url:"/gettables",type:"POST",contentType:!1,cache:!1,processData:!1,success:function(e,t,a){if(e){var s="";$.each(e,function(e,t){s=t.isOccupied?s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(247, 0, 0, 0.48);">\'+t.tableNo+" </div>":s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(0, 128, 0, 0.55);">\'+t.tableNo+" </div>",$(".table-list").html(s)})}else{var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}},error:function(e,t,a){var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}});');
?>
<?php $this->start('breadcrum');?>
     <ol class="breadcrumb">
                            <li><a href="../" class="red">Dashboard</a></li>
                            <li><a href="../reports" class="red">Restaurent 1</a></li>
                           <li class="active">Menu</li>
                    </ol>
<?php $this->end('breadcrum'); ?>           
        
          <div class="row">
              
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Menu</h2>
                       <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-plus-circle"></i> Add New Menu</a>
                    </li>
                  </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                       
                        <table id="menu" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Title</th>
                              <th>Image</th>
                              <th>Price</th>
                              <th>Ingredients</th>
                              <th>Category</th>
                              <th>Kirchen</th>
                              <th>Type</th>
                              <th>Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Hare masale ka bhuna paneer<img src="images/menu/spicy_food.png" class="spicy-food"></td>
                              <td><img src="images/sad.png" class="img-responsive menu-img"></td>
                              <td>63</td>
                              <td>Architect</td>                             
                              <td>Edinburgh</td>
                              <td>Architect</td>
                              <td><img src="images/menu/floating_veg_icon.png" class="veg-non-veg center-block"></td>
                              <td>
                                     <button type="button" class="btn btn-success btn-circle btn-lg" data-toggle="tooltip" data-placement="left" title="Edit Menu"><i class="fa fa-pencil-square-o fa-size"></i>
                            </button>
                                  <button type="button" class="btn btn-warning btn-circle btn-lg" data-toggle="tooltip" data-placement="right" title="Edit Recipe"><i class="fa fa-cutlery fa-size"></i>
                            </button>
                            <!--      
                                  <a class="btn-edit">
                                            <i class="fa fa-pencil-square-o fa-edit"></i> Edit
                                        </a> 
                                    <a class="btn-edit">
                                            <i class="fa fa-trash fa-edit"></i>  Delete
                                        </a>
                                -->
                                </td>
                             
                            </tr>
                            <tr>
                              <td>Stuffed fried cheese mushroon</td>
                              <td><img src="images/sad.png" class="img-responsive menu-img"></td>
                              <td>63</td>
                              <td>Architect</td>                             
                              <td>Edinburgh</td>
                              <td>Architect</td>
                              <td><img src="images/menu/floating_non_veg_icon.png" class="veg-non-veg center-block"></td>
                              <td>
                                    <button type="button" class="btn btn-success btn-circle btn-lg" data-toggle="tooltip" data-placement="left" title="Edit Menu"><i class="fa fa-pencil-square-o fa-size"></i>
                            </button>
                                  <button type="button" class="btn btn-warning btn-circle btn-lg" data-toggle="tooltip" data-placement="right" title="Edit Recipe"><i class="fa fa-cutlery fa-size"></i>
                            </button>
                            <!--      
                                  <a class="btn-edit">
                                            <i class="fa fa-pencil-square-o fa-edit"></i> Edit
                                        </a> 
                                    <a class="btn-edit">
                                            <i class="fa fa-trash fa-edit"></i>  Delete
                                        </a>
                                -->
                                </td>
                            </tr>
                            <tr>
                              <td>Jalapeno and cheese peppers<img src="images/menu/spicy_food.png" class="spicy-food"></td>
                              <td><img src="images/sad.png" class="img-responsive menu-img"></td>
                              <td>63</td>
                              <td>Architect</td>                              
                              <td>Edinburgh</td>
                              <td>Architect</td>
                              <td><img src="images/menu/floating_veg_icon.png" class="veg-non-veg center-block"></td>
                            <td>
                                       <button type="button" class="btn btn-success btn-circle btn-lg" data-toggle="tooltip" data-placement="left" title="Edit Menu"><i class="fa fa-pencil-square-o fa-size"></i>
                            </button>
                                  <button type="button" class="btn btn-warning btn-circle btn-lg" data-toggle="tooltip" data-placement="right" title="Edit Recipe"><i class="fa fa-cutlery fa-size"></i>
                            </button>
                            <!--      
                                  <a class="btn-edit">
                                            <i class="fa fa-pencil-square-o fa-edit"></i> Edit
                                        </a> 
                                    <a class="btn-edit">
                                            <i class="fa fa-trash fa-edit"></i>  Delete
                                        </a>
                                -->
                                </td>
                            </tr>
                          </tbody>
                        </table>

                      </div>
                    </div>
                  </div>
              
              
              
              
              
           
          </div>
          <div class="clearfix"></div>
<?php $this->start('script');?>
<script>
   $(document).ready(function() {
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
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});

</script>

<?php $this->end('script'); ?>