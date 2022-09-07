<?php

namespace builder;
include "../../exec/Builder.php";

if (isset($_GET['request_type'])) {

    $reqType = $_GET['request_type'];
    $data = (isset($_GET['request_data'])) ? $_GET['request_data'] : "";

    $builder = getBuilder();

    header("Content-Type: application/json");

    switch ($reqType) {
        case "save":
            echo save(json_decode($data));
            break;
        case "update":
            echo getUpdate($builder);
            break;
        default:
            echo "{}";
            break;
    }

}

function getBuilder()
{

    if (Builder::cacheIsEmpty()) {

        $config = Builder::getConfig();
        $buildDir = "../../build/";

        if (isset($config->build_dir)) {
            $buildDir = $config->build_dir;
        }

        return Builder::fromNew($buildDir);

    } else {

        return Builder::fromCache();

    }

}

function save($obj)
{
    parse();
}

function getUpdate($builder)
{

    $obj = (object)[];

    $obj->info = $builder->getInfo();
    $obj->template = $builder->getTemplate();
    $obj->tasks = $builder->getTasks();
    $obj->hyper_file = $builder->getHyperFileStr();

    return json_encode($obj);

}

function parse()
{

}

?>