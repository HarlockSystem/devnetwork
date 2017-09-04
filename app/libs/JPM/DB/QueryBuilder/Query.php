<?php

namespace JPM\DB\QueryBuilder;

/**
 * 
 * @author linkus
 */
class Query
{
    const SELECT = 'SELECT ';
    const FROM = ' FROM ';
    const WHERE = ' WHERE ';
    const JOIN = ' JOIN ';
    const ANDWHERE = ' AND ';
    const ORWHERE = ' OR ';
    const GROUPBY = ' GROUP BY ';
    const HAVING = ' HAVING ';
    const HAVINGAND = ' AND ';
    const ORDERBY = ' ORDER BY ';
    const LIMIT = ' LIMIT ';

    protected $sqlquery;
    protected $parameters;

    /**
     * 
     * @param array $stmt
     * 
     * @param array $parameters
     * 
     * @return $Query
     * 
     * @throws \Exception
     */
    public function generate(array $stmt, array $parameters)
    {
        $this->parameters = $parameters;
        $query = [
            'select' => [],
            'from' => [],
            'join' => [],
            'where' => [],
            'groupBy' => [],
            'having' => [],
            'orderBy' => [],
            'range' => [],
        ];

        foreach ($stmt as $qpart) {
            if ($qpart['clause'] == 'select') {
                $query['select'] = $qpart['query'];
            } elseif ($qpart['clause'] == 'from') {
                $query['from'] = $qpart['query'];
            } elseif ($qpart['clause'] == 'join') {
                $query['join'][] = $qpart['query'];
            } elseif ($qpart['clause'] == 'andWhere' or $qpart['clause'] == 'orWhere') {
                $query['where'][] = [$qpart['clause'], $qpart['query']];
            } elseif ($qpart['clause'] == 'groupBy') {
                $query['groupBy'] = $qpart['query'];
            } elseif ($qpart['clause'] == 'having') {
                $query['having'][] = $qpart['query'];
            } elseif ($qpart['clause'] == 'orderBy') {
                $query['orderBy'][] = $qpart['query'];
            } elseif ($qpart['clause'] == 'range') {
                $query['range'] = $qpart['query'];
            }
        }

        //SELECT
        $sql = self::SELECT . (empty($query['select']) ? ' * ' : $query['select']);
        //FROM
        if (empty($query['from'])) {
            throw new \Exception('clause FROM not found');
        }
        $sql .= self::FROM . $query['from'];
        //JOIN
        foreach ($query['join'] as $queyJoin) {
            $sql .= $queyJoin[2] . $queyJoin[0] . ' ON ' . $queyJoin[1];
        }
        //WHERE
        $hasWhere = false;
        foreach ($query['where'] as $queryWhere) {
            if (false === $hasWhere) {
                $sql .= self::WHERE . $queryWhere[1];
                $hasWhere = true;
            } else {
                if ($queryWhere[0] == 'andWhere') {
                    $sql .= self::ANDWHERE . $queryWhere[1];
                } elseif ($queryWhere[0] == 'orWhere') {
                    $sql .= self::ORWHERE . $queryWhere[1];
                }
            }
        }
        //GROUP BY
        if (!empty($query['groupBy'])) {
            $sql .= self::GROUPBY . $query['groupBy'];
        }
        //HAVING
        $hasHaving = false;
        foreach ($query['having'] as $queryHaving) {
            if (false === $hasHaving) {
                $sql .= self::HAVING . $queryHaving;
                $hasHaving = true;
            } else {
                $sql .= self::HAVINGAND . $queryHaving;
            }
        }
        //ORDER BY
        if (!empty($query['orderBy'])) {
            $sql .= self::ORDERBY . implode(', ', $query['orderBy']);
        }
        //LIMIT
        if (!empty($query['range'])) {
            $sql .= self::LIMIT . $query['range'];
        }

        $this->sqlquery = $sql;

        return $this;
    }

    public function getSQL()
    {
        return $this->sqlquery;
    }

    public function showSQL()
    {
        $this->checkSQL();
        $sql = $this->sqlquery;
        foreach ($this->parameters as $key => $valueToReplace) {
            $needle = ':' . $key;
            if (is_string($valueToReplace)) {
                $valueToReplace = "'$valueToReplace'";
            }
            $pos = strpos($sql, $needle);
            if ($pos !== false) {
                $sql = substr_replace($sql, $valueToReplace, $pos, strlen($needle));
            }
        }
        return $sql;
    }

    public function addParametersFromQb($qbs)
    {
        if (!is_array($qbs)) {
            $qbs = [$qbs];
        }
        foreach ($qbs as $qb) {
            $params = $qb->getParameters();
            foreach ($params as $key => $value) {
                if (isset($this->parameters[$key])) {
                    throw new \Exception('error in adding parameters from QueryBuilder: param "' . $key . '" already exist');
                }
                $this->parameters[$key] = $value;
            }
        }
    }
    
    public function getParameters()
    {
        return $this->parameters;
    }

    public function checkSQL()
    {

        $params = $this->parameters;

        $matchAssoc = null;
        preg_match_all('#:[a-z0-9]+#', $this->sqlquery, $matchAssoc);
        foreach ($matchAssoc[0] as $i => $key) {
            if (isset($params[ltrim($key, ':')])) {
                unset($params[ltrim($key, ':')]);
                unset($matchAssoc[0][$i]);
            }
        }
        if (!empty($params)) {
            $msg = 'Error: some parameters are not assigned: ' . implode(', ', $params);
            throw new \Exception($msg);
        }
        if (!empty($matchAssoc[0])) {
            $msg = 'Error: some parameters are mising: ' . implode(', ', $matchAssoc[0]);
            throw new \Exception($msg);
        }
    }

}
