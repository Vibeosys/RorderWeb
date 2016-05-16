<?php

    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Edit Restaurant');
    $this->assign('heading', 'Edit Restaurant Deatils');
    //$this->assign('script','var loading=\'<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>\';$(".table-list").html(loading),$.ajax({url:"/gettables",type:"POST",contentType:!1,cache:!1,processData:!1,success:function(e,t,a){if(e){var s="";$.each(e,function(e,t){s=t.isOccupied?s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(247, 0, 0, 0.48);">\'+t.tableNo+" </div>":s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(0, 128, 0, 0.55);">\'+t.tableNo+" </div>",$(".table-list").html(s)})}else{var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}},error:function(e,t,a){var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}});');
?>
<?php $this->start('breadcrum');?>
     <ol class="breadcrumb">
                            <li><a href="../" class="red">Dashboard</a></li>
                            <li><a href="../reports" class="red">Restaurent 1</a></li>
                           <li class="active">Edit</li>
                    </ol>
<?php $this->end('breadcrum'); ?>           
        
        <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_content">
                  <br />
                  <?php if(isset($suc_msg)){ ?>
                                    <p style="text-align:center;color:<?= $color ?>"> <?= $suc_msg ?> </p>
                                <?php } ?>
                   <?php if(isset($data)){
                            foreach ($data as $rest){    
                    ?>   
                  <form id="demo-form2" method="post" action="edit" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                      
                    <div class="form-group">
                        
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Restaurant Title 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input style="display:none" type="text" name="restaurantId" value="<?=$rest->restaurantId?>">
                        <input type="text" id="title" value="<?=$rest->title?>" name="title" required="required" class="form-control col-md-7 col-xs-12"> 
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="address" value="<?=$rest->address?>" name="address" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="area" class="control-label col-md-3 col-sm-3 col-xs-12">Area</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="area" value="<?=$rest->area?>" class="form-control col-md-7 col-xs-12" type="text" name="area">
                      </div>
                    </div>                  
                      <div class="form-group">
                      <label for="city" class="control-label col-md-3 col-sm-3 col-xs-12">City</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="city" value="<?=$rest->city?>" class="form-control col-md-7 col-xs-12" type="text" name="city">
                      </div>
                    </div>   
                      <div class="form-group">
                      <label for="country" class="control-label col-md-3 col-sm-3 col-xs-12">Country</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="country" value="<?=$rest->country?>" class="form-control col-md-7 col-xs-12" type="text" name="country">
                      </div>
                    </div>                  
                      <div class="form-group">
                      <label for="phone" class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="phone" value="<?=$rest->phone?>" class="form-control col-md-7 col-xs-12" type="text" name="phone">
                      </div>
                    </div>                  
                      <?php if($rites){?>
                                             <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <div class="checkbox">
                                                        <label>
                                                <?php if($rest->active){
                                                    echo '<input type="checkbox" checked> Active';
                                                }else {echo '<input type="checkbox"> Active';}
                                                  ?>                  
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>  
                                     
                      
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<?= $rest->logoUrl ?>" alt="rest-logo" /></div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change Image</span><input name="file-upload" type="file" /></span>
                                <?php if(isset($message)){ ?>
                                    <i style="color:<?= $color ?>"> <?= $message ?> </i>
                                <?php } ?>
                                </div>
                            </div>
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="save" class="btn btn-success">Submit</button>
                          <button type="button" class="btn btn-primary" onclick="window.history.back();">Cancel</button>
                      </div>
                    </div>

                  </form>
                   <?php }}?>
                </div>
              </div>
            </div>
          </div>


        </div>
<?php $this->start('script');?>
<?= $this->Html->script("design/bootstrap-fileupload.js") ?>
<script>
   $(document).ready(function() {
          
          });
         
        </script>



<?php $this->end('script'); ?>