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

        $this->render('User/index.html', ['users' => $users]);
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
        }

        return $this->render('User/show.html', ['user' => $user]);
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
                echo '<pre>';
                print_r($user);
                echo '</pre>';
            } else {
                return $this->redirectToRoute('UserShow', ['id' => $user->getId()]);
            }
        }

        return $this->render('User/new.html');
    }

    public function editAction(Request $request, $id)
    {

        if ($request->server->get('REQUEST_METHOD') == 'POST') {
            $user = $this->get('UserTool')->edditUser($request);
        } else {
            $user = $this->get('UsertTool')->showUser($id);
            if (!$user) {
                // throw error/ 404
            }
        }
    }

}
