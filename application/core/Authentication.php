<?php
/**
* 
*/
class Authentication
{
    
    public static function is_admin()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 2) {
            return true;
        }
        return false;
    }

    public static function is_login()
    {
        if (isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }
}
?>