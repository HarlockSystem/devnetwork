<?php

namespace DNW\Util;

use DNW\Manager\UserManager;
use JPM\HTTP\Request;

class UserTool
{

    protected $usrMng;

    public function __construct(UserManager $usrMng)
    {
        $this->usrMng = $usrMng;
    }
    
    /**
     * 
     * @param int $page
     */
    public function getUsers($page)
    {
        $users = $this->usrMng->findBy($page);
        /**
         * @todo related data
         */
        return $users;
        
        
    }

    /**
     * Add an User
     * 
     * @param Request $request
     * 
     * @return string
     */
    public function addUser(Request $request)
    {
        $login = $request->request->get('login');
        $pass = $request->request->get('password');
        $email = $request->request->get('email');

        $hasUser = $this->usrMng->findOneBy(['login' => $login]);
        $hasEmail = $this->usrMng->findOneBy(['email' => $email]);

        if ($hasUser or $hasEmail) {
            return 'Login ou E-mail déjà enregistré';
        }

        try {
            $rsp = $this->usrMng->create($login, $pass, $email);
        } catch (\Exception $e) {
            $rsp = $e->getMessage();
        }
        return $rsp;
    }

    public function showUser($id)
    {
        $user = $this->usrMng->findById($id);
        /**
         * @todo related data
         */
        return $user;
    }

}
