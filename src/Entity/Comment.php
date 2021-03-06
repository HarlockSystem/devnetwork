<?php

namespace DNW\Entity;

use DNW\Entity\User;
use DNW\Entity\Post;

class Comment
{

    protected $id;
    protected $content;
    protected $createdAt;
    protected $updatedAt;
    
    protected $PostId;
    protected $post;
    protected $UserId;
    protected $user;

    public function getId()
    {
        return $this->id;
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

}
