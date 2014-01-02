<?php

class AppController
{
    private $vars;

    public function __construst()
    {

    }

    protected function setVars(array $vars)
    {
        $this->vars = $vars;
    }

    public function getVars()
    {
        return $this->vars;
    }
}
