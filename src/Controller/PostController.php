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
    public function indexAction(Request $request, $page)
    {
        $posts = $this->get('PostTool')->getPosts($page);


        return $this->render('Post/index.html', ['posts' => $posts, 'page' => $page]);
    }

    /**
     * Display a post
     * 
     * @param int $id Post id
     * 
     * @return Response
     */
    public function showAction($id)
    {
        $post = $this->get('PostManager')->findById($id);
        if (!$post) {
            $this->get('Session')->addFlashMsg('alert', 'Impossible de trouver le post#' . $id);
            return $this->redirectToRoute('Posts');
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
     * @param string $type code|text
     * 
     * @return Response
     */
    public function newAction(Request $request, $type)
    {

        if (!$this->get('Session')->isLogged()) {
            $this->get('Session')->addFlashMsg('info', 'Connectez-vous pour envoyer un post');
            return $this->redirectToRoute('UserLogin');
        } else {
            $id = $this->get('Session')->get('userId');
        }

        if ($request->server->get('REQUEST_METHOD') == 'POST') {

            //use session for id user
            $user = $this->get('UserManager')->findById($id);

            $post = $this->get('PostTool')->addPost($user, $type, $request);
            if (is_string($post)) {
                $this->get('Session')->addFlashMsg('alert', $post);
            } else {
                return $this->redirectToRoute('PostShow', ['id' => $post->getId()]);
            }
        }
        return $this->render('Post/new_' . $type . '.html');
    }

    /**
     * Edit a post
     * 
     * @param Request $request
     * @param int $id Post id
     * 
     * @return Response
     */
    public function editAction(Request $request, $id)
    {
        $post = $this->get('PostManager')->findById($id);
        if (!$post) {
            $this->get('Session')->addFlashMsg('alert', 'Impossible de trouver le post#' . $id);
            return $this->redirectToRoute('Posts');
        }

        if (!$this->get('Session')->isUser($post->getUser()->getId())) {
            $this->get('Session')->addFlashMsg('warning', 'Vous n\ếtes pas l\'auteur de ce post');
            return $this->redirectToRoute('UserLogin');
        }
        if ($request->server->get('REQUEST_METHOD') == 'PUT') {
            $postEdited = $this->get('PostTool')->editPost($request, $id);

            if (is_string($postEdited)) {
                $this->get('Session')->addFlashMsg('alert', $postEdited);
            } else {
                $post = $postEdited;
                $this->get('TagTool')->addTagsToPost($post, $request->request->get('tags'));
            }
        }

        return $this->render('Post/edit_' . $post->getContentType(true) . '.html', [
                    'post' => $post
        ]);
    }

    public function deleteAction($id)
    {
        $post = $this->get('PostManager')->findById($id);
        if(!$post){
            $this->get('Session')->addFlashMsg('alert', 'Impossible de trouver le post#' . $id);
            return $this->redirectToRoute('Posts');
        }
        $user = $post->getUser();
        if(!$this->get('Session')->isUser($post->getUser()->getId())){
            $this->get('Session')->addFlashMsg('info', 'Connectez-vous pour supprimer un post');
            return $this->redirectToRoute('UserLogin');
        }
        $this->get('PostManager')->remove($post);
        return $this->redirectToRoute('Posts');
        
    }

}

// Anno 1404
// starcraft 1
