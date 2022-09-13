<?php

class Application {

    private $rootPath;

    public function load(): Application {
        return $this;
    }

    /**
     * @return string
     */
    public function getRootPath() : string {
        return $this->rootPath;
    }

}