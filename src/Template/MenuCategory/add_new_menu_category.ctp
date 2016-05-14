<?php

    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Add New Menu Category');
    $this->assign('heading', 'Add New Menu Category');
    //$this->assign('script','var loading=\'<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>\';$(".table-list").html(loading),$.ajax({url:"/gettables",type:"POST",contentType:!1,cache:!1,processData:!1,success:function(e,t,a){if(e){var s="";$.each(e,function(e,t){s=t.isOccupied?s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(247, 0, 0, 0.48);">\'+t.tableNo+" </div>":s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(0, 128, 0, 0.55);">\'+t.tableNo+" </div>",$(".table-list").html(s)})}else{var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}},error:function(e,t,a){var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}});');
?>
<?php $this->start('breadcrum');?>
     <ol class="breadcrumb">
                            <li><a href="../" class="red">Dashboard</a></li>
                            <li><a href="../reports" class="red">Restaurent 1</a></li>
                           <li class="active">Menu Category</li>
                    </ol>
<?php $this->end('breadcrum'); ?>           
        
          <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                   <div class="x_title">
                        <h2> For Single Menu Category</h2>
                        <div class="clearfix"></div>
                      </div>
                <div class="x_content">
                  <br />
                  <form id="form-single" method="post" action="addnewmenucategory" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Menu Category Title 
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
                           <button type="button" class="btn btn-primary">Cancel</button>
                      </div>
                    </div>

                  </form>
                </div>
                  <div class="center-block">
                    <h1 class="text-center">OR</h1>
                  </div>
                   <div class="x_title">
                        <h2>For Bulk Menu Categories</h2>
                        <div class="clearfix"></div>
                      </div>
                  
                  <div class="x_content">
                  <br />
                  <form id="form-bulk" method="post" action="addnewmenucategory" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                      
                       <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Image 
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="file-upload" id="image-bulk" class="date-picker form-control col-md-7 col-xs-12" required="required" type="file">
                          <br> (Please choose csv file)
                          <?php if(isset($bulk)){ ?>
                          <span style="text-transform:capitalize; color: <?= $color ?>"> <?= $message ?> </span>
                          <?php } ?>
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" name="bulk" class="btn btn-success">Submit</button>
                           <button type="button" class="btn btn-primary">Cancel</button>
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
            $(':button').on('click',function(){
                window.location.replace('../menucategory');
                
            });
          });
         
        </script>
  <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});

</script>

<?php $this->end('script'); ?>