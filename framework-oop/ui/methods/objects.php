<?php

    function _($key, $val) {
        return pair($key, $val);
    }

    function arr(...$vals) {
        return array($vals);
    }

    function pair($key, $val) {
        return (object)[$key => $val];
    }


?>