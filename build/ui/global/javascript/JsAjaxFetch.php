<?php

class JsAjaxFetch extends Script {

    private string $endpoint;
    private string $resource;
    private JsVariable $data;
    private JsUpdateWindow $update;

    public function __construct($name, $body, $scriptType, $loadType, $returnType, $id)
    {
        parent::__construct($name, $body, $scriptType, $loadType, $returnType, $id);
    }

    public function getJavaScript() {
        // TODO: Implement getJavaScript() method.
    }

}