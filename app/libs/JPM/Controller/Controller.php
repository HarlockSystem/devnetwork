<?php

namespace JPM\Controller;

use JPM\Pimple;

/**
 * Abstract Controller
 * 
 * @todo add helpers
 *
 * @author linkus
 */
abstract class Controller
{
    protected $container;

    /**
     * Load the container when an instance of a controller is called
     * @param Pimple $container
     */
    public function initContainer(Pimple $container)
    {
        $this->container = $container;
    }

    /**
     * Return a service
     * 
     * @param string $id
     * 
     * @return object
     */
    protected function get($id)
    {
        return $this->container[$id];
    }
    
    /**
     * Check if a service exist
     * 
     * @param string $id
     * 
     * @return bool
     */
    protected function has($id)
    {
        return $this->container->offsetExists($id);
    }

}
