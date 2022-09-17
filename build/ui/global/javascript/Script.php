<?php

abstract class Script {

    private $name;
    private $body;
    private $returnType;
    private $loadType;
    private $scriptType;

    public function __construct($name, $body, $scriptType, $loadType, $returnType, $id) {

        if(!is_string($name)) {
            return;
        }

        if(!is_string($body) || !is_array($body)) {
            return;
        }

        if(!($scriptType instanceof script_t)) {
            return;
        }

        if(!($loadType instanceof load_t)) {
            return;
        }

        if(!($returnType instanceof return_t)) {
            return;
        }

        if(isset($id)) {

            if (!is_str($id)) {

            }

        } else {


        }

        $this->name = $name;
        $this->scriptType = $scriptType;
        $this->loadType = $loadType;
        $this->returnType = $returnType;
        if(is_array($this->body)) {
            $this->body = $body;
        } else {
            $this->body = preg_replace("/\\<script\\>/", "", $body); //update to preg_replace
            $this->body = preg_replace("/\\<\\/script\\>/", "", $this->body);
        }

    }

    public function head() {

        if($this->loadType == load_t::PRELOADED
            && $this->returnType == return_t::WITH_OUT) {

            return $this->getJavaScript();

        }

        return "";

    }

    public function body() {
        return $this->body;
    }

    public function onload() {
        if($this->scriptType == script_t::ONLOAD) {
            return $this->getJavaScript();
        }
    }

    public abstract function getJavaScript();

    public function end() {

        if($this->loadType == load_t::AFTER_BODY
            && $this->returnType == return_t::WITH_OUT) {

            return $this->getJavaScript();

        }

    }

    public function headForFile() {

        if($this->loadType == load_t::PRELOADED
            && $this->returnType == return_t::FILE) {

            return $this->getJavaScript();

        }

    }

    public function endForFile() {

        if($this->loadType == load_t::AFTER_BODY
            && $this->returnType == return_t::FILE) {

            return $this->getJavaScript();

        }

    }

    /**
     * @return script_t
     */
    public function getScriptType(): script_t
    {
        return $this->scriptType;
    }

}