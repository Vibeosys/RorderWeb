<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

     $this->layout = 'rorder_layout';
     $this->assign('title', 'Edit Table');
     //$this->start('content');
?>
      
<section class="content-header">
                <h1>
                    Table
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>  
                    <li><a href="../users">Restaurant Tables</a></li>
                    <li class="active">Edit Table</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">                           
                            <section class="content content-div show-add-section">
                                <div class="row">
                                    <!--Destination Form -->
                                    <div class="with-border box-header">
                                        <h3 class="box-title">Edit Table</h3>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                  <?php if(isset($tableInfo)) { ?>
                                    <form class="form-horizontal" method="post" action="edittable">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <input style="display:none" type="text" name="tid" value="<?= $tableInfo->tid ?>">
                                                <label for="Title" class="col-sm-2 control-label">Table No.</label>
                                                <div class="col-sm-8">
                                                    <input name="tno" type="text" class="form-control" id="Title" value="<?= $tableInfo->tno ?>" placeholder="User Name" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="latitude" class="col-sm-2 control-label">Capacity</label>
                                                <div class="col-sm-8">
                                                    <input name="cpty" type="text" class="form-control" value="<?= $tableInfo->cpty ?>" placeholder="Password" required>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="permissions" class="col-sm-2 control-label"></label>
                                                <div class="col-sm-8">
                                            <?php if($tableInfo->iopd) { ?>
                                                    <input name="iopd" type="checkbox"  checked> Occupied 
                                                <?php } else{?>
                                                  <input name="iopd" type="checkbox"> Occupied 
                                                <?php } ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="longitude" class="col-sm-2 control-label">Select Category</label>
                                                <div class="col-sm-8">
                                                    <select name="category" class="form-control-select" required>
                                                        <option value="null">Select Role</option>
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
                                        </div><!-- /.box-body -->
                                        <div class="box-footer col-xs-12" style="margin-left:0px">
                                            <div class="row">
                                                <div class="col-xs-4"></div>
                                                    <div class="col-xs-6">
                                                        <button name="save" value="true" type="submit" style="margin-bottom:10px" class="dark-orange add-save-btn">Submit</button>
                                                        <input type="button" value="cancel" class="light-orange button add-save-btn"  onclick="window.history.back();">
                                                    </div>
                                                <div class="col-xs-2"></div>
                                            </div>
                                        </div><!-- /.box-footer -->
                                    </form>
                                  <?php } ?>
                                 <?php if(isset($message)) {?>
                                    <div class="error-message" style="color:<?= $color ?>"> <?= $message ?> <a style="margin-left: 20px;padding: 5px;border:1px solid gainsboro" href="../rtables">OK</a> </div>   
                                 <?php } ?>
                                    <!-- /.box -->
                                    <!-- Destination form elements disabled -->
                                </div>
                            </section>
                        </div><!-- /.box -->                       
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->
             <?php $this->end();?>