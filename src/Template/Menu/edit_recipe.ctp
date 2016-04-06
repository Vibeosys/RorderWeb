<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
     $this->layout = 'rorder_layout';
     $this->assign('title', 'Edit Recipe');
     //$this->start('content');
?>
            <section class="content-header">
                <h1>
                    Edit Recipe
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li ><a href="../menu">Menu</a></li>
                    <li class="active">Edit Recipe</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">                           
                            <section class="content content-div show-add-section">
                                    <div class="with-border box-header">
                                       <?php if(isset($menu)){?>
                                        <h3 class="box-title">Edit Recipe for<span style="color: orangered"> <?php echo $menu->menuTitle; ?></span> </h3>
                                       <?php } ?>
                                    </div>
                                 <div class="back-btn" style="margin-top: 10px"> 
                                   <a href="../menu" > << Back </a>
                                </div>
                                <div class="form-div">  
                               <form class="form-horizontal" method="post" action="editrecipe">
                                          <div class="box-body" style="margin-top:50px">
                                            <div class="form-group">
                                                <label for="Title" class="col-sm-2 control-label">Item Description</label>
                                                <div class="col-sm-8">
                                                   <select name="recipeItem" class="form-control-select recipe-item-select" required>
                                                        <option value="null">Select Item</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="Quantity" class="col-sm-2 control-label">Quantity</label>
                                                <div class="col-sm-8">
                                                    <input name="qty" type="number" > 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Unit" class="col-sm-2 control-label">Unit</label>
                                                <div class="col-sm-8">
                                                    <select name="itemUnit" class="form-control-select item-unit-select" required>
                                                        <option value="null">Select Unit</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                        <div class="box-footer col-xs-12" style="margin-left:0px">
                                            <div class="row">
                                                <div class="col-xs-3"></div>
                                                    <div class="col-xs-6">
                                                        <button name="save" value="true" type="submit" style="margin-bottom:10px" class="dark-orange add-save-btn">Submit</button>
                                                        <input type="button" value="cancel" class="light-orange button add-save-btn"  onclick="window.history.back();">
                                                    </div>
                                                <div class="col-xs-3"></div>
                                            </div>
                                        </div><!-- /.box-footer -->
                                    </form>
                                </div>    
                                <section class="stock-section" style="margin-top:50px">
                                      <div class="box-body show-grid-section">
                                <?php if(isset($menurecipe) and !is_null($menurecipe)){ ?>          
                                <table id="destination" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th >Item</th>
                                            <th >Quantity</th>
                                            <th >Unit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php foreach ($menurecipe as $recipe){?>
                                        <tr>
                                            <input type="text" class="itemId hidden" value="<?= $recipe->itemId ?>">
                                            <td class="title-width">
                                                <?= $recipe->itemName ?>
                                            </td>
                                            <td class="lat-width">
                                                <?= $recipe->qty ?>
                                            </td>
                                            <td class="lat-width">
                                                <input type="text" class="unitId hidden" value="<?= $recipe->unitId ?>">
                                                <?= $recipe->unitTitle ?>
                                            </td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        
                                       <?php } ?>
                                       
                                    </tbody>
                                </table>
                                <?php }else {?>
                                           <div class=" alert alert-error">
                                            Please Add recipe item for <span> <?php echo $menu->menuTitle; ?></span>
                                        </div>
                                       <?php } ?>
                                </div>                              
                                </section>
                            </section>
                        </div><!-- /.box -->                       
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->