<?php

abstract class Handler {

    private static ClientInterface $client;
    private static ApiInterface $api;
    private static array $listeners = array();
    private static array $objects = array();

    public function __construct() {
        self::$client = new ClientInterface();
        self::$api = new ApiInterface();
    }

    public static function setClient($client) {
        self::$client = $client;
    }

    public static function client(): ClientInterface {
        return self::$client;
    }

    public static function api(): ApiInterface {
        return self::$api;
    }

    public static function addObject($object) {
        array_push(self::$objects, $object);
    }

    public static function clearObjects() {
        self::$objects = array();
    }

    public static function getObjects() {
        return self::$objects;
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