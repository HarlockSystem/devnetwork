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
    public function create($title, $content, $contentType)
    {
        $post = new Post();
        try {
            $post->setTitle($title);
            $post->setContent($content);
            $post->setContentType($contentType);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        $sql = "INSERT INTO Post (:title, :content, :contentType)
                VALUES(:title, :content, :contentType)";
        $query = $this->db->prepare($sql);
        $query->execute([
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'contentType' => $post->getContentType(),
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
