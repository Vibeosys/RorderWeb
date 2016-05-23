<?php

use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Add New Tables');
    $this->assign('heading', 'Add New Table');
    //$this->assign('script','var loading=\'<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>\';$(".table-list").html(loading),$.ajax({url:"/gettables",type:"POST",contentType:!1,cache:!1,processData:!1,success:function(e,t,a){if(e){var s="";$.each(e,function(e,t){s=t.isOccupied?s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(247, 0, 0, 0.48);">\'+t.tableNo+" </div>":s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(0, 128, 0, 0.55);">\'+t.tableNo+" </div>",$(".table-list").html(s)})}else{var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}},error:function(e,t,a){var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}});');
?>
<?php $this->start('breadcrum');?>

    <li class="active">Add New Table</li>
<?php $this->end('breadcrum'); ?>           



                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> <h2>Add Single Table</h2></a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div class="x_content">
                                    <br/>
                                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="addnewtables">

                                        <div class="form-group" >
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="table-no">Table No 
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12" style="display:inline-flex">
                                                <input type="text" id="table-no" name="tno" required="required" class="form-control col-md-7 col-xs-12"> <span id="checker"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="capacity">Capacity
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="capacity" name="cpty" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Category</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select name="category" class="select2_category form-control">
                                                    <?php  if(isset($category)){
                                                        foreach ($category as $key => $value){
                                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                                        }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                Occupied: 
                                                <input type="radio" class="flat" name="topd" id="occupied" value="1" required /> 
                                                Unoccupied: 
                                                <input type="radio" class="flat" name="topd" checked="" id="unoccupied" value="0" />  
                                            </div>
                                        </div>
                                        <?php if(isset($message)){ ?>
                                        <p style="text-align:center;color:<?= $color?>"><?= $message?></p>
                                        <?php } ?>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <button type="submit" name="add_single" class="btn btn-success">Submit</button>
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
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><h2>Add Bulk Tables(using csv file)</h2></a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="x_content">
                                    <br />
                                    <form id="form-bulk" method="post" action="addnewtables" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload CSV. File Here
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input  name="file-upload" id="image-bulk" class="date-picker form-control col-md-7 col-xs-12" required="required" type="file">
                                            </div>
                                        </div>
                                        <?php if(isset($message)){ ?>
                                        <p style="text-align: center;color:<?= $color?>"> <?= $message ?> </p>
                                        <?php } ?>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <button name="add_bulk" type="submit" value="1" class="btn btn-success">Submit</button>
                                                <button type="button" onclick="window.history.back();" class="btn btn-primary">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
         
<?php $this->start('script');?>
<script type="text/javascript">
    $(document).ready(function () {
        $(".select2_category").select2({
            placeholder: "Select a Category",
            allowClear: true
        });
        var load = '<img width="40" height="40" src="../img/loading1.gif">';
        var suc = '<a class="btn btn-success btn-circle"><i class="fa fa-check"></i></a>available';
        var error = '<a class="btn btn-danger btn-circle"><i class="fa fa-times"></i> </a>choose another';
        $('#table-no').change(function(){
            $('#checker').html(load);
            var tno = $(this).val();
            $.post('/tablenumbervalidator',{tableNo:tno},function(result){
                if(result){
                 $('#checker').html(error);
                 $('#table-no').css('border', '1px solid red');
                }else{
                 $('#checker').html(suc);   
                 $('#table-no').css('border', '1px solid #ccc');
                }
            });
            
        });
        
        
    });
</script>

<?php $this->end('script'); ?>