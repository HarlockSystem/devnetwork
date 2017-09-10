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
     * Add new comment
     * 
     * @param Request $request
     * @param int $id_post Post id
     * 
     * @return Response
     */
    public function newAction(Request $request, $id_post)
    {
        $post = $this->get('PostManager')->findById($id_post);
        if (!$post) {
            $this->get('Session')->addFlashMsg('alert', 'Impossible de trouver le post#' . $id_post);
            return $this->redirectToRoute('Posts');
        }
        $user = $this->get('UserManager')->findById($this->get('Session')->get('userId'));
        if (!$user) {
            $this->get('Session')->addFlashMsg('warning', 'Vous devez vous connecter pour poster un commentaire');
            return $this->redirectToRoute('UserLogin');
        }

        if ($request->server->get('REQUEST_METHOD') == 'POST') {
            $comment = $this->get('CommentTool')->addComment($user, $post, $request);
            if (is_string($comment)) {
                $this->get('Session')->addFlashMsg('alert', $comment);
            }
        }
        return $this->redirectToRoute('PostShow', ['id' => $id_post]);
    }

}
