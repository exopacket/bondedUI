<?php



class Container extends Element {

    public function __construct(...$params) {
        $this->id = "app";
        $this->name = "app";
    }

    public function build() {
        return "<div style='width: 100%;' id='app'>" . $this->child->render() . "</div>";
    }
}