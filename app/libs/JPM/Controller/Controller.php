<?php

namespace JPM\Controller;

use JPM\Pimple;
use JPM\HTTP\Response;

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
     */
    protected function redirectToRoute($pathName, array $properties = [], array $params = [])
    {
        $url = $this->container['Router']->generateUrl($pathName, $properties, $params);
        $response = new Response('', 301);
        $response->isRedirect($url);
        return $response;
    }

    protected function render($template, array $data = [])
    {
        

        $data['path'] = $this->container['Router'];
        $data['session'] = $this->container['Session'];
        $plate = $this->container['Plates'];
        $content = $plate->render($template, $data);
        $response = new Response();
        $response->setStatusCode(200);
        $response->setContent($content);
        return $response;
    }

}
