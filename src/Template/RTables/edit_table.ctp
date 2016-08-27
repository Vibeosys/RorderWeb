<?php

use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Edit Table');
    $this->assign('heading', 'Edit Table');
    //$this->assign('script','var loading=\'<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>\';$(".table-list").html(loading),$.ajax({url:"/gettables",type:"POST",contentType:!1,cache:!1,processData:!1,success:function(e,t,a){if(e){var s="";$.each(e,function(e,t){s=t.isOccupied?s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(247, 0, 0, 0.48);">\'+t.tableNo+" </div>":s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(0, 128, 0, 0.55);">\'+t.tableNo+" </div>",$(".table-list").html(s)})}else{var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}},error:function(e,t,a){var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}});');
?>
<?php $this->start('breadcrum');?>
    <li class="active">Edit Table</li>
<?php $this->end('breadcrum'); ?>           

                <div class="x_content">
                  <br />
                 <?php if(isset($tableInfo)) { ?>
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="edittable">

                    <div class="form-group">
                         <input style="display:none" type="text" name="tid" value="<?= $tableInfo->tid ?>">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="table-no">Table No 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="tno" value="<?= $tableInfo->tno ?>" name="tno" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="capacity">Capacity
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="capacity" value="<?= $tableInfo->cpty ?>" name="cpty" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Category</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="category" class="select2_category form-control" tabindex="-1">
                          <?php  if(isset($category)){
                            foreach ($category as $key => $value){
                            if($key == $tableInfo->tcid){
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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php if($tableInfo->iopd) { ?>
                        Occupied: 
                        <input type="radio" class="flat" name="iopd" id="occupied" value="1" checked="" required /> 
                        Unoccupied: 
                            <input type="radio" class="flat" name="iopd" id="unoccupied" value="0" />  
                      <?php } else{?>    
                              Occupied: 
                            <input type="radio" class="flat" name="iopd" id="occupied" value="1" required /> 
                        Unoccupied: 
                            <input type="radio" class="flat" name="iopd" id="unoccupied" checked=""  value="0" />  
                             <?php } ?>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button name="save" value="true" type="submit" class="btn btn-success">Submit</button>
                        <button type="button" onclick="window.history.back();" class="btn btn-primary">Cancel</button>
                      </div>
                    </div>

                  </form>
                 <?php }else { ?>
                  <section class="fil-not-found">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    
                       <div class="error-msg1">
                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 border-bottom">
                               <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        <i class="fa fa-2x red fa-warning"></i>
                                        <!-- <img src="images/billalreadygenerate.png" class="img-responsive error-fix"> -->
                                   </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <span class="error-heading">Opps ! Error</span>
                                   </div>
                               </div> 
                            </div>
                           <div class="msg-text">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-3 "> 
                                     <?php if(isset($message)){ ?>   
                                        <p class="error-p1" style="color:<?= $color?>"><?= $message ?></p>
                                     <?php } ?>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  col-lg-offset-2 col-md-offset-3">
                                           <p class="error-msg2">Here are some suggestions:</p>
                                                    <ul class="error-list1">
                                                                <li> <a href="../rtables">Back</a> </li>
                                                                <li> <a href="../reports">Home</a></li>
                                                    </ul>
                                    </div>
                            </div>
                    </div>
                </div>                    
            </div>                    
        </div>
    </section>
                 <?php } ?>
                </div>
            
<?php $this->start('script');?>
<script type="text/javascript">
   $(document).ready(function() {
      $(".select2_category").select2({
        placeholder: "Select a Category",
        allowClear: true
      });
    });
</script>

<?php $this->end('script'); ?>