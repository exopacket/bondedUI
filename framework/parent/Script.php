<?php

namespace hyper;

class Script {

    private $name;
    private $js;

    public function __construct($name, $js) {

        $this->name = $name;
        $this->js = $js;

    }

}