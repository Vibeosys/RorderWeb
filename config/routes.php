<?php


use Cake\Core\Plugin;
use Cake\Routing\Router;

Router::defaultRouteClass('DashedRoute');



Router::scope('/', function ($routes) {
    $routes->connect('menu/addnewmenu', ['controller' => 'Menu', 'action' => 'addNewMenu']);
    $routes->connect('menu', ['controller' => 'Menu', 'action' => 'menuList']);
    $routes->connect('menu/editmenu', ['controller' => 'Menu', 'action' => 'editMenu']);
    $routes->connect('menu/editrecipe', ['controller' => 'Menu', 'action' => 'editRecipe']);
    $routes->connect('menu/editrecipe/addnewitem', ['controller' => 'Menu', 'action' => 'addNewItem']);
    $routes->connect('menucategory/addnewmenucategory', ['controller' => 'MenuCategory', 'action' => 'addNewMenuCategory']);
    $routes->connect('menucategory', ['controller' => 'MenuCategory', 'action' => 'menuCategoryList']);
    $routes->connect('tablecategory/addnewtablecategory', ['controller' => 'TableCategory', 'action' => 'addNewTableCategory']);
    $routes->connect('rtables/addnewtables', ['controller' => 'RTables', 'action' => 'addNewTables']);
    $routes->connect('rtables', ['controller' => 'RTables', 'action' => 'tableList']);
    $routes->connect('rtables/edittable', ['controller' => 'RTables', 'action' => 'editTable']);
    $routes->connect('tablenumbervalidator', ['controller' => 'RTables', 'action' => 'tableNoValidation']);
    $routes->connect('manage/users', ['controller' => 'User', 'action' => 'usersList']);
    $routes->connect('getwebuser', ['controller' => 'User', 'action' => 'getWebUser']);
    $routes->connect('getpaymentoptions', ['controller' => 'PaymentModeMaster', 'action' => 'getPaymentOptions']);
    $routes->connect('getcurrenttablecustomer', ['controller' => 'TableTransaction', 'action' => 'getCurrentTableCustomer']);
    $routes->connect('getdiscountamount', ['controller' => 'Bill', 'action' => 'getDiscountAmount']);
    $routes->connect('getlatestbill', ['controller' => 'Bill', 'action' => 'getLatestBill']);
    $routes->connect('manage/user/addnewuser', ['controller' => 'User', 'action' => 'addNewUser']);
    $routes->connect('manage/user/edituser', ['controller' => 'User', 'action' => 'editUser']);
    $routes->connect('recipeitems/addnewrecipeitems', ['controller' => 'RecipeItemMaster', 'action' => 'addNewRecipeItem']);
    $routes->connect('stocktaking', ['controller' => 'RecipeItemMaster', 'action' => 'inventory']); 
    $routes->connect('inventory/materialstockupload', ['controller' => 'RecipeItemMaster', 'action' => 'materialStockUpload']); 
    $routes->connect('inventory/materialbrandstockupload', ['controller' => 'RecipeItemMaster', 'action' => 'materialBrandStockUpload']);
    $routes->connect('inventory/materialstockmodification', ['controller' => 'RecipeItemMaster', 'action' => 'materialStockModification']); 
    $routes->connect('inventory/materialbrandstockmodification', ['controller' => 'RecipeItemMaster', 'action' => 'materialBrandStockModification']);
    $routes->connect('inventory/stockinventoryreport', ['controller' => 'RecipeItemMaster', 'action' => 'stockInventoryReport']);
    $routes->connect('inventory/materialrequisitionreport', ['controller' => 'RecipeItemMaster', 'action' => 'materialRequisitionReport']);
    $routes->connect('inventory/materialbrandwiserequisitionreport', ['controller' => 'RecipeItemMaster', 'action' => 'materialBrandwiseRequisitionReport']);
    $routes->connect('getrecipeitem', ['controller' => 'RecipeItemMaster', 'action' => 'getItemInfo']); 
    $routes->connect('getunits', ['controller' => 'UnitMaster', 'action' => 'getUnits']); 
    $routes->connect('/', ['controller' => 'MgmtPanel', 'action' => 'consol']);
    $routes->connect('upload', ['controller' => 'MgmtPanel', 'action' => 'upload']);
    $routes->connect('manage/edit', ['controller' => 'MgmtPanel', 'action' => 'edit']);
    $routes->connect('managedata', ['controller' => 'MgmtPanel', 'action' => 'manageData']);
    // table routes
    $routes->connect('tableview/placeorder', ['controller' => 'RTables', 'action' => 'tableView']);
    $routes->connect('tableview/placeorder/place-an-order', ['controller' => 'MgmtPanel', 'action' => 'commingSoon']);
    $routes->connect('tableview/generatebill', ['controller' => 'RTables', 'action' => 'tableView']);
    $routes->connect('tableview/generatebill/generate-status', ['controller' => 'Bill', 'action' => 'generateStatus']);
    $routes->connect('tableview/generatebill/bill-payment', ['controller' => 'Bill', 'action' => 'billPayment']);
    $routes->connect('tableview/generatebill/invalid-entry', ['controller' => 'Bill', 'action' => 'invalidEntry']);
    $routes->connect('tableview/cancelorder', ['controller' => 'RTables', 'action' => 'tableView']);
    $routes->connect('tableview/cancelorder/cancel-an-order', ['controller' => 'MgmtPanel', 'action' => 'commingSoon']);
    $routes->connect('tableview/printkot', ['controller' => 'RTables', 'action' => 'tableView']);
    $routes->connect('tableview/managetable', ['controller' => 'RTables', 'action' => 'tableView']);
    $routes->connect('tableview/printbill', ['controller' => 'RTables', 'action' => 'tableView']);
   //takeaway routes
    $routes->connect('takeaway/placeorder', ['controller' => 'Takeaway', 'action' => 'takeawayView']);
    $routes->connect('takeaway/placeorder/place-an-order', ['controller' => 'MgmtPanel', 'action' => 'commingSoon']);
    $routes->connect('takeaway/generatebill', ['controller' => 'Takeaway', 'action' => 'takeawayView']);
    $routes->connect('takeaway/generatebill/generate-status', ['controller' => 'Bill', 'action' => 'generateStatus']);
    $routes->connect('takeaway/generatebill/bill-payment', ['controller' => 'Bill', 'action' => 'billPayment']);
    $routes->connect('takeaway/generatebill/invalid-entry', ['controller' => 'Bill', 'action' => 'invalidEntry']);
    $routes->connect('takeaway/cancelorder', ['controller' => 'Takeaway', 'action' => 'takeawayView']);
    $routes->connect('takeaway/cancelorder/cancel-an-order', ['controller' => 'MgmtPanel', 'action' => 'commingSoon']);
    $routes->connect('takeaway/printkot', ['controller' => 'Takeaway', 'action' => 'takeawayView']);
    $routes->connect('takeaway/printbill', ['controller' => 'Takeaway', 'action' => 'takeawayView']);
    // delivery routes
    $routes->connect('delivery/placeorder', ['controller' => 'Delivery', 'action' => 'deliveryView']);
    $routes->connect('delivery/placeorder/place-an-order', ['controller' => 'MgmtPanel', 'action' => 'commingSoon']);
    $routes->connect('delivery/generatebill', ['controller' => 'Delivery', 'action' => 'deliveryView']);
    $routes->connect('delivery/generatebill/generate-status', ['controller' => 'Bill', 'action' => 'generateStatus']);
    $routes->connect('delivery/generatebill/bill-payment', ['controller' => 'Bill', 'action' => 'billPayment']);
    $routes->connect('delivery/generatebill/invalid-entry', ['controller' => 'Bill', 'action' => 'invalidEntry']);
    $routes->connect('delivery/cancelorder', ['controller' => 'Delivery', 'action' => 'deliveryView']);
    $routes->connect('delivery/cancelorder/cancel-an-order', ['controller' => 'MgmtPanel', 'action' => 'commingSoon']);
    $routes->connect('delivery/printkot', ['controller' => 'Delivery', 'action' => 'deliveryView']);
    $routes->connect('delivery/printbill', ['controller' => 'Delivery', 'action' => 'deliveryView']);
    $routes->connect('billprintpreview', ['controller' => 'MgmtPanel', 'action' => 'printPreview']);
    $routes->connect('logout', ['controller' => 'MgmtPanel', 'action' => 'logout']);
    $routes->connect('tableview/tableorders', ['controller' => 'Order', 'action' => 'displayOrders']);
    $routes->connect('takeaway/takeawayorders', ['controller' => 'Order', 'action' => 'displayOrders']);
    $routes->connect('delivery/deliveryorders', ['controller' => 'Order', 'action' => 'displayOrders']);
    $routes->connect('tableview/tablebills', ['controller' => 'Bill', 'action' => 'displayBill']);
    $routes->connect('takeaway/takeawaybills', ['controller' => 'Bill', 'action' => 'displayBill']);
    $routes->connect('delivery/deliverybills', ['controller' => 'Bill', 'action' => 'displayBill']);
    $routes->connect('gettables', ['controller' => 'MgmtPanel', 'action' => 'getTables']);
    $routes->connect('gettakeaway', ['controller' => 'MgmtPanel', 'action' => 'getTakeaway']);
    $routes->connect('getdelivery', ['controller' => 'MgmtPanel', 'action' => 'getDelivery']);
    $routes->connect('sendmail', ['controller' => 'MgmtPanel', 'action' => 'sendMail']);
    $routes->connect('setcookie', ['controller' => 'MgmtPanel', 'action' => 'setCookie']);
    $routes->connect('getcookie', ['controller' => 'MgmtPanel', 'action' => 'getCookie']);
    $routes->connect('reports', ['controller' => 'MgmtPanel', 'action' => 'reports']);
    $routes->connect('reportsnew', ['controller' => 'MgmtPanel', 'action' => 'reportsNew']);
    $routes->connect('orderprintpreview', ['controller' => 'OrderDetails', 'action' => 'orderPrintPreview']);
    $routes->connect('salesreport', ['controller' => 'SalesHistory', 'action' => 'getReport']);
    $routes->connect('transactionMaster/getTransactionReport', ['controller' => 'TransactionMaster', 'action' => 'getTransactionReport']);
    $routes->connect('customervisitreport', ['controller' => 'CustomerVisit', 'action' => 'customerVisitReport']);
    $routes->connect('login', ['controller' => 'MgmtPanel', 'action' => 'login']);
    $routes->connect('stockopencheck', ['controller' => 'ItemStockLevel', 'action' => 'stockOpenCheck']);
    $routes->connect('stockclosecheck', ['controller' => 'ItemStockLevel', 'action' => 'stockCloseCheck']);
    $routes->connect('saveopenstock', ['controller' => 'ItemStockLevel', 'action' => 'saveOpenStock']);
    $routes->connect('saveclosestock', ['controller' => 'ItemStockLevel', 'action' => 'saveCloseStock']);
    $routes->connect('menu/editrecipe/editrecipeitem', ['controller' => 'MenuRecipe', 'action' => 'editRecipeItem']);
    $routes->connect('reports/stockavailability', ['controller' => 'RecipeItemMaster', 'action' => 'stockAvailability']); 
    $routes->connect('reports/transactionreport', ['controller' => 'TransactionMaster', 'action' => 'transactionReport']); 
    $routes->connect('reports/customerrushhour', ['controller' => 'CustomerVisit', 'action' => 'rushHourReport']); 
    $routes->connect('reports/salesreport', ['controller' => 'SalesHistory', 'action' => 'salesReport']); 
    $routes->connect('ajax/materialrequisitionreport', ['controller' => 'RecipeItemMaster', 'action' => 'getMaterialRequisitionReport']);
   // $routes->connect('ajax/materialbwrequisitionreport', ['controller' => 'RecipeItemDetails', 'action' => 'getBrandWiserequisitionReport']);
    
    $routes->connect('kitchen/recipe', ['controller' => 'MgmtPanel', 'action' => 'commingSoon']);
    $routes->connect('kitchen/recipecategory', ['controller' => 'MgmtPanel', 'action' => 'commingSoon']);
    $routes->connect('kitchen/printers', ['controller' => 'MgmtPanel', 'action' => 'commingSoon']);
    $routes->connect('reports/orderleadtime', ['controller' => 'MgmtPanel', 'action' => 'commingSoon']);
    $routes->connect('reports/salesforcast', ['controller' => 'MgmtPanel', 'action' => 'commingSoon']);
    $routes->connect('reports/leadtineforcast', ['controller' => 'MgmtPanel', 'action' => 'commingSoon']);
    $routes->connect('reports/favouratemenu', ['controller' => 'MgmtPanel', 'action' => 'commingSoon']);
    $routes->connect('reports/perstawordssales', ['controller' => 'MgmtPanel', 'action' => 'commingSoon']);
    $routes->connect('reports/stawordsperformance', ['controller' => 'MgmtPanel', 'action' => 'commingSoon']);
    $routes->connect('manage/devices', ['controller' => 'MgmtPanel', 'action' => 'commingSoon']);
    $routes->connect('manage/configuration', ['controller' => 'MgmtPanel', 'action' => 'commingSoon']);
    //error url
    $routes->connect('notfound', ['controller' => 'Error', 'action' => 'notFound']);
    $routes->fallbacks('DashedRoute');
});

//Restaurant rest api end points
Router::scope('/api/v1', function ($routes) {
    
     $routes->connect('/downloadDb', ['controller' => 'DownloadDb', 'action' => 'index']); 
     //$routes->connect('/getRestaurant', ['controller' => 'Restaurant', 'action' => 'index']);
     $routes->connect('/download', ['controller' => 'Download', 'action' => 'index']); 
     $routes->connect('/upload', ['controller' => 'Upload', 'action' => 'index']);
     $routes->connect('/*', ['controller' => 'Api', 'action' => 'error']);
    
});


Plugin::routes();
