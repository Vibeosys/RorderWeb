<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

     $this->layout = 'rorder_layout';
     $this->assign('title', 'Edit User');
     $this->assign('heading', 'Edit User');
     //$this->start('content');
?>
<?php $this->start('breadcrum');?>

        <li class="active">Edit User </li>
<?php $this->end('breadcrum'); ?>       

                <div class="x_content">
                  <br />
                  <?php if(isset($userInfo)) { ?>
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="edituser" enctype="multipart/form-data">

                    <div class="form-group">
                        <input style="display:none" type="text" name="uid" value="<?= $userInfo->uid ?>">
                         <input style="display:none" name="permi" type="text" id="permi_text" value="">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user-name">User Name
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="user-name" name="userName" required="required" value="<?= $userInfo->unm ?>" placeholder="User Name" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" id="password" name="password" value="<?= $userInfo->upw ?>" placeholder="Password" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Role</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="userRole" class="select2_role form-control" tabindex="-1">
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
                       <?php if(isset($permissions)){ ?>
                      <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Permission</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="permission" class="select2_permission form-control" multiple="multiple" id="per">
                        <?php $per = explode('|', $userInfo->up); 
                        foreach ($permissions as $permission){ 
                        if(in_array($permission->permissionId, $per)) { ?>
                            <option name="1" value="<?= $permission->permissionId?>" selected><?= $permission->permissionKey?></option> 
                        <?php } else { ?>
                            <option name="1" value="<?= $permission->permissionId?>"><?= $permission->permissionKey?></option> 
                        <?php } ?>
                        <?php } ?>    
                        </select>
                         
                      </div>
                    </div>
                       <?php } ?>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button id="sub" name="save" value="true" type="submit" class="btn btn-success">Submit</button>
                           <button type="button" class="btn btn-primary" onclick="window.history.back();">Cancel</button>
                      </div>
                    </div>

                  </form>
                  <?php } ?>
                </div>
              
<?php $this->start('script'); ?>
<script>
  $(document).ready(function() {
      $(".select2_role").select2({
        placeholder: "Select  Role",
        allowClear: true
      });
        $(".select2_permission").select2({
        maximumSelectionLength: 15,
        placeholder: "Select Permission",
        allowClear: true
      });
      $('#per').change(function(){
      var array_value = $('#per').val();
      var permission ='';
      $.each(array_value,function(key, value){
          permission += value +',';
      });
      var per_string = permission.substring(0,permission.length - 1);
      $('input[name=permi]').val(per_string);
      });
    });
</script>
<?php $this->end('script'); ?>