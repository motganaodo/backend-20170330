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
     * 
     * @param  string $sql
     * @param  array $params    values for prepare statement sql
     * @return statement
     */
    protected function general_query($sql, $params = array())
    {
        try{
            $stmt = $this->db->prepare($sql);
            for ($i = 0; $i < count($params); $i++) {
                $stmt->bindParam($i+1, $params[$i]);
            }
            $stmt->execute();
            return $stmt;
        }catch(Exception $e) {
            throw new Exception("Query error: ". $e->getMessage(), 1);
        }
    }

    /**
     * fetch one row in table
     * @param  array $args  table, where-condition, values = array('value_1', 'value_2', ...)
     * @return array or FALSE
     */
    protected function fetch_one_row($args)
    {
        $sql = "SELECT * FROM ". $args['table'] ." WHERE ". $args['key'] ."= ? LIMIT 1";
        $stmt = $this->general_query($sql, $args['values']);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function fetch_all($table, $offset, $limit)
    {
        $offset = ($offset + 0 - 1) * $limit;
        $sql = "SELECT * FROM ". $table ." LIMIT ?, ?";
        $stmt = $this->general_query($sql, array($offset, $limit));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @param  string   $table
     * @param  array    $data   array('column' => 'value')
     * @return int              number of rows
     */
    protected function insert($table, $data)
    {
        $columns = $values = $prepare = array();
        foreach ($data as $column => $value) {
            $columns[] = $column;
            $values[] = $value;
            $prepare[] = "?";
        }
        $sql = "INSERT INTO ". $table ." (". implode(",", $columns) .") VALUES (". implode(",", $prepare) . ")";
        $stmt = $this->general_query($sql, $values);
        return $stmt;
    }
}
?>