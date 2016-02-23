<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
     $this->layout = 'rorder_layout';
     $this->assign('title', 'ADD NEW TABLE CATEGORY');
     //$this->start('content');
?>
            <section class="content-header">
                <h1>
                    Restaurant Table Categories
                </h1>
                <ol class="breadcrumb">
                    <li><a href="Login.html"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="../table-category">Restaurant Table Categories</a></li>
                    <li class="active">Add New Category</li>
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
                                        <h3 class="box-title">Add New Category</h3>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                    <form class="form-horizontal" method="post" action="addnewtablecategory" enctype="multipart/form-data">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="Title" class="col-sm-2 control-label">Category Title</label>
                                                <div class="col-sm-8">
                                                    <input name="categoryTitle" type="text" class="form-control" id="Title" placeholder="Title" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="latitude" class="col-sm-2 control-label">Category Image</label>
                                                <div class="col-sm-8">
                                                    <label for="file-upload" class="custom-file-upload">
                                                        <i> <?= $this->Html->image('upload.png', ['width' => '25','alt' => 'Upload File'])?></i> Upload your image here
                                                    </label>
                                                    <input type="file" name="file-upload" class="form-control" required>
                                                </div>
                                            </div>
                                             <?php if(isset($message)){?>
                                            <div id="error-div" style="margin-left: 20%;color: <?= $color ?>" ><?=$message?></div>
                                        <?php }?>
                                        </div><!-- /.box-body -->
                                        <div class="box-footer" style="margin-left:170px">
                                            <button name="save" type="submit" class="dark-orange add-save-btn">Save Category</button>
                                            <button type="submit" class="light-orange add-save-btn">Cancel</button>
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