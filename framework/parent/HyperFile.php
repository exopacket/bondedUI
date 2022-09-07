<?php

namespace hyper;

class HyperFile {

    private $info;
    private $template;
    private $scripts;

    public function __construct($name) {

        $contents = file_get_contents("../config/$name.hyper");
        $this->parse($contents);

    }

    private function parse($contents) {



    }

}