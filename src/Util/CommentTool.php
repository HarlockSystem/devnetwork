<?php

namespace DNW\Util;

use DNW\Manager\CommentManager;
use DNW\Entity\User;
use DNW\Entity\Post;
use JPM\HTTP\Request;

/**
 * Description of CommentTool
 *
 * @author was137
 */
class CommentTool
{

    protected $comMng;

    public function __construct(CommentManager $comMng)
            
    {
        $this->comMng = $comMng;
    }

    public function addComment(User $user, Post $post, Request $request)
    {
         
        $content = $request->request->get('content');
        
        try {
            $rsp = $this->comMng->create($user, $post, $content);
        } catch (\Exception $e) {
            $rsp = $e->getMessage();
        }
        return $rsp;
    }

}
