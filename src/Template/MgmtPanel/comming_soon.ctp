<?php

use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = 'rorder_layout';
    $this->assign('title', 'Page Under Construction');
?>
<div class="right_col" role="main">
 <section class="coming-soon">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                   <h1>This Page is Under</h1>
                    <h3>Contruction</h3>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <?= $this->Html->image('under-contruction.png',['alt' => 'Comming Soon', 'class' => 'img-responsive']) ?>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                <h4>Please check back soon</h4>
                </div>
            </div>
        </div>
 </section>
</div>