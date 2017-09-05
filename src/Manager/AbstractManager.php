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
        $sql = 'SELECT * FROM '.$this->tableName.' WHERE ' . implode(' AND ', $params .' LIMIT 1');
//        echo $sql;
        $query = $this->db->prepare($sql);
        $query->execute($execute);
        return $query->fetchObject($this->className);
    }

}
