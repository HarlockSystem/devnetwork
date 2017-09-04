<?php

namespace DNW\Manager;

use DNW\Entity\User;

/**
 * Description of UserManager
 *
 * @author linkus
 */
class UserManager
{

    protected $db;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM User WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
        $user = $query->fetchObject(User::class);
        return $user;
    }

    public function create(array $params)
    {
        /* Début de la faille spatio-temporelle */
        $user = new User();
        try {
            $user->setLogin($params['login']);
            $user->setPassword($params['password']);
            $user->setEmail($params['email']);
            $user->setFirstname($params['firstname']);
            $user->setLastname($params['lastname']);
            $user->setSkill($params['skill']);
            $user->setBio($params['bio']);
            $user->setJobStatus($params['jobStatus']);
            $user->setCreatedAt($params['createdAt']);
            $user->setUpdatedAt($params['updatedAt']);
            $user->setSettings($params['settings']);
            $user->setImg($params['img']);
            $user->setRole($user::ROLE_USER);
            $user->setEmail($params['statusUser']);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
        /* Fin de la faille */
        $sql = "INSERT INTO User (login, password, email, firstname, lastname, 
                skill, bio, jobStatus, settings, img, role, statusUser) VALUES(
                :login, :password, :email, :firstname, :lastname, 
                :skill, :bio, :jobStatus, :settings, :img, :role, :statusUser)";
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
            'img' => $user->getEmail(),
            'role' => $user->getEmail(),
            'statusUser' => $user->getEmail(),
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
            'img' => $user->getEmail(),
            'role' => $user->getEmail(),
            'statusUser' => $user->getEmail(),
        ]);
        return $this->findById($user->getId());
    }

}
