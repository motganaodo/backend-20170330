<?php
defined('DIR_BASE') OR exit('No direct script access allowed');

function home_url()
{
    return ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http') . '://' . $_SERVER['SERVER_NAME']);
}

/**
 * Redirect to url
 * @param  string $url
 * @return default home
 */
function redirect($url = '/')
{
    header('Location: ' . $url);
    exit();
}

/**
 * Debug
 * @param  string $message
 * @return
 */
function log_message($message)
{
    error_log(var_export($message, true) . "\n", 3, DIR_BASE . '/debug/tien-dev.log');
}



?>