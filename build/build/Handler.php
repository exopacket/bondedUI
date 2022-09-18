<?php

abstract class Handler {

    private static ClientInterface $client;
    private static ApiInterface $api;
    private static array $listeners = array();
    private static array $calls = array();

    public static function setClient($client) {
        self::$client = $client;
    }

    public static function client(): ClientInterface {
        return self::$client;
    }

    public static function api(): ApiInterface {
        return self::$api;
    }

    public static function addCall($call) {
        array_push(self::$calls, $call);
    }

    public static function clearCalls() {
        self::$calls = array();
    }

    public static function getCalls() {
        return self::$calls;
    }

    public static function initialize() {

    }

    public static function addListener($listener) {
        array_push(self::$listeners, $listener);
    }

    public static function getListeners() {
        return self::$listeners;
    }

}