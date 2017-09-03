<?php

namespace JPM\Controller;

use JPM\Pimple;

/**
 * Description of Controller
 *
 * @author linkus
 */
abstract class Controller
{
    protected $container;
    protected $containerx;

    public function initContainer(Pimple $container)
    {
        $this->container = $container;
        $this->containerx = 'bite';
        
    }

    protected function get($id)
    {
        return $this->container[$id];
    }

    protected function has($id)
    {
        return $this->container->offsetExists($id);
//        return $this->containerx;
    }

}
