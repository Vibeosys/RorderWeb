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
    $routes->connect('tablecategory/addnewtablecategory', ['controller' => 'TableCategory', 'action' => 'addNewTableCategory']);
    $routes->connect('rtables/addnewtables', ['controller' => 'RTables', 'action' => 'addNewTables']);
    $routes->connect('rtables', ['controller' => 'RTables', 'action' => 'tableList']);
    $routes->connect('rtables/edittable', ['controller' => 'RTables', 'action' => 'editTable']);
    $routes->connect('users', ['controller' => 'User', 'action' => 'usersList']);
    $routes->connect('user/addnewuser', ['controller' => 'User', 'action' => 'addNewUser']);
    $routes->connect('user/edituser', ['controller' => 'User', 'action' => 'editUser']);
    $routes->connect('recipeitems/addnewrecipeitems', ['controller' => 'RecipeItemMaster', 'action' => 'addNewRecipeItem']);
    $routes->connect('inventory', ['controller' => 'RecipeItemMaster', 'action' => 'inventory']); 
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
    $routes->connect('/edit', ['controller' => 'MgmtPanel', 'action' => 'edit']);
    $routes->connect('managedata', ['controller' => 'MgmtPanel', 'action' => 'manageData']);
    $routes->connect('tableview/placeorder', ['controller' => 'RTables', 'action' => 'tableView']);
    $routes->connect('tableview/generatebill', ['controller' => 'RTables', 'action' => 'tableView']);
    $routes->connect('tableview/cancelorder', ['controller' => 'RTables', 'action' => 'tableView']);
    $routes->connect('tableview/printkot', ['controller' => 'RTables', 'action' => 'tableView']);
    $routes->connect('tableview/managetable', ['controller' => 'RTables', 'action' => 'tableView']);
    $routes->connect('tableview/printbill', ['controller' => 'RTables', 'action' => 'tableView']);
    $routes->connect('billprintpreview', ['controller' => 'MgmtPanel', 'action' => 'printPreview']);
    $routes->connect('logout', ['controller' => 'MgmtPanel', 'action' => 'logout']);
    $routes->connect('tableview/tableorders', ['controller' => 'Order', 'action' => 'displayOrders']);
    $routes->connect('takeawayorders', ['controller' => 'Order', 'action' => 'displayOrders']);
    $routes->connect('tableview/tablebills', ['controller' => 'Bill', 'action' => 'displayBill']);
    $routes->connect('takeawaybills', ['controller' => 'Bill', 'action' => 'displayBill']);
    $routes->connect('gettables', ['controller' => 'MgmtPanel', 'action' => 'getTables']);
    $routes->connect('gettakeaway', ['controller' => 'MgmtPanel', 'action' => 'getTakeaway']);
    $routes->connect('sendmail', ['controller' => 'MgmtPanel', 'action' => 'sendMail']);
    $routes->connect('setcookie', ['controller' => 'MgmtPanel', 'action' => 'setCookie']);
    $routes->connect('getcookie', ['controller' => 'MgmtPanel', 'action' => 'getCookie']);
    $routes->connect('reports', ['controller' => 'MgmtPanel', 'action' => 'reports']);
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
