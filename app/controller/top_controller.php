<?php

class TopController extends AppController
{
    public function index()
    {
        $msg = "test";
        $this->setVars(get_defined_vars());
    }
}
