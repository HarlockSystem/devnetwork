<?php

namespace JPM\Router\Tests;

use JPM\Router\Route;
use PHPUnit\Framework\TestCase;

/**
 * @todo \Exception don't catch error, \ArgumentCountError (php7) do;
 *
 * @author linkus
 */
class RouteTest extends TestCase
{

    /**
     * Fail if no argument on initialization
     */
    public function testFailInit()
    {
        $err = null;
        try {
            $route = new Route();
        } catch (\ArgumentCountError $exc) {
            $err = $exc->getMessage();
        }
        $this->assertNotNull($err);
    }

    /**
     * Test getters
     */
    public function testGetter()
    {
        $route = new Route('aaa{c}', ['a' => 'b'], ['c' => 'd'], 'GET', 'sub', 'http');
        $this->assertEquals('aaa{c}', $route->getPath());
        $this->assertEquals('b', $route->getDefaults()['a']);
        $this->assertEquals('d', $route->getRequirements()['c']);
        $this->assertEquals('GET', $route->getMethods()[0]);
        $this->assertEquals('sub', $route->getHost());
        $this->assertEquals('http', $route->getSchemes()[0]);
    }

}
