<?php

class Bond {

    private static Application $app;
    private static $requried = array();
    private static Page $page;
    private static Layout $layout;
    private static $mountpoints = array();
    private static $mounted = array();
    private static Handler $handler;

    public static function start($app): void {

        self::$app = $app;

    }

    public static function required(...$params) {

        include $_SERVER["DOCUMENT_ROOT"] . "/bondedUI/build/ui/autoload.php";

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

        if($obj instanceof Handler) {
            self::setHandler($obj);
            return;
        }

    }

    public static function getApi() {
        return self::$app->api();
    }

    private static function setPage($page) {

        self::$page = $page;

    }

    private static function setLayout($layout) {

        self::$layout = $layout;
        self::$mountpoints = $layout->getMountpoints();

    }

    private static function setHandler($handler) {
        self::$handler = $handler;
    }

    public static function getHandler() {
        return self::$handler;
    }

    public static function out(...$params): void {

        for($i=0; $i<count($params); $i++) {

            if($params[$i] == out_t::STYLESHEETS_ALL) {
                self::$page->setHeadStylesheets(self::$app->getStylesheets());
            }

            if($params[$i] == out_t::VARIABLES_ALL) {
                $js = "";
                foreach(self::$mounted as $component) {
                   // $component[1]->
                }
                //self::$page->setVariables(self::$mounted->getVars());
            }

            if($params[$i] == out_t::ONLOAD) {

            }

        }

    }

    public static function mount($where, $what): void {

        if(in_array($where, self::$mountpoints)) {

            $children = self::$layout->getChildren();

            for($i=0; $i<count($children); $i++) {

                if($children[$i]->getName() == $where) {
                    $what->setHandler(self::$handler);
                    $children[$i]->setChild($what);
                    array_push(self::$mounted, array($where, $what));
                    break;
                }

            }

        } else {
            //TODO throw exception
        }

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