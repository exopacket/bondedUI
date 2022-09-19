<?php

include $_SERVER["DOCUMENT_ROOT"] . "/bondedUI/build/ui/global/Application.php";

class MyApplication extends Application {

    public function buildThemes(): void {
        // TODO: Implement buildThemes() method.

    }

    public function buildLayouts(): void {
        // TODO: Implement buildLayouts() method.
    }

    public function getStylesheets(): array {
        return array("bootstrap.min.css",
            "bootstrap.rtl.min.css",
           "dashboard.css");
    }

}