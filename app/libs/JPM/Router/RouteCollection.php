<?php

namespace JPM\Router;

use JPM\Router\Route;

/**
 * RouteCollection is a collection of registered Route
 */
class RouteCollection
{
    protected $server;
    protected $routeCollection = [];

    public function __construct()
    {
        
    }
    
    /**
     * Add Route to collection. If a route name already exist,
     * it will be overwritted
     * 
     * @param string $routeName
     * @param Route $route
     */
    public function add($routeName, Route $route)
    {
        unset($this->routeCollection[$routeName]);
        $this->routeCollection[$routeName] = $route;
    }

    /**
     * Display registered Route with options
     * 
     * @return array
     */
    public function debugRouter()
    {
        $data = [];
        foreach ($this->routeCollection as $routeName => $route) {
            $data[] = [
                'Name' => $routeName,
                'Method' => empty($route->getMethod) ? 'ANY' : implode(' ', $route->getMethod),
                'Scheme' => empty($route->getSchemes) ? 'ANY' : implode(' ', $route->getSchemes),
                'Host' => empty($route->getHost) ? 'ANY' : $route->getHost,
                'Path' => $route->getPath(),
                'Controller' => $route->getDefaults()['_controller']
            ];
        }

        return $data;
    }

    /**
     * Execute Route matching with controllers
     */
    public function run()
    {
        $this->server = $_SERVER;
        $this->routesMatcher();
    }

    /**
     * Parse routes collection and try to find a Route object
     * with required criteria
     */
    protected function routesMatcher()
    {
        $match = false;
        foreach ($this->routeCollection as $routeName => $route) {
            $match = $this->matchRoute($route);
            if ($match) {
                break;
            }
        }
        if ($match) {
            print_r($match);
        }else{
            // route not found process
        }
    }

    /**
     * Match a Route against an url
     * 
     * @param Route $route
     * 
     * @return false|array
     * 
     * @throws \Exception
     */
    protected function matchRoute(Route $route)
    {
        $data = [];
        $data['path'] = $this->server['PATH_INFO'];

        // match against url
        $matches = null;
        preg_match('#' . $route->getPattern() . '#', $data['path'], $matches);

        if (empty($matches[0])) {
            return false;
        }
        $i = 1;
        foreach ($route->getRequirements() as $key => $v) {
            if (isset($route->getDefaults()[$key])) {
                $data['params'][$key] = $route->getDefaults()[$key];
            }
            if (isset($matches[$i])) {
                if (!empty($matches[$i])) {
                    $data['params'][$key] = $matches[$i];
                }
            }
            $i++;
        }

        // match against method
        if (!empty($route->getMethods())) {
            if (!in_array($this->server['REQUEST_METHOD'], $route->getMethods())) {
                return false;
            }
        }

        if (!isset($route->getDefaults()['_controller'])) {
            throw new \Exception('unable to find controller');
        }
        $data['controller'] = $route->getDefaults()['_controller'];



        return $data;
    }
    
    /**
     * Generate an url from a route name;
     * 
     * @param string $name
     * @param array $params
     * 
     * @return string
     * 
     * @throws \InvalidArgumentException
     */
    public function generateUrl($name, $params = [])
    {
        if (!isset($this->routeCollection[$name])) {
            throw new \InvalidArgumentException('route "' . $name . '" not found');
        }
        $route = $this->routeCollection[$name];
        $url = $route->getPath();
        foreach ($route->getRequirements() as $key => $value) {
            if (!isset($params[$key])) {
                throw new \InvalidArgumentException('param "' . $key . '" for route "' . $name . '" not found');
            }
            $url = str_replace('{' . $key . '}', $params[$key], $url);
            unset($params[$key]);
        }
        return $url;
    }

}