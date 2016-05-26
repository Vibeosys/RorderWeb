<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
     $this->layout = 'rorder_layout';
     $this->assign('title', 'Material Stock Modification');
     $this->assign('heading', 'Material Stock Modification');
     //$this->start('content');
?>       
<?php $this->start('breadcrum');?>
                           <li class="red">Inventory Management</li>
                           <li class="active">Stock Modification</li>
<?php $this->end('breadcrum'); ?>   
                       
                              <div class="x_content">
                       
                        <table id="material-stock" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Material Code</th>
                              <th>Description</th>
                              <th>Category</th>
                              <th>Stock</th>
                              <th>Unit</th>
                              <th>Action</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                              <?php if(isset($items)){ ?>
                              <?php $i =0; foreach ($items as $item) { ?>
                            <tr>
                          <form action="materialstockmodification" method="post">   
                              <td>
                               <?= $item->itemId ?>
                                  <input class="ItemId<?= $i ?>" style="display:none" type="text" name="ItemId" value="<?= $item->itemId ?>">
                              </td>
                              <td>
                               <input class="roleId" style="display:none" type="text" name="itemName" value="<?= $item->itemName ?>">
                             <?= $item->itemName ?>
                              </td>
                              <td>
                              <input class="roleId" style="display:none" type="text" name="category" value="<?= $item->category ?>">
                                <?= $item->category ?>
                              </td>
                              <td>
                                  <input id="stockmodify<?= $i?>" type="text" value="<?= $item->qty ?>" class="form-control hidden stock" name="stockmodify" >
                                  <span class="stock-span"><?= $item->qty ?></span>
                              </td>
                              <td><?= $item->unit ?><input class="unit<?php echo $i; ?>" style="display:none" type="text" name="unit" value="<?= $item->unitId ?>"></td>                             
                             <td>
                            <button id="<?= $i?>" type="button" class="btn btn-info btn-circle btn-lg" data-toggle="tooltip" data-placement="left" title="Edit">
                                <i class="fa fa-pencil-square-o fa-size"></i>
                            </button>
                                  <button id="<?= $i?>" type="button" class="btn btn-success btn-circle btn-lg hidden" data-toggle="tooltip" data-placement="left" title="Save">
                                      <i class="fa fa-floppy-o fa-size"></i>
                            </button>
                                 <button id="<?= $i?>" type="button" class="btn btn-danger btn-circle btn-lg" data-toggle="tooltip" data-placement="right" title="Delete">
                                      <i class="fa fa-trash fa-size"></i>
                            </button>
                            
                                </td>
                           </form>
                            </tr>
                           
                              <?php $i++; }} ?>
                            
                          </tbody>
                        </table>

                      </div>                            

 <?php $this->start('script');?>                          
                            <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
              keys: true
            });
            $('#material-stock').DataTable();
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
         $(document).ready(function(){
    var heading_last=$('table.table-bordered th:last-child').text();
    if(heading_last == 'Action'){
        $('th:last-child').removeClass('sorting');
    }
});
        </script>
<?php $this->end('script'); ?>