<?php

use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

     $this->layout = 'rorder_layout';
     $this->assign('title', 'Users List');
     $this->assign('heading', 'Restautant Staff');
?>
<?php $this->start('breadcrum');?>

    <li class="active">Staff List</li>
<?php $this->end('breadcrum'); ?>             
<?php $this->start('head_title');?>
            
            <div class="x_title">
                <h2>User List</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a href="user/addnewuser"><i class="fa fa-plus-circle"></i> Add New User</a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
 <?php $this->end('head_title'); ?>    
            <div class="x_content">

                <table id="menu" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>User Id</th>
                            <th>User Name</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                         <?php if(isset($users)){
                             foreach ($users as $user){
                             ?>
                        
                        <tr>
                            <form action="user/edituser" method="post">
                            <td><?= $user->userId ?><input style="display:none" type="text" name="uid" value="<?= $user->userId ?>"></td>
                            <td><?= $user->userName ?><input style="display:none" type="text" name="unm" value="<?= $user->userName ?>"></td>
                            <td> <?= $user->password ?><input style="display:none" type="text" name="upw" value="<?= $user->password ?>"></td>
                            <td><input class="roleId" style="display:none" type="text" name="url" value="<?= $user->roleId ?>">
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
                            <td>
                                <button type="submit" name="edit" class="btn btn-success btn-circle btn-lg" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil-square-o fa-size"></i>
                                </button>
                             <!--   <button type="button" class="btn btn-danger btn-circle btn-lg" data-toggle="tooltip" data-placement="right" title="Delete"><i class="fa fa-trash fa-size"></i>
                                </button> -->
                            </td>
                            </form>
                        </tr>
                        
                             <?php } } ?>
                    </tbody>
                </table>
            </div>
    
<?php $this->start('script');?>
<script type="text/javascript">
    $(document).ready(function () {
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
    });

</script>

<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<?php $this->end('script'); ?>