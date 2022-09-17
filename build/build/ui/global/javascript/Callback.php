<?php

class Callback {

    private string $className;
    private string $htmlId;
    private string $functionName;
    private string $functionId;
    private array $params;

    //($className, $htmlId, $this->functionName, $this->params)
    public function __construct($className, $htmlId, $functionName, $functionId, $params) {
        $this->className = $className;
        $this->htmlId = $htmlId;
        $this->functionName = $functionName;
        $this->functionId = $functionId;
        $arr = array($htmlId);
        foreach($params as $param) {
            array_push($arr, $param);
        }
        $this->params = $arr;
    }

    public function javascript() {

        $js = $this->functionId . "(";
        $start = true;
        foreach($this->params as $param) {
            if($start) { $js .= $param[1]; $start = false; }
            else $js .= ", " . $param[1];
        }
        $js .= ");";

        return $js;

    }

    public function call(...$params) {

        $className = $this->className;
        $function = $this->functionName;
        return call_user_func("$className::$function", $params);

    }

}