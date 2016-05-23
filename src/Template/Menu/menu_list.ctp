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

                           <li class="active">Menu</li>
<?php $this->end('breadcrum'); ?>           
        
<?php $this->start('head_title');?>        
                      <div class="x_title">
                        <h2>Menu</h2>
                       <ul class="nav navbar-right panel_toolbox">
                    <li><a href="menu/addnewmenu"><i class="fa fa-plus-circle"></i> Add New Menu</a>
                    </li>
                  </ul>
                        <div class="clearfix"></div>
                      </div>
 <?php $this->end('head_title'); ?>                             
                      <div class="x_content">
                      <?php if(isset($menus)) {?>
                        <table id="menu" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Title</th>
                              <th>Image</th>
                              <th>Price</th>
                              <th>Category</th>
                              <th>Kirchen</th>
                              <th>Type</th>
                              <th>Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach ($menus as $menu) { ?>    
                            <tr>
                          <form action="menu/editmenu" method="post">
                              
                              <?php if($menu->isSpicy){ ?>
                              <td><?= $menu->menuTitle ?><?= $this->Html->image("menu/spicy_food.png", ['class' => 'spicy-food']) ?>
                                  
                              <input style="display:none" type="text" name="ttl" value="<?= $menu->menuTitle ?>"></td>
                              <?php }else { ?>
                              <td><?= $menu->menuTitle ?>
                              <input style="display:none" type="text" name="ttl" value="<?= $menu->menuTitle ?>"></td>
                              <?php } ?>
                              
                              <td><?= $this->Html->image("sad.png",['class' => 'img-responsive menu-img']) ?>
                              <input  style="display:none" type="text" name="img" value="<?= $menu->image ?>"></td>
                              <td><input class="roleId" style="display:none" type="text" name="prc" value="<?= $menu->price ?>">
                                                <?= $menu->price ?>
                                   <input style="display:none" type="text" name="tags" value="<?= $menu->tags ?>">
                                                <input style="display:none" type="text" name="avl" value="<?= $menu->availabilityStatus ?>">
                                               <input style="display:none" type="text" name="act" value="<?= $menu->active ?>">
                                               <input class="roleId" style="display:none" type="text" name="spy" value="<?= $menu->isSpicy ?>">
                                               <input style="display:none" type="text" name="mid" value="<?= $menu->menuId ?>">
                              </td>
                                               
                              <td> <input class="roleId" style="display:none" type="text" name="ctgy" value="<?= $menu->categoryId ?>">
                                                <?php if($menu->categoryId){ $key = $menu->categoryId; echo $categories->$key;} ?></td>
                              <td> <input class="roleId" style="display:none" type="text" name="rm" value="<?= $menu->roomId ?>">
                                                <?php if($menu->roomId and $room){ $key = $menu->roomId; echo $room->$key;} ?></td>
                              
                              <td>
                              <input class="roleId" style="display:none" type="text" name="fbtp" value="<?= $menu->fbTypeId ?>">
                                                <?php if($menu->fbTypeId and $fbType){ $key = $menu->fbTypeId; echo  $this->Html->image('menu/'.$fbType->$key.'.png', ['class' => "veg-non-veg center-block"]);} ?></td>
                              <td>
                                  <button type="submit" name="edit" class="btn btn-success btn-circle btn-lg" data-toggle="tooltip" data-placement="left" title="Edit Menu"><i class="fa fa-pencil-square-o fa-size"></i>
                                    </button>
                                  <button type="submit" name="edit-recipe" class="btn btn-warning btn-circle btn-lg" data-toggle="tooltip" data-placement="right" title="Edit Recipe"><i class="fa fa-cutlery fa-size"></i>
                                    </button>
                             </td>
                          </form>
                            </tr>
                          <?php } ?>
                           
                          </tbody>
                        </table>
                      <?php } ?>

                      </div>
                 
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