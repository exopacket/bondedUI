<?php

class JsOnload extends Script {

    private array $functionNames;

    public function __construct(...$params) {
        $this->functionNames = $params;
        parent::__construct("onload", $params, script_t::ONLOAD, load_t::AFTER_BODY, return_t::WITH_OUT, "");
    }

    public function getJavaScript() {

        $js = "";

        foreach($this->functionNames as $name) {
            $js .= "$name();";
        }

        return array($this->getScriptType(), $js);

    }

    public function addFunctionCall($functionName) {
        array_push($this->functionNames, $functionName);
    }

}