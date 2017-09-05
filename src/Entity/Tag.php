<?php

namespace DNW\Entity;


class Tag
{
    
    protected $id;
    protected $name;
    protected $category;
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }


}

