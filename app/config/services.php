<?php

use JPM\Pimple;
use JPM\Router\RouteCollection;

$container = new Pimple();

// Router
$container['router_class'] = 'JPM\Router\RouteCollection';
$container['Router'] = $container->share(function($c){
    return new $c['router_class']();
});

