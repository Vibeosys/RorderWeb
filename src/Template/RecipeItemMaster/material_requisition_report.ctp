<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

     $this->layout = 'rorder_layout';
     $this->assign('title', 'Restaurant Material Requisition Report');
     
?>    
     
<?php $this->start('breadcrum');?>
       <ol class="breadcrumb">
                            <li><a href="../" class="red">Dashboard</a></li>
                            <li><a href="../reports" class="red">Reports</a></li>
                            <li class="active">Material Requisition</li>
                    </ol>
<?php $this->end('breadcrum'); ?>
<div class="row">
              
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Material Requisition Report</h2>
                       <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                        <div class="clearfix"></div>
                      </div>
                        <div class="x_content" id="main-div">
                       
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Material Code</th>
                              <th>Material</th>
                              <th>Stock</th>
                              <th>Reorder Stock</th>
                              <th>Unit</th>
                             
                            </tr>
                          </thead>
                          <tbody id="req">
                          
                          </tbody>
                        </table>

                      </div>
                    </div>
                  </div>
          </div>
 <?php $this->start('script'); ?>  
 <script type="text/javascript">
     var htmlc = '';
$.post('/ajax/materialrequisitionreport',{},function(result){
            if(result){
                $.each(result,function(key,value){
                    if(value.qty <= value.rLevel){
                    htmlc += '<tr style="color: red">';
                    }else{ 
                        htmlc += '<tr style="color: green">';
                    }
                    htmlc += '<td>' + value.itemId + '</td>'
                    htmlc += '<td>' + value.itemName + '</td>';
                    htmlc += '<td>' + value.qty + '</td>';
                    htmlc += '<td>' + value.rLevel + '</td>';
                    htmlc +=     '<td>' + value.unit + '</td></tr>';
                });
                $('#req').html(htmlc);
                if(htmlc){
                     $(document).ready(function() {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
              keys: true
            });
            $('#datatable-responsive').DataTable();
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
                    }
            }else{
                $.get('/notfound',{},function(result){
                                    $('#main-div').append(result);
                });
           }
        });
        </script>
  <?php $this->end('script'); ?>