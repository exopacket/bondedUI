<?php

//SWATCH IS 3 PRIMARY COLORS (RED, GREEN, BLUE)
class Swatch extends Color {

    private int $degreesValue;
    private int $whiteness;
    private int $blackness;
    private color_t $value;

    public function __construct($colorValue, $degreesValue, $whiteness, $blackness) {

        $this->value = $colorValue;
        $this->degreesValue = intval($degreesValue);
        $this->whiteness = $whiteness;
        $this->blackness = $blackness;
        return $this->create();

    }

    private function create() : Swatch {

        $res = $this->hsv2rgb($this->degreesValue, $this->whiteness, $this->blackness);
        return parent::fromRGB($res[0], $res[1], $res[2]);

    }

    public function getValues() {
        return array($this->degreesValue, $this->whiteness, $this->blackness);
    }

    function hsv2rgb($hue,$sat,$val) {;
        $rgb = array(0,0,0);
        for($i=0;$i<4;$i++) {
            if (abs($hue - $i*120)<120) {
                $distance = max(60,abs($hue - $i*120));
                $rgb[$i % 3] = 1 - (($distance-60) / 60);
            }
        }
        $max = max($rgb);
        $factor = 255 * ($val/100);
        for($i=0;$i<3;$i++) {
            $rgb[$i] = round(($rgb[$i] + ($max - $rgb[$i]) * (1 - $sat/100)) * $factor);
        }
        return $rgb;
    }


}