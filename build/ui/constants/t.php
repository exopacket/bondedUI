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
}

enum return_t {
    case FILE;
    case WITH_OUT;
}

enum action_t: string {
    case ONCLICK = "onclick";
    case HREF = "href";
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