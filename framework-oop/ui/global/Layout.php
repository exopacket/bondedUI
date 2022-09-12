<?php

class Layout {

    private $mountpoints = array();

    public function __construct($props) {

        if(isset($props->mountpoints)) {
            $this->mountpoints = $props->mountpoints;
        }

    }

    public function getMountpoints() {
        return $this->mountpoints;
    }

    public function body() {
        return HTML::tag("body", null, "<h5>HEADER TEST</h5>");
    }

}