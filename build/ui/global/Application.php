<?php

abstract class Application {

    private $themes = array();
    private $layouts = array();

    public function load(): Application {
        return $this;
    }

    public abstract function buildThemes(): void;
    public abstract function buildLayouts(): void;
    public abstract function getStylesheets(): array;

    public function addTheme($theme) {
        array_push($this->themes, $theme);
    }

    public function addLayout($layout) {
        array_push($this->layouts, $layout);
    }

    public function api() {
        return $this->api;
    }

}