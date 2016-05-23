<?php

    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Device List');
    $this->assign('heading', 'Device List');
?>
<?php $this->start('breadcrum');?>
                            <li class="red">Device</li>
                           <li class="active">Device</li>
<?php $this->end('breadcrum'); ?>           
                           
                      <div class="x_content">
                      
                        <table id="device-info" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>IMEI</th>
                              <th>IP Address</th>
                              <th>City</th>
                              <th>Region</th>
                              <th>Country</th>
                              <th>Brand</th>
                              <th>Board</th>
                              <th>Manu Facturer</th>
                              <th>Model</th>
                              <th>Product</th>
                              <th>FM Version</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            <?php if(isset($rows)) {
                            foreach ($rows as $row){    
                            ?>  
                            <tr>
                              <td><?= $row->imei ?></td>
                              <td><?= $row->ip ?></td>
                              <td><?= $row->city ?></td>
                              <td><?= $row->region ?></td>
                              <td><?= $row->country ?></td>
                              <td><?= $row->brand ?></td>
                              <td><?= $row->board ?></td>
                              <td><?= $row->manufacturer ?></td>
                              <td><?= $row->model ?></td>
                              <td><?= $row->product ?></td>
                              <td><?= $row->fmVersion ?></td>
                            </tr>
                            <?php } } ?>
                            
                          </tbody>
                        </table>
                      

                      </div>
                 
<?php $this->start('script');?>
<script>
   $(document).ready(function() {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
              keys: true
            });
            $('#device-info').DataTable();
            $('#datatable-scroller').DataTable({
              //ajax: "js/datatables/json/scroller-demo.json",
              deferRender: true,
              scrollY: 380,
              scrollCollapse: true,
              scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({
              fixedHeader: true
            });
          });
         
        </script>
  <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});

</script>

<?php $this->end('script'); ?>