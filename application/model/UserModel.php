<?php
/**
* table: users
*/
class UserModel extends Model
{
    protected $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_total()
    {
        return (int)$this->count($this->table);
    }

    /**
     * Get user data
     * @param  string $key      username or email
     * @param  string $value 
     * @return array            user info
     */
    public function get_user($key_name, $value)
    {
        $args = array($key_name => array('type' => 'string', 'value' => $value));
        return $this->fetch_one_row($this->table, $key_name, $args);
    }

    public function get_all_user($paged = 1, $limit = 12)
    {
        return $this->fetch_all($this->table, (int)$paged, $limit);
    }

    /**
     * 
     * @param  array    $info   array('column' => 'value')
     * @return int              number of rows
     */
    public function create_user($username, $email, $birthdate, $password, $role = 0)
    {
        $info = array(
            'name' => array('type' => 'string', 'value' => $username),
            'email' => array('type' => 'string', 'value' => $email),
            'birthdate' => array('type' => 'string', 'value' => $birthdate),
            'password' => array('type' => 'string', 'value' => sha1($password)),
            'role' => array('type' => 'int', 'value' => $role),
            );
        $stmt = $this->insert($this->table, $info);
        return $stmt->rowCount();
    }

    public function delete_user($value, $key_name = '')
    {
        $key = 'id';
        if (!empty($key_name)) {
            $key = $key_name;
        }
        $args = array($key => array('type' => 'int', 'value' => $value));
        return $this->delete_one($this->table, $key, $args)->rowCount();
    }

    public function update_user($id, $username, $birthdate, $password)
    {
        $data = array(
            'id' => array('type' => 'string', 'value' => $id),
            'name' => array('type' => 'string', 'value' => $username),
            'birthdate' => array('type' => 'string', 'value' => $birthdate)
            );
        if (!empty($password)) {
            $data['password'] = array('type' => 'string', 'value' => sha1($password));
        }
        return $this->update_one($this->table, 'id', $data)->rowCount();
    }
}
?>