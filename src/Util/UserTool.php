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
        $name = $request->request->get('name');
        $pass = $request->request->get('password');
        $email = $request->request->get('email');

        $hasUser = $this->usrMng->findOneBy(['name' => $name]);
        $hasEmail = $this->usrMng->findOneBy(['email' => $email]);

        if ($hasUser or $hasEmail) {
            return 'Name ou E-mail déjà enregistré';
        }

        try {
            $rsp = $this->usrMng->create($name, $pass, $email);
        } catch (\Exception $e) {
            $rsp = $e->getMessage();
        }
        return $rsp;
    }
    
    public function editUser(Request $request, $id)
    {
        $user = $this->usrMng->findById($id);
        if(!$user){
            
        }

        $fields = ['firstname', 'lastname', 'skill', 'jobs', 'bio', 'jobStatus', 'img'];
        foreach ($fields as $field){
            $method = 'set'.ucfirst($field);
            $user->$method($request->request->get($field));
        }
        $this->usrMng->update($user);
        return $user;
        
        
    }

    /**
     * ?????
     * @param type $id
     * @return type
     */
    public function showUser($id)
    {
        $user = $this->usrMng->findById($id);
        /**
         * @todo related data
         */
        return $user;
    }
    
    /**
     * Check User authorozation
     * 
     * @todo bcrypt
     * 
     * @param string $name
     * @param string $pass
     * 
     * @return boolean
     */
    public function checkUser($name, $pass)
    {
        $user = $this->usrMng->findOneBy(['name' => $name]);

        if (!$user) {
            return false;
        }
        if ($user->getPassword() != $pass) {
            return false;
        }
        return $user;
    }
    
    

}
