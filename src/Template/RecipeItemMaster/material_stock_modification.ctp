<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
     $this->layout = 'rorder_inventory_layout';
     $this->assign('title', 'Restaurant Stock Upload');
     $this->assign('breadcrum', ' <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Material Stock Modification</li>
                </ol>');
     //$this->start('content');
?>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">                           
                            <section class="content content-div show-add-section">
                                <div class="back-btn" style="margin-top: 10px"> 
                                   <a href="../inventory" > << Back </a>
                                </div>
                                  <section class="stock-section" id="msm" style="margin-top:50px">
                                      <div class="box-body show-grid-section">
                                <table id="destination" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Material Code</th>
                                            <th class="title-width">Description</th>
                                            <th class="lat-width">Stock</th>
                                            <th class="lat-width">Unit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1001</td>
                                            <td class="title-width">
                                                Paneer
                                            </td>
                                            <td class="lat-width">18</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1002</td>
                                            <td class="title-width">
                                                Cottage Cheese
                                            </td>
                                            <td class="lat-width">8</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1003</td>
                                            <td class="title-width">
                                                Oil
                                            </td>
                                            <td class="lat-width">20</td>
                                            <td class="lat-width">Litre</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1004</td>
                                            <td class="title-width">
                                                Cashew
                                            </td>
                                            <td class="lat-width">5</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1005</td>
                                            <td class="title-width">
                                                Tomato
                                            </td>
                                            <td class="lat-width">15</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1006</td>
                                            <td class="title-width">
                                                Onion
                                            </td>
                                            <td class="lat-width">20</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1007</td>
                                            <td class="title-width">
                                                eggs
                                            </td>
                                            <td class="lat-width">240</td>
                                            <td class="lat-width">Units</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1008</td>
                                            <td class="title-width">
                                                Fish
                                            </td>
                                            <td class="lat-width">10</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1009</td>
                                            <td class="title-width">
                                                Chicken
                                            </td>
                                            <td class="lat-width">10</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1010</td>
                                            <td class="title-width">
                                                Ginger
                                            </td>
                                            <td class="lat-width">2</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1011</td>
                                            <td class="title-width">
                                                White Flower
                                            </td>
                                            <td class="lat-width">30</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1012</td>
                                            <td class="title-width">
                                                Mutton
                                            </td>
                                            <td class="lat-width">10</td>
                                            <td class="lat-width">Kg</td>
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