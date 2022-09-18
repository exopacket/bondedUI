<?php

abstract class Element implements ElementMethods {

    protected $child;
    protected $id;
    protected $name;

    public function __construct($obj) {
        if(isset($obj->name)) {
            $this->name = $obj->name;
            $this->id = ElementMapper::getNewId($this->name);
        }
    }

    public function html(){
        return $this->build();
    }

    public function setChild($child) {
        $this->child = $child;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

}