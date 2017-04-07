<?php
/**
* table: users
*/
class UserModel extends Model
{   
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get user data
     * @param  string $key      username or email
     * @param  string $value 
     * @return array            user info
     */
    public function get_user($key_name, $value)
    {
        $args = array(
            'table' => 'users',
            'key' => $key_name,
            'values' => array($value)
            );
        return $this->fetch_one_row($args);
    }

    public function get_all_user($paged = 1, $limit = 12)
    {
        return $this->fetch_all('users', $paged, $limit);
    }

    /**
     * 
     * @param  array    $info   array('column' => 'value')
     * @return int              number of rows
     */
    public function create_user($username, $email, $birthdate, $password)
    {
        $info = array(
            'name' => $username,
            'email' => $email,
            'birthdate' => $birthdate,
            'password' => sha1($password),
            'role' => 0
            );
        $stmt = $this->insert('users', $info);
        return $stmt->rowCount();
    }
}
?>