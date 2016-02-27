<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
     $this->layout = 'rorder_layout';
     $this->assign('title', 'RESTAURANT EDIT');
     //$this->start('content');
?>
            <section class="content-header">
                <h1>
                    Restaurant Edit
                </h1>
                <ol class="breadcrumb">
                    <li><a href="Login.html"><i class="fa fa-dashboard"></i>Home</a></li>
                    <li><a href="../">MgmtPanel</a></li>
                    <li class="active">Restaurant Edit</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">                           
                            <section class="content content-div show-add-section">
                                <div class="row">
                                    <!--Destination Form -->
                                    <div class="with-border box-header">
                                      
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                    <form class="form-horizontal" method="post" action="mgmtpanel/edit" enctype="multipart/form-data">
                                        <div class="box-body">
     <?php if(isset($data)){
     foreach ($data as $rest){    
         ?>                             <div class="restaurant-edit-img col-sm-2">
                                            <a class="restaurant-logo" href="" rel="theater" id="u_jsonp_6_5">
                                            <?= $this->Html->image($rest->logoUrl, ['class' => 'resturant-logo-img','id' => 'logo','alt' => 'Retsurant Logo'])?>
                                            </a>
                                            <div class="restaurant-logo-overline">
                                           
                                        </div>
                                         <a tabindex="0" class="restaurant-logo-overline" href="#" data-ft="" rel="dialog" role="button">
                                              Choose Logo
                                               <input type="file" name="file-upload" class="file-control" >
                                            </a>
                                        <div class="spinner">
                                            <?= $this->Html->image('loading1.gif', ['class' => 'resturant-upload-loading','id' => 'loading','alt' => 'loading'])?>
                                        </div>
                                        </div>
                                            <div class="restaurant-edit-field col-sm-10">    
                                            <input style="display:none" type="text" name="restaurantId" value="<?=$rest->restaurantId?>">
                                            <div class="form-group">
                                                <label for="Title" class="col-sm-2 control-label">Restaurant Title</label>
                                                <div class="col-sm-8">
                                                    <input name="title" value="<?=$rest->title?>" type="text" class="form-control" id="Title" placeholder="Title" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="address" class="col-sm-2 control-label">Address</label>
                                                <div class="col-sm-8">
                                                    <textarea name="address" class="form-control" placeholder="Address" required><?=$rest->address?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="area" class="col-sm-2 control-label">Area</label>
                                                <div class="col-sm-8">
                                                    <input type="text" value="<?=$rest->area?>" name="area" class="form-control" placeholder="Area" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="city" class="col-sm-2 control-label">City</label>
                                                <div class="col-sm-8">
                                                    <input type="text" value="<?=$rest->city?>" name="city" class="form-control" placeholder="City" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="country" class="col-sm-2 control-label">Country</label>
                                                <div class="col-sm-8">
                                                    <input type="text" value="<?=$rest->country?>" name="country" class="form-control" placeholder="Country" required>
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
                                        </div>    
                                        <?php }}}?>
                                             <?php if(isset($message)){?>
                                            <div id="error-div" style="margin-left: 20%;color: <?= $color ?>" ><?=$message?></div>
                                        <?php }?>
                                        </div><!-- /.box-body -->
                                        <div class="box-footer" style="margin-left:170px">
                                            <button name="save" type="submit" class="dark-orange add-save-btn">Submit</button>
                                            <button name="cancel" type="submit" class="light-orange add-save-btn">Cancel</button>
                                        </div><!-- /.box-footer -->
                                    </form>
                                    <!-- /.box -->
                                    <!-- Destination form elements disabled -->
                                </div>
                            </section>
                        </div><!-- /.box -->                       
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->