<?php

class Page {

    public $title;
    public $favicon;
    public $meta;
    public $stylesheets;
    public $scipts;
    public $urlBase;
    public $variables;
    private $headStylesheets = array();

    public function __construct($props) {

        if(isset($props->title)) {
            $this->title = $props->title;
        }

        if(isset($props->favicon)) {
            $this->favicon = $props->favicon;
        }

        if(isset($props->meta)) {
            $this->meta = $props->meta;
        }

        if(isset($props->stylesheets)) {
            $this->stylesheets = $props->stylesheets;
        }

        if(isset($props->scripts)) {
            $this->scipts = $props->scripts;
        }

        if(isset($props->url_base)) {
            $this->urlBase = $props->url_base;
        }

    }

    public function head() {

        $stylesheetsHtml = "";

        if(isset($this->headStylesheets)) {

            foreach($this->headStylesheets as $stylesheet) {
                $stylesheetsHtml .= HTML::tag("link", a(a("rel", "stylesheet"), a("href", $stylesheet)), null);
            }

        }

        echo HTML::tag("head", null,
            HTML::tag("title", null, $this->title) .
            HTML::tag("base", a(a("src", $this->urlBase), a("target", "_blank")), null) .
            $stylesheetsHtml
        );

    }

    public function setVariables($variables) {
        $this->variables = $variables;
    }

    public function end($clientScripts) {

        $htmlScript = ""; //$this->variables;
        /*

        foreach($this->variables as $variable) {
            $onPageScript .= $variable;
        }

        */

        $onloadArr = array();

        foreach($clientScripts as $script) {
            $js = $script->onload();
            if(isset($js)) array_push($onloadArr, $js);
        }

        if(count($onloadArr)) {
            $onloadHtml = "window.onload = (event) => { ";
            foreach($onloadArr as $item) {
                $onloadHtml .= $item;
            }
            $onloadHtml .= " } ";
            $htmlScript .= $onloadHtml;
        }

        foreach($clientScripts as $script) {
            $js = "\n" . $script->end();
            if(isset($js)) $htmlScript .= $js;
        }

        echo HTML::tag("script", null, $htmlScript);

    }

    public function setHeadStylesheets($val) {
        $this->headStylesheets = $val;
    }

}

?>