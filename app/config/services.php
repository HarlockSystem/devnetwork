<?php

use JPM\Pimple;
use JPM\Router\RouteCollection;

$container = new Pimple();

// Router
$container['router_class'] = 'JPM\Router\RouteCollection';
$container['Router'] = $container->share(function($c){
    return new $c['router_class']();
});

// ControllerResolver
$container['controller_resolver_class'] = 'JPM\Controller\ControllerResolver';
$container['ControllerResolver'] = $container->share(function($c){
    return new $c['controller_resolver_class']();
});
