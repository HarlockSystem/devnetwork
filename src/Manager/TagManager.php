<?php

namespace DNW\Manager;

use DNW\Entity\Tag;

/**
 * Description of TagManager
 *
 * @author was137
 */
class TagManager
{
    protected $db;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }
    
    /**
     * Find an user by id
     * 
     * @param int $id
     * 
     * @return Tag
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM Tag WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
        $user = $query->fetchObject(Tag::class);
        return $user;
    }
    
    /**
     * Create an tag
     * 
     * @param array $params
     * 
     * @return Tag
     */
    public function create($name, $category)
    {
        $user = new Tag();
        try {
            $user->setName($name);
            $user->setCategory($category);
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }
        $sql = "INSERT INTO User (name, category) 
                VALUES(:name, :category)";
        $query = $this->db->prepare($sql);
        $query->execute([
            'name' => $user->getName(),
            'category' => $user->getCategory(),
        ]);
        $id = $this->db->lastInsertId();
        return $this->findById($id);
    }
    
    /**
     * Remove a Tag
     * (soft delete)
     * 
     * @param User $user
     */
    public function remove(Tag $tag)
    {
        $sql = "DELETE FROM Tag WHERE id=:id";
        $query = $this->db->prepare($sql);
        $query->execute([
            'id' => $tag->getId(),
        ]);
    }
}
