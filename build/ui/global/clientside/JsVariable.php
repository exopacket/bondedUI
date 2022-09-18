<?php

class JsVariable extends Script {

    private var_t $variableType;
    private string $variableName;
    private string $variableId;
    private $defaultValue;
    private JsFunction $setFunction;
    private JsOnload $onloadCall;

    public function __construct($variableName, $defaultValue, $currentValue) {
        $id = "abc";
        $functionId = "abcd";
        $this->defaultValue = $defaultValue;
        $this->currentValue = $currentValue;
        $this->variableId = $id;
        $this->variableName = $variableName;
        $this->variableType = var_t::OBJECT;
        $this->setFunction = new JsFunction($functionId, $id . " = val;", "val");
        $this->onloadCall = new JsOnload($functionId);
        parent::__construct($variableName,
            array($this->defaultValue, $this->currentValue, $this->setFunction),
            script_t::VARIABLE, load_t::AFTER_BODY, return_t::WITH_OUT, $id);
    }

    public function getJavaScript() {

        $js = "";
        $js .= "let " . $this->variableName . " = " . $this->defaultValue . ";";
        $js .= $this->setFunction->getJavaScript();

        return $js;

    }

}