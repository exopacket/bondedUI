<?php

namespace hyper;

class ComponentInfo {

    private $name;
    private $componentName;

    public function __construct($name, $componentName) {

        $this->componentName = $componentName;
        $this->name = $name;

    }

}