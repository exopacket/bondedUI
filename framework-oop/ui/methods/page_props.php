<?php

    function _favicon($val) {
        return _("favicon", $val);
    }

    function _pageTitle($val) {
        return _("title", $val);
    }

    function _scripts(...$vals) {
        return _("scripts", arr($vals));
    }

    function _stylesheets(...$vals) {
        return _("stylesheets", arr($vals));
    }

    function _meta(...$vals) {
        return _("meta", arr($vals));
    }

    function _urlBase($val) {
        return _("url_base", $val);
    }

?>
