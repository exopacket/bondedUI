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

        if(!isset($body) && $scriptType != script_t::LISTENER) {
            return;
        } else {
            if (!is_string($body) && !is_array($body)) {
                return;
            }
        }

        $this->name = $name;
        if(isset($scriptType)) $this->scriptType = $scriptType;
        if(isset($loadType)) $this->loadType = $loadType;
        if(isset($returnType)) $this->returnType = $returnType;

        if(isset($body)) {
            if (is_array($this->body)) {
                $this->body = $body;
            } else {
                $this->body = preg_replace("/\\<script\\>/", "", $body); //update to preg_replace
                $this->body = preg_replace("/\\<\\/script\\>/", "", $this->body);
            }
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

    public function setTypes($scriptType, $loadType, $returnType) {
        $this->scriptType = $scriptType;
        $this->loadType = $loadType;
        $this->returnType = $returnType;
    }

    public abstract function getJavaScript();

    public function end() {

        if($this->scriptType == script_t::GLOBAL_FUNCTION &&
            $this->loadType == load_t::AFTER_BODY
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

    public function getScriptType(): script_t {
        return $this->scriptType;
    }

    public function getLoadType() : load_t {
        return $this->loadType;
    }

    public function getReturnType() : return_t {
        return $this->returnType;
    }

}