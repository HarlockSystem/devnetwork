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
        $comment = $query->fetchObject(Comment::class);
        return $comment;
    }

    /**
     * Create a comment
     * 
     * @param string $content
     * 
     * @return Comment
     */
    public function create($content)
    {
        $comment = new Comment();
        try {
            $comment->setContent($content);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        $sql = "INSERT INTO Comment (:content)
                VALUES(:content)";
        $query = $this->db->prepare($sql);
        $query->execute([
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
