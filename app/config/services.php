<?php

use JPM\Pimple;
use JPM\Router\RouteCollection;

// load parameters
$cfg = parse_ini_file(__DIR__ . '/params.ini');


$container = new Pimple();


/* * ********************************
 * 
 * Low-level service configuration
 * 
 * ******************************* */

// Router
$container['router_class'] = 'JPM\Router\RouteCollection';
$container['Router'] = $container->share(function($c) {
    return new $c['router_class']();
});

// ControllerResolver
$container['controller_resolver_class'] = 'JPM\Controller\ControllerResolver';
$container['ControllerResolver'] = $container->share(function($c) {
    return new $c['controller_resolver_class']();
});

// PDO
$container['pdo_class'] = '\PDO';
$container['param_pdo_user'] = $cfg['db_user'];
$container['param_pdo_pass'] = $cfg['db_pass'];
$dns = 'mysql:host=' . $cfg['db_host'] . ';dbname=' . $cfg['db_db'] . ';charset=' . $cfg['db_charset'];
$container['param_pdo_dns'] = $dns;
$container['param_pdo_opt'] = [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, // change in prod !!
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES => false,
    \PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false // if selecting a really huge amount of data
];
$container['PDO'] = $container->share(function($c) {
    return new $c['pdo_class']($c['param_pdo_dns'], $c['param_pdo_user'], $c['param_pdo_pass'], ['param_pdo_opt']);
});

/* * ********************************
 * 
 * Framework service configuration
 * 
 * ******************************* */

// UserManager
$container['user_manager_class'] = '\DNW\Manager\UserManager';
$container['UserManager'] = $container->share(function($c) {
    return new $c['user_manager_class']($c['PDO']);
});




unset($dns);
unset($cfg);
