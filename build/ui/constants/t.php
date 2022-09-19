<?php

//types

enum out_t {
    case STYLESHEETS_ALL;
    case VARIABLES_ALL;
    case SCRIPTS_ALL;
    case ONLOAD;
}

enum size_t {
    case FULL_WIDTH;
    case FULL_HEIGHT;
    case FULL_SCREEN;
}

enum load_t {
    case PRELOADED;
    case AFTER_BODY;
}

enum script_t {
    case ONLOAD;
    case GLOBAL_FUNCTION;
    case LISTENER;
    case VARIABLE;
    case COMPONENT;
}

enum return_t {
    case FILE;
    case WITH_OUT;
}

enum action_t: string {
    case ONCLICK = "click";
}

enum var_t {
    case DYNAMIC;
    case STRING;
    case FUNCTION;
    case INTEGER;
    case FLOAT;
    case BOOLEAN;
    case ARRAY;
    case OBJECT;
    case JSON;
}

enum content_t {
    case OBJECT;
    case ARRAY;
    case OBJECT_WITH_ARRAY;
    case VARIABLE;
}

enum lightness_t {
    case LIGHT;
    case REGULAR;
    case DARK;
}

enum color_t : string {
    case WHITE = "FFFFFF";
    case BLACK = "000000";
    case RED = "FF0000";
    case BLUE = "0000FF";
    case GREEN = "00FF00";
    case ORANGE = "FF6600";
    case YELLOW = "FFFF00";
    case PURPLE = "A020F0";
    case SILVER = "C0C0C0";
    case BROWN = "964B00";
    case GRAY = "808080";
    case PINK = "FFC0CB";
    case OLIVE = "808000";
    case MAROON = "800000";
    case VIOLET = "8F00FF";
    case CHARCOAL = "36454F";
    case MAGENTA = "FF00FF";
    case BRONZE = "CD7F32";
    case CREAM = "FFFDD0";
    case GOLD = "FFD700";
    case TAN = "D2B48C";
    CASE TEAL = "008080";
    case MUSTARD = "FFDB58";
    case NAVY_BLUE = "000080";
    case CORAL = "FF7F50";
    case BURGUNDY = "800020";
    case LAVENDER = "E6E6FA";
    case MAUVE = "E0B0FF";
    case PEACH = "FFE5B4";
    case RUST = "B7410E";
    case INDIGO = "4B0082";
    case RUBY = "E0115F";
    case CLAY = "CC7357";
    case CYAN = "00FFFF";
    case AZURE = "007FFF";
    case BEIGE = "F5F5DC";
    case OFF_WHITE = "FAF9F6";
    case TURQUOISE = "30D5C8";
    case AMBER = "FFBF00";
    case MINT = "3EB489";
}