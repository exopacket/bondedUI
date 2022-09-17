<?php

class Layout {

    private $mountpoints = array();
    private $children = array();

    public function __construct(...$params) {

        for($i=0; $i<count($params); $i++) {

            if($params[$i] instanceof stdClass) {
                $props = $params[$i];
            }

            if($params[$i] instanceof Element) {
                array_push($this->children, $params[$i]);
            }

        }

        if(isset($props->mountpoints)) {
            $this->mountpoints = $props->mountpoints;
        }

    }

    public function getMountpoints() {
        return $this->mountpoints;
    }

    public function body() {

        $html = "";

        foreach($this->children as $child) {

            $html .= $child->html();

        }

        return HTML::tag("body", null, $html);
    }

    public function getChildren() {
        return $this->children;
    }

    public function getVars() {

        $vars = "";

        foreach($this->children as $child) {

            $vars .= $child->getVars();

        }

        return $vars;

    }

}