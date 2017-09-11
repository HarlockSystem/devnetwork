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
     * User list
     * 
     * @param int $page
     * 
     * @return Response
     */
    public function indexAction($page)
    {
        $users = $this->get('UserTool')->getUsers($page);
        return $this->render('User/index.html', ['users' => $users]);
    }

    /**
     * Display an user
     * 
     * @param int $id User id
     * 
     * @return Response
     */
    public function showAction($id)
    {
        $user = $this->get('UserTool')->showUser($id);
        if (!$user) {
            $this->get('Session')->addFlashMsg('alert', 'Impossible de trouver l\user#' . $id);
            return $this->redirectToRoute('Users');
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
     * 
     * @return Response
     */
    public function newAction(Request $request)
    {
        if ($request->server->get('REQUEST_METHOD') == 'POST') {
            $user = $this->get('UserTool')->addUser($request);
            if (is_string($user)) {
                // $user as string = error msg
                $this->get('Session')->addFlashMsg('alert', $user);
            } else {
                $this->get('Session')->setUser($user->getId(), $user->getName(), $user->getRole(), $user->getTheme());
                return $this->redirectToRoute('UserShow', ['id' => $user->getId()]);
            }
        }
        return $this->render('User/new.html');
    }

    /**
     * Edit an user
     * 
     * @param Request $request
     * @param int $id User id
     * 
     * @return Response
     */
    public function editAction(Request $request, $id)
    {
        if (!$this->get('Session')->isUser($id)) {
            return $this->redirectToRoute('UserLogin');
        }

        if ($request->server->get('REQUEST_METHOD') == 'PUT') {
            $user = $this->get('UserTool')->editUser($request, $id);
            $this->get('Session')->set('theme', $user->getTheme());
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
     * 
     * @param int $id
     * 
     * @return Response
     */
    public function deleteAction($id)
    {
        if (!$this->get('Session')->isUser($id)) {
            return $this->render('User/login.html');
        }
    }

    /**
     * Log/Sign in (connection)
     * 
     * @return Response
     */
    public function loginAction()
    {
        return $this->render('User/login.html');
    }

    /**
     * Log out (connection)
     * 
     * @return Response
     */
    public function logoutAction()
    {
        $this->get('Session')->clear();
        return $this->redirectToRoute('Homepage');
    }

    /**
     * Check user id (connection)
     * 
     * @param Request $request

     * @return Response
     */
    public function processAction(Request $request)
    {
        $user = $this->get('UserTool')->checkUser($request->request->get('name'), $request->request->get('pass'));
        if ($user) {
            $this->get('Session')->setUser($user->getId(), $user->getName(), $user->getRole(), $user->getTheme());
            return $this->redirectToRoute('UserShow', ['id' => $user->getId()]);
        } else {
            $this->get('Session')->addFlashMsg('warning', 'Login ou password invalide');
            return $this->redirectToRoute('UserLogin');
        }
    }

    public function favoriteAction(Request $request, $id_post)
    {
        if (!$this->get('Session')->isLogged()) {
            $this->get('Session')->addFlashMsg('info', 'Connectez-vous pour envoyer un post');
            return $this->redirectToRoute('UserLogin');
        } else {
            $user = $this->get('UserManager')->findById($this->get('Session')->get('userId'));
            if (!$user) {
                
            }
        }
        $post = $this->get('PostManager')->findById($id_post);
        if (!$post) {
            
        }

        if ($request->server->get('REQUEST_METHOD') == 'POST') {
            $user = $this->get('UserTool')->addFavoritePost($user, $post);
        } elseif ($request->server->get('REQUEST_METHOD') == 'DELETE') {
            $user = $this->get('UserTool')->removeFavoritePost($user, $post);
        }

        return $this->redirect($request->headers->get('REFERER'));
    }

    public function favoritesAction($id, $page)
    {
        if (!$this->get('Session')->isUser($id)) {
            return $this->redirectToRoute('UserLogin');
        }
        
        $user = $this->get('UserTool')->showUser($id);
        if (!$user) {
            $this->get('Session')->addFlashMsg('alert', 'Impossible de trouver l\user#' . $id);
            return $this->redirectToRoute('Users');
        }
        
        $posts = $this->get('PostManager')->findFavoritesByUser($id);
        
        return $this->render('User/favorites.html', [
            'user' => $user,
            'posts' => $posts,
        ]);
        
    }

    public function postsAction($id, $page)
    {
        if (!$this->get('Session')->isUser($id)) {
            return $this->redirectToRoute('UserLogin');
        }
        
        $user = $this->get('UserTool')->showUser($id);
        if (!$user) {
            $this->get('Session')->addFlashMsg('alert', 'Impossible de trouver l\user#' . $id);
            return $this->redirectToRoute('Users');
        }
        
        $posts = $this->get('PostManager')->findPostByUser($id);
        
        return $this->render('User/posts.html', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

}
