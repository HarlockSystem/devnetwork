<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace JPM\HTTP;

/**
 * Description of ParamContainer
 *
 * @author linkus
 */
class ParamContainer
{
    protected $parameters;
    
    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }
    
    /**
     * Returns a parameter by name.
     *
     * @param string $key     The key
     * @param mixed  $default The default value if the parameter key does not exist
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return array_key_exists($key, $this->parameters) ? $this->parameters[$key] : $default;
    }
    
    /**
     * Sets a parameter by name.
     *
     * @param string $key   The key
     * @param mixed  $value The value
     */
    public function set($key, $value)
    {
        $this->parameters[$key] = $value;
    }
    
    /**
     * Returns true if the parameter is defined.
     *
     * @param string $key The key
     *
     * @return bool true if the parameter exists, false otherwise
     */
    public function has($key)
    {
        return array_key_exists($key, $this->parameters);
    }
    
    /**
     * Removes a parameter.
     *
     * @param string $key The key
     */
    public function remove($key)
    {
        unset($this->parameters[$key]);
    }
    
    /**
     * Returns the parameters.
     *
     * @return array An array of parameters
     */
    public function all()
    {
        return $this->parameters;
    }
    
}
