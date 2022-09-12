<?php

class Margin {

    public $top;
    public $right;
    public $bottom;
    public $left;

    public function __construct($top, $right, $bottom, $left) {

        $this->top = $top;
        $this->right = $right;
        $this->bottom = $bottom;
        $this->left = $left;

    }

    public static function all($val) {
        return new Margin($val, $val, $val, $val);
    }

}