<?php

namespace DNW\Controller;

use JPM\Controller\Controller;
use JPM\HTTP\Request;

/**
 * Description of UserController
 *
 * @author linkus
 */
class UserController extends Controller
{

    public function indexAction(Request $request, $page)
    {
        echo __METHOD__;
        echo '<pre>page: ';
        print_r($page);
        echo '</pre>';
    }

    public function showAction($id)
    {
        echo __METHOD__;
        echo '<pre>id: ';
        print_r($id);
        echo '</pre>';
    }

}
