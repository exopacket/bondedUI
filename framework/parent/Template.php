<?php

namespace hyper;

class Template {

    private $html;
    private $data;
    private $methods;

    public function __construct($html, $data, $methods) {

        $this->html = $html;
        $this->data = $data;
        $this->methods = $methods;

    }

}