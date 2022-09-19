<?php

class Color {

    public $hex;
    public $rgb;
    public $opacity;

    public function __construct($valArr) {

        $this->rgb = $valArr[0];
        $this->opacity = $valArr[1];
        $this->hex = $valArr[2];

    }

    public static function fromHex($hexVal) {

        return new Color(array(self::hexToRGB($hexVal), 255,
            str_replace("#", "", $hexVal)));

    }

    public static function fromRGB($red, $green, $blue) {
        $rgb = array(intval($red), intval($green), intval($blue));
        return new Color(array($rgb, 255, self::RGBtoHex($rgb)));
    }

    public static function fromRGBA($red, $green, $blue, $opacity) {
        $rgb = array(intval($red), intval($green), intval($blue));
        $a = intval($opacity);
        return new Color(array($rgb, $a, self::RGBtoHex($rgb)));
    }

    public function getRgbArr() {
        return $this->rgb;
    }

    public function setOpacity($opacity) {
        $this->opacity = intval($opacity);
    }

    public function getHex() {
        return "#" . $this->hex;
    }

    public function getRGBA() {
        return "rgba(" . $this->rgb[0] . ", " .
            $this->rgb[1] . ", " .
            $this->rgb[2] . ", " .
            $this->opacity . ")";
    }

    private function hexToRGB($hexVal) : array {

        if(strlen($hexVal) == 3) {

            $r = substr($hexVal, 0, 1) . substr($hexVal, 0, 1);
            $g = substr($hexVal, 1, 1) . substr($hexVal, 1, 1);
            $b = substr($hexVal, 2, 1) . substr($hexVal, 2, 1);

        } else if(strlen($hexVal) == 6) {

            $r = substr($hexVal, 0, 2) . substr($hexVal, 0, 2);
            $g = substr($hexVal, 2, 2) . substr($hexVal, 2, 2);
            $b = substr($hexVal, 4, 2) . substr($hexVal, 4, 2);

        } else {
            return array(255, 255, 255);
        }

        return array(hexdec($r), hexdec($g), hexdec($b));

    }

    private function RGBtoHex($rgb) : string {

        return dechex($rgb[0]) . dechex($rgb[1]) . dechex($rgb[2]);

    }

    public function values(): array {
        return array($this->rgb, $this->opacity, $this->hex);
    }

}