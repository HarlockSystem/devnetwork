<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace JPM\HTTP;

/**
 * Description of Session
 *
 * @author linkus
 */
class Session
{
    protected $session;
    protected $defaultKeys = [
        'userId' => null,
        'userName' => null,
        'isLogged' => false,
        'isAdmin' => false,
    ];

    public function __construct()
    {
        if (!session_start()) {
            throw new \RuntimeException('Failed to start the session');
        }
        $this->session = &$_SESSION;
        $this->init();
    }

    protected function init()
    {
        foreach ($this->defaultKeys as $key => $value) {
            if (!array_key_exists($key, $this->session)) {
                $this->session[$key] = $value;
            }
        }
    }

    public function start()
    {
        
    }

    public function clear()
    {
        $_SESSION = array();
        $this->session = array();
    }

    public function set($key, $value)
    {
        $this->session[$key] = $value;
    }

    public function get($key, $default = null)
    {
        return array_key_exists($key, $this->session) ? $this->session[$key] : $default;
    }

    public function getId()
    {
        return $this->saveHandler->getId();
    }

    public function setUser($userId, $userName)
    {
        $this->set('userId', $userId);
        $this->set('userName', $userName);
    }

    public function getUser()
    {
        return [
            'userId' => $this->get('userId'),
            'userName' => $this->get('userName'),
        ];
    }

}
