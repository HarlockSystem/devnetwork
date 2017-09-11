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
        'theme' => 'monokai',
        'flashMsg' => [],
        
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

    public function addFlashMsg($type, $msg)
    {
        $this->session['flashMsg'][] = [$type, $msg];
    }

    public function getFlashMsg()
    {
        $data = [];
        if (isset($this->session['flashMsg'])) {
            foreach ($this->session['flashMsg'] as $msg) {
                $data[] = [
                    'type' => $msg[0],
                    'msg' => $msg[1],
                ];
            }
        }
        $this->session['flashMsg'] = [];
        return $data;
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

    public function isLogged()
    {
        return $this->get('isLogged');
    }
    public function isAdmin()
    {
        return $this->get('isAdmin');
    }

    public function isUser($id)
    {
        if (($this->get('userId') == $id and $id > 0) or $this->get('isAdmin')) {
            return true;
        }
        return false;
    }


    public function setUser($userId, $userName, $role, $theme)
    {
        $this->clear();
        $this->init();
        $this->set('userId', $userId);
        $this->set('userName', $userName);
        $this->set('theme', $theme);
        $this->set('isLogged', true);
        $this->set('isAdmin', $role == 1 ? true : false);
    }

    public function debug()
    {
        echo '<pre>';
        print_r($this->session);
        echo '</pre>';
    }

    public function getUser()
    {
        return [
            'id' => $this->get('userId'),
            'name' => $this->get('userName'),
        ];
    }

}
