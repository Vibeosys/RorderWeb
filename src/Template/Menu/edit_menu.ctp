<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

     $this->layout = 'rorder_layout';
     $this->assign('title', 'Edit Menu');
     //$this->start('content');
?>
      
<section class="content-header">
                <h1>
                    Menu
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>  
                    <li><a href="../menu">Restaurant Menu</a></li>
                    <li class="active">Edit Menu</li>
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
                                        <h3 class="box-title">Edit menu</h3>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                  <?php if(isset($menuInfo)) { ?>
                                    <form class="form-horizontal" method="post" action="editmenu">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <input style="display:none" type="text" name="mid" value="<?= $menuInfo->mid ?>">
                                                <label for="Title" class="col-sm-2 control-label">Title</label>
                                                <div class="col-sm-8">
                                                    <input name="ttl" type="text" class="form-control" id="Title" value="<?= $menuInfo->ttl ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="latitude" class="col-sm-2 control-label">Image</label>
                                                <div class="col-sm-8">
                                                    <?php if(strlen($menuInfo->img)) { ?>
                                                 <img  src="<?= $menuInfo->img ?>" alt ="<?= $menuInfo->ttl ?>" width="100" height="100">
                                                <?php }else{ ?>
                                                <?= $this->Html->image('Quickserve-menu-default.gif', ['width' => '100','height' => '100','alt' => 'MENU'])?>
                                                <?php } ?>
                                                   
                                                    <input style="display:none" name="img" type="text" class="form-control" value="<?= $menuInfo->img ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="latitude" class="col-sm-2 control-label">Price</label>
                                                <div class="col-sm-8">
                                                    <input name="prc" type="text" class="form-control" value="<?= $menuInfo->prc ?>" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="latitude" class="col-sm-2 control-label">Ingredients</label>
                                                <div class="col-sm-8">
                                                    <input name="igt" type="text" class="form-control" value="<?= $menuInfo->igt ?>" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="latitude" class="col-sm-2 control-label">Tags</label>
                                                <div class="col-sm-8">
                                                    <input name="tags" type="text" class="form-control" value="<?= $menuInfo->tags ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="latitude" class="col-sm-2 control-label"></label>
                                                <div class="col-sm-8">
                                                <?php if($menuInfo->avl){ ?>
                                                    <input name="avl" type="checkbox" checked> Available
                                                <?php }else {?>   
                                                    <input name="avl" type="checkbox" > Available
                                                <?php }?>    
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="latitude" class="col-sm-2 control-label"></label>
                                                <div class="col-sm-8">
                                                   <?php if($menuInfo->act){ ?>
                                                    <input name="act" type="checkbox" checked> Active
                                                <?php }else {?>   
                                                    <input name="act" type="checkbox" > Active
                                                <?php }?>  
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="latitude" class="col-sm-2 control-label"></label>
                                                <div class="col-sm-8">
                                                   <?php if($menuInfo->spy){ ?>
                                                    <input name="spy" type="checkbox" checked> Spicy
                                                <?php }else {?>   
                                                    <input name="spy" type="checkbox" > Spicy
                                                <?php }?>  
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="longitude" class="col-sm-2 control-label">Menu Category</label>
                                            <div class="col-sm-8">
                                                    <select name="category" class="form-control-select" required>
                                                        <option value="null">Select Category</option>
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
                                            <label for="longitude" class="col-sm-2 control-label">Room </label>
                                            <div class="col-sm-8">
                                                    <select name="room" class="form-control-select" required>
                                                        <option value="null">Select Room</option>
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
                                            <label for="longitude" class="col-sm-2 control-label">Food Beverages Type </label>
                                            <div class="col-sm-8">
                                                    <select name="fbType" class="form-control-select" required>
                                                        <option value="null">Select Type</option>
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
                                    <div class="error-message" style="color:<?= $color ?>"> <?= $message ?> <a style="margin-left: 20px;padding: 5px;border:1px solid gainsboro" href="../menu">OK</a> </div>   
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