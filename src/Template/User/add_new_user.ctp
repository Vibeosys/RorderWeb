<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

     $this->layout = 'rorder_layout';
     $this->assign('title', 'ADD NEW USER');
     //$this->start('content');
?>
      
<section class="content-header">
                <h1>
                    Users
                </h1>
                <ol class="breadcrumb">
                    <li><a href="Login.html"><i class="fa fa-dashboard"></i> Home</a></li>  
                      <li><a href="../users">Restaurant Users</a></li>
                    <li class="active">Add New User</li>
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
                                        <h3 class="box-title">Add New User</h3>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                    <form class="form-horizontal" method="post" action="addnewuser">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="Title" class="col-sm-2 control-label">User Name</label>
                                                <div class="col-sm-8">
                                                    <input name="userName" type="text" class="form-control" id="Title" placeholder="User Name" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="latitude" class="col-sm-2 control-label">Password</label>
                                                <div class="col-sm-8">
                                                    <input name="password" type="text" class="form-control" placeholder="Password" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="longitude" class="col-sm-2 control-label">Select Role</label>
                                                <div class="col-sm-8">
                                                    <select name="userRole" class="form-control-select" required>
                                                        <option value="null">Select Role</option>
                                                    <?php  if(isset($roles)){
                                                        foreach ($roles as $role){
                                                        echo '<option value="'.$role->roleId.'">'.$role->roleTitle.'</option>';
                                                    }}?>
                                                    </select>
                                                </div>
                                            </div>
                                             <?php if(isset($message)){?>
                                            <div id="error-div" style="margin-left: 20%;color: <?= $color ?>" ><?=$message?></div>
                                        <?php }?>
                                        </div><!-- /.box-body -->
                                        <div class="box-footer col-xs-12" style="margin-left:0px">
                                            <div class="row">
                                                <div class="col-xs-4"></div>
                                                    <div class="col-xs-6">
                                                        <button name="save" value="true" type="submit" style="margin-bottom:10px" class="dark-orange add-save-btn">Submit</button>
                                                        <button type="submit" class="light-orange add-save-btn">Cancel</button>
                                                    </div>
                                                <div class="col-xs-2"></div>
                                            </div>
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
             <?php $this->end();?>