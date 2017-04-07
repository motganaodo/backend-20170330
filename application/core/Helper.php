<?php
defined('DIR_BASE') OR exit('No direct script access allowed');

function home_url()
{
    return ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http') . '://' . $_SERVER['SERVER_NAME']);
}

/**
 * Redirect to url
 * @return default home
 */
function redirect($url = '/')
{
    header('Location: '. $url);
    exit();
}

function frontend_class($type) {
    switch ($type) {
        case 'error':
            return 'danger';
            break;
        default:
            return $type;
            break;
    }
}

/**
 * Debug
 * @param  string $message
 * @return
 */
function log_message($message)
{
    error_log( '['. date('Y-M-d | H:i:s') .'] ### '. var_export($message, true) . "\n", 3, DIR_BASE . '/debug/tien-dev.log');
}

function get_user_name()
{
    return $_SESSION['user']['name'];
}

?>