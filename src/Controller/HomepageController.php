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
        echo __METHOD__;


        $pdo = $this->get('PDO');
        $stmt = $pdo->prepare('DESCRIBE User');
        $stmt->execute([]);
        $gg = $stmt->fetchAll();
        
        $usrMng = $this->get('UserManager');
    }

}
