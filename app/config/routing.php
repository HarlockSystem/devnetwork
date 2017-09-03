<?php

use JPM\Router\Route;
//use JPM\Router\RouteCollection;

//$routes = new RouteCollection;
$routes = $container['Router'];
//echo '<pre>';
//print_r($container);
//echo '</pre>';
//echo '<pre>';
//print_r($routes);
//echo '</pre>';
//exit;

$routes->add('Homepage', new Route('/', ['_controller' => 'Site:Homepage:index'], [], 'GET'));

//User's Url
$routes->add('Users', new Route('/users/{page}', ['_controller' => 'Site:User:index', 'page' => 1], ['page' => '\d+'], 'GET'));
$routes->add('UserAdd', new Route('/user', ['_controller' => 'Site:User:new'], [], 'POST'));
$routes->add('UserShow', new Route('/user/{id}', ['_controller' => 'Site:User:show'], ['id' => '\d+'], 'GET'));
$routes->add('UserEdit', new Route('/user/{id}', ['_controller' => 'Site:User:edit'], ['id' => '\d+'], 'PUT'));
$routes->add('UserDel', new Route('/user/{id}', ['_controller' => 'Site:User:delete'], ['id' => '\d+'], 'DELETE'));

$routes->add('Tags', new Route('/tags/{page}', ['_controller' => 'Site:Tag:index', 'page' => 1], ['page' => '\d+'], 'GET'));
$routes->add('Tag', new Route('/tag', ['_controller' => 'Site:Tag:new'], [], 'POST'));
$routes->add('TagShow', new Route('/tag/{name}', ['_controller' => 'Site:Tag:show'], ['name' => '\w+'], 'GET'));
$routes->add('TagEdit', new Route('/tag/{id}', ['_controller' => 'Site:Tag:edit'], ['id' => '\d+'], 'PUT'));
$routes->add('TagDelete', new Route('/tag/{id}', ['_controller' => 'Site:Tag:delete'], ['id' => '\d+'], 'DELETE'));

$routes->add('Posts', new Route('/posts/{page}', ['_controller' => 'Site:Post:index', 'page' => 1], ['page' => '\d+'], 'GET'));
$routes->add('Post', new Route('/post', ['_controller' => 'Site:Post:new'], [], 'POST'));
$routes->add('PostShow', new Route('/post/{name}', ['_controller' => 'Site:Post:show'], ['name' => '\w+'], 'GET'));
$routes->add('PostEdit', new Route('/post/{id}', ['_controller' => 'Site:Post:edit'], ['id' => '\d+'], 'PUT'));
$routes->add('PostDelete', new Route('/post/{id}', ['_controller' => 'Site:Post:delete'], ['id' => '\d+'], 'DELETE'));