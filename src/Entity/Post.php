<?php

namespace DNW\Entity;

use DNW\Entity\User;
use DNW\Manager\UserManager;

class Post
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    protected $id;
    protected $title;
    protected $contentType;
    protected $content;
    protected $createdAt;
    protected $updatedAt;
    protected $statusPost;
    protected $UserId;
    protected $user;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContentType()
    {
        return $this->contentType;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getStatusPost()
    {
        return $this->statusPost;
    }

    public function getUser()
    {
        $usrMng = new UserManager($this->pdo);
        return $usrMng->findById($this->UserId);
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        return $this;
    }

    public function setContent($content)
    {
        $this->content = $content;
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

    public function setStatusPost($statusPost)
    {
        $this->statusPost = $statusPost;
        return $this;
    }

    public function setUser(User $user)
    {
        $this->UserId = $user->getId();
        $this->user = $user;
        return $this;
    }

}
