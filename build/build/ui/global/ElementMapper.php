<?php

class ElementMapper {

    private static array $mapper = array();

    public static function getNewId($entryName) {

        $md5 = md5($entryName);
        $len = 7;
        while(true) {
            $substr = substr($md5, 0, $len);
            $continue = false;
            foreach(self::$mapper as $item) {
                $currId = $item[0];
                if($substr == $currId) {
                    $len++;
                    $continue = true;
                    break;
                }
            }
            if($continue) $continue;
            $id = $substr;
            break;
        }

        array_push(self::$mapper, array($id, $entryName));
        return $id;

    }

    public static function getId($entryName): ?string {
        foreach(self::$mapper as $entry) {
            $currName = $entry[1];
            if($currName == $entryName) return $entry[0];
        }
        return null;
    }

}