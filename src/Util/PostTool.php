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

    public function getPosts(Request $request)
    {
        $rid = $request->query->get('id');
        $direction = $request->query->get('d');
        if(in_array($direction, ['p', 'n']) and is_numeric($rid)){echo 'ookk';
            $dir = $direction;
            $id = $rid;
        }else{
            $dir = false;
            $id = null;
        }
        echo '<pre>';
        print_r($request->query);
        echo '</pre>';


        $posts = $this->postMng->findBy($dir, $id);
        /**
         * @todo get tag
         */
        return $posts;
    }

    public function addPost(User $user, $type, Request $request)
    {

        $content = $request->request->get('content');
        $language = $request->request->get('language');
        $title = $request->request->get('title');

        try {
            $rsp = $this->postMng->create($title, $content, $type, $user, $language);
        } catch (\Exception $e) {
            $rsp = $e->getMessage();
        }
        return $rsp;
    }

    public function editPost(Request $request, $id)
    {
        $post = $this->postMng->findById($id);
        if (!$post) {
            
        }

        
        try {
            $content = $request->request->get('content');
            if(!empty($content)){
                $post->setContent($content);
            }
            $title = $request->request->get('title');
            if(!empty($title)){
                $post->setTitle($title);
            }
            $post->setUpdatedAt(date('Y-m-d H:i:s',time()));
            $rsp = $this->postMng->update($post);
        } catch (\Exception $e) {
            $rsp = $e->getMessage();
        }
        return $rsp;
    }
    
}
