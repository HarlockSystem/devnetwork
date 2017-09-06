<?php

use JPM\Router\Route;

$routes = $container['Router'];

$routes->add('Homepage', new Route('/', ['_controller' => 'Homepage:index'], [], 'GET'));

//User's Url

// User
$routes->add('Users', new Route('/users/{page}', ['_controller' => 'User:index', 'page' => 1], ['page' => '\d+'], 'GET'));
$routes->add('UserNew', new Route('/user/new', ['_controller' => 'User:new'], [], ['GET', 'POST']));
$routes->add('UserShow', new Route('/user/{id}', ['_controller' => 'User:show'], ['id' => '\d+'], 'GET'));
$routes->add('UserEdit', new Route('/user/{id}', ['_controller' => 'User:edit'], ['id' => '\d+'], 'PUT'));
$routes->add('UserDel', new Route('/user/{id}', ['_controller' => 'User:delete'], ['id' => '\d+'], 'DELETE'));
$routes->add('UserLogin', new Route('/user/login', ['_controller' => 'User:login'], [], 'GET'));
$routes->add('UserLogout', new Route('/user/logout', ['_controller' => 'User:logout'], [], 'GET'));
$routes->add('UserProcess', new Route('/user/process', ['_controller' => 'User:process'], [], 'POST'));

// Tag General
$routes->add('Tags', new Route('/tags/{page}', ['_controller' => 'Tag:index', 'page' => 1], ['page' => '\d+'], 'GET'));

$routes->add('TagShow', new Route('/tag/{name}', ['_controller' => 'Tag:show'], ['name' => '\w+'], 'GET'));
$routes->add('TagEdit', new Route('/tag/{id}', ['_controller' => 'Tag:edit'], ['id' => '\d+'], 'PUT'));
$routes->add('TagDelete', new Route('/tag/{id}', ['_controller' => 'Tag:delete'], ['id' => '\d+'], 'DELETE'));
// Tag on Post
$routes->add('TagPostNew', new Route('/tag/post/{id}', ['_controller' => 'Tag:Postnew'], [], 'POST'));
// Tag on User
$routes->add('TagUserNew', new Route('/tag/user/{id}', ['_controller' => 'Tag:Usernew'], [], 'POST'));

// Post
$routes->add('Posts', new Route('/posts/{page}', ['_controller' => 'Post:index', 'page' => 1], ['page' => '\d+'], 'GET'));
$routes->add('PostNew', new Route('/post/new', ['_controller' => 'Post:new'], [], ['GET', 'POST']));
$routes->add('PostShow', new Route('/post/{id}', ['_controller' => 'Post:show'], ['id' => '\d+'], 'GET'));
$routes->add('PostEdit', new Route('/post/{id}', ['_controller' => 'Post:edit'], ['id' => '\d+'], 'PUT'));
$routes->add('PostDelete', new Route('/post/{id}', ['_controller' => 'Post:delete'], ['id' => '\d+'], 'DELETE'));
// Post by User
$routes->add('PostUser', new Route('/posts_user/{user_id}', ['_controller' => 'Post:postsUserList'], ['user_id' => '\d+'], 'GET'));

// Comment
$routes->add('Comments', new Route('/comments', ['_controller' => 'Comment:index', 'page' => 1], ['page' => '\d+'], 'GET'));
$routes->add('CommentShow', new Route('/comment/{id}', ['_controller' => 'Comment:show'], ['id' => '\d+'], 'GET'));
$routes->add('CommentDelete', new Route('/comment/{id}', ['_controller' => 'Comment:delete'], ['id' => '\d+'], 'DELETE'));
// Comment by Post
$routes->add('CommentAdd', new Route('/comment/new/{id_post}', ['_controller' => 'Comment:add'], ['id_post' => '\d+'], ['GET', 'POST']));
$routes->add('CommentEdit', new Route('/comment/{id}', ['_controller' => 'Comment:edit'], ['id' => '\d+'], 'PUT'));
