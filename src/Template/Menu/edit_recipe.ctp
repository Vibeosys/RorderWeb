<?php

    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Recipe Edit');
    $this->assign('heading', 'Recipe Edit');
    //$this->assign('script','var loading=\'<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>\';$(".table-list").html(loading),$.ajax({url:"/gettables",type:"POST",contentType:!1,cache:!1,processData:!1,success:function(e,t,a){if(e){var s="";$.each(e,function(e,t){s=t.isOccupied?s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(247, 0, 0, 0.48);">\'+t.tableNo+" </div>":s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(0, 128, 0, 0.55);">\'+t.tableNo+" </div>",$(".table-list").html(s)})}else{var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}},error:function(e,t,a){var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}});');
?>
<?php $this->start('breadcrum');?>
                            <li><a href="../../menu">Menu</a></li>
                            <li class="active">Recipe Edit</li>
<?php $this->end('breadcrum'); ?>           
        
<?php $this->start('head_title');?>        
                      <div class="x_title">
                          <?php if(isset($menu)){?>
                        <h2>Edit Recipe for <?= $menu->menuTitle ?>  </h2>
                            <?php } ?>
                        <div class="clearfix"></div>
                      </div>
 <?php $this->end('head_title'); ?>                             
                      <div class="x_content">
                          <form method="post" action="editrecipe" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Item Description</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="recipeItem" class="select2_item form-control recipe-item-select" tabindex="-1">
                         
                        </select>
                      </div>
                    </div>
                      
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="quantity">Quantity
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="qty" type="number" id="quantity" name="quantity" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="itemUnit" class="select2_unit form-control item-unit-select" tabindex="-1">
                          
                        </select>
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" name="save" value="true" class="btn btn-success">Submit</button>
                           <button type="button" onclick="window.history.back();" value="cancel" class="btn btn-primary">Cancel</button>
                      </div>
                    </div>

                  </form>

                      </div>
                <div class="x_content">
                   <?php if(isset($menurecipe) and !is_null($menurecipe)){ ?>
                   <table id="recipe-item" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Item</th>
                              <th>Quantity</th>
                              <th>Units</th>
                              <th>Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                               <?php foreach ($menurecipe as $recipe){ ?>
                               
                            <tr>
                                <form action="../menu/editrecipe/editrecipeitem" method="post">    
                               
                              <td>  <input type="text" name="itemId" class="recipe-itemid hidden" value="<?= $recipe->itemId ?>">
                                   <?= $recipe->itemName ?>
                              </td>
                              <td> <span class="recipe-qty-fix<?= $recipe->itemId ?>"><?= $recipe->qty ?></span>
                                <input type="text" value="<?= $recipe->qty ?>" id="quantity" name="qty" required="required" class="form-control col-lg-12 recipe-qty-text<?= $recipe->itemId ?> hidden">
                              </td>
                              <td>
                                  <input type="text" class="recipe-unitid hidden" value="<?= $recipe->unitId ?>">
                                  <?= $recipe->unitTitle ?>
                              </td>
                              <td>
                            <button type="button" id="<?= $recipe->itemId ?>" class="btn btn-info edit btn-circle btn-lg recipe-edit-row-btn" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-square-o fa-size"></i>
                            </button>
                                  <button type="submit" name="save"  class="btn btn-success save<?= $recipe->itemId ?> recipe-edit-row-btn btn-circle btn-lg hidden" data-toggle="tooltip" data-placement="left" title="Save"><i class="fa fa-floppy-o fa-size"></i>
                            </button>
                                  <button type="submit" name="delete" class="btn btn-danger btn-circle btn-lg" data-toggle="tooltip" data-placement="right" title="Delete"><i class="fa fa-trash fa-size"></i>
                            </button>
                                </td>
                              </form>
                            </tr>
                            
                            <?php } ?> 
                          </tbody>
                        </table>
                     <?php }else {?>
                    <div class=" alert alert-error" style="margin: 0px 24%; text-align: center;font-size: 17px;">
                                            Please Add recipe item for <span> <?php echo $menu->menuTitle; ?></span>
                                        </div>    
                                       <?php } ?>
                     <div class="notification">
                                    <div class="notice alert alert-warning fade in">
                                        <span class="notice-message"></span>
                                        <a >Close</a>
                                    </div>
                                    <div class="success alert alert-success fade in">
                                        <span class="success-message"></span>
                                        <a >Close</a>
                                    </div>
                                </div>
                  </div>            
                 
<?php $this->start('script');?>
<script>
   $(document).ready(function() {
      $(".select2_item").select2({
        placeholder: "Select a Item",
        allowClear: true
      });
        $(".select2_unit").select2({
        placeholder: "Select a Unit",
        allowClear: true
      });
        $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
              keys: true
            });
            $('#recipe-item').DataTable();
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

   
 
    
    
  //get units
 
         
        </script>
  <script>
       $(document).ready(function() {
            var itemcheck =   $('.recipe-item-select').length;

                if(itemcheck === 1){
                  $.get('/getrecipeitem',{},function(result){
                      var html = '';
                      itemcheck = false;
                     $.each(result,function(index,obj){
                         html = html + '<option value="'+ obj.itemId + '">'+ obj.itemName + '</option>';
                     });
                     $('.recipe-item-select').append(html);
                  });

              }
               var fullcheck =  $('.item-unit-select').length;

                if(fullcheck === 1){
                  $.get('/getunits',{},function(result){
                      var html = '';
                      fullcheck = false;
                     $.each(result,function(index,obj){
                         html = html + '<option value="'+ obj.unitId + '">'+ obj.unitTitle + '</option>';
                     });
                     $('.item-unit-select').append(html);
                  });
              }
               $('.edit').on('click',function(){
                    var btnId = $(this).attr('id'); 
                     $(this).addClass('hidden'); 
                     $('.save' + btnId).removeClass('hidden'); 
                   
                   $('.recipe-qty-fix' + btnId).addClass('hidden');
                   $('.recipe-qty-text' + btnId).removeClass('hidden');
                   return false;
                  
                });
                });
          

</script>

<?php $this->end('script'); ?>