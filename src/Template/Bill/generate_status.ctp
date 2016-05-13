<?php

use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = 'rorder_layout';
    $this->assign('title', 'Page Under Construction');
    $this->assign('heading', 'Bill Generation Status');
?>
<?php $this->start('breadcrum');?>
     <ol class="breadcrumb">
                            <li><a href="../" class="red">Dashboard</a></li>
                            <li><a href="../reports" class="red">Restaurent 1</a></li>
                              <li class="active">Table List</li>
                              <li style="text-transform: capitalize" class="active">generate bill</li>
                    </ol>
<?php $this->end('breadcrum'); ?> 
 <section class="fil-not-found">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    
                       <div class="error-msg1">
                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 border-bottom">
                               <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        <?= $this->Html->image('cash-payment-icon.png',['class' =>  'img-responsive error-fix','alt' => 'BG']) ?>
                                   </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <p id="bg_st_msg" class="error-heading"> </p>
                                   </div>
                                   <!--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                       <img src="images/no-data.png" class="error-img1 img-responsive">
                                   </div>
-->
                               </div> 
                            </div>
                           <div class="msg-text">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-3 ">                  
                                            <p class="error-p1">Do you want Pay?</p>
                                    </div>
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 push-top">                  
                                   <button type="button" id="btn_yes" class="btn btn-success-outline ">Yes</button>
                                   <button type="button" id="btn_no" class="btn btn-danger-outline">NO</button>
                                   <span id="loading" style="display: none"> <?= $this->Html->image('loading1.gif',['class' =>  '','alt' => 'BG']) ?></span>
                                    </div>
                                    
                            </div>
                    </div>
                </div>                    
            </div>                    
        </div>
    </section>
<?php $this->start('script');?>
<script type="text/javascript">
    $(document).ready(function(){
       $.post('/getcookie',{name:'bg_st_msg'},function(result){
           $('#bg_st_msg').text(result);
       }); 
       $('#btn_no').on('click',function(){
           window.location.replace('../../tableview/generatebill');
       });
         $('#btn_yes').on('click',function(){
           window.location.replace('bill-payment');
       });
        
        
        
        
        
        
        
    });
    
    
    
    
 </script>   
 <?php $this->end('script'); ?>