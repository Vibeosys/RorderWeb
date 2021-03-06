<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

     $this->layout = 'rorder_layout';
     $this->assign('title', 'Menu List');
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
                                 <a style="float: right" href="menu/addnewmenu"><button class="dark-orange add-edit-btn"><span>Add New Menu</span></button></a>
                            </div>
                            <div class="box-body show-grid-section">
                               <?php if(isset($menus)){ ?>
                                <table id="destination" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                        
                                            <th class="title-width">Title</th>
                                            <th>Image</th>
                                            <th class="lat-width">Price</th>
                                            <th>Spicy</th>
                                            <th>Category</th>
                                            <th>Kitchen</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   <?php foreach($menus as $menu){ ?>
                                        <tr>
                                        <form action="menu/editmenu" method="post">
                                           
                                               <input style="display:none" type="text" name="mid" value="<?= $menu->menuId ?>">
                                           
                                            <td class="title-width">
                                                <?= $menu->menuTitle ?><input style="display:none" type="text" name="ttl" value="<?= $menu->menuTitle ?>">
                                            </td>
                                            <td><input style="display:none" type="text" name="img" value="<?= $menu->image ?>">
                                                <?php if(!is_null($menu->image)) {  ?>
                                                <img src="<?= $menu->image ?>" title="<?= $menu->menuTitle ?>" alt="<?= $menu->menuTitle ?>" width="70" height="70">
                                                <?php }else{ ?>
                                                <?= $this->Html->image('Quickserve-menu-default.gif', ['width' => '70','height' => '70','alt' => 'MENU'])?>
                                                <?php } ?>
                                            </td>
                                            <td class="lat-width"><input class="roleId" style="display:none" type="text" name="prc" value="<?= $menu->price ?>">
                                                <?= $menu->price ?>
                                                 <input style="display:none" type="text" name="tags" value="<?= $menu->tags ?>">
                                                <input style="display:none" type="text" name="avl" value="<?= $menu->availabilityStatus ?>">
                                               <input style="display:none" type="text" name="act" value="<?= $menu->active ?>">
                                            </td>
                                             <td class="lat-width">
                                                <input class="roleId" style="display:none" type="text" name="spy" value="<?= $menu->isSpicy ?>">
                                                <?php if($menu->isSpicy){ echo 'Yes';}else{ echo 'No';} ?>
                                            </td>
                                             <td class="lat-width">
                                                <input class="roleId" style="display:none" type="text" name="ctgy" value="<?= $menu->categoryId ?>">
                                                <?php if($menu->categoryId){ $key = $menu->categoryId; echo $categories->$key;} ?>
                                                
                                            </td>
                                             <td class="lat-width">
                                                <input class="roleId" style="display:none" type="text" name="rm" value="<?= $menu->roomId ?>">
                                                <?php if($menu->roomId and $room){ $key = $menu->roomId; echo $room->$key;} ?>
                                            </td>
                                            <td class="lat-width">
                                                <input class="roleId" style="display:none" type="text" name="fbtp" value="<?= $menu->fbTypeId ?>">
                                                <?php if($menu->fbTypeId and $fbType){ $key = $menu->fbTypeId; echo  $this->Html->image($fbType->$key.'.png', ['width' => '40','height' => '40','alt' => 'MENU']);} ?>
                                            </td>
                                            <td> <button name="edit" type="submit" class="dark-orange user-edit-btn"><span> Edit</span></button>
                                                <button style="width: 130px" name="edit-recipe" type="submit" class="dark-orange user-edit-btn"><span> Edit Recipe</span></button> 
                                            </td>
                                           </form>
                                        </tr>
                                   
                                   <?php } ?>   
                                    </tbody>
                                </table>
                                <div class="col-xs-3"></div>
                                <div class="col-xs-3"></div>
                                <div class="col-xs-2"></div>
                                <div class="col-xs-4" id="pagination">
                                     
                                    <span id="prev-btn" ><button class="previous dark-orange" ><?=  $this->Paginator->prev(' << ' . __('previous')) ?></button></span>
                                    <span id="next-btn" ><button class="next dark-orange" ><?= $this->Paginator->next('next »') ?></button></span>
                                </div>
                                <textarea id="next-page" style="display: none"><?= $this->Paginator->hasNext()?></textarea>
                                <textarea id="prev-page" style="display: none"><?= $this->Paginator->hasPrev()?></textarea>
                               <?php }else{ ?>
                                 <div id="error-div" style="margin-left: 20%;color: red" >Menu not found for current restaurant.<br><br><br>
                                     <a style="margin-left: 90px;padding: 5px;border:1px solid gainsboro" href="../managedata"> << Back</a>
                                 </div>
                               <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->                       
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->
             <?php $this->end();?>