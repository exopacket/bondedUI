<?php

    function _setStyle(...$vals) {
        return a("styles", params($vals));
    }

    function _setStyleClass(...$vals) {

    }

    function _setId($val) {

    }

    function _child($val) {
        return a("child", $val);
    }

    function _children(...$vals) {
        return a("children", params($vals));
    }


?>