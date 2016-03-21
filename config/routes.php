<?php


use Cake\Core\Plugin;
use Cake\Routing\Router;

Router::defaultRouteClass('DashedRoute');



Router::scope('/', function ($routes) {
    $routes->connect('menu/addnewmenu', ['controller' => 'Menu', 'action' => 'addNewMenu']);
    $routes->connect('menu', ['controller' => 'Menu', 'action' => 'menuList']);
    $routes->connect('menu/editmenu', ['controller' => 'Menu', 'action' => 'editMenu']);
    $routes->connect('menucategory/addnewmenucategory', ['controller' => 'MenuCategory', 'action' => 'addNewMenuCategory']);
    $routes->connect('tablecategory/addnewtablecategory', ['controller' => 'TableCategory', 'action' => 'addNewTableCategory']);
    $routes->connect('rtables/addnewtables', ['controller' => 'RTables', 'action' => 'addNewTables']);
    $routes->connect('users', ['controller' => 'User', 'action' => 'usersList']);
    $routes->connect('user/addnewuser', ['controller' => 'User', 'action' => 'addNewUser']);
    $routes->connect('user/edituser', ['controller' => 'User', 'action' => 'editUser']);
    $routes->connect('/', ['controller' => 'MgmtPanel', 'action' => 'consol']);
    $routes->connect('upload', ['controller' => 'MgmtPanel', 'action' => 'upload']);
    $routes->connect('/edit', ['controller' => 'MgmtPanel', 'action' => 'edit']);
    $routes->connect('managedata', ['controller' => 'MgmtPanel', 'action' => 'manageData']);
    $routes->connect('printbill', ['controller' => 'MgmtPanel', 'action' => 'printBill']);
    $routes->connect('billprintpreview', ['controller' => 'MgmtPanel', 'action' => 'printPreview']);
    $routes->connect('logout', ['controller' => 'MgmtPanel', 'action' => 'logout']);
    $routes->connect('tableorders', ['controller' => 'Order', 'action' => 'displayOrders']);
    $routes->connect('takeawayorders', ['controller' => 'Order', 'action' => 'displayOrders']);
    $routes->connect('tablebills', ['controller' => 'Bill', 'action' => 'displayBill']);
    $routes->connect('takeawaybills', ['controller' => 'Bill', 'action' => 'displayBill']);
    $routes->connect('gettables', ['controller' => 'MgmtPanel', 'action' => 'getTables']);
    $routes->connect('gettakeaway', ['controller' => 'MgmtPanel', 'action' => 'getTakeaway']);
    $routes->connect('orderprintpreview', ['controller' => 'OrderDetails', 'action' => 'orderPrintPreview']);
    $routes->connect('salesreport', ['controller' => 'SalesHistory', 'action' => 'getReport']);
    $routes->connect('customervisitreport', ['controller' => 'CustomerVisit', 'action' => 'customerVisitReport']);
    $routes->connect('login', ['controller' => 'MgmtPanel', 'action' => 'login']);
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
