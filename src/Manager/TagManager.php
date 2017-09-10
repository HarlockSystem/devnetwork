<?php

namespace DNW\Manager;

use DNW\Manager\AbstractManager;
use DNW\Entity\Tag;
use DNW\Entity\Post;

/**
 * Description of TagManager
 *
 * @author was137
 */
class TagManager extends AbstractManager
{
    protected $db;
    protected $className;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
        $this->tableName = 'Tag';
        $this->className = Tag::class;
    }
    
    /**
     * Find a tag by id
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
        $tag = $query->fetchObject(Tag::class);
        return $tag;
    }
    
    public function findInPost($id)
    {
        $sql = "SELECT t.id, t.name FROM Tag t INNER JOIN PostTag pt ON pt.TagId = t.id WHERE pt.PostId = :id";
        $query = $this->db->prepare($sql);
        $query->execute([
            'id' => $id
        ]);
        return $query->fetchAll(\PDO::FETCH_CLASS, Tag::class);
    }


    /**
     * Create an tag
     * 
     * @param array $params
     * 
     * @return Tag
     */
    public function create($name)
    {
        $tag = new Tag();
        try {
            $tag->setName($name);
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }
        $sql = "INSERT INTO Tag (name) VALUES(:name)";
        $query = $this->db->prepare($sql);
        $query->execute([
            'name' => $tag->getName(),
        ]);
        $id = $this->db->lastInsertId();
        return $this->findById($id);
    }
    
    /**
     * Remove a Tag
     * (soft delete)
     * 
     * @param $tag Tag
     */
    public function remove(Tag $tag)
    {
        $sql = "DELETE FROM Tag WHERE id=:id";
        $query = $this->db->prepare($sql);
        $query->execute([
            'id' => $tag->getId(),
        ]);
    }
    
    public function addPostTag(Post $post, Tag $tag)
    {
        $sql = "INSERT INTO PostTag (PostId, TagId) VALUES (:postid, :tagid)";
        $query = $this->db->prepare($sql);
        $query->execute([
            'postid' => $post->getId(),
            'tagid' => $tag->getId(),
        ]);
    }
    
    public function removeAllTag(Post $post)
    {
        $sql = "DELETE FROM PostTag WHERE PostId = :postid";
        $query = $this->db->prepare($sql);
        $query->execute([
            'postid' => $post->getId(),
        ]);
    }
}
