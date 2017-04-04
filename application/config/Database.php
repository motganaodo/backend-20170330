<?php
/**
* 
*/
class Database
{
    protected $database_name = 'testsite';
    protected $username = 'root';
    protected $password = '123456';

    protected $dbh;
    
    public function __construct()
    {
        try{
            $this->dbh = new PDO('mysql:host=localhost;dbname=' . $this->database_name, $this->username, $this->password);
        }catch(PDOException $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }

    /**
     * 
     * @param  string $sql    
     * @param  array $params    values for prepare statement sql
     * @return mixed
     */
    public function query($sql, $params)
    {
        $stmt = $dbh->prepare($sql);
        for ($i = 1; $i < count($params); $i++) {
            $stmt->bindParam($i, $params[$i]);
        }
        return $stmt->execute();
    }
}
?>