<html>
    <head>
        <title> Print preview</title>
        <?= $this->Html->css('print-preview-style.css') ?>
        <script>
            function printfunction(id){
                alert('button clicked is is :- '+ id);
                 var html="<html>";
                  html+="<head>";
                html+= "<style>@font-face{font-family:JQuicksand-Light;src:url(Quicksand-Light.otf) format('truetype')}body{width:225px;height:100%;font-family:sans-serif;font-size:15px}.content-wrapper{width:225px}.restaurant-info{text-align:center;font-size:20px}tbody{border-top:2px dotted gray}table.desc-table{font-family:Quicksand-Light;font-size:16px;text-decoration:none}.amount-desc{text-align:right}.amount-desc > span{margin-right:20px}.small{width:40%;position:relative;left:30%}.footer{height:50px}td{text-align:left}hr{border:.1px dashed gray}span.date-time{font-size:14px;padding-top:4px;padding-left:10px}div.print-button{position:relative;top:-350px;left:60%}input{height:100px;width:200px;font-size:29px;background-color:#dcdcdc;border:1px solid gray;border-radius:5px}.small-width{width:10px}</style>";
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
        </script>
    </head>
    <body>
        <div id="print-div" class="content-wrapper">
            <?php if(isset($bill) and isset($restaurants) and isset($printInfo)){ ?>
            <?php foreach ($restaurants as $restaurant){ ?>
            <div class="restaurant-info">
                <?= $restaurant->title ?><br>
                <?= $restaurant->area ?>,<?= $restaurant->city ?><br>
                <span style="font-size: 15px">Phone : <?= $restaurant->phone ?></span><br>
                Tax Invoice
            </div>
            <?php } ?>
            <br>
            <span class="date-time">
            Bill No. : <?= $bill->billNo ?><br>  
               <?php date_default_timezone_set(CURRENT_TIME_ZONE);?>
            &nbsp;&nbsp;Bill Date :  <?= date('d M Y h:ia')?><br>
            &nbsp;&nbsp;Captain : <?= $user ?>
            </span>
            <hr>
            <div class="order-desc">
                <table class="desc-table" border = 0>
                    <thead>
                    <th class="small-width">#</th>
                    <th style="text-align: left">Description</th>
                                    <th  class="small-width">Qty</th>
                                    <th style="text-align: left">Rt</th>
                                    <th style="text-align: right" >Amt</th>
                    </thead>
                    <tbody>
                        <tr><td colspan="5"><hr></td></tr>
                        <?php foreach ($printInfo as $print){ ?>
                        <tr>
                            <td><?= $print->srNo ?></td>
                            <td><?= $print->desc ?></td>
                            <td><?= $print->qty ?></td>
                            <td style="text-align: left"><?= $print->rate ?></td>
                            <td style="text-align: right"><?= $print->amt ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="amount-desc">
                <span>Net Amount</span><?= $bill->netAmt ?><br>
                <span>Taxes</span>+     <?= $bill->totalTaxAmt ?><br>
                <span>Discount</span>-     <?= $bill->discount ?>
                <hr class="small">
                <span>Total Amount </span>    <?= $bill->totalPayAmt ?>
            </div>
            <hr>
            <div class="footer">
                
                
            </div>
            <hr>
            <span style="font-size: 12px;text-align: center;padding-left: 50px">Powered by QuickServe &trade;</span>
            
          
            <?php } ?>
        </div>
        <div class="print-button">
                <input type="button" class="print" value="PRINT" onclick="printfunction('print-div')">
        </div>
    </body>
    
    
</html>
