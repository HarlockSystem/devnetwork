<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerResolver
 *
 * @author linkus
 */
class ControllerResolver
{
    protected $refMeth;
    
    public function __construct()
    {
        $this->reflexion = new \ReflectionMethod;
    }

    public function getController($controllerName, array $properties = [], array $getParameter = [], array $postParameter = [])
    {
        
    }

}
