<?php

namespace JPM\DB\QueryBuilder;

/**
 * 
 * @author linkus
 */
class ExprBuilder
{
    /** Comparison objects */
    const EQ = ' = ';
    const NEQ = ' <> ';
    const LT = ' < ';
    const LTE = ' <= ';
    const GT = ' > ';
    const GTE = ' >= ';
    const ISNULL = ' IS NULL ';
    const ISNOTNULL = ' IS NOT NULL ';

    /** Pseudo-function objects */
    const IN = ' IN ';
    const NOTIN = ' NOT IN ';
    const LIKE = ' LIKE ';
    const NOTLIKE = ' NOT LIKE ';
    const BETWEEN = ' BETWEEN ';

    /**
     * 
     * Comparison objects 
     * 
     */

    /**
     * Creates an equality comparison expression with the given arguments.
     *
     * First argument is considered the left expression and the second is the right expression.
     * When converted to string, it will generated a <left expr> = <right expr>. Example:
     *
     *     [php]
     *     // u.id = ?1
     *     $expr->eq('u.id', ':id');
     *
     * @param mixed $x Left expression.
     * @param mixed $y Right expression.
     * 
     * @return string
     */
    public function eq($x, $y)
    {
        return ' ' . $x . self::EQ . $y . ' ';
    }

    /**
     * First argument is considered the left expression and the second is the right expression.
     * When converted to string, it will generated a <left expr> <> <right expr>. Example:
     *
     *     [php]
     *     // u.id <> ?1
     *     $q->where($q->expr()->neq('u.id', '?1'));
     *
     * @param mixed $x Left expression.
     * @param mixed $y Right expression.
     *
     * @return string
     */
    public function neq($x, $y)
    {
        return ' ' . $x . self::NEQ . $y . ' ';
    }

    /**
     * First argument is considered the left expression and the second is the right expression.
     * When converted to string, it will generated a <left expr> < <right expr>. Example:
     *
     *     [php]
     *     // u.id < ?1
     *     $q->where($q->expr()->lt('u.id', '?1'));
     *
     * @param mixed $x Left expression.
     * @param mixed $y Right expression.
     * 
     * @return string
     */
    public function lt($x, $y)
    {
        return ' ' . $x . self::LT . $y . ' ';
    }

    /**
     * First argument is considered the left expression and the second is the right expression.
     * When converted to string, it will generated a <left expr> <= <right expr>. Example:
     *
     *     [php]
     *     // u.id <= ?1
     *     $q->where($q->expr()->lte('u.id', '?1'));
     *
     * @param mixed $x Left expression.
     * @param mixed $y Right expression.
     * 
     * @return string
     */
    public function lte($x, $y)
    {
        return ' ' . $x . self::LTE . $y . ' ';
    }

    /**
     * 
     * First argument is considered the left expression and the second is the right expression.
     * When converted to string, it will generated a <left expr> > <right expr>. Example:
     *
     *     [php]
     *     // u.id > ?1
     *     $q->where($q->expr()->gt('u.id', '?1'));
     *
     * @param mixed $x Left expression.
     * @param mixed $y Right expression.
     * 
     * @return string
     */
    public function gt($x, $y)
    {
        return ' ' . $x . self::GT . $y . ' ';
    }

    /**
     * First argument is considered the left expression and the second is the right expression.
     * When converted to string, it will generated a <left expr> >= <right expr>. Example:
     *
     *     [php]
     *     // u.id >= ?1
     *     $q->where($q->expr()->gte('u.id', '?1'));
     *
     * @param mixed $x Left expression.
     * @param mixed $y Right expression.
     *
     * @return string
     */
    public function gte($x, $y)
    {
        return ' ' . $x . self::GTE . $y . ' ';
    }

    /**
     * Creates an IS NULL expression with the given arguments.
     *
     * @param string $x Field in string format to be restricted by IS NULL.
     *
     * @return string
     */
    public function isNull($x)
    {
        return ' ' . $x . self::ISNULL;
    }

    /**
     * Creates an IS NOT NULL expression with the given arguments.
     *
     * @param string $x Field in string format to be restricted by IS NOT NULL.
     *
     * @return string
     */
    public function isNotNull($x)
    {
        return ' ' . $x . self::ISNOTNULL;
    }

    /**
     * 
     * Pseudo-function objects
     * 
     */

    /**
     * Creates an IN() expression with the given arguments.
     *
     * @param string $x Field in string format to be restricted by IN() function.
     * @param mixed  $y Argument to be used in IN() function.
     *
     * @return string
     */
    public function in($x, $y)
    {
        if (is_array($y)) {
            $y = implode(', ', $y);
        }

        return ' ' . $x . self::IN . '( ' . $y . ' ) ';
    }

    /**
     * Creates a NOT IN() expression with the given arguments.
     *
     * @param string $x Field in string format to be restricted by NOT IN() function.
     * @param mixed  $y Argument to be used in NOT IN() function.
     *
     * @return string
     */
    public function notIn($x, $y)
    {
        if (is_array($y)) {
            $y = implode(', ', $y);
        }

        return ' ' . $x . self::NOTIN . '( ' . $y . ' ) ';
    }

    /**
     * Creates a LIKE() comparison expression with the given arguments.
     *
     * @param string $x Field in string format to be inspected by LIKE() comparison.
     * @param mixed  $y Argument to be used in LIKE() comparison.
     * 
     * @return string
     */
    public function like($x, $y)
    {
        return ' ' . $x . self::LIKE . $y . ' ';
    }

    /**
     * Creates a NOT LIKE() comparison expression with the given arguments.
     *
     * @param string $x Field in string format to be inspected by LIKE() comparison.
     * @param mixed  $y Argument to be used in LIKE() comparison.
     * 
     * @return string
     */
    public function notLike($x, $y)
    {
        return ' ' . $x . self::NOTLIKE . $y . ' ';
    }

    /**
     * Creates an instance of BETWEEN() function, with the given argument.
     *
     * @param mixed   $val Valued to be inspected by range values.
     * @param integer $x   Starting range value to be used in BETWEEN() function.
     * @param integer $y   End point value to be used in BETWEEN() function.
     *
     * @return string
     */
    public function between($val, $x, $y)
    {
        return $val . self::BETWEEN . $x . ' AND ' . $y;
    }

}
