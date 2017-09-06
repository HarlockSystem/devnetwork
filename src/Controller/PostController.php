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

        return $this->render('Post/index.html', ['posts' => $posts]);
    }

    /**
     * Display a post
     * 
     * @param int $id
     */
    public function showAction($id)
    {
        $post = $this->get('PostManager')->findById($id);
        if (!$post) {
            // throw error/ 404
        }

        $comments = $this->get('CommentManager')->findByPost($id);

        return $this->render('Post/show.html', [
                    'post' => $post,
                    'comments' => $comments
        ]);
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
         * => go to loggin page
         */
//        $user = $this->

        /**
         * Load
         */
        if ($request->server->get('REQUEST_METHOD') == 'POST') {

            //use session for id user
            $user = $this->get('UserManager')->findById(1);

            $post = $this->get('PostTool')->addPost($user, $request);
            if (is_string($post)) {
                //error
            } else {
                return $this->redirectToRoute('PostShow', ['id' => $post->getId()]);
            }
        }

        return $this->render('Post/new.html');
    }

}

// Anno 1404
// starcraft 1
