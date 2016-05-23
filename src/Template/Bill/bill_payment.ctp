<?php

use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = 'rorder_layout';
    $this->assign('title', 'Bill Payment');
     $this->assign('heading', 'Bill Payment');
?>
<?php $this->start('breadcrum');?>
     <ol class="breadcrumb">
                              <li class="red">Table List</li>
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
                                        <?= $this->Html->image("payment-icon.png",['class' => 'img-responsive error-fix']) ?>
                                   </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <span class="error-heading">Bill Payment! </span>
                                   </div>
                               </div> 
                            </div>
                           <div class="msg-text">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-3 ">                  
                                            <p class="error-p1">Payment By</p>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-3 ">                  
                                        <select id="pm" class="form-control select-payment">
                                              <option>Choose option</option>
                                              <?php if(isset($p_option)){
                                                  foreach ($p_option as $mode){
                                                      echo '<option value="'.$mode->paymentMOdeId .'">'. $mode->paymentModeTitle .'</option>';
                                                  }
                                              }
                                              ?>
                                          </select>
                                    </div>
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-3 push-top">
                                   <span style="padding-top: 25px">Discount : <input id="discount" type="text" value="" disabled="disabled"></span>
                               </div> 
                               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 push-top">                  
                                   <button type="button" id="btn_yes" class="btn btn-success-outline ">Submit</button>
                                   <button type="button" id="btn_no" class="btn btn-danger-outline">Cancel</button>
                                    <span id="loading" style="display: none;padding-top: 23px;"> <?= $this->Html->image('loading1.gif',['class' =>  '','alt' => 'BG']) ?>
                                    Processing</span>
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
      // $('#btn_yes').on('click',function(){
        //   window.location.replace('../../tableview/generatebill');
       //});
       var billNo = '';
       var userInfo = '';
       var table = '';
       var takeaway = '';
       var delivery = '';
       var cust = '';
       var disc = '';
        $.post('/getcookie',{name:'bg_billno'},function(billNo){
            $.post('/getcookie',{name:'bg_userinfo'},function(userInfo){
                $.post('/getcookie',{name:'bg_table'},function(table){
                    $.post('/getcookie',{name:'bg_take'},function(takeaway){
                        $.post('/getcookie',{name:'bg_deli'},function(delivery){
                            $.post('/getcookie',{name:'bg_cust'},function(cust){
                                $.post('/getcookie',{name:'bg_disc'},function(disc){
                                    if(disc){
                                    $('#discount').val(disc);
                                }else{
                                    $('#discount').val('0');
                                }
                                    $('#btn_yes').attr('onclick','makepayment(' + billNo +',\''+ userInfo +'\',\''+ table +'\',\''+ takeaway +'\',\''+ delivery +'\',\''+ cust +'\')');
                                });
                            });
                        });
                    });
                });
            });
        });
    });
    
    
    
    
 </script>   
 <?php $this->end('script'); ?>