<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
     $this->layout = 'rorder_layout';
     $this->assign('title', 'Add New Table Category');
     $this->assign('heading', 'Add New Table Category');
     //$this->start('content');
?>
 <?php $this->start('breadcrum');?>

<li><a  class="red" href="../../tablecategory">Table Categories</a></li>
    <li class="active">Add New Category</li>
<?php $this->end('breadcrum'); ?> 
                   
                <div class="x_content">
                  <br />
                  <form id="form-single" method="post" action="addnewtablecategory" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Table Category Title 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="title" name="title" required="required" class="form-control col-md-7 col-xs-12"> 
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Image 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="image" id="image" class="date-picker form-control col-md-7 col-xs-12" required="required" type="file">
                          <br> (Please choose image file)
                           <?php if(isset($single)){ ?>
                          <span style="text-transform:capitalize; color: <?= $color ?>"> <?= $message ?> </span>
                          <?php } ?>
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="single" class="btn btn-success">Submit</button>
                          <button type="button" id="cancel" class="btn btn-primary">Cancel</button>
                      </div>
                    </div>

                  </form>
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
            $('#cancel').on('click',function(){
                window.location.replace('../tablecategory');
                
            });
          });
         
        </script>
  <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});

</script>

<?php $this->end('script'); ?>