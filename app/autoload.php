<?php

class Autoload
{
    protected $class;
    protected $method;

    public function __construct($class, $method)
    {
        $this->class = $class;
        $this->method = $method;
    }

    public function getControllerPath()
    {
        $controller_file = CONTROLLER_DIR . "/". $this->class . "_controller.php";
        if (!file_exists($controller_file)) {
            throw new Exception("not found controller:{$controller_file}");
        }
        return $controller_file;
    }

    public function getControllerClassName()
    {
        $class_name = '';
        foreach (explode('_', $this->class) as $word) {
            $class_name .= ucwords($word);
        }
        $class_name .= "Controller";
        return $class_name;
    }

    public function dispatch()
    {
        try {
            // execute controller
            require_once($this->getControllerPath());
            $class_name = $this->getControllerClassName();
            $controller = new $class_name();
            if (!method_exists($controller, $this->method)) {
                throw new Exception("not found method:{$class_name}/" . $this->method);
            }
            $controller->{$this->method}();

            // execute view
            $viewer = new AppView($this->class, $this->method, $controller->getVars());
            $viewer->render();

        } catch(Exception $e) {
            // execute controller
            require_once(CONTROLLER_DIR . "/error_controller.php");
            $error = new ErrorController();
            $error->index();

            $vars = $error->getVars();
            $vars['msg'] = $e->getMessage();

            // execute view
            $viewer = new AppView("error", "index", $vars);
            $viewer->render();
        }

    }

}
