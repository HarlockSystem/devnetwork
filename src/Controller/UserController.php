<?php

namespace DNW\Controller;

use JPM\Controller\Controller;
use JPM\HTTP\Request;

/**
 * Description of UserController
 *
 * @author linkus
 */
class UserController extends Controller
{

    /**
     * list users
     * 
     * @param int $page
     */
    public function indexAction($page)
    {
        $users = $this->get('UserTool')->getUsers($page);

        return $this->render('User/index.html', ['users' => $users]);
    }

    /**
     * Display an user
     * 
     * @param int $id
     */
    public function showAction($id)
    {
        $user = $this->get('UserTool')->showUser($id);
        if (!$user) {
            // throw error/ 404
            die('user not found: redirect/404');
        }

        $posts = $this->get('PostManager')->findPostByUser($id);


        return $this->render('User/show.html', [
                    'user' => $user,
                    'posts' => $posts
        ]);
    }

    /**
     * Add a new user
     * 
     * @param Request $request
     */
    public function newAction(Request $request)
    {


        if ($request->server->get('REQUEST_METHOD') == 'POST') {
            $user = $this->get('UserTool')->addUser($request);
            if (is_string($user)) {
                // error as string
                // pass error as flash session?
                echo '<pre>';
                print_r($user);
                echo '</pre>';
                exit;
            } else {
                return $this->redirectToRoute('UserShow', ['id' => $user->getId()]);
            }
        }

        return $this->render('User/new.html');
    }

    public function editAction(Request $request, $id)
    {
 
        //check session usrid = id

        if ($request->server->get('REQUEST_METHOD') == 'PUT') {
            $user = $this->get('UserTool')->addUser($request);
        } else {
            $user = $this->get('UsertTool')->showUser($id);
            if (!$user) {
                // throw error/ 404
            }
        }
        $user = $this->get('UserManager')->findById(1);
        
        return $this->render('User/edit.html', ['user' => $user ]);
    }

    /**
     * Delete an user (soft)
     * @param int $id
     */
    public function deleteAction($id)
    {
        
    }

    /**
     * Log/Sign in
     */
    public function loginAction()
    {
        return $this->render('User/login.html');
    }

    /**
     * Log out
     */
    public function logoutAction()
    {
        
    }

    /**
     * Check user id
     */
    public function processAction(Request $request)
    {
        $user = $this->get('UserTool')->checkUser($request->request->get('login'), $request->request->get('pass'));
        echo '<pre>';
        var_export($user);
        echo '</pre>';
        exit;
    }

}
