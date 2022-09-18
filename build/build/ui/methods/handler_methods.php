<?php

    //TODO implement fetch() in both client and api
    //fetch() is a client side update of the UI (ajax api request)
    //call() will only be available in api; it will call the api function from the api class
    //OR if a link, will make a request.
    //_this($call) is for per page implementations (api like)
    //most likely will be part of the client call() function.
    //OR may need to add to both the clientside and serverside functions
    function _client() {
        return Bond::getHandler()::client();
    }

    function _api() {
        return Bond::getHandler()::api();
    }

    function _update($component) {

    }

    function _this($call) {

        if(is_callable($call)) {
            //
        } else if(is_string($call)) {
            //call_user_func string(Bond::getHandler()::<function>)
        }

    }

?>