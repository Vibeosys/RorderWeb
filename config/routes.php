<?php


use Cake\Core\Plugin;
use Cake\Routing\Router;

Router::defaultRouteClass('DashedRoute');



Router::scope('/', function ($routes) {
    $routes->connect('menu/addnewmenu', ['controller' => 'Menu', 'action' => 'addNewMenu']);
    $routes->connect('menu-category/addnewmenucategory', ['controller' => 'MenuCategory', 'action' => 'addNewMenuCategory']);
    $routes->connect('table-category/addnewtablecategory', ['controller' => 'TableCategory', 'action' => 'addNewTableCategory']);
    $routes->connect('rtables/addnewtables', ['controller' => 'RTables', 'action' => 'addNewTables']);
    $routes->connect('user/addnewuser', ['controller' => 'User', 'action' => 'addNewUser']);
    $routes->connect('mgmtpanel', ['controller' => 'MgmtPanel', 'action' => 'mgmtPanel']);
    $routes->connect('upload', ['controller' => 'MgmtPanel', 'action' => 'upload']);
    $routes->connect('mgmtpanel/edit/id', ['controller' => 'MgmtPanel', 'action' => 'edit','id']);
    $routes->connect('mgmtpanel/managedata', ['controller' => 'MgmtPanel', 'action' => 'manageData']);
    $routes->connect('mgmtpanel/printbill', ['controller' => 'MgmtPanel', 'action' => 'printBill']);
    $routes->connect('logout', ['controller' => 'MgmtPanel', 'action' => 'logout']);
    $routes->connect('salesreport', ['controller' => 'SalesHistory', 'action' => 'getReport']);
    $routes->connect('customervisitreport', ['controller' => 'CustomerVisit', 'action' => 'customerVisitReport']);
    $routes->connect('/', ['controller' => 'MgmtPanel', 'action' => 'login']);
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
