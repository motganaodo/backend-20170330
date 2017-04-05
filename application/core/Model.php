<?php
/**
* 
*/
class Model extends Database
{
    
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * fetch one row in table
     * @param  array $args  table, where-condition, values = array('value_1', 'value_2', ...)
     * @return array or FALSE
     */
    public function fetch_one_row($args)
    {
        $sql = "SELECT * FROM ". $args['table'] ." WHERE ". $args['key'] ."= ? LIMIT 1";
        $stmt = $this->query($sql, $args['values']);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function fetch_all($table, $offset, $limit)
    {
        $offset = ($offset - 1) * $limit;
        $sql = "SELECT * FROM ". $table . " LIMIT ?,?";
        $stmt = $this->query($sql, array($offset, $limit));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>