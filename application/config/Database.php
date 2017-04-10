<?php
/**
* 
*/
class Database
{
    protected $database_name = 'testsite';
    protected $username = 'root';
    protected $password = '123456';

    protected $db;
    
    public function __construct()
    {
        try{
            $this->db = new PDO('mysql:host=localhost;dbname=' . $this->database_name, $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }
}
?>