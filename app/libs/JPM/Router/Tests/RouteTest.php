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

    public function testSanitize()
    {
        $route = new Route('aaa');
        $err = null;
        try {
            $route->setDefaults(['a' => []]);
        } catch (\Exception $exc) {
            $err = $exc->getMessage();
        }
        $this->assertEquals('Routing requirement for "a" must be a string.', $err);
    }

    public function stringToArray()
    {
        $route = new Route('aaa');
        $route->setMethods('GET');
        $this->assertEquals(['GET'], $route->getMethods());
    }

    /**
     * Fail to generate route pattern
     */
    public function testFailGeneratePattern()
    {
        $route = new Route('aaa');
        $route->setRequirements(['id' => '\d+']);
        $err = null;
        try {
            $route->generatePattern();
        } catch (\Exception $exc) {
            $err = $exc->getMessage();
        }
        $this->assertEquals('Missing pattern in url "aaa" for parametter "id => \d+".', $err);

        $route2 = new Route('aaa/{id}');
        $err2 = null;
        try {
            $route2->generatePattern();
        } catch (\Exception $exc) {
            $err2 = $exc->getMessage();
        }
        $this->assertEquals('Missing parameter "id" in "aaa/{id}".', $err2);
    }

    public function testGeneratePattern()
    {
        $route = new Route('aaa/{id}');
        $route->setRequirements(['id' => '\d+']);
        $route->generatePattern();
        $this->assertEquals('aaa/(\d+)$', $route->getPattern());
        
        $route->setPath('posts/{page}');
        $route->setRequirements(['page' => '\d+']);
        $route->generatePattern();
        $this->assertEquals('posts/(\d+)$', $route->getPattern());
        
        $route->setDefaults(['page' => 1]);
        $route->generatePattern();
        $this->assertEquals('posts/?(\d+|1?)$', $route->getPattern());        
    }

}
