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
     * List users
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

        // posts from user
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
                // $user as string = error msg
                $this->get('Session')->addFlashMsg('alert', $user);
            } else {
                $this->get('Session')->setUser($user->getId(), $user->getName(), $user->getRole());
                return $this->redirectToRoute('UserShow', ['id' => $user->getId()]);
            }
        }
        return $this->render('User/new.html');
    }

    public function editAction(Request $request, $id)
    {
        if (!$this->get('Session')->isUser($id)) {
            return $this->redirectToRoute('UserLogin');
        }

        if ($request->server->get('REQUEST_METHOD') == 'PUT') {
            $user = $this->get('UserTool')->editUser($request, $id);
            return $this->redirectToRoute('UserShow', ['id' => $user->getId()]);
        } else {
            $user = $this->get('UserManager')->findById(1);
            if (!$user) {
              return $this->redirectToRoute('UserLogin');
            }
            return $this->render('User/edit.html', ['user' => $user]);
        }
        

        
    }

    /**
     * Delete an user (soft)
     * @param int $id
     */
    public function deleteAction($id)
    {
        if (!$this->get('Session')->isUser($id)) {
            return $this->render('User/login.html');
        }
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
        $this->get('Session')->clear();
        return $this->redirectToRoute('Homepage');
    }

    /**
     * Check user id
     */
    public function processAction(Request $request)
    {
        $user = $this->get('UserTool')->checkUser($request->request->get('name'), $request->request->get('pass'));
        if ($user) {
            $this->get('Session')->setUser($user->getId(), $user->getName(), $user->getRole());
            return $this->redirectToRoute('UserShow', ['id' => $user->getId()]);
        } else {
            $this->get('Session')->addFlashMsg('warning', 'Login ou password invalide');
            return $this->redirectToRoute('UserLogin');
        }
    }

}
