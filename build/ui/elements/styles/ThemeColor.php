<?php

class ThemeColor {

    private color_t $value;
    private array $colors;

    //TODO update lightness ($colors size == 3)

    public function __construct($input, $swatches, $value) {

        $this->value = $value;

        $r = 0;
        $g = 0;
        $b = 0;
        if(is_array($input)) {
            $r = $input[0];
            $g = $input[1];
            $b = $input[2];
        } else if(is_string($input)) {
            $res = $this->hex2rgb($input);
            $r = $res[0];
            $g = $res[1];
            $b = $res[2];
        }

        $rgb = array("red" => $r, "green" => $g, "blue" => $b);
        $swatch1 = $this->getDifferences($swatches[0]->getRgbArr());
        $swatch2 = $this->getDifferences($swatches[1]->getRgbArr());
        $swatch3 = $this->getDifferences($swatches[2]->getRgbArr());
        $swatchArr = array("red" => $swatch1, "green" => $swatch2, "blue" => $swatch3);
        $sortedRgb = rsort($rgb);

        $highestArr = array();
        $highest = $sortedRgb[0];
        foreach($sortedRgb as $value) {
            if($highest == $value) {
                array_push($highestArr, key($value));
            } else { break; }
        }

        $mixedArr = array();

        foreach($highestArr as $item) {

            $diffs1 = $swatchArr[$item];
            $diffs2 = $this->getDifferences($rgb);
            $avgs = $this->avgDifferences($diffs1, $diffs2);
            $steps = $this->calcSteps($avgs);

            $increase = array(0, 0, 0);

            if($swatchArr[$item]->getRgbArr()[0] > $rgb[0]) {
                $increase[0] = 1;
            } else if($swatchArr[$item]->getRgbArr()[0] < $rgb[0]) {
                $increase[0] = -1;
            }

            if($swatchArr[$item]->getRgbArr()[1] > $rgb[1]) {
                $increase[1] = 1;
            } else if($swatchArr[$item]->getRgbArr()[1] < $rgb[1]) {
                $increase[1] = -1;
            }

            if($swatchArr[$item]->getRgbArr()[2] > $rgb[2]) {
                $increase[2] = 1;
            } else if($swatchArr[$item]->getRgbArr()[2] < $rgb[2]) {
                $increase[2] = -1;
            }

            $currMixed = $this->mix($rgb, $steps, $increase);
            array_push($mixedArr, $currMixed);

        }

        $mixed = array();

        if(count($mixedArr) == 2) {
            $mixed = $this->merge($mixedArr[0], $mixedArr[1], null);
        } else if(count($mixedArr) == 3) {
            $mixed = $this->merge($mixedArr[0], $mixedArr[1], $mixedArr[2]);
        }

        return Color::fromRGBA($mixed[0], $mixed[1], $mixed[2], 255);

    }

    private function hex2rgb($hexVal) : array {

        $hexVal = preg_replace("/\\#/", "", $hexVal);

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

    private function getDifferences($arr) {
        $rg = (($arr[0] - $arr[1]) >= 0) ? ($arr[0] - $arr[1]) : ($arr[0] - $arr[1]) * -1;
        $gb = (($arr[1] - $arr[2]) >= 0) ? ($arr[1] - $arr[2]) : ($arr[1] - $arr[2]) * -1;
        $rb = (($arr[0] - $arr[2]) >= 0) ? ($arr[0] - $arr[2]) : ($arr[0] - $arr[2]) * -1;
        return array($rg, $gb, $rb);
    }

    private function avgDifferences($arr1, $arr2) {
        $rg = intval((($arr1[0] + 1) + ($arr2[0] + 1)) / 2);
        $gb = intval((($arr1[1] + 1) + ($arr2[1] + 1)) / 2);
        $rb = intval((($arr1[2] + 1) + ($arr2[2] + 1)) / 2);
        return array($rg, $gb, $rb);
    }

    private function calcSteps($arr) {
        $rg = floatval(($arr[0] + 1) / 8) - 1;
        $gb = floatval(($arr[1] + 1) / 8) - 1;
        $rb = floatval(($arr[2] + 1) / 8) - 1;
        return array($rg, $gb, $rb);
    }

    private function merge($one, $two, $three) {

        if(isset($three)) {

            $r = ($one[0] + $two[0] + $three[0]) / 3;
            $g = ($one[1] + $two[1] + $three[1]) / 3;
            $b = ($one[2] + $two[2] + $three[2]) / 3;

            return array($r, $g, $b);

        } else {

            $r = ($one[0] + $two[0]) / 2;
            $g = ($one[1] + $two[1]) / 2;
            $b = ($one[2] + $two[2]) / 2;

            return array($r, $g, $b);

        }

    }

    private function mix($rgb, $steps, $increase) {

            $rg = $steps[0] * 5.5;
            $gb = $steps[1] * 5.5;
            $rb = $steps[2] * 5.5;
            $avg = round((($rg + 1) + ($gb + 1) + ($rb + 1)) / 3) - 1;
            if($increase[0] == 0) $r = $rgb[0];
            elseif($increase[0] > 0) $r = (($rgb[0] + $avg) == 255) ? 255 : ($rgb[0] + $avg);
            else $r = (($rgb[0] - $avg) == 0) ? 0 : ($rgb[0] + $avg);
            if($increase[1] == 0) $g = $rgb[1];
            elseif($increase[1] > 0) $g = (($rgb[1] + $avg) == 255) ? 255 : ($rgb[1] + $avg);
            else $g = (($rgb[1] - $avg) == 0) ? 0 : ($rgb[1] + $avg);
            if($increase[2] == 0) $b = $rgb[2];
            elseif($increase[2] > 0) $b = (($rgb[2] + $avg) == 255) ? 255 : ($rgb[2] + $avg);
            else $b = (($rgb[2] - $avg) == 0) ? 0 : ($rgb[2] + $avg);
            return array($r, $g, $b);

    }

}