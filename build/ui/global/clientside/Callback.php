<?php

class Callback {

    private string $className;
    private string $htmlId;
    private string $functionName;
    private string $functionId;
    private array $params;
    private array $functions;
    private action_t $actionType;

    //($className, $htmlId, $this->functionName, $this->params)
    public function __construct($actionType, $className, $htmlId, $functionName, $functionId, $params) {

        $this->actionType = $actionType;
        $this->className = $className;
        $this->htmlId = $htmlId;
        $this->functionName = $functionName;
        $this->functionId = $functionId;
        $arr = array();
        foreach($params as $param) {
            array_push($arr, $param);
        }
        $this->params = $arr;
        call_user_func("$className::$functionName", $arr);
        $this->functions = Bond::getHandler()::getObjects();
        Bond::getHandler()::clearObjects();
        foreach($this->functions as $function) {
            Bond::in($function);
        }
    }

    public function getJavaScript() {

        $js = "function " . $this->functionId . "() { ";

        foreach($this->functions as $function) {
            if($function instanceof JsFunction) {
                $js .= $function->getId() . "(); ";
            }
        }

        $js .= " } ";

        return $js;

    }

    public function getId() {
        return $this->functionId;
    }

    public function getHtmlId(): string {
        return $this->htmlId;
    }

    public function getActionType(): action_t {
        return $this->actionType;
    }

}