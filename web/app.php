<?php

require __DIR__ . '/../vendor/autoload.php';

use JPM\HTTP\Request;

$request = new Request();

require __DIR__ . '/../app/Kernel.php';

$kernel->handle();


// test route
//include('_testRoute.html');

