<?php

class AppView
{
    private $class;
    private $method;
    protected $vars;

    public function __construct($class, $method, array $vars = array())
    {
        $this->class = $class;
        $this->method = $method;
        $this->vars = $vars;
    }

    public function getTitle()
    {
        return $this->class . "/" . $this->method;
    }

    public function getViewFile()
    {
        $view_file = "./" . $this->class . "/" . $this->method . ".tmp";
        return $view_file;
    }

    public function getVars()
    {
        $vars = $this->vars;
        $vars['_title'] = $this->getTitle();
        return $vars;
    }

    public function render()
    {
        $vars = $this->getVars();
        $vars['_title'] = $this->getTitle();

        require_once PLUGINS_DIR . "vendor/autoload.php";

        Twig_Autoloader::register();

        $loader = new Twig_Loader_Filesystem(VIEW_DIR);
        $twig = new Twig_Environment($loader);
        $template = $twig->loadTemplate($this->getViewFile());
        echo $template->render($this->vars);
    }
}
