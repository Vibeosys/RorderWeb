<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
     $this->layout = 'rorder_layout';
     $this->assign('title', 'Material Stock Upload');
     $this->assign('heading', 'Material Stock Upload');
?>          
 <div class="x_content">
      <?php if(isset($suc_msg)){ ?>
<p class="error-top" style="border: 1px solid <?= $color ?>;padding: 5px; margin: 10px 26%;text-align:center;color:<?= $color ?>"> <?= $suc_msg ?> </p>
                                <?php } ?>
                                      <br />
                                      <form method="post" action="materialstockupload" enctype="multipart/form-data" id="form-bulk" data-parsley-validate class="form-horizontal form-label-left">
                                           <div class="form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload CSV. File Here 
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                              <input id="image-bulk" name="file-upload" class="form-control col-md-7 col-xs-12" required="required" type="file">
                                          </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button name="upload" type="submit" value="1" class="btn btn-success">Submit</button>
                                            <button type="button" id="cancel" class="btn btn-primary">Cancel</button>
                                          </div>
                                        </div>
                                          </form>
                            </div>
<?php $this->start('script');?>
<script>
   $(document).ready(function() {
    
            $('#cancel').on('click',function(){
                window.location.replace('../../stocktaking');
            });
    });
         
</script>
<?php $this->end('script'); ?>