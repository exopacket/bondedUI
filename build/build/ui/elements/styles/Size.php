<?php

class Size {

    public $width;
    public $height;

    public function __construct($width, $height) {
        //TODO check for px or %, if none append px, if null set auto
        $this->height = $height;
        $this->width = $width;
    }

}