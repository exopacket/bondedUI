<?php

    namespace ui;

    include "MyApplication.php";

    // BEGIN INCLUDES
    include "framework-oop/Bond.php";

    Bond::start(MyApplication::load());

    Bond::imports(IMPORTS::DEFAULTS());

    Bond::in(new Page([
            _pageTitle("Test"),
            _favicon("/path/to/favicon"),
            _urlBase("https://www.testing.com"),
        ])
    );

    Bond::out(out_t::STYLESHEETS_ALL);

    //TODO
    Bond::in(new Layout(
        _(
            o("mountpoints", a("1", "2", "3", "4"))
        )
    ));

    Bond::mount("1"); //...

    Bond::out(out_t::VARIABLES_ALL, out_t::SCRIPTS_ALL);

    Bond::close();

?>