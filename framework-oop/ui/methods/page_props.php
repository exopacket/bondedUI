<?php

    function _favicon($val) {
        return a("favicon", $val);
    }

    function _pageTitle($val) {
        return a("title", $val);
    }

    function _scripts(...$vals) {
        return a("scripts", params($vals));
    }

    function _stylesheets(...$vals) {
        return a("stylesheets", params($vals));
    }

    function _meta(...$vals) {
        return a("meta", params($vals));
    }

    function _urlBase($val) {
        return a("url_base", $val);
    }

?>
