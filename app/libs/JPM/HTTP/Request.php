<?php

namespace JPM\HTTP;

use JPM\HTTP\ParamContainer;

/**
 * Load Environnement Data
 *
 * @author linkus
 */
class Request
{
    /**
     * Request body parameters ($_POST).
     *
     * @var \JPM\HTTP\ParamContainer
     */
    public $request;

    /**
     * Query string parameters ($_GET).
     *
     * @var \JPM\HTTP\ParamContainer
     */
    public $query;

    /**
     * Server and execution environment parameters ($_SERVER).
     *
     * @var \JPM\HTTP\ParamContainer
     */
    public $server;

    /**
     * Uploaded files ($_FILES).
     *
     * @var \JPM\HTTP\ParamContainer
     */
    public $files;

    /**
     * Cookies ($_COOKIE).
     *
     * @var \JPM\HTTP\ParamContainer
     */
    public $cookies;

    /**
     * Headers (taken from the $_SERVER).
     *
     * @var \JPM\HTTP\ParamContainer
     */
    public $headers;

    public function __construct()
    {
        $this->initialize();
    }
    
    /**
     * Load data from PHP superglobals
     */
    protected function initialize()
    {
        $this->request = new ParamContainer($_POST);
        $this->query = new ParamContainer($_GET);
        $this->server = new ParamContainer($_SERVER);
        $this->files = new ParamContainer($_FILES);
        $this->cookies = new ParamContainer($_COOKIE);
        $this->headers = new ParamContainer();
        foreach ($this->server->all() as $key => $value) {
            if (0 === strpos($key, 'HTTP_')) {
                $this->headers->set(substr($key, 5), $value);
                $this->server->remove($key);
            }
        }
        if (!$this->server->has('PATH_INFO')) {
            $this->server->set('PATH_INFO', '/');
        }
    }

}
