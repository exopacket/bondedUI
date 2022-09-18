<?php

class JsUpdateWindow extends Script {

    private JsComponent $component;
    private JsVariable $data;
    private JsFunction $function;
    private array $children;

    public function __construct($componentName, ...$childFunctions)
    {
        parent::__construct($componentName, $this->getJavaScript(), script_t::GLOBAL_FUNCTION,
            load_t::AFTER_BODY, return_t::FILE, "");
    }

    public function getJavaScript() {

        $js = "function " . $this->function->getId() . "() { ";

        foreach($this->children as $child) {
            $functionId = $child->getId();
            $js .= $functionId . "(); ";
        }

        $js .= "}";

        return $js;

    }

    public function getChildren() {
        return $this->children;
    }

}