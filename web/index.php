<?php

define("ROOT_DIR", "./..");
define("APP_DIR", ROOT_DIR . "/app");
define("CONTROLLER_DIR", APP_DIR . "/controller");
define("VIEW_DIR", APP_DIR . "/view");
define("CONFIG", APP_DIR . "/config");

// load controller
$class = $_GET['class'];
$method = $_GET['method'];
require (CONTROLLER_DIR . "/{$class}_controller.php");

// execute controller
$class_name = '';
foreach (explode('_', $class) as $word) {
    $class_name .= ucwords($word);
}
$class_name .= "Controller";
$controller = new $class_name();
$controller->{$method}();

// execute view
require (VIEW_DIR . "/{$class}/{$method}.php");
