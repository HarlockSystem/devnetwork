<?php

namespace DNW\Manager;

use DNW\Manager\AbstractManager;
use DNW\Entity\User;

/**
 * Description of UserManager
 *
 * @author linkus
 */
class UserManager extends AbstractManager
{

    protected $db;
    protected $className;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
        $this->tableName = 'User';
        $this->className = User::class;
    }

    /**
     * Get list of users
     * 
     * @param tint $page
     * @param array $criteria
     * 
     * @return array 
     */
    public function findBy($page, array $criteria = null)
    {
        $sql = "SELECT * FROM User";
        $query = $this->db->prepare($sql);
        $query->execute([]);
        return $query->fetchAll(\PDO::FETCH_CLASS, User::class);
    }

    /**
     * Find an user by id
     * 
     * @param int $id
     * 
     * @return User
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM User WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
        $user = $query->fetchObject(User::class);
        return $user;
    }

    /**
     * Create an user
     * 
     * @param array $params
     * 
     * @return User
     */
    public function create($login, $password, $email)
    {
        $user = new User();
        $user
                ->setLogin($login)
                ->setPassword($password)
                ->setEmail($email)
                ->setRole($user::ROLE_USER)
                ->setStatusUser(0)
        ;
        $sql = "INSERT INTO User (login, password, email, role, statusUser) 
                VALUES(:login, :password, :email, :role, :statusUser)";
        $query = $this->db->prepare($sql);
        $query->execute([
            'login' => $user->getLogin(),
            'password' => $user->getPassword(),
            'email' => $user->getEmail(),
            'role' => $user->getRole(),
            'statusUser' => $user->getStatusUser(),
        ]);
        $id = $this->db->lastInsertId();
        return $this->findById($id);
    }

    /**
     * Remove an User
     * (soft delete)
     * 
     * @param User $user
     */
    public function remove(User $user)
    {
        $sql = "UPDATE User SET statusUser = :statusUser WHERE id=:id";
        $query = $this->db->prepare($sql);
        $query->execute([
            'id' => $user->getId(),
            'statusUser' => $user::DELETE_STATUS
        ]);
    }

    /**
     * Update an user
     * 
     * @param User $user
     * 
     * @return User
     */
    public function update(User $user)
    {
        $sql = "UPDATE User SET login=:login, 
                password=:pass, 
                email=:email
                firstname=:firstname
                lastname=:lastname
                skill=:skill
                bio=:bio
                jobStatus=:jobStatus
                settings=:settings
                img=:img
                role=:role
                statusUser=:statusUser
                WHERE id=:id";
        $query = $this->db->prepare($sql);
        $query->execute([
            'login' => $user->getLogin(),
            'password' => $user->getPassword(),
            'email' => $user->getEmail(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'skill' => $user->getSkill(),
            'bio' => $user->getBio(),
            'jobStatus' => $user->getJobStatus(),
            'settings' => $user->getSettings(),
            'img' => $user->getImg(),
            'role' => $user->getRole(),
            'statusUser' => $user->getStatusUser(),
            'id' => $user->getId()
        ]);
        return $this->findById($user->getId());
    }

}
