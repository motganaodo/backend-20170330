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
    protected function fetch_one_row($table, $field_name, $data)
    {
        $sql = "SELECT * FROM ". $table ." WHERE ". $field_name ." = :". $field_name ." LIMIT 1";
        $args = array(":". $field_name => $data[$field_name]);
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

    protected function count($table)
    {
        $stmt = $this->db->query("SELECT COUNT(id) FROM ". $table);
        return $stmt->fetchColumn();
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

    protected function delete_one($table, $field_name, $data)
    {
        $sql = "DELETE FROM ". $table ." WHERE ". $field_name ." = :". $field_name;
        $args = array(":". $field_name => $data[$field_name]);
        $stmt = $this->general_query($sql, $args);
        return $stmt;
    }

    /**
     * 
     * @param  string   $table      
     * @param  string   $key_name   
     * @param  array    $data       
     * @return                
     */
    protected function update_one($table, $key_name, $data)
    {
        $key = $data[$key_name];
        unset($data['id']);
        
        $update_arg = $values = array();
        foreach ($data as $field_name => $value) {
            $prepare = ":". $field_name;
            $update_arg[] = $field_name ." = ". $prepare;
            $values[$prepare] = $value;
        }
        $sql = "UPDATE ". $table ." SET ". implode(",", $update_arg) ." WHERE ". $key_name ." = :keyname";
        $values[":keyname"] = $key;
        $stmt = $this->general_query($sql, $values);
        return $stmt;
    }

}
?>