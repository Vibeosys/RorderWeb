<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;

$this->layout = false;
$this->layout = 'rorder_layout';
$this->assign('title', 'Stock Taking');
$this->assign('heading', 'Stock Taking');
//$this->assign('script','var loading=\'<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>\';$(".table-list").html(loading),$.ajax({url:"/gettables",type:"POST",contentType:!1,cache:!1,processData:!1,success:function(e,t,a){if(e){var s="";$.each(e,function(e,t){s=t.isOccupied?s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(247, 0, 0, 0.48);">\'+t.tableNo+" </div>":s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(0, 128, 0, 0.55);">\'+t.tableNo+" </div>",$(".table-list").html(s)})}else{var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}},error:function(e,t,a){var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}});');
?>
<?php $this->start('breadcrum'); ?>
<li class="red">Inventory</li>
<li class="active">Stock Taking</li>
<?php $this->end('breadcrum'); ?>           

<?php $this->start('head_title'); ?>        
<div class="x_title">
    <p class="error-top" style="font-weight:bold; padding: 5px; text-align:center; width: 100%;"> </p>    
    <ul class="nav navbar-right panel_toolbox">
        <li><i class="fa fa-calendar fa-date"></i>
            <?php date_default_timezone_set(CURRENT_TIME_ZONE); ?><?php echo date('d M Y'); ?>
        </li>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <button name="os" value="true" type="button" class="open-stock-btn btn btn-success btn-lg btn-line btn-rect">Open Stock</button>
        <button name="os" value="true" type="button" class="close-stock-btn btn btn-danger btn-lg btn-line btn-rect" disabled>Close Stock</button>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group text-right push-top-btn">
            <button name="os" value="true" type="submit" class="stock-save btn btn-success btn-grad btn-lg btn-rect" disabled>Save</button>
            <button type="button" class="btn btn-primary btn-grad btn-lg btn-rect">Cancel</button>
        </div>
    </div>
</div>
<?php $this->end('head_title'); ?> 

<div class="x_content">

    <table id="stocktaking" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Item Code</th>
                <th>Material</th>
                <th>Category</th>
                <th>Stock In Hand</th>
                <th>Unit</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;

            if ($items) {
                foreach ($items as $item) {
                    ?>
                    <tr>
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
                        <td><input value="<?= $item->qty ?>" type="text" class="stock hidden qty<?= $i ?> form-control" name="srock" id="stockinhand">
                            <span class="stock-value"><?= $item->qty ?></span></td>
                        <td><?= $item->unit ?><input class="unit<?php echo $i; ?>" style="display:none" type="text" name="unit" value="<?= $item->unitId ?>"></td>                             
                    </tr>
        <?php $i++;
    }
} ?>
        </tbody>
    </table>
    <input id="count" style="display:none" type="text" name="count" value="<?= $i ?>">
    <div class="notification">
        <div class="notice alert alert-warning fade in">
            <span class="notice-message"></span>
            <a >Close</a>
        </div>
        <div class="success alert alert-success fade in">
            <span class="success-message"></span>
            <a >Close</a>
        </div>
    </div>
</div>

<?php $this->start('script'); ?>
<script type="text/javascript">

    $(document).ready(function () {
        $('.open-stock-btn').on('click', function () {

            $.post('/getcookie', {name: 'stocko'}, function (result) {
                result = parseInt(result);
                if (result) {
                    $('.error-top').text('Please save before performing any operation');
                    $('.error-top').css('color', 'orange');
                    $('.error-top').css('border', '1px solid orange');
                } else {
                    openstockCheck(1);
                }
            });


        });
        $('.close-stock-btn').on('click', function () {
            $.post('/getcookie', {name: 'stockc'}, function (result) {
                result = parseInt(result);
                if (result) {
                    $('.error-top').text('Please save before performing any operation');
                    $('.error-top').css('color', 'orange');
                    $('.error-top').css('border', '1px solid orange');
                } else {
                    closestockCheck(1);
                }
            });
        });
        $('.stock-save').on('click', function () {
            $(this).text('WAIT ..');
            $.post('/getcookie', {name: 'stocko'}, function (resulto) {
                $.post('/getcookie', {name: 'stockc'}, function (resultc) {
                    var os = parseInt(resulto);
                    var cs = parseInt(resultc);
                    var count = $('#count').val();
                    var saveResult = false;
                    if (os || cs) {
                        if (os) {
                            var i = 0;
                            var itemIdList = [];
                            var stockList = [];
                            var unitList = [];
                            while (i < count) {
                                itemIdList.push($('.ItemId' + i).val());
                                stockList.push($('.qty' + i).val());
                                unitList.push($('.unit' + i).val());
                                i++;
                            }
                            $.post("saveopenstock", {item: itemIdList, stock: stockList, unit: unitList}, function (result) {
                                if (result === 1) {
                                    $('.stock-save').text('SAVE');
                                    $('.stock-save').attr('disabled', 'disabled');
                                    $('.open-stock-btn').attr('disabled', 'disabled');
                                    $('.close-stock-btn').removeAttr('disabled');
                                    $.post('/deletecookie', {name: 'stocko'}, function (result) {
                                    });
                                    $('.stock').addClass('hidden');
                                    $('.stock-value').removeClass('hidden');

                                    $('.error-top').text('Stock opened for current day');
                                    $('.error-top').css('color', 'green');
                                    $('.error-top').css('border', '1px solid green');
                                } else {
                                    $('.stock-save').text('SAVE');
                                    $('.error-top').text('Error in stock operation please try again');
                                    $('.error-top').css('color', 'red');
                                    $('.error-top').css('border', '1px solid red');
                                }

                            });
                        } else {
                            var i = 0;
                            var itemIdList = [];
                            var stockList = [];
                            var unitList = [];
                            while (i < count) {
                                itemIdList.push($('.ItemId' + i).val());
                                stockList.push($('.qty' + i).val());
                                unitList.push($('.unit' + i).val());
                                i++;
                            }
                            $.post("saveclosestock", {item: itemIdList, stock: stockList, unit: unitList}, function (result) {

                                if (result === 1) {
                                    $('.stock-save').text('SAVE');
                                    $('.stock-save').attr('disabled', 'disabled');
                                    $('.close-stock-btn').attr('disabled', 'disabled');
                                    $.post('/deletecookie', {name: 'stockc'}, function (result) {
                                    });
                                    $('.stock').addClass('hidden');
                                    $('.stock-value').removeClass('hidden');
                                    $('.error-top').text('Stock closed for current day');
                                    $('.error-top').css('color', 'green');
                                    $('.error-top').css('border', '1px solid green');
                                } else {
                                    $('.stock-save').text('SAVE');
                                    $('.error-top').text('Error in stock operation please try again');
                                    $('.error-top').css('color', 'red');
                                    $('.error-top').css('border', '1px solid red');
                                }

                            });
                        }
                        document.location.reload();
                    } else {
                        $(this).text('SAVE');
                        $('.error-top').text('Please open or close stock before save.');
                        $('.error-top').css('color', 'orange');
                        $('.error-top').css('border', '1px solid orange');
                    }
                    return false;
                });
            });
        });
        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({
            keys: true
        });

        //$('#stocktaking').DataTable();

        $('#datatable-scroller').DataTable({
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });
        var table = $('#datatable-fixed-header').DataTable({
            fixedHeader: true
        });

    });
    function openstockCheck(check) {
        $.ajax({
            url: "/stockopencheck",
            type: "POST",
            contentType: false,
            cache: false,
            processData: false,
            success: function (result, jqXHR, textStatus) {
                if (result) {
                    if (check) {
                        $('.open-stock-btn').attr('disabled', 'disabled');
                        $('.error-top').text('Stock was already open for current day');
                        $('.error-top').css('color', 'red');
                        $('.error-top').css('border', '1px solid red');
                    } else {
                        $('.open-stock-btn').attr('disabled', 'disabled');
                        return true;
                    }
                } else {
                    if (check) {
                        $.post('/setcookie', {name: 'stocko', value: '1'}, function (result) {
                            $.cookie("", true, {expires: 1});
                            $('.stock-value').addClass('hidden');
                            $('.stock').removeClass('hidden');
                            $('.open-stock-btn').attr('disabled', 'disabled');
                            $('.stock-save').removeAttr('disabled');
                        });
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('.error-top').text(textStatus);
                $('.error-top').css('color', 'red');
                $('.error-top').css('border', '1px solid red');
            }});
    }

    function closestockCheck(check) {
        $.ajax({
            url: "/stockclosecheck",
            type: "POST",
            contentType: false,
            cache: false,
            processData: false,
            success: function (result, jqXHR, textStatus) {
                if (result) {
                    if (check) {
                        $('.error-top').text('Stock was already closed for current day');
                        $('.error-top').css('color', 'red');
                        $('.error-top').css('border', '1px solid red');
                        $('.close-stock-btn').attr('disabled');
                    } else {
                        $('.close-stock-btn').attr('disabled');
                    }
                } else {
                    if (check) {
                        $.post('/setcookie', {name: 'stockc', value: '1'}, function (result) {

                            $('.stock-value').addClass('hidden');
                            $('.stock').removeClass('hidden');
                            $('.close-stock-btn').attr('disabled', 'disabled');
                            $('.stock-save').removeAttr('disabled');
                        });
                    } else {
                        $('.close-stock-btn').removeAttr('disabled');
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('.error-top').text('No material for stock taking available, please upload inventory using CSV file upload !!');
                $('.error-top').css('color', 'red');
                $('.error-top').css('border', '0px solid red');

            }});
    }
    $(document).ready(function () {
        openstockCheck(0);
        closestockCheck(0);
    });
</script>
<?php $this->end('script'); ?>