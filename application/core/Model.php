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
            foreach ($params as $key => $data) {
                switch ($data['type']) {
                    case 'int':
                        // Must use intval
                        $stmt->bindParam($key, intval($data['value']), PDO::PARAM_INT);
                        break;
                    default:
                        // Do not convert to string
                        $stmt->bindParam($key, $data['value'], PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
            // Debug
            // ob_start();
            // $stmt->debugDumpParams();
            // log_message(ob_get_clean());
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
    protected function fetch_one_row($table, $key_name, $value)
    {
        $sql = "SELECT * FROM ". $table ." WHERE ". $key_name ."= :email LIMIT 1";
        $args = array(
            ':email' => array('type' => 'string', 'value' => $value),
            );
        $stmt = $this->general_query($sql, $args);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function fetch_all($table, $offset, $limit)
    {
        $offset *= 1;
        $limit *= 1;
        $offset = ($offset - 1) * $limit;
        $sql = "SELECT * FROM ". $table ." LIMIT :offset, :limit";
        $args = array(
            ':offset' => array('type' => 'int', 'value' => $offset),
            ':limit' => array('type' => 'int', 'value' => $limit),
            );
        $stmt = $this->general_query($sql, $args);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 
     * @param  string   $table
     * @param  array    $data   array(
     *                              'column' => array(
     *                                          'type' => '',
     *                                          'value' => ''
     *                                          )
     *                              )
     * @return int              number of rows
     */
    protected function insert($table, $data)
    {
        $columns = $values = $prepare = array();
        foreach ($data as $column => $args) {
            $columns[] = $column;
            $param = ":". $column;
            $prepare[] = $param;
            $values[$param] = $args;
        }
        $sql = "INSERT INTO ". $table ." (". implode(",", $columns) .") VALUES (". implode(",", $prepare) . ")";
        $stmt = $this->general_query($sql, $values);
        return $stmt;
    }
}
?>