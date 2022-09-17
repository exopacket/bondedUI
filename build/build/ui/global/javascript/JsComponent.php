<?php

class JsComponent extends Script {

    private string $componentId;
    private string $componentName;
    private Mountable $component;

    public function __construct($name, $component) {
        $this->componentName = $name;
        $this->component = $component;
        $this->componentId = ElementMapper::getId($name);
        parent::__construct($name, $component, script_t::COMPONENT, load_t::AFTER_BODY, return_t::FILE, $this->componentId);
    }

    public function getJavaScript() {
        // TODO: Implement getJavaScript() method.
    }
}