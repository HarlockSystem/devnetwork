<?php

namespace DNW\Entity;

use DNW\Entity\User;
use DNW\Manager\UserManager;
use DNW\Manager\TagManager;

class Post
{
    const CODE = 0;
    const TEXT = 1;

    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    protected $id;
    protected $title;
    protected $contentType;
    protected $content;
    protected $language;
    protected $createdAt;
    protected $updatedAt;
    protected $statusPost;
    protected $UserId;
    protected $user;
    protected $tags;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContentType($mode = false)
    {
        if($mode){
            return $this->contentType == self::CODE ? 'code' : 'text';
        }
        return $this->contentType;
    }

    public function getContent()
    {
        return $this->content;
    }
    public function getLanguage()
    {
        return $this->language;
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
    
    public function getTags($onlyName = false)
    {
        $tagMng = new TagManager($this->pdo);
        $data = $tagMng->findInPost($this->id);

        if($onlyName){
            $tags = [];
            foreach ($data as $tag){
                $tags[] = $tag->getName();
            }
            return implode(', ', $tags);
        }
        return $data;
    }

    public function setTitle($title)
    {
        if (strlen($title) < 4 OR strlen($title) > 65) {
            throw new \Exception('Titre invalide (taille doit être comprise entre 4 et 65 caractères)');
        }
        $this->title = $title;
        return $this;
    }

    public function setContentType($contentType)
    {
        if (in_array($contentType, ['0', 'code'])) {
            $this->contentType = self::CODE;
        } elseif (in_array($contentType, ['1', 'text'])) {
            $this->contentType = self::TEXT;
        } else {
            throw new \Exception('Le type de post n\'est pas déterminé');
        }
        return $this;
    }

    public function setContent($content)
    {
        if (strlen($content) < 4 OR strlen($content) > 1000) {
            throw new \Exception('Code/Text invalide (taille doit être comprise entre 4 et 65 caractères)');
        }
        $this->content = $content;
        return $this;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
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
