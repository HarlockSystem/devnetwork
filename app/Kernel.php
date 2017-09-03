<?php

use JPM\HTTP\Request;
use JPM\Pimple;

require __DIR__ . '/config/services.php';
require __DIR__ . '/config/routing.php';

/**
 * Description of Kernel
 *
 * @author linkus
 */
class Kernel
{
    protected $request;
    protected $container;

    public function __construct(Request $request, Pimple $container)
    {
        $this->request = $request;
        $this->container = $container;
    }

    public function handle()
    {
        $routes = $this->container['Router'];
        $routes->setServerInfo($this->request->server->all());
        $ctrl = $routes->run();
        echo '<pre>';
        print_r($ctrl);
        echo '</pre>';
    }

}

$kernel = new Kernel($request, $container);


