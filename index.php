<?php
/**
 * Begin
 */
// Report all PHP errors
error_reporting(-1);

define(DIR_BASE, __DIR__);

define(DIR_CORE, DIR_BASE . '/application/core');
define(DIR_CONFIG, DIR_BASE . '/application/config');
define(DIR_CONTROL, DIR_BASE . '/application/controller');
define(DIR_MODEL, DIR_BASE . '/application/model');
define(DIR_VIEW, DIR_BASE . '/application/view');

define(URL, '/');
define(URL_ASSETS, URL . 'assets' );

// Load global function
require_once(DIR_CORE . '/Helper.php');
require_once(DIR_CONFIG . '/Config.php');
require_once(DIR_CONFIG . '/Database.php');
// Load all core
require_once(DIR_CORE . '/Model.php');
require_once(DIR_CORE . '/Controller.php');
require_once(DIR_CORE . '/View.php');

require_once(DIR_CORE . '/Autoload.php');

$autoload = new Autoload($config);
$autoload->run();

?>