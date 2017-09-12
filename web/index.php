<?php

require __DIR__ . '/../vendor/autoload.php';

use JPM\HTTP\Request;

$request = new Request();

echo '<pre>';
print_r($request);
echo '</pre>';
exit;


require __DIR__ . '/../app/Kernel.php';

$response = $kernel->handle();
$response->send();

// test route
//include('_testRoute.html');

