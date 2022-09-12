<?php

    function _favicon($val) {
        return a("favicon", $val);
    }

    function _pageTitle($val) {
        return a("title", $val);
    }

    function _scripts(...$vals) {
        return a("scripts", a($vals));
    }

    function _stylesheets(...$vals) {
        return a("stylesheets", a($vals));
    }

    function _meta(...$vals) {
        return a("meta", a($vals));
    }

    function _urlBase($val) {
        return a("url_base", $val);
    }

?>
