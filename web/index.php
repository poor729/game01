<?php

// define constant
define("ROOT_DIR", "../");
define("APP_DIR", ROOT_DIR . "app/");
define("CONTROLLER_DIR", APP_DIR . "controller/");
define("VIEW_DIR", APP_DIR . "view/");
define("CONFIG", APP_DIR . "config/");
define("PLUGINS_DIR", ROOT_DIR . "plugins/");

// load base file
require_once (CONTROLLER_DIR . "app_controller.php");
require_once (VIEW_DIR . "app_view.php");

// dispatcher
require_once (APP_DIR . "autoload.php");
$class = ($_GET['class']) ? $_GET['class'] : 'top';
$method = ($_GET['method']) ? $_GET['method'] : 'index';
$autoload = new Autoload($class, $method);
$autoload->dispatch();
