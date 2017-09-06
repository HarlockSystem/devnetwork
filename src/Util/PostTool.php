<?php

namespace DNW\Util;

use DNW\Manager\PostManager;
use DNW\Manager\UserManager;
use DNW\Entity\User;
use JPM\HTTP\Request;

class PostTool
{

    protected $postMng;
    protected $usrMng;

    public function __construct(PostManager $postMng, UserManager $usrMng)
    {
        $this->postMng = $postMng;
        $this->usrMng = $usrMng;
    }
    
    public function getPosts($page)
    {
        $posts = $this->postMng->findBy($page);
        /**
         * @todo get tag
         */
        return $posts;
    }
    
    public function addPost(User $user, Request $request)
    {
        $content = $request->request->get('content');
        $title = $request->request->get('title');
        $contentType = $request->request->get('content_type');
        
        $post = $this->postMng->create($title, $content, $contentType, $user);
        return $post;
    }

}
