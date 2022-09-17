<?php

class JsFunction extends Script {

    private string $functionId;
    private string $functionName;
    private string $functionBody;
    private Callback $callback;
    private array $params;

    public function __construct($functionName, $functionBody, ...$params)
    {
        $this->functionName = $functionName;
        if($functionBody instanceof Callback) $this->callback = $functionBody;
        else $this->functionBody = $functionBody;
        $this->params = params($params);
        $this->functionId = Script::createId();
        parent::__construct($functionName,
            $functionBody, script_t::GLOBAL_FUNCTION,
            load_t::AFTER_BODY, return_t::FILE, $this->functionId);
    }

    public function getJavaScript() {

        $js = "function " . $this->functionId . "(";
        $start = true;
        foreach($this->params as $param) {
            if($start) {
                $js .= $param;
                $start = false;
            } else {
                $js .= ", " . $param;
            }
        }
        $js .= ") { " . $this->functionBody . " }";

        return array($this->getScriptType(), $js);

    }

    public function getId() {
        return $this->functionId;
    }

}