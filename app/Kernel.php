<?php

use JPM\HTTP\Request;
use JPM\Pimple;

require __DIR__ . '/config/services.php';
require __DIR__ . '/config/routing.php';

/**
 * Main class for processing request
 *
 * @author linkus
 */
class Kernel
{
    protected $request;
    protected $container;

    /**
     * Initialize a process
     * 
     * @param Request $request
     * @param Pimple $container
     */
    public function __construct(Request $request, Pimple $container)
    {
        $this->request = $request;
        $this->container = $container;
    }
    
    /**
     * Process a request
     * 
     * @return type // need to be a Response object
     */
    public function handle()
    {
        $routes = $this->container['Router'];
        $routes->setServerInfo($this->request->server->all());
        $ctrlCandidat = $routes->run();

        $ctrResolver = $this->container['ControllerResolver'];
        $ctrResolver->setRequest($this->request);
        $ctrResolver->setContainer($this->container);
        
        return $ctrResolver->getController($ctrlCandidat['controller'], $ctrlCandidat['params']);
        
    }

}

$kernel = new Kernel($request, $container);


