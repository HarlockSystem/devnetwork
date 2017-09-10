<?php

namespace DNW\Controller;

use JPM\Controller\Controller;
use JPM\HTTP\Request;

/**
 * Description of HomePageController
 *
 * @author linkus
 */
class HomepageController extends Controller
{
    
    /**
     * Homepage
     * 
     * @return Response
     */
    public function indexAction()
    {
        
        return $this->render('User/login.html');
    }

}
