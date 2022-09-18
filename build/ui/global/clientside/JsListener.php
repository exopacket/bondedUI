<?php

class JsListener {

    private string $htmlId;
    private string $className;
    private string $listenerId;
    private string $listenerName;
    private string $functionName;
    private array $params = [];
    private action_t $type;
    private JsFunction $function;
    private JsOnload $onload;

    public function __construct($listenerName, $actionType, $functionName, $className, $htmlId, $params) {
        $this->listenerId = ElementMapper::getNewId("listener_" . $listenerName);
        $this->functionName = $functionName;
        $this->listenerName = $listenerName;
        $this->type = $actionType;
        $this->htmlId = $htmlId;
        $this->className = $className;
        if(isset($params)) if(count($params) > 0) $this->params = $params;
        $this->create();
    }

    private function create() {
        $callback = new Callback($this->type, $this->className, $this->htmlId, $this->functionName, $this->listenerId, $this->params);
        $this->function = new JsFunction($this->functionName, $callback , $this->params);
        $this->onload = new JsOnload($this->function);
        $this->function->setTypes(script_t::GLOBAL_FUNCTION, load_t::AFTER_BODY, return_t::WITH_OUT);
        $this->onload->setTypes(script_t::ONLOAD, load_t::AFTER_BODY, return_t::WITH_OUT);
        Bond::in($this->function);
        Bond::in($this->onload);
    }

    public function getName() {
        return $this->listenerName;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getObjects() {
        return array($this->function, $this->onload);
    }
}