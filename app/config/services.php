<?php

use JPM\Pimple;

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
    return new $c['pdo_class']($c['param_pdo_dns'], $c['param_pdo_user'], $c['param_pdo_pass'], $c['param_pdo_opt']);
});

// Templating
$container['template_class'] = 'League\Plates\Engine';
$container['param_template_source'] = realpath(__DIR__ . '/../../src/viewstest');
$container['Plates'] = $container->share(function($c) {
    return new $c['template_class']($c['param_template_source']);
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
// PostManager
$container['post_manager_class'] = '\DNW\Manager\PostManager';
$container['PostManager'] = $container->share(function($c) {
    return new $c['post_manager_class']($c['PDO']);
});
// TagManager
$container['tag_manager_class'] = '\DNW\Manager\TagManager';
$container['TagManager'] = $container->share(function($c) {
    return new $c['tag_manager_class']($c['PDO']);
});
// CommentManager
$container['comment_manager_class'] = '\DNW\Manager\CommentManager';
$container['CommentManager'] = $container->share(function($c) {
    return new $c['comment_manager_class']($c['PDO']);
});

// 
$container['user_tool_class'] = '\DNW\Util\UserTool';
$container['UserTool'] = $container->share(function($c) {
    return new $c['user_tool_class']($c['UserManager']);
});

unset($dns);
unset($cfg);
