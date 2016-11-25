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
                                          <div class="col-md-9 col-sm-9 col-xs-12">
<!--                                              <input id="image-bulk" name="file-upload" class="form-control col-md-7 col-xs-12" required="required" type="file">-->
                                              <input type="file" name="file-upload" id="image-bulk" class="inputfile inputfile-6" required="required"  />
					<label for="image-bulk"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> Choose a file&hellip;</strong></label>
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