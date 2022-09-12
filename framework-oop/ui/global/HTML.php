<?php

class HTML {

    public static function tag($type, $attr, $val) {

        $attributes = "";

        if(isset($attr)) {
            for ($i = 0; $i < count($attr); $i++) {

                $_type = $attr[$i][0];
                $_val = $attr[$i][1];

                $attributes .= " $_type='$_val'";

            }
        }

        if(isset($val)) {
            return "<$type $attributes>$val</$type>";
        } else {
            return "<$type $attributes />";
        }

    }

}