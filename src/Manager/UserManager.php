<?php

namespace DNW\Manager; 

/**
 * Description of UserManager
 *
 * @author linkus
 */
class UserManager
{
    protected $pdo;
    
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}
