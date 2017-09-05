<?php

use JPM\Router\Route;

$routes = $container['Router'];

$routes->add('Homepage', new Route('/', ['_controller' => 'Homepage:index'], [], 'GET'));

//User's Url
$routes->add('Users', new Route('/users/{page}', ['_controller' => 'User:index', 'page' => 1], ['page' => '\d+'], 'GET'));
$routes->add('UserAdd', new Route('/user', ['_controller' => 'User:new'], [], ['GET', 'POST']));
$routes->add('UserShow', new Route('/user/{id}', ['_controller' => 'User:show'], ['id' => '\d+'], 'GET'));
$routes->add('UserEdit', new Route('/user/{id}', ['_controller' => 'User:edit'], ['id' => '\d+'], 'PUT'));
$routes->add('UserDel', new Route('/user/{id}', ['_controller' => 'User:delete'], ['id' => '\d+'], 'DELETE'));

$routes->add('Tags', new Route('/tags/{page}', ['_controller' => 'Tag:index', 'page' => 1], ['page' => '\d+'], 'GET'));
$routes->add('Tag', new Route('/tag', ['_controller' => 'Tag:new'], [], 'POST'));
$routes->add('TagShow', new Route('/tag/{name}', ['_controller' => 'Tag:show'], ['name' => '\w+'], 'GET'));
$routes->add('TagEdit', new Route('/tag/{id}', ['_controller' => 'Tag:edit'], ['id' => '\d+'], 'PUT'));
$routes->add('TagDelete', new Route('/tag/{id}', ['_controller' => 'Tag:delete'], ['id' => '\d+'], 'DELETE'));

$routes->add('Posts', new Route('/posts/{page}', ['_controller' => 'Post:index', 'page' => 1], ['page' => '\d+'], 'GET'));
$routes->add('Post', new Route('/post', ['_controller' => 'Post:new'], [], 'POST'));
$routes->add('PostShow', new Route('/post/{name}', ['_controller' => 'Post:show'], ['name' => '\w+'], 'GET'));
$routes->add('PostEdit', new Route('/post/{id}', ['_controller' => 'Post:edit'], ['id' => '\d+'], 'PUT'));
$routes->add('PostDelete', new Route('/post/{id}', ['_controller' => 'Post:delete'], ['id' => '\d+'], 'DELETE'));