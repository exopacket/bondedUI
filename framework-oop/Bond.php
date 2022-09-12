<?php

class Bond {

    private static $app;
    private static $requried = array();
    private static $page;
    private static $layout;
    private static $mountpoints = array();
    private static $mounted = array();

    public static function start($app): void {

    }

    public static function required(...$params) {

        include $_SERVER["DOCUMENT_ROOT"] . "/bondedUI/framework-oop/ui/autoload.php";

    }

    public static function in($obj): void {

        if($obj instanceof Page) {
            self::setPage($obj);
            return;
        }

        if($obj instanceof Layout) {
            self::setLayout($obj);
            return;
        }

    }

    private static function setPage($page) {

        self::$page = $page;

    }

    private static function setLayout($layout) {

        self::$layout = $layout;
        self::$mountpoints = $layout->getMountpoints();

    }

    public static function out(...$params): void {

    }

    public static function mount($where, $what): void {

    }

    public static function pong(...$params): void {

    }

    public static function create(): void {

        echo "<!DOCTYPE html>\n";
        echo "<html>\n";
        if(isset(self::$page)) echo self::$page->head();
        else throw new Exception("Page is not set.");
        if(isset(self::$layout)) echo self::$layout->body();
        else throw new Exception("Layout is not set.");
        if(isset(self::$page)) echo self::$page->end();
        else throw new Exception("Page is not set.");
        echo "</html>";

    }

}