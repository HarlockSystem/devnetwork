<?php

namespace JPM\Controller;

use JPM\HTTP\Request;
use JPM\Pimple;

/**
 * ControllerResolver
 * 
 * @todo Add Request
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

    public function __construct()
    {
        $this->prefixClass = 'DNW\\Controller\\';
        $this->sufffixClass = 'Controller';
        $this->sufffixMethod = 'Action';
        $this->requestNamespace = 'JPM\HTTP\Request';
    }

    public function getController($controllerName, array $properties = [], array $getParameter = [], array $postParameter = [])
    {
        $classInfo = $this->getClassAndMethod($controllerName);

        $rfx = new \ReflectionMethod($classInfo['class'], $classInfo['method']);
        $rfxParamsName = $rfx->getParameters();
//        var_dump($rfxParamsName);
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

        if (!empty($properties)) {
            $cl = $classInfo['class'] . '::' . $classInfo['method'];
            $msg = sprintf('Some parameters are not defined for "%s": %s.', $cl, implode(', ', $properties));
            throw new \Exception($msg);
        }

        $controller = new $classInfo['class']();
        $controller->initContainer($this->getContainer());
        return call_user_func_array([$controller, $classInfo['method']], $paramsData);

            
    }

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

    public function setContainer(Pimple $container)
    {
        if (empty($this->container)) {
            $this->container = $container;
        }
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function setRequest(Request $request)
    {
        if (empty($this->request)) {
            $this->request = $request;
        }
    }

    public function getRequest()
    {
        if (empty($this->request)) {
            return new Request();
        }
        return $this->request;
    }

}
