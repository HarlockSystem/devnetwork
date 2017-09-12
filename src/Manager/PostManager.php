<?php

namespace DNW\Manager;

use DNW\Manager\AbstractManager;
use DNW\Entity\Post;
use DNW\Entity\User;

/**
 * Description of PoistManager
 *
 * @todo refactor pagination
 * 
 * @author was137
 */
class PostManager extends AbstractManager
{
    protected $db;
    protected $className;
    protected $tableName;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
        $this->tableName = 'Post';
        $this->className = Post::class;
    }

    /**
     * Get list of posts
     * 
     * @param int $page
     * @param array $criteria
     * 
     * @return arrary
     */
    public function findBy($page = 1)
    {
        $count = $this->count();
        $limitPerPage = 5;
        $i = 0;
        $p = 0;
        $offset = $page * $limitPerPage - $limitPerPage;
        while ($offset > $count) {
            $offset -= $limitPerPage;
        }

        while ($i < $count) {
            $p++;
            $indexesPage[] = [
                'p' => $p,
                's' => ($page == $p) ? true : false,
                'page' => $page,
            ];
            $i += $limitPerPage;
        }
        $sql = 'SELECT * FROM Post ORDER BY id DESC LIMIT ' . $offset . ', ' . $limitPerPage;
        $stmt = $this->db->prepare($sql);
        $stmt->execute([]);
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Post::class, [$this->db]);
    }

    public function findPostByUser($userId, $page = 1)
    {
        
        $count = $this->count();
        $limitPerPage = 5;
        $i = 0;
        $p = 0;
        $offset = $page * $limitPerPage - $limitPerPage;
        while ($offset > $count) {
            $offset -= $limitPerPage;
        }
        
        while ($i < $count) {
            $p++;
            $indexesPage[] = [
                'p' => $p,
                's' => ($page == $p) ? true : false,
                'page' => $page,
            ];
            $i += $limitPerPage;
        }
        $sql = 'SELECT * FROM Post WHERE UserId = :userId ORDER BY id DESC LIMIT ' . $offset . ', ' . $limitPerPage;
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Post::class, [$this->db]);
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

    public function findFavoritesByUser($id_user, $page = 1)
    {
        $sqlc = 'SELECT COUNT(*) AS count FROM Post p INNER JOIN FavoriteUserPost fu ON fu.PostId = p.id AND fu.UserId = :id';
        $queryc = $this->db->prepare($sqlc);
        $queryc->execute(['id' => $id_user]);
        $idc = $queryc->fetch(\PDO::FETCH_ASSOC);
        $count = isset($idc['count']) ? $idc['count'] : 0;
       

        $limitPerPage = 5;
        $i = 0;
        $p = 0;
        $offset = $page * $limitPerPage - $limitPerPage;
        while ($offset > $count) {
            $offset -= $limitPerPage;
        }
        
        while ($i < $count) {
            $p++;
            $indexesPage[] = [
                'p' => $p,
                's' => ($page == $p) ? true : false,
                'page' => $page,
            ];
            $i += $limitPerPage;
        }
        
        $sql = 'SELECT p.* FROM Post p INNER JOIN FavoriteUserPost fu ON fu.PostId = p.id AND fu.UserId = :id LIMIT ' . $offset . ', ' . $limitPerPage;
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $id_user]);
        return $query->fetchAll(\PDO::FETCH_CLASS, Post::class, [$this->db]);
    }

}
