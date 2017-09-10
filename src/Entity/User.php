<?php

namespace DNW\Entity;

class User
{
    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;
    const ACTIVE_STATUS = 0;
    const DELETE_STATUS = 1;

    protected $id;
    protected $name;
    protected $email;
    protected $password;
    protected $firstname;
    protected $lastname;
    protected $skill;
    protected $jobs;
    protected $bio;
    protected $jobStatus;
    protected $createdAt;
    protected $updatedAt;
    protected $theme;
    protected $img;
    protected $role;
    protected $statusUser;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getSkill()
    {
        return $this->skill;
    }

    public function getArrSkill()
    {
        if (empty($this->skill)) {
            return [];
        }
        return explode(',', $this->skill);
    }

    public function getJobs()
    {
        return $this->jobs;
    }
    public function getArrJobs()
    {
        if (empty($this->jobs)) {
            return [];
        }
        $jobs = explode(',', $this->jobs);
        $data = [];
        foreach ($jobs as $job){
            $data[] = explode(':', $job);
        }
        return $data;
    }
    public function getBio()
    {
        return $this->bio;
    }

    public function getJobStatus()
    {
        return $this->jobStatus;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getTheme()
    {
        return $this->theme;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getStatusUser()
    {
        return $this->statusUser;
    }

    public function setName($name)
    {

        if (strlen($name) < 4 OR strlen($name) > 65) {
            throw new \Exception('Nom invalide (taille doit être comprise entre 4 et 63 caractères)');
        }
        $this->name = $name;
        return $this;
    }

    public function setEmail($email)
    {
        if (false == filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Email non valide');
        }
        $this->email = $email;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function setSkill($skill)
    {
        $this->skill = $skill;
        return $this;
    }
    
    public function setJobs($jobs)
    {
        $this->jobs = $jobs;
        return $this;
    }

    public function setBio($bio)
    {
        $this->bio = $bio;
        return $this;
    }

    public function setJobStatus($jobStatus)
    {
        $this->jobStatus = $jobStatus;
        return $this;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function setTheme($theme)
    {
        $this->theme = $theme;
        return $this;
    }

    public function setImg($img)
    {
        $this->img = $img;
        return $this;
    }

    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    public function setStatusUser($statusUser)
    {
        $this->statusUser = $statusUser;
        return $this;
    }

}
