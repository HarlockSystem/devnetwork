<?php

namespace DNW\Manager;

use DNW\Entity\Post;
use DNW\Entity\User;

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
    public function findBy($direction , $id)
    {
        $sql = "SELECT * FROM Post ORDER BY id DESC LIMIT 5";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([]);
        $posts = [];
        while ($post = $stmt->fetchObject(Post::class, [$this->db])) {
            $posts[] = $post;
        }
        return $posts;
    }

    public function findPostByUser($userId)
    {
        $sql = "SELECT * FROM Post WHERE UserId = :userId ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['userId' => $userId]);
        $posts = [];
        while ($post = $stmt->fetchObject(Post::class, [$this->db])) {
            $posts[] = $post;
        }
        return $posts;
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
        $post = $query->fetchObject(Post::class, [$this->db]);
        return $post;
    }

    /**
     * Create a post
     * @param type $title
     * @param type $content
     * @param type $contentType
     * @return type
     */
    public function create($title, $content, $contentType, User $user, $language = null)
    {
        $post = new Post($this->db);
        $post->setTitle($title);
        $post->setContent($content);
        $post->setContentType($contentType);
        $post->setUser($user);
        $post->setLanguage($language);


        $sql = "INSERT INTO Post (title, content, contentType, UserId, language)
                VALUES(:title, :content, :contentType, :userId, :language)";
        $query = $this->db->prepare($sql);
        $query->execute([
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'contentType' => $post->getContentType(),
            'userId' => $post->getUser()->getId(),
            'language' => $post->getLanguage(),
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
        $sql = "UPDATE Post SET title=:title, content=:content, updatedAt=:updatedAt WHERE id=:id";
        $query = $this->db->prepare($sql);
        $query->execute([
            'title' => $post->getTitle(),
            'content' => $post->getContent(),
            'updatedAt' => $post->getUpdatedAt(),
            'id' => $post->getId()
        ]);
        return $this->findById($post->getId());
    }

    public function findFavoritesByUser($id_user)
    {
        $sql = "SELECT p.* FROM Post p INNER JOIN FavoriteUserPost fu ON fu.PostId = p.id AND fu.UserId = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id_user]);
        return $query->fetchAll(\PDO::FETCH_CLASS, Post::class, [$this->db]);
    }

}
