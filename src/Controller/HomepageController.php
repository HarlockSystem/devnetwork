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

    public function indexAction()
    {
        
        return $this->render('Homepage/homepage.html');
    }

}
