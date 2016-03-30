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
                                        <h3 class="box-title">Edit Recipe for<span style="color: orangered"> Paneer Tiranga</span> </h3>
                                    </div>
                                 <div class="back-btn" style="margin-top: 10px"> 
                                   <a href="#" onclick="window.history.back();"> << Back </a>
                                </div>
                                <div class="form-div">  
                               <form class="form-horizontal" method="post" action="../editrecipe">
                                          <div class="box-body" style="margin-top:50px">
                                            <div class="form-group">
                                                <label for="Title" class="col-sm-2 control-label">Item Description</label>
                                                <div class="col-sm-8">
                                                   <select name="userRole" class="form-control-select" required>
                                                        <option value="null">Select Item</option>
                                                        <option value="null">Paneer</option>
                                                        <option value="null">Cottage Cheese</option>
                                                        <option value="null">Ginger</option>
                                                        <option value="null">Oil</option>
                                                        <option value="null">Cashew</option>
                                                        <option value="null">Tomato</option>
                                                    </select>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label for="permissions" class="col-sm-2 control-label">Quantity</label>
                                                <div class="col-sm-8">
                                                    <input name="qty" type="number" > 
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="longitude" class="col-sm-2 control-label">Unit</label>
                                                <div class="col-sm-8">
                                                    <select name="userRole" class="form-control-select" required>
                                                        <option value="null">Select Unit</option>
                                                        <option value="null">Kg</option>
                                                        <option value="null">Grams</option>
                                                        <option value="null">Litre</option>
                                                        <option value="null">ml</option>
                                                        <option value="null">Units</option>
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
                                        <tr>
                                            <td class="title-width">
                                                Paneer
                                            </td>
                                            <td class="lat-width">250</td>
                                            <td class="lat-width">Grams</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td class="title-width">
                                               Oil
                                            </td>
                                            <td class="lat-width">50</td>
                                            <td class="lat-width">ml</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td class="title-width">
                                              	Tomato
                                            </td>
                                            <td class="lat-width">200</td>
                                            <td class="lat-width">Grams</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td class="title-width">
                                                Onion
                                            </td>
                                            <td class="lat-width">250</td>
                                            <td class="lat-width">Grams</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td class="title-width">
                                               Ginger
                                            </td>
                                            <td class="lat-width">15</td>
                                            <td class="lat-width">Grams</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                       
                                    </tbody>
                                </table>
                                </div>                              
                                </section>
                            </section>
                        </div><!-- /.box -->                       
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->