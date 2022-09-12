<?php

    //include "MyApplication.php";
    include $_SERVER["DOCUMENT_ROOT"] . "/bondedUI/framework-oop/Bond.php";

    //Bond::start(MyApplication::load());

    Bond::required();

    Bond::in(new Page(
        builder(
            _pageTitle("Test"),
            _favicon("/path/to/favicon"),
            _urlBase("https://www.testing.com"),
        ))
    );

    //Bond::out(out_t::STYLESHEETS_ALL);

    //TODO
    Bond::in(new Layout(builder(
        _mountpoints("app1", "app2", "app3")
    )));

    //Bond::mount("1"); //...

    //Bond::out(out_t::VARIABLES_ALL, out_t::SCRIPTS_ALL);

    Bond::create();

?>