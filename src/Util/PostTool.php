<?php

namespace DNW\Util;

use DNW\Manager\PostManager;
use DNW\Manager\UserManager;
use JPM\HTTP\Request;

class PostTool
{

    protected $postMng;
    protected $usrMng;

    public function __construct(PostrManager $postMng, UserManager $usrMng)
    {
        $this->postMng = $postMng;
        $this->usrMng = $usrMng;
    }

}
