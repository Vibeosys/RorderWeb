<html>
    <head>
        <title> QuickServe | Kot Print preview</title>
        <?= $this->Html->css('print-preview-style.css') ?>
        <script>
            function printfunction(id){
                 var html="<html>";
                  html+="<head>";
                html+= "<style>body{width:230px;height:100%;font-family:sans-serif;font-size:15px}.content-wrapper{width:230px}.right-position{right: 0;}.restaurant-info{text-align:center;font-size:20px}tbody{border-top:2px dotted gray}table.desc-table{font-family:Quicksand-Light;font-size:16px;text-decoration:none}.amount-desc{text-align:right}.amount-desc > span{margin-right:20px}.small{width:40%;position:relative;left:30%}.footer{height:auto;text-align: center}td{text-align:left}hr{border:.1px dashed gray}span.date-time{font-size:14px;padding-top:4px;padding-left:10px}div.print-button{position:relative;top:-350px;left:60%}input{height:100px;width:200px;font-size:29px;background-color:#dcdcdc;border:1px solid gray;border-radius:5px}.small-width{width:10px}</style>";
                html+= "</head>";
                html+= document.getElementById(id).innerHTML;
        
                html+="</html>";
                var printWin = window.open('','','left=0,top=0,width=1,height=1,toolbar=0,scrollbars=0,status =0');
                printWin.document.write(html);
                printWin.document.close();
                printWin.focus();
                printWin.print();
                printWin.close();
            }
            $(document).ready(function(){
                var width = $('.dis-td').width();
                var td = 229 - width;
                $('.td-width').width(td);
            });
        </script>
    </head>
    <body>
        <?php if(isset($message)){?>
        <div class="error-message"><div class="error-img"></div><span class="error-text"><?= $message?></span></div>
        <?php }?>
        <div id="print-div" class="content-wrapper">
            <?php if(isset($menus) and isset($orderNo) and isset($tableNo)){ ?>
            <div class="date-time" style="padding-left: 0px">
             <span style="position:relative;left: 0">Order  #<?= $orderNo ?></span>
             <?php if($tableNo){?>
              <span class="right-position" style="position:absolute;">Table  #<?= $tableNo ?></span><br>  
             <?php }else if($takeawayNo){ ?>
             <span class="right-position" style="position:absolute;">Takeaway  #<?= $takeawayNo ?></span><br> 
              <?php }else if($deliveryNo){ ?>
             <span class="right-position" style="position:absolute;">Delivery  #<?= $deliveryNo ?></span><br> 
            <?php } ?>
             <span style="position:relative;left: 0">Served By  <?= $user ?></span>
             <span class="right-position" style="position:absolute;">Time <?= $time ?></span>
            </div>
            <hr>
            <div class="order-desc">
                <table class="desc-table">
                    <thead>
                    <th></th>
                    <th class="dis-td" style="text-align: left">Description</th>
                    <th class="td-width"></th>
                    <th style="text-align: right">Qty</th>
                    <th></th>
                    </thead>
                    <tbody>
                        <tr><td colspan="6"><hr></td></tr>
                        <?php foreach ($menus as $menu){ ?>
                        <tr>
                            <td></td>
                            <td ><?= $menu->desc ?><br><span style="margin-left: 20px;font-size: 14px;font-style: italic;"><?= $menu->note ?></span></td>
                            <td style="width:18px"></td>
                            <td><?= $menu->qty ?></td>
                            <td style="width:6%"></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <hr>
            <?php } ?>
        </div>
        <div class="print-button">
                <input type="button" class="print" value="PRINT" onclick="printfunction('print-div')">
        </div>
    </body>
    
    
</html>
