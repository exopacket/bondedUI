<?php

namespace hyper;

class Component {

    private $hyperFile;
    private $name;

    public function __construct($name) {

        $this->name = $name;
        $this->hyperFile = new HyperFile($name);

    }

}