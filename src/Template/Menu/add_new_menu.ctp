<?php

    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Add New Menu');
    $this->assign('heading', 'Add New Menu');
    //$this->assign('script','var loading=\'<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>\';$(".table-list").html(loading),$.ajax({url:"/gettables",type:"POST",contentType:!1,cache:!1,processData:!1,success:function(e,t,a){if(e){var s="";$.each(e,function(e,t){s=t.isOccupied?s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(247, 0, 0, 0.48);">\'+t.tableNo+" </div>":s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(0, 128, 0, 0.55);">\'+t.tableNo+" </div>",$(".table-list").html(s)})}else{var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}},error:function(e,t,a){var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}});');
?>
<?php $this->start('breadcrum');?>
<li class="red"><a href="../../menu">Menu</a></li>
<li class="active">Add New Menu</li>
<?php $this->end('breadcrum'); ?>           
        
<?php $this->start('head_title');?>        
          
 <?php $this->end('head_title'); ?> 
  <?php if(isset($suc_msg)){ ?>
<p class="error-top" style="border: 1px solid <?= $color ?>;padding: 5px; margin: 10px 26%;text-align:center;color:<?= $color ?>"> <?= $suc_msg ?> </p>
                                <?php } ?>
                     <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> <h2>Single Menu</h2></a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                             <div class="x_content">
                          <br />
                   <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="addnewmenu" enctype="multipart/form-data">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="title" name="title" required="required" class="form-control col-md-7 col-xs-12"> 
                        <input name="SPICY" type="checkbox" class="flat">  <?= $this->Html->image("menu/spicy_food.png", ['class' => "spicy-food"]) ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Price
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="price" name="price" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="ingredients" class="control-label col-md-3 col-sm-3 col-xs-12">tags</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="ingredients" class="form-control col-md-7 col-xs-12" type="text" name="tags">
                      </div>
                    </div>
                                 <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                           
                          <input name="AVL" type="checkbox" class="flat" checked> Available
                          <div style="margin-top:10px">   
                          <input name="ACT" type="checkbox" class="flat" checked> Active
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
                          <input name="file-upload"  id="image" class="date-picker form-control col-md-7 col-xs-12" required="required" type="file">
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="add-single" class="btn btn-success">Submit</button>
                           <button type="submit" class="btn btn-primary">Cancel</button>
                      </div>
                    </div>

                  </form>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><h2>Bulk Menu</h2></a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">

                            
                            
                            <div class="x_content">
                                      <br />
                                      <form id="form-bulk" data-parsley-validate class="form-horizontal form-label-left" method="post" action="addnewmenu" enctype="multipart/form-data">

                                           <div class="form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload CSV. File Here 
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                              <input id="image-bulk" name="file-upload" class="date-picker form-control col-md-7 col-xs-12" required="required" type="file">
                                          </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                              <button type="submit" name="add-bulk"  class="btn btn-success">Submit</button>
                                               <button type="submit" class="btn btn-primary">Cancel</button>
                                          </div>
                                        </div>
                                          </form>
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