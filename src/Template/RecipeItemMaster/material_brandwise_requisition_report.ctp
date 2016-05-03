<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

     $this->layout = 'rorder_layout';
     $this->assign('title', 'Restaurant Material BrandWise Requisition Report');
?>          
<?php $this->start('breadcrum');?>
       <ol class="breadcrumb">
                            <li><a href="../" class="red">Dashboard</a></li>
                            <li><a href="../reports" class="red">Reports</a></li>
                            <li class="active">Material BrandWise Requisition</li>
                    </ol>
<?php $this->end('breadcrum'); ?>          
<div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Material Brandwise Requisition Report </h2>
                       <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                        <div class="clearfix"></div>
                      </div>
                        <div class="x_content" id="error-div">
                       
                       <table id="datatable-responsive-second" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Brand Code</th>
                              <th>Brand</th>
                              <th>Material</th>
                              <th>Stock</th>
                              <th>Reorder Stock</th>
                              <th>Unit</th>
                              
                            </tr>
                          </thead>
                          <tbody id="bw-req">
                           
                          </tbody>
                        </table>

                      </div>
                    </div>
                  </div>
          </div>
<?php $this->start('script'); ?>  
   <script type="text/javascript">
          var htmlt = '';
         $.post('/ajax/materialbwrequisitionreport',{},function(result){
            if(result){
                $.each(result,function(key,value){
                    if(value.qty <= value.rLevel){
                        htmlt += '<tr style="color: red">';
                    }else{ 
                        htmlt += '<tr style="color: green">';
                    }
                    htmlt += '<td>' + value.brandCode + '</td>';
                    htmlt += '<td>' + value.brand + '</td>';
                    htmlt += '<td>' + value.item + '</td>';
                    htmlt += '<td>' + value.stock + '</td>';
                    htmlt += '<td>' + value.rstock + '</td>';
                    htmlt += '<td>' + value.unit + '</td></tr>';
                });
                $('#bw-req').html(htmlt);
                  $(document).ready(function() {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
              keys: true
            });
            $('#datatable-responsive-second').DataTable();
            $('#datatable-scroller').DataTable({
              deferRender: true,
              scrollY: 380,
              scrollCollapse: true,
              scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({
              fixedHeader: true
            });
          });
         
            }else{
                 var error = '<div class="right_col" role="main">' +
                                '<section class="fil-not-found">' +
                                    '<div class="container">' +
                                        '<div class="row">' +
                                            '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">' +
                                            '<img src="../img/sad.png" >' +
                                            '<h1 class="e-msg">Sorry!  </h1>' +
                                            '<h3> Information </h3> <h1> not found.</h1>' +
                                            '</div></div></div></section></div>';
               $('#bw-req').html(error);                     
           }
        });
        
        </script>
 
  <?php $this->end('script'); ?>
           