<?php

class Container extends Element {

    public function build() {
        var_dump($this->child);
        return "<div style='width: 100%;' id='" . $this->getId() . "'>" . $this->child->render() . "</div>";
    }
}