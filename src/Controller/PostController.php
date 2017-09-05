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
        $users = $this->get('UserPost')->getPosts($page);

        $this->render('Posts/index.html', ['users' => $users]);
    }
}
