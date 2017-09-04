<?php

namespace JPM\DB\QueryBuilder;

use JPM\DB\QueryBuilder\Query;
use JPM\DB\QueryBuilder\ExprBuilder;

/**
 * 
 * @author linkus
 */
class QueryBuilder
{
    const JOIN = ' JOIN ';
    const LEFT_JOIN = ' LEFT JOIN ';
    const INNER_JOIN = ' INNER JOIN ';
    const SELF_JOIN = ' SELF JOIN ';

    /**
     * @var array query parts
     */
    protected $stmt = [];

    /**
     * @var array query parameters 
     */
    protected $parameters = [];

    /**
     * @var Query query object
     */
    protected $query;

    /**
     * @var ExprBuilder expression object
     */
    protected $expr;

    public function __construct()
    {
        $this->query = new Query();
        $this->expr = new ExprBuilder();
    }

    /**
     * Generate a SELECT clause. All clauses are overrided
     * 
     * @param string $queryPart
     * 
     * @return QueryBuilder
     */
    public function select($queryPart)
    {
        $this->stmt[] = [
            'query' => $queryPart,
            'clause' => 'select'
        ];
        return $this;
    }

    /**
     * Generate a FROM clause. All clauses are overrided
     * 
     * @param string $queryPart
     * 
     * @return QueryBuilder
     */
    public function from($queryPart)
    {
        $this->stmt[] = [
            'query' => $queryPart,
            'clause' => 'from'
        ];
        return $this;
    }

    /**
     * Generate a JOIN clause. All clauses are added
     * 
     * @param string $table target table
     * @param mixed $relation join condition
     * @param string $joinType join type
     * 
     * @return QueryBuilder
     */
    public function join($table, $relation, $joinType = self::JOIN)
    {
        $this->stmt[] = [
            'query' => [$table, $relation, $joinType],
            'clause' => 'join'
        ];
        return $this;
    }

    /**
     * Generate a WHERE (AND) clause. All clauses are added
     * 
     * @param string $queryPart
     * 
     * @return QueryBuilder
     */
    public function andWhere($queryPart)
    {
        $this->stmt[] = [
            'query' => $queryPart,
            'clause' => 'andWhere'
        ];
        return $this;
    }

    /**
     * Generate a WHERE (OR) clause. All clauses are added
     * 
     * @param string $queryPart
     * 
     * @return QueryBuilder
     */
    public function orWhere($queryPart)
    {
        $this->stmt[] = [
            'query' => $queryPart,
            'clause' => 'orWhere'
        ];
        return $this;
    }

    /**
     * Generate a GROUP BY clause. All clauses are overrided
     * 
     * @param string $queryPart
     * 
     * @return QueryBuilder
     */
    public function groupBy($queryPart)
    {
        $this->stmt[] = [
            'query' => $queryPart,
            'clause' => 'groupBy'
        ];
        return $this;
    }

    /**
     * Generate a HAVING clause. All clauses are overrided
     * 
     * @param string $queryPart
     * 
     * @return QueryBuilder
     */
    public function having($queryPart)
    {
        $this->stmt[] = [
            'query' => $queryPart,
            'clause' => 'having'
        ];
        return $this;
    }

    /**
     * Generate a ORDER BY clause. All clauses are added
     * 
     * @param string $field
     * @param $direction $field
     * 
     * @return QueryBuilder
     */
    public function orderBy($field, $direction)
    {
        $this->stmt[] = [
            'query' => $field . ' ' . $direction,
            'clause' => 'orderBy'
        ];
        return $this;
    }

    /**
     * Generate a LIMIT clause. All clauses are overrided
     * 
     * @param int $limit
     * @param int $offset
     * 
     * @return QueryBuilder
     */
    public function range( $limit, $offset = null)
    {
        $this->stmt[] = [
            'query' => trim(($offset ? $offset. ', ': null) . $limit),
            'clause' => 'range'
        ];
        return $this;
    }

    /**
     * 
     * @return ExprBuilder
     */
    public function expr()
    {
        return $this->expr;
    }

    /**
     * Add a parameter to the QueryBuilder
     * 
     * @param string $key
     * @param mixec $value
     * 
     * @return QueryBuilder
     * 
     * @throws \Exception
     */
    public function setParameter($key, $value)
    {
        if (isset($this->parameters[$key])) {
            throw new \Exception('parameter wih key "' . $key . '" already defined');
        }
        $this->parameters[$key] = $value;
        return $this;
    }

    /**
     * return all parameters
     * 
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
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

    /**
     * Generate and return a Query object
     * 
     * @return Query
     */
    public function getQuery()
    {
        $this->query->generate($this->stmt, $this->parameters);
        return $this->query;
    }

}
