<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

     $this->layout = 'rorder_layout';
     $this->assign('title', 'Users List');
     //$this->start('content');
?>
      
<section class="content-header">
                <h1>
                    Users
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>  
                    <li><a>Restaurant Users</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">                           
                            <div class="box-body show-grid-section">
                               <?php if(isset($users)){ ?>
                                <table id="destination" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>User Id</th>
                                            <th class="title-width">UserName</th>
                                            <th class="lat-width">Password</th>
                                            <th class="lat-width">Role</th>
                                            <th>Permissions</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   <?php foreach($users as $user){ ?>
                                    
                                        <tr>
                                        <form action="user/edituser" method="post">
                                            <td><?= $user->userId ?><input style="display:none" type="text" name="uid" value="<?= $user->userId ?>"></td>
                                            <td class="title-width">
                                                <?= $user->userName ?><input style="display:none" type="text" name="unm" value="<?= $user->userName ?>">
                                            </td>
                                            <td class="lat-width">
                                           <?= $user->password ?><input style="display:none" type="text" name="upw" value="<?= $user->password ?>">
                                            </td>
                                            <td class="lat-width"><input class="roleId" style="display:none" type="text" name="url" value="<?= $user->roleId ?>">
                                                <?php $key = $user->roleId; echo $roles->$key; ?></td>
                                            <td>
                                              <?php $pkey = $user->permissions;
                                              if($pkey){
                                                         $pkey = explode('|', $pkey);
                                                         $print = '';
                                                         foreach($pkey as $i => $v){
                                                         $print = $print. $permissions->$v.' | ';
                                                         }
                                                    echo  substr($print, 0, -2);
                                                }
                                                ?>
                                                <input style="display:none" type="text" name="up" value="<?= $user->permissions ?>">
                                            </td>
                                            <td> <button name="edit" type="submit" class="dark-orange user-edit-btn"><span> Edit</span></button></td>
                                           </form>
                                        </tr>
                                   
                                   <?php } ?>   
                                    </tbody>
                                </table>
                               <?php }else{ ?>
                                 <div id="error-div" style="margin-left: 20%;color: red" >Users not found for current restaurant.</div>
                               <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->                       
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->
             <?php $this->end();?>