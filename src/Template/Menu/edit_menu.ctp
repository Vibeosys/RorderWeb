<?php

    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Edit Menu');
    $this->assign('heading', 'Edit Menu');
    //$this->assign('script','var loading=\'<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>\';$(".table-list").html(loading),$.ajax({url:"/gettables",type:"POST",contentType:!1,cache:!1,processData:!1,success:function(e,t,a){if(e){var s="";$.each(e,function(e,t){s=t.isOccupied?s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(247, 0, 0, 0.48);">\'+t.tableNo+" </div>":s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(0, 128, 0, 0.55);">\'+t.tableNo+" </div>",$(".table-list").html(s)})}else{var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}},error:function(e,t,a){var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}});');
?>
<?php $this->start('breadcrum');?>
     <ol class="breadcrumb">
                            <li><a href="../" class="red">Dashboard</a></li>
                            <li><a href="../reports" class="red">Restaurent 1</a></li>
                           <li class="active"> Edit Menu</li>
                    </ol>
<?php $this->end('breadcrum'); ?>           
        
         <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_content">
                  <br />
                  <?php if(isset($menuInfo)) {?>
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="editmenu">

                    <div class="form-group">
                        <input style="display:none" type="text" name="mid" value="<?= $menuInfo->mid ?>">
                        <input style="display:none" name="img" type="text" class="form-control" value="<?= $menuInfo->img ?>">
                        <input style="display:none" name="igt" type="text" class="form-control" value="" >
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="title" name="ttl" required="required" class="form-control col-md-7 col-xs-12" value="<?= $menuInfo->ttl ?>">  
                         <?php if($menuInfo->spy){ ?>
                          <input name="spy" type="checkbox" class="flat" checked>
                         <?php }else {?>   
                          <input name="spy" type="checkbox" class="flat">
                        <?php }?>  
                           <?= $this->Html->image("menu/spicy_food.png", ['class' => "spicy-food"]) ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Price
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="price" name="prc" required="required" class="form-control col-md-7 col-xs-12" value="<?= $menuInfo->prc ?>">
                      </div>
                    </div>
                  <div class="form-group">
                      <label for="ingredients" class="control-label col-md-3 col-sm-3 col-xs-12">Tags</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="ingredients" class="form-control col-md-7 col-xs-12" type="text" name="tags" value="<?= $menuInfo->tags ?>">
                      </div>
                    </div>
                    <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                           <?php if($menuInfo->avl){ ?>
                          <input name="avl" type="checkbox" class="flat" checked> Available
                           <?php }else {?>   
                          <input name="avl" type="checkbox" class="flat" > Available
                           <?php }?>  
                          <div style="margin-top:10px">
                           <?php if($menuInfo->act){ ?>
                          <input name="act" type="checkbox" class="flat" checked> Active
                            <?php }else {?>   
                            <input name="act" type="checkbox" class="flat"> Active
                            <?php }?>  
                            </div>
                      </div>
                    </div>  
                      
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Category</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="category" class="select2_category form-control">
                            <option value="null" disabled>Select Category</option>
                          <?php  if(isset($category)){
                            foreach ($category as $key => $value){
                            if($key == $menuInfo->ctgy){
                            echo '<option value="'.$key.'" selected>'.$value.'</option>';
                            }else {
                              echo '<option value="'.$key.'">'.$value.'</option>';
                            }
                            }
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                      
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Kitchen</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="room" class="select2_kitchen form-control">
                            <?php  if(isset($room)){
                            foreach ($room as $key => $value){
                            if($key == $menuInfo->rm){
                            echo '<option value="'.$key.'" selected>'.$value.'</option>';
                            }else {
                            echo '<option value="'.$key.'">'.$value.'</option>';
                            }
                            }
                            }
                           ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Food Type</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="fbType" class="select2_foodtype form-control">
                            <?php  if(isset($fbType)){
                              foreach ($fbType as $key => $value){
                              if($key == $menuInfo->fbtp){
                              echo '<option value="'.$key.'" selected>'.$value.'</option>';
                              }else {
                              echo '<option value="'.$key.'">'.$value.'</option>';
                              }
                              }
                               }
                               ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Image 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="image" class="date-picker form-control col-md-7 col-xs-12" type="file">
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
                  <?php } else { ?>
                   <div class="error-message" style="color:<?= $color ?>"> <?= $message ?> <a style="margin-left: 20px;padding: 5px;border:1px solid gainsboro" href="../menu">OK</a> </div>   
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>


        </div>
<?php $this->start('script');?>
<script>
   $(document).ready(function() {
      $(".select2_category").select2({
        placeholder: "Select a Category",
        allowClear: true
      });
        $(".select2_kitchen").select2({
        placeholder: "Select a Kitchen",
        allowClear: true
      });
      $(".select2_foodtype").select2({
        placeholder: "Select a Food Type",
        allowClear: true
      });
    });
         
 </script>
 

<?php $this->end('script'); ?>