<?php

namespace hyper;

include "includes.php";

class Components {

    public static function getClass($component) {

        switch($component) {
            case "compact-table":
                return new CompactTable();
        }

    }

}