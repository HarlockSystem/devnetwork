<?php

namespace DNW\Manager;

use DNW\Entity\Comment;

/**
 * Description of PoistManager
 *
 * @author was137
 */
class CommentManager
{

    protected $db;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }
    
    public function findByPost($postId)
    {
        
        $sql = "SELECT * FROM Comment WHERE PostId = :postId ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['postId' => $postId]);
        $comments = [];
        while ($comment = $stmt->fetchObject(Comment::class, [$this->db])) {
            $comments[] = $comment;
        }
        return $comments;
    }

    /**
     * Find comment by id
     * 
     * @param int $id
     * 
     * @return Comment
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM Comment WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id]);
        $comment = $query->fetchObject(Comment::class, [$this->db]);
        return $comment;
    }

    /**
     * Create a comment
     * 
     * @param string $content
     * 
     * @return Comment
     */
    public function create($user, $post, $content)
    {
        $comment = new Comment($this->db);
        $comment->setContent($content);
        $comment->setUser($user);
        $comment->setPost($post);

        $sql = "INSERT INTO Comment (UserId, PostId, content)
                VALUES(:UserId, :PostId, :content)";
        $query = $this->db->prepare($sql);
        $query->execute([
            'UserId' => $comment->getUser()->getId(),
            'PostId' => $comment->getPost()->getId(),
            'content' => $comment->getContent(),
        ]);
        $id = $this->db->lastInsertId();
        return $this->findById($id);
    }

    public function remove(Comment $comment)
    {
        $sql = "DELETE FROM Comment WHERE id=:id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $comment->getId()]);
    }

    public function update(Comment $comment)
    {
        $sql = "UPDATE Comment SET content=:content WHERE id=:id";
        $query = $this->db->prepare($sql);
        $query->execute([
            'content' => $comment->getContent(),
        ]);
        return $this->findById($comment->getId());
    }

}
