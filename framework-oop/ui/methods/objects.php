<?php

    function o($key, $val) {
        return pair($key, $val);
    }

    function a(...$vals) {
        $arr = array();
        for($i=0; $i<count($vals); $i++) {
            array_push($arr, $vals[$i]);
        }
        return $arr;
    }

    function params(...$vals) {
        $arr = array();
        for($i=0; $i<count($vals[0]); $i++) {
            array_push($arr, $vals[0][$i]);
        }
        return $arr;
    }

    function pair($key, $val) {
        return (object)[$key => $val];
    }

    function builder(...$params) {

        $obj = (object)[];

        for($i=0; $i<count($params); $i++) {

            $key =  $params[$i][0];
            $val = $params[$i][1];

            $obj->$key = $val;

        }

        return $obj;

    }

?>