<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

     $this->layout = 'rorder_layout';
     $this->assign('title', 'Edit User');
     //$this->start('content');
?>
      
<section class="content-header">
                <h1>
                    Users
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>  
                    <li><a href="../users">Restaurant Users</a></li>
                    <li class="active">Edit User</li>
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
                                  <?php if(isset($userInfo)) { ?>
                                    <form class="form-horizontal" method="post" action="edituser">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <input style="display:none" type="text" name="uid" value="<?= $userInfo->uid ?>">
                                                <label for="Title" class="col-sm-2 control-label">User Name</label>
                                                <div class="col-sm-8">
                                                    <input name="userName" type="text" class="form-control" id="Title" value="<?= $userInfo->unm ?>" placeholder="User Name" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="latitude" class="col-sm-2 control-label">Password</label>
                                                <div class="col-sm-8">
                                                    <input name="password" type="password" class="form-control" value="<?= $userInfo->upw ?>" placeholder="Password" required>
                                                </div>
                                            </div>
                                          <?php if(isset($permissions)){ ?>
                                             <div class="form-group">
                                                <label for="permissions" class="col-sm-2 control-label">Set Permissions</label>
                                                <div class="col-sm-8">
                                            <?php $per = explode('|', $userInfo->up); 
                                            foreach ($permissions as $permission){ 
                                                if(in_array($permission->permissionId, $per)) {?>
                                                    <input name="<?= $permission->permissionKey?>" type="checkbox" value="<?= $permission->permissionId?>" checked> <?= $permission->permissionKey?>&nbsp;&nbsp;&nbsp;
                                                <?php } else{?>
                                                    <input name="<?= $permission->permissionKey?>" type="checkbox" value="<?= $permission->permissionId?>"> <?= $permission->permissionKey?>&nbsp;&nbsp;&nbsp;
                                                <?php } ?>
                                            <?php } ?>    
                                                </div>
                                            </div>
                                          <?php } ?>
                                            <div class="form-group">
                                                <label for="longitude" class="col-sm-2 control-label">Select Role</label>
                                                <div class="col-sm-8">
                                                    <select name="userRole" class="form-control-select" required>
                                                        <option value="null">Select Role</option>
                                                    <?php  if(isset($roles)){
                                                                foreach ($roles as $role){
                                                                    if($role->roleId == $userInfo->url){
                                                                        echo '<option value="'.$role->roleId.'" selected>'.$role->roleTitle.'</option>';
                                                                     }else {
                                                                        echo '<option value="'.$role->roleId.'">'.$role->roleTitle.'</option>';
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
                                    <div class="error-message" style="color:<?= $color ?>"> <?= $message ?> <a style="margin-left: 20px;padding: 5px;border:1px solid gainsboro" href="../users">OK</a> </div>   
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