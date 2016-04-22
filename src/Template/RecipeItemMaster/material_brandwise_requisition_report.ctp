<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

       if(isset($limit)){
     $this->layout = 'rorder_layout';
     $this->assign('title', 'Restaurant Material BrandWise Requisition Report');
?>          
             <section class="content-header">
            <h1>
                  Restaurant Material BrandWise Requisition Report
            </h1>
            <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Material BrandWise Requisition Report</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">                           
                            <section class="content content-div show-add-section">
                                <?php } ?>
                                <section class="stock-section" id="msu" style="margin-top:50px">
                                   <div class="material-requisition" style="">
                                       <div class="graph-head">Material BrandWise Requisition Report <a  onclick="alert('Work In Progress')">Download</a></div>   
                                    <div class="box-body show-grid-section">
                                <table id="destination" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Brand Code</th>
                                            <th class="title-width">Brand</th>
                                            <th class="lat-width">Stock</th>
                                            <th class="lat-width">Reorder Stock</th>
                                            <th class="lat-width">Unit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="color: red">
                                          <td>1</td>
                                            <td>
                                                Saffola
                                            </td>
                                             <td>4</td>
                                             <td>5</td>
                                            <td>Litre</td>
                                        </tr>
                                        <tr style="color: red">
                                             <td>2</td>
                                            <td>
                                                Fortune
                                            </td>
                                            <td >3</td>
                                            <td >5</td>
                                            <td >Litre</td>
                                        </tr>
                                        <tr style="color: green">
                                             <td>3</td>
                                            <td class="title-width">
                                                Planters
                                            </td>
                                            <td class="lat-width">1</td>
                                            <td class="lat-width">1</td>
                                            <td class="lat-width">Kg</td>
                                        </tr>
                                        <tr style="color: red">
                                             <td>4</td>
                                            <td class="title-width">
                                               Terrasoul Superfoods
                                            </td>
                                            <td class="lat-width">1</td>
                                            <td class="lat-width">2</td>
                                            <td class="lat-width">Kg</td>
                                        </tr>
                                   </tbody>
                                </table>
                            </div>          
                                    </div>  
                                </section>
                                <?php if(isset($limit)) {?>
                            </section>
                        </div><!-- /.box -->                       
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->
              <?php } ?>       
           