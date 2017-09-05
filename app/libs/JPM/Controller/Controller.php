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

    /**
     * Redirect to a Routename
     * 
     * @param string $pathName
     * @param array $properties
     * @param array $getParameter
     * @param array $postParameter
     */
    protected function redirectToRoute($pathName, array $properties, array $getParameter = [], array $postParameter = [])
    {
        
    }

    protected function render($template, array $data = [])
    {
        $plate = $this->container['Plates'];
        echo $plate->render($template, $data);
    }

}
