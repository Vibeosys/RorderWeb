<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

     $this->layout = 'rorder_layout';
     $this->assign('title', 'Menu List');
     //$this->start('content');
?>
      
<section class="content-header">
                <h1>
                    Menu
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>  
                    <li><a>Restaurant Menu</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">  
                             <div class="box-header">
                                <a href="menu/addnewmenu"><button class="dark-orange add-edit-btn"><span>Add New Menu</span></button></a>
                            </div>
                            <div class="box-body show-grid-section">
                               <?php if(isset($menus)){ ?>
                                <table id="destination" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th class="title-width">Title</th>
                                            <th>Image</th>
                                            <th class="lat-width">Price</th>
                                            <th>Ingredients</th>
                                            <th>Tags</th>
                                            <th>Available</th>
                                            <th>Active</th>
                                            <th>Food Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   <?php foreach($menus as $menu){ ?>
                                    
                                        <tr>
                                        <form action="menu/editmenu" method="post">
                                            <td>
                                                <?= $menu->menuId ?><input style="display:none" type="text" name="mid" value="<?= $menu->menuId ?>">
                                            </td>
                                            <td class="title-width">
                                                <?= $menu->menuTitle ?><input style="display:none" type="text" name="ttl" value="<?= $menu->menuTitle ?>">
                                            </td>
                                            <td>
                                                 <?= $menu->image ?><input style="display:none" type="text" name="img" value="<?= $menu->image ?>">
                                            </td>
                                            <td class="lat-width"><input class="roleId" style="display:none" type="text" name="prc" value="<?= $menu->price ?>">
                                                <?= $menu->price ?>
                                            </td>
                                            <td>
                                                <?= $menu->ingredients ?><input style="display:none" type="text" name="igt" value="<?= $menu->ingredients ?>">
                                            </td>
                                             <td>
                                                <?= $menu->tags ?><input style="display:none" type="text" name="tags" value="<?= $menu->tags ?>">
                                            </td>
                                            <td class="title-width">
                                                <?= $menu->availabilityStatus ?><input style="display:none" type="text" name="avl" value="<?= $menu->availabilityStatus ?>">
                                            </td>
                                            <td class="lat-width">
                                                 <?= $menu->active ?><input style="display:none" type="text" name="act" value="<?= $menu->active ?>">
                                            </td>
                                            <td class="lat-width">
                                                <input class="roleId" style="display:none" type="text" name="ft" value="<?= $menu->foodType ?>">
                                                <?= $menu->foodType ?>
                                            </td>
                                            <td> <button name="edit" type="submit" class="dark-orange user-edit-btn"><span> Edit</span></button></td>
                                           </form>
                                        </tr>
                                   
                                   <?php } ?>   
                                    </tbody>
                                </table>
                               <?php }else{ ?>
                                 <div id="error-div" style="margin-left: 20%;color: red" >Menu not found for current restaurant.<br><br>
                                     <a style="margin-left: 90px;padding: 5px;border:1px solid gainsboro" href="../managedata"> << Back</a>
                                 </div>
                               <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->                       
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->
             <?php $this->end();?>