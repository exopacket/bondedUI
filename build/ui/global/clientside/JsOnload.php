<?php

class JsOnload extends Script {

    private array $functionCalls;

    public function __construct(...$params) {
        $this->functionCalls = $params;
        parent::__construct("onload", null, null, null, $params, "");
    }

    public function getJavaScript() {

        $js = "";

        foreach($this->functionCalls as $function) {
            $callbackObj = $function->getCallback();
            if(isset($callbackObj)) {
                $htmlId = $callbackObj->getHtmlId();
                $id = $callbackObj->getId();
                $type = $callbackObj->getActionType()->value;
                $js .= " document.getElementById('$htmlId').addEventListener('$type', $id); ";
            } else {
                $id = $function->getId();
                $js .= " $id(); ";
            }
        }

        return $js;

    }

    public function addFunctionCall($functionName) {
        array_push($this->functionNames, $functionName);
    }

}