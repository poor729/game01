<?php

class AppController
{
    private $vars;

    protected function setVars(array $vars)
    {
        $this->vars = $vars;
    }

    public function getVars()
    {
        return $this->vars;
    }
}
