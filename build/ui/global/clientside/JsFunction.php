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
        if(count($params) > 0) if(count($params) == 1) $this->params = $params[0]; else $this->params = $params;
        $this->functionId = ElementMapper::getNewId("function_" . $this->functionName);
        parent::__construct($functionName,
            $functionBody, null, null, null, $this->functionId);
    }

    public function getJavaScript() {

        if(isset($this->callback)) {
            return $this->callback->getJavaScript();
        } else {
            $js = "function " . $this->functionId . "(";
            $start = true;
            if(isset($this->params)) {
                foreach ($this->params as $param) {
                    if ($start) {
                        $js .= $param;
                        $start = false;
                    } else {
                        $js .= ", " . $param;
                    }
                }
            }
            $js .= ") { " . $this->functionBody . " } ";
        }

        return $js;

    }

    public function getCallBack() {
        return $this->callback;
    }

    public function getId() {
        return $this->functionId;
    }

}