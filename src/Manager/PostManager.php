<?php

namespace DNW\Manager;

use DNW\Entity\Post;

/**
 * Description of PoistManager
 *
 * @author was137
 */
class PostManager
{

    protected $db;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }
    
    /**
     * Get list of posts
     * 
     * @param int $page
     * @param array $criteria
     * 
     * @return arrary
     */
    public function findBy($page, array $criteria = null)
    {
        $sql = "SELECT * FROM Post";
        $query = $this->db->prepare($sql);
        $query->execute([]);
        return $query->fetchAll(\PDO::FETCH_CLASS, Post::class);
    }

    /**
     * Find post by id
     * 
     * @param int $id
     * 
     * @return Post
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM Post WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
        $post = $query->fetchObject(Post::class);
        return $post;
    }

    /**
     * Create a post
     * @param type $title
     * @param type $content
     * @param type $contentType
     * @return type
     */
    public function create($title, $content, $contentType, User $user)
    {
        $post = new Post();
        try {
            $post->setTitle($title);
            $post->setContent($content);
            $post->setContentType($contentType);
            $post->setUser($user);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        $sql = "INSERT INTO Post (title, content, contentType, UserId)
                VALUES(:title, :content, :contentType, :userId)";
        $query = $this->db->prepare($sql);
        $query->execute([
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'contentType' => $post->getContentType(),
            'UserId' => $post->getUser()->getId(),
        ]);
        $id = $this->db->lastInsertId();
        return $this->findById($id);
    }

    public function remove(Post $post)// EN GENERAL, CA SUPPRIME PAS
    {
        $sql = "DELETE FROM Post WHERE id=:id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $post->getId()]);
    }

    public function update(Post $post)
    {
        $sql = "UPDATE Post SET title=:title, content=:content WHERE id=:id";
        $query = $this->db->prepare($sql);
        $query->execute([
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
        ]);
        return $this->findById($post->getId());
    }

}
