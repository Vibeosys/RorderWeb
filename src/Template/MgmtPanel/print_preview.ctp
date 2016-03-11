<html>
    <head>
        <title> QuickServe | Print preview</title>
        <?= $this->Html->css('print-preview-style.css') ?>
        <script>
            function printfunction(id){
                 var html="<html>";
                  html+="<head>";
                html+= "<style>@font-face{font-family:JQuicksand-Light;src:url(Quicksand-Light.otf) format('truetype')}body{width:225px;height:100%;font-family:sans-serif;font-size:15px}.content-wrapper{width:225px}.restaurant-info{text-align:center;font-size:20px}tbody{border-top:2px dotted gray}table.desc-table{font-family:Quicksand-Light;font-size:16px;text-decoration:none}.amount-desc{text-align:right}.amount-desc > span{margin-right:20px}.small{width:40%;position:relative;left:30%}.footer{height:auto;text-align: center}td{text-align:left}hr{border:.1px dashed gray}span.date-time{font-size:14px;padding-top:4px;padding-left:10px}div.print-button{position:relative;top:-350px;left:60%}input{height:100px;width:200px;font-size:29px;background-color:#dcdcdc;border:1px solid gray;border-radius:5px}.small-width{width:10px}</style>";
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
                <div style="font-size: 15px;text-align: center"><?= $restaurant->area ?>,<?= $restaurant->city ?></div>
                <span style="font-size: 15px;text-align: center">Phone : <?= $restaurant->phone ?></span><br>
                <span style="text-decoration: underline">Tax Invoice</span><br>
                <?php if($table){ ?>   
                <span style="font-size: 15px;font-weight: bold;text-align: center">Dine-In</span>   
           <?php }else { ?>
                <span style="font-size: 15px;font-weight: bold;text-align: center">Takeaway</span> 
            <?php } ?>
            </div>
            <?php } ?>
            <br>
            <div class="date-time">
           <?php if($table){ ?>   
            Table No. :  <?= $table ?><br>   
           <?php }else { ?>
            TakeAway No. :  <?= $bill->takeawayNo ?><br>
            <?php } ?>
            Bill No. : <?= $bill->billNo ?><br>  
               <?php date_default_timezone_set(CURRENT_TIME_ZONE);?>
            Bill Date :  <?= date('d M Y h:ia')?><br>
            Captain : <?= $user ?>
            </div>
            <hr>
            <div class="order-desc">
                <table class="desc-table" border = 0>
                    <thead>
                    <th class="small-width">#</th>
                    <th style="text-align: left">Description</th>
                                    <th  class="small-width">Qty</th>
                                    <th style="text-align: right" >Amt</th>
                    </thead>
                    <tbody>
                        <tr><td colspan="6"><hr></td></tr>
                        <?php foreach ($printInfo as $print){ ?>
                        <tr>
                            <td><?= $print->srNo ?></td>
                            <td><?= $print->desc ?></td>
                            <td><?= $print->qty ?></td>
                            <td style="text-align: right"><?= $print->amt ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="amount-desc">
                <span>Net Amount</span><?= number_format((float)$bill->netAmt, 2, '.', '') ?><br>
                <span>Taxes</span>     <?= number_format((float)$bill->totalTaxAmt, 2, '.', '') ?><br>
                <span>Discount</span>     <?= number_format((float)$bill->discount, 2, '.', '') ?>
                <hr class="small">
                <span>Total Amount </span> ₹   <?= number_format((float)$bill->totalPayAmt, 2, '.', '') ?>
            </div>
            <hr>
            <div class="footer">
               I/We hereby certify that my/our registration certificate under the Maharashtra Value Added Tax,2002 is in force on the date on which the sales of the goods specified in this tax invoice is made by me/us and that the transaction of sale covered by this tax invoice has been effected by me/us and it shall be accounted for in the turnover of sales while filling of return and the due tax, if any, payable on the sale has been paid or shall be paid 'Subject to Pune Jurisdiction' 
                
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
