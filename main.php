<?php

    //TODO implement list builder (later...)

    include "MyApplication.php";
    include $_SERVER["DOCUMENT_ROOT"] . "/bondedUI/build/ui/global/Mountable.php";
    include $_SERVER["DOCUMENT_ROOT"] . "/bondedUI/build/Bond.php";
    include $_SERVER["DOCUMENT_ROOT"] . "/bondedUI/build/ui/components/DashboardNavBar.php";

    Bond::start(new MyApplication());

    Bond::required();

    class DashboardHandler extends Handler {

        public static function incrementCounter() {

            //TODO create listener, generate javascript, echo variables, call javascript function, update ui
            _client()->javascript("increment", "data.counter++");
            _update("navbar");

        }

        public static function getSearchResultsServer($params) {

            //TODO create listener (onKeyUp), generate javascript with update function
            //TODO contd... generate php GET request on current page
            self::client()->update("navbar", self::api()->call("search", $params));

        }

        public static function getSearchResultsClient() {

            //TODO create listener (onKeyUp), generate javascript with update function
            //TODO contd... generate php GET request on api
            return self::client()->update("navbar", self::api()->fetch("search", "<todo>"));

        }

        public static function purplePage() {

            //TODO create listener, generate javascript -> wireframe update -> mount update -> component update
            //TODO contd... show loader, load page with GET parameter
            return self::client()->changePage("purple.php");

        }

    }


    Bond::in(new Page(
                builder(
                    _pageTitle("Test"),
                    _favicon("/path/to/favicon"),
                    _urlBase("https://www.testing.com"),
                )
            )
        );

    //DashboardHandler is auto-recognized as a handler
    Bond::in(new DashboardHandler());

    //STYLESHEETS_ALL are all the stylesheets set in the Application class
    Bond::out(out_t::STYLESHEETS_ALL);

    //TODO
    Bond::in(
        new Layout(
            builder(
                _mountpoints("app")
            ),
            new Container(
                _setId("app"),
                _setStyle(new Size("100%", null))
            )
        )
    );

    Bond::mount("app", new DashboardNavBar(
            builder(
                _data(
                    builder(
                        //_get("DashboardHandler", "getCounterValue"),
                        _set("company_name", "Acme Widgets, Inc", "")
                    )
                )
            ),
            _handle("increment", action_t::ONCLICK)
            //_handle("updateSearchResults", "DashboardHandler", "getSearchResultsServer");
        )
    ); //...

    //VARIABLES_ALL outputs all data and calls javascript function setData()
    //SCRIPTS_ALL are any page-specific scripts
    Bond::out(out_t::VARIABLES_ALL);

    Bond::create();

?>