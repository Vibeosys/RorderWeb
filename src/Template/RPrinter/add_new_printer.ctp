<?php

    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Add New Printer');
    $this->assign('heading', 'Add New Printer');
    //$this->assign('script','var loading=\'<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>\';$(".table-list").html(loading),$.ajax({url:"/gettables",type:"POST",contentType:!1,cache:!1,processData:!1,success:function(e,t,a){if(e){var s="";$.each(e,function(e,t){s=t.isOccupied?s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(247, 0, 0, 0.48);">\'+t.tableNo+" </div>":s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(0, 128, 0, 0.55);">\'+t.tableNo+" </div>",$(".table-list").html(s)})}else{var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}},error:function(e,t,a){var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}});');
?>
<?php $this->start('breadcrum');?>

                            <li class="red">Kitchen</li>
                            <li><a class="red" href="../../kitchen/printers">Printer</a></li>
                           <li class="active">Add New Printer</li>
<?php $this->end('breadcrum'); ?>  
                           
                            <?php if(isset($suc_msg)){ ?>
                  <p class="error-top" style="border: 1px solid <?= $color ?>;padding: 5px; margin: 10px 26%;text-align:center;color:<?= $color ?>"> <?= $suc_msg ?> </p>
                                <?php } ?>  
                           <form id="demo-form2" method="post" action="" data-parsley-validate class="form-horizontal form-label-left">
                                
                      <!--   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Room</label>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="select2_room form-control" tabindex="-1">
                          <option value="AK">Shoup</option>
                          <option value="HI">Starters</option>
                          <option value="CA">Rice</option>
                          <option value="NV">Breads</option>
                          <option value="OR">Main course</option>
                          <option value="WA">Chinese main course</option>
                          <option value="AZ">Noodles</option>
                          <option value="CO">Chinese rice</option>
                          <option value="ID">Desserts</option>
                          <option value="MT">Drinks</option>
                          <option value="NE">Chinese starters</option>
                          <option value="NM">Salads</option>
                          <option value="ND">Continental</option>
                          <option value="UT">Chinese</option>
                          <option value="WY">Pasta</option>
                          <option value="AR">Sizzlers</option>
                          <option value="IL">Dal</option>
                          <option value="IA">Biryani</option>
                        </select>
                      </div>
                    </div>
                     <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Room Type</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="select2_roomtype form-control" tabindex="-1">
                          <option value="AK">Alaska</option>
                          <option value="HI">Hawaii</option>
                          <option value="CA">California</option>
                          <option value="NV">Nevada</option>
                          <option value="OR">Oregon</option>
                          <option value="WA">Washington</option>
                          <option value="AZ">Arizona</option>
                          <option value="CO">Colorado</option>
                          <option value="ID">Idaho</option>
                        </select>
                      </div>
                    </div> -->     
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ipaddress">IpAddress
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="ipaddress" name="ip" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="printername" class="control-label col-md-3 col-sm-3 col-xs-12">Printer Name</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="printername" class="form-control col-md-7 col-xs-12" type="text" name="name">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Model Name</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input id="modelname" class="form-control col-md-7 col-xs-12" type="text" name="model">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Company 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input id="company" class="form-control col-md-7 col-xs-12" type="text" name="company">
                      </div>
                    </div>
                        <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Mac Address 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input id="macaddress" class="form-control col-md-7 col-xs-12" type="text" name="mac">
                      </div>
                    </div> 
           
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="save" class="btn btn-success">Submit</button>
                        <button type="button" id="cancel" class="btn btn-primary">Cancel</button>
                      </div>
                    </div>

                  </form>
<?php $this->start('script');?>
<script>
   $(document).ready(function() {
    
            $('#cancel').on('click',function(){
                window.location.replace('../printers');
            });
    });
         
</script>
<?php $this->end('script'); ?>