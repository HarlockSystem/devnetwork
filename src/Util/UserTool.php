<?php

namespace DNW\Util;

use DNW\Manager\UserManager;
use JPM\HTTP\Request;
use DNW\Entity\Post;
use DNW\Entity\User;

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
        $pass2 = $request->request->get('password2');
        $email = $request->request->get('email');

        $hasUser = $this->usrMng->findOneBy(['name' => $name]);
        $hasEmail = $this->usrMng->findOneBy(['email' => $email]);

        if ($hasUser or $hasEmail) {
            return 'Name ou E-mail déjà enregistré';
        }
        if($pass != $pass2){
            return 'Votre mot de passe n\'a pas été vérifié';
        }

        $password = password_hash($pass, PASSWORD_BCRYPT);

        try {
            $rsp = $this->usrMng->create($name, $password, $email);
        } catch (\Exception $e) {
            $rsp = $e->getMessage();
        }
        return $rsp;
    }

    public function editUser(Request $request, $id)
    {
        $user = $this->usrMng->findById($id);
        if (!$user) {
            
        }

        $fields = ['firstname', 'lastname', 'theme', 'skill', 'jobs', 'bio', 'jobStatus', 'img'];
        foreach ($fields as $field) {
            $method = 'set' . ucfirst($field);
            $user->$method($request->request->get($field));
        }
        $user->setUpdatedAt(date('Y-m-d H:i:s',time()));
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
        if (password_verify($pass, $user->getPassword())) {
            return $user;
        }
        return false;
    }

    public function addFavoritePost(User $user, Post $post)
    {
        if ($user->getId() != $post->getUser()->getId()) {
            $this->usrMng->addFavorite($user->getId(), $post->getId());
        }
    }

    public function removeFavoritePost(User $user, Post $post)
    {
        $this->usrMng->removeFavorite($user->getId(), $post->getId());
    }

}
