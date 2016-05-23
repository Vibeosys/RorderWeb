<?php

    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = 'rorder_layout';
    $this->assign('title', 'Invalid Entry');
     $this->assign('heading', 'Invalid Entry');
?>
<?php $this->start('breadcrum');?>
    
                              <li class="red">Table List</li>
                              <li style="text-transform: capitalize" class="active">generate bill</li>
              
<?php $this->end('breadcrum'); ?> 
            <section class="fil-not-found">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    
                       <div class="error-msg1">
                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 border-bottom">
                               <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        <?= $this->Html->image("billalreadygenerate.png",['class' => 'img-responsive error-fix']) ?>
                                   </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <span class="error-heading">Invalid Entry</span>
                                   </div>
                               </div> 
                            </div>
                           <div class="msg-text">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-3 ">                  
                                            <p class="error-p1">Bill has been already generated</p>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  col-lg-offset-2 col-md-offset-3">
                                           <p class="error-msg2">Here are some suggestions:</p>
                                                    <ul class="error-list1">
                                                        <li> <a id="back_link" href="" >Back</a> </li>
                                                                <li> <a href="../../reports">Home</a></li>
                                                    </ul>
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
            $('.error-p1').text(result);
        });
        $.post('/getcookie',{name:'bg_link'},function(result){
            $('#back_link').attr('href','../../'+result);
        });
    });
 </script>   
 <?php $this->end('script'); ?>