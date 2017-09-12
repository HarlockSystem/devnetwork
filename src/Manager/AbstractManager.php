<?php

namespace DNW\Manager;

/**
 * Description of AbstractManager
 *
 * @author was137
 */
abstract class AbstractManager
{

    public function findOneBy(array $criteria)
    {
        $params = [];
        $execute = [];
        foreach ($criteria as $field => $value) {
            $params[] = $field . '=:'.$field;
            $execute[$field] = $value;
        }

        $sql = 'SELECT * FROM '.$this->tableName.' WHERE ' . implode(' AND ', $params) .' LIMIT 1';
        $query = $this->db->prepare($sql);
        $query->execute($execute);
        return $query->fetchObject($this->className);
    }
    
    public function count()
    {
        $sql = 'SELECT COUNT(*) AS count FROM '.$this->tableName;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $c = $stmt->fetch(\PDO::FETCH_ASSOC);
        return isset($c['count']) ? $c['count'] : 0;
    }
    
    public function maxId()
    {
        $sql = 'SELECT id FROM '.$this->tableName.' ORDER BY id DESC LIMIT 1';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $id = $stmt->fetch(\PDO::FETCH_ASSOC);
        return isset($id['id']) ? $id['id'] : 0;
    }

}
