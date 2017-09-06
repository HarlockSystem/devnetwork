<?php

namespace DNW\Controller;

use JPM\Controller\Controller;
use JPM\HTTP\Request;

/**
 * Description of CommentController
 *
 * @author was137
 */
class CommentController extends Controller
{

    /**
     * list comments
     * 
     * @param int $page
     */
    public function indexAction($page)
    {
//        $posts = $this->get('PostTool')->getPosts($page);
//
//        return $this->render('Post/index.html', ['posts' => $posts]);
    }

    public function newAction(Request $request, $id_post)
    {
        $post = $this->get('PostManager')->findById($id_post);
        if (!$post) {
            //redirect
        }



        if ($request->server->get('REQUEST_METHOD') == 'POST') {
            
            //use session for id user
            $user = $this->get('UserManager')->findById(1);
            

            $comment = $this->get('CommentTool')->addComment($user, $post, $request);
            if (is_string($comment)) {
                // error as string
                echo '<pre>';
                print_r($user);
                echo '</pre>';
            } else {
                return $this->redirectToRoute('PostShow', ['id' => $post->getId()]);
            }
            echo '<pre>';
            var_export($comment);
            echo '</pre>';
            exit;
        }
        echo '<pre>';
        var_export($post);
        echo '</pre>';
        exit;
    }

}
