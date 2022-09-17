<?php

    function _mountpoints(...$vals) {
       return a("mountpoints", params($vals));
    }

    function _layoutName($val) {
       return a("name", $val);
    }
?>

