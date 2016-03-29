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
                                <div class="box-header">
                                <a href="editrecipe/addnewitem"><button class="dark-orange add-edit-btn"><span>Add New Item</span></button></a>
                            </div>
                                <section class="stock-section">
                                      <div class="box-body show-grid-section">
                                <table id="destination" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Menu</th>
                                            <th >Item</th>
                                            <th >Quantity</th>
                                            <th >Unit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Paneer tiranga</td>
                                            <td class="title-width">
                                                Paneer
                                            </td>
                                            <td class="lat-width">250</td>
                                            <td class="lat-width">Grams</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>Paneer tiranga</td>
                                            <td class="title-width">
                                               Oil
                                            </td>
                                            <td class="lat-width">50</td>
                                            <td class="lat-width">ml</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>Paneer tiranga</td>
                                            <td class="title-width">
                                              	Tomato
                                            </td>
                                            <td class="lat-width">200</td>
                                            <td class="lat-width">Grams</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>Paneer tiranga</td>
                                            <td class="title-width">
                                                Onion
                                            </td>
                                            <td class="lat-width">250</td>
                                            <td class="lat-width">Grams</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>Paneer tiranga</td>
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