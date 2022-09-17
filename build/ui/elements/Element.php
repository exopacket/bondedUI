<?php

abstract class Element implements ElementMethods {

    protected $child;
    protected $id;

    public function html(){
        return $this->build();
    }

    public function setChild($child) {
        $this->child = $child;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

}