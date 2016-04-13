<?php

use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Print Bill');
    $this->assign('page','printbill');
    $this->assign('sec','10000');
?>
<script>
    printtable();
</script>
<section class="content-header">
    <h1>
        Restaurant Table View
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Table View</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box"> 
               
                <section class="content content-div show-add-section">
                    <div class="row">
                        <div class="table-list">    
                                   
                        </div>
                    </div>
                </section>
            </div><!-- /.box -->                       
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<input type="text" class="hidden" id="option" value="<?= $option ?>">