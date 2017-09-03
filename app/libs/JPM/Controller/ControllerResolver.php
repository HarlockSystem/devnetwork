<?php

namespace JPM\Controller;

use JPM\HTTP\Request;
use JPM\Pimple;

/**
 * Try to load a controller method from
 * a route parameters
 *
 * @author linkus
 */
class ControllerResolver
{
    protected $prefixClass = '';
    protected $sufffixClass = '';
    protected $prefixMethod = '';
    protected $sufffixMethod = '';
    protected $request = null;
    protected $container = null;
    protected $requestNamespace;

    /**
     * Default parameter
     */
    public function __construct()
    {
        $this->prefixClass = 'DNW\\Controller\\';
        $this->sufffixClass = 'Controller';
        $this->sufffixMethod = 'Action';
        $this->requestNamespace = 'JPM\HTTP\Request';
    }

    /**
     * If no error, a method controller is called.
     * The controller is hydrated with the container.
     * 
     * Bonus: the request object is loaded if present in method arguments
     * 
     * @param string $controllerName
     * @param array $properties method arguments
     * @param array $getParameter list of $_GET parameters
     * @param array $postParameter list of $_POST parameters
     * 
     * @return object
     * 
     * @throws \Exception
     */
    public function getController($controllerName, array $properties = [], array $getParameter = [], array $postParameter = [])
    {
        $classInfo = $this->getClassAndMethod($controllerName);

        $rfx = new \ReflectionMethod($classInfo['class'], $classInfo['method']);
        $rfxParamsName = $rfx->getParameters();

        $paramsData = [];
        foreach ($rfxParamsName as $p) {
            $name = $p->getName();
            if (isset($properties[$p->getName()])) {
                $paramsData[$p->getName()] = $properties[$p->getName()];
                unset($properties[$p->getName()]);
                continue;
            }
            if (is_object($p->getClass())) {
                $objType = $p->getClass()->name;
                if ($objType == $this->requestNamespace) {
                    $paramsData[$p->getName()] = $this->getRequest();
                    continue;
                }
            }
            $cl = $classInfo['class'] . '::' . $classInfo['method'];
            $msg = sprintf('parameter "%s" not defined for "%s".', $p->getName(), $cl);
            throw new \Exception($msg);
        }
        
        /**
         * @todo Load $_GET/$_POST into Request
         * (only for forwarding controller)
         */
        
        // check for unload parameters from Route
        if (!empty($properties)) {
            $cl = $classInfo['class'] . '::' . $classInfo['method'];
            $msg = sprintf('Some parameters are not defined for "%s": %s.', $cl, implode(', ', $properties));
            throw new \Exception($msg);
        }

        $controller = new $classInfo['class']();
        $controller->initContainer($this->getContainer());
        return call_user_func_array([$controller, $classInfo['method']], $paramsData);

    }
    
    /**
     * Check if a class/method exist
     * 
     * @param string $controllerName
     * 
     * @return array
     * 
     * @throws \Exception
     */
    protected function getClassAndMethod($controllerName)
    {
        $exp = explode(':', $controllerName);
        $class = $this->prefixClass . $exp[0] . $this->sufffixClass;
        $method = $this->prefixMethod . $exp[1] . $this->sufffixMethod;

        if (false === class_exists($class)) {
            throw new \Exception('class "' . $class . '" from "' . $controllerName . '" not found');
        }
        if (false === method_exists($class, $method)) {
            throw new \Exception('method "' . $method . '" for class "' . $class . '" not found');
        }
        return [
            'class' => $class,
            'method' => $method
        ];
    }

    /**
     * Load the container
     * 
     * @param Pimple $container
     */
    public function setContainer(Pimple $container)
    {
        if (empty($this->container)) {
            $this->container = $container;
        }
    }

    /**
     * get the container
     * 
     * @return Pimple
     */
    public function getContainer()
    {
        return $this->container;
    }
    
    /**
     * Load the request
     * @param Request $request
     */
    public function setRequest(Request $request)
    {
        if (empty($this->request)) {
            $this->request = $request;
        }
    }

    /**
     * When a Request object is called in the controller method,
     * if Request is null, a new obect is created
     * 
     * @return Request
     */
    public function getRequest()
    {
        if (empty($this->request)) {
            return new Request();
        }
        return $this->request;
    }

}
