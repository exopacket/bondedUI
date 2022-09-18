<?php

class ElementMapper {

    private static array $mapper = array();

    public static function getNewId($entryName) {

        $chars = "abcdefghijklmnopqrstuvwxyz";
        $md5 = md5($entryName);
        $len = 7;
        $offset = 0;
        while(true) {
            $substr = substr($md5, $offset, $len);
            $firstChar = substr($substr, 0, 1);
            if(strpos($chars, $firstChar) === false) {
                $offset++;
                continue;
            }
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