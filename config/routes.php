<?php


use Cake\Core\Plugin;
use Cake\Routing\Router;

Router::defaultRouteClass('DashedRoute');



Router::scope('/', function ($routes) {
    $routes->connect('menu/addnewmenu', ['controller' => 'Menu', 'action' => 'addNewMenu']);
    $routes->connect('menu-category/addnewmenucategory', ['controller' => 'MenuCategory', 'action' => 'addNewMenuCategory']);
    $routes->connect('table-category/addnewtablecategory', ['controller' => 'TableCategory', 'action' => 'addNewTableCategory']);
    $routes->connect('rtables/addnewtables', ['controller' => 'RTables', 'action' => 'addNewTables']);
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'rorderHome']);
    $routes->connect('/insertMasterData', ['controller' => 'Pages', 'action' => 'insertMasterData']);
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
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
