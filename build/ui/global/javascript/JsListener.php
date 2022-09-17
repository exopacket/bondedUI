<?php

class JsListener {

    private string $htmlId;
    private string $id;
    private array $functionIds;
    private string $listenerName;
    private string $functionName;
    private array $params;
    private action_t $type;
    private JsFunction $function;
    private JsOnload $onload;

    public function __construct($listenerName, $actionType, $functionName, $params) {
        $this->id = ElementMapper::getNewId($functionName);
        $ids = array($this->id, ElementMapper::getNewId($listenerName));
        $this->functionName = $functionName;
        $this->listenerName = $listenerName;
        $this->type = $actionType;
        $this->functionIds = $ids;
        if(isset($params)) $this->params = $params;
    }

    public function create($className, $htmlId) {
        $this->htmlId = $htmlId;
        $this->function = new JsFunction($this->functionName, new Callback($className, $htmlId, $this->functionName, $this->params), $this->params);
        $this->onload = new JsOnload($this->functionName);
    }

    public function getScriptObjects() {
        return array($this->functionName, $this->onload);
    }

    public function getName() {
        return $this->listenerName;
    }

}