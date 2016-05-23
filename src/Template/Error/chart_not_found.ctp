<?php

    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
   
?>
     <!--           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
                    
                       <div class="error-msg1">
                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 border-bottom">
                               <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        <img src="/img/error-fix.png" class="img-responsive error-fix" alt="...">                                   </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <span class="error-heading">Data not Found! </span>
                                   </div>
                               </div> 
                            </div>
                           <div class="msg-text">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-3 ">                  
                                            <p class="error-p1">The content not found</p>
                                    </div>
                                 
                            </div>
                    </div>
                </div>      -->
<div class="col-lg-12 dnf-style center-block" >
     <?= $this->Html->image("dnf.png", ['class' => "img-responsive center-block"]) ?>
</div> 