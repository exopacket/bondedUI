<?php

    function _handle($listenerName, $type, ...$params) {
        if(count($params) > 0) {
            $_params = array();
            $functionName = "";
            $start = true;
            foreach($params as $param) {
                if($start) {
                    $functionName = $param;
                    $start = false;
                } else {
                    array_push($_params, $param);
                }
            }
            return a("handle", $listenerName, $type, $functionName, $_params);
        } else return a("handle", $listenerName, $type, $listenerName, array());
    }

    function _data($input) {
        return a("data", $input);
    }

    function _get($handlerClass, $handlerFunction) {
        return call_user_func("$handlerClass::$handlerFunction");
    }

    function _set($key, ...$params) {
        $value = $params[0];
        $defaultValue = (isset($params[1])) ? $params[1] : null;
        return a($key, a($value, $defaultValue));
    }

?>