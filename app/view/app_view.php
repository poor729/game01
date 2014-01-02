<?php

class AppView
{
    private $class;
    private $method;
    protected $vars;

    public function __construct($class, $method)
    {
        $this->class = $class;
        $this->method = $method;
    }

    public function getTitle()
    {
        return $this->class . "/" . $this->method;
    }

    public function getViewFile()
    {
        $view_file = "./" . $this->class . "/" . $this->method . ".html";
        return $view_file;
    }

    public function setVars($vars)
    {
        $this->vars = $vars;
    }

    public function render()
    {
        $vars = $this->vars;
        $vars['_title'] = $this->getTitle();

        require_once PLUGINS_DIR . "vendor/autoload.php";

        Twig_Autoloader::register();

        $loader = new Twig_Loader_Filesystem(VIEW_DIR);
        $twig = new Twig_Environment($loader);
        $template = $twig->loadTemplate($this->getViewFile());
        echo $template->render($this->vars);
    }
}
