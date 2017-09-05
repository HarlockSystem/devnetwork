<?php

namespace DNW\Controller;

use JPM\Controller\Controller;
use JPM\HTTP\Request;

/**
 * Description of PostController
 *
 * @author was137
 */
class PostController extends Controller
{
     /**
     * list posts
     * 
     * @param int $page
     */
    public function indexAction($page)
    {
        $posts = $this->get('PostTool')->getPosts($page);

        $this->render('Post/index.html', ['posts' => $posts]);
    }
    
    /**
     * Add a new post
     * 
     * @param Request $request
     */
    public function newAction(Request $request)
    {
        /**
         * User isAuthentified ?
         */
        
        /**
         * Load
         */

        if ($request->server->get('REQUEST_METHOD') == 'POST') {
            $request->request->set('userId');
            $post = $this->get('PostTool')->addPost($request);
            if (is_string($post)) {
                //error
            } else {
                //redirect
            }
        }

        $this->render('Post/new.html');
    }
}

// Anno 1404
// starcraft 1
