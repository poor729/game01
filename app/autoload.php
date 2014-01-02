<?php

try {
    // load controller
    $class = ($_GET['class']) ? $_GET['class'] : 'top';
    $method = $_GET['method'] ? $_GET['method'] : 'index';
    $controller_file = CONTROLLER_DIR . "/{$class}_controller.php";
    if (!file_exists($controller_file)) {
        throw new Exception("not found controller:{$controller_file}");
    }
    require_once($controller_file);

    // execute controller
    $class_name = '';
    foreach (explode('_', $class) as $word) {
        $class_name .= ucwords($word);
    }
    $class_name .= "Controller";
    $controller = new $class_name();
    if (!method_exists($controller, $method)) {
        throw new Exception("not found method:{$class_name}/{$method}");
    }
    $controller->{$method}();

    // execute view
    $viewer = new AppView($class, $method);
    $viewer->setVars($controller->getVars());
    $viewer->render();

} catch(Exception $e) {
//    var_dump($e->getMessage());
    require_once(CONTROLLER_DIR . "/error_controller.php");
    $error = new ErrorController();
    $error->index();

    $vars = $error->getVars();
    $vars['msg'] = $e->getMessage();

    $viewer = new AppView("error", "index");
    $viewer->setVars($vars);
    $viewer->render();
}
