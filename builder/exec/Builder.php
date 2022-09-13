<?php

namespace builder;

class Builder
{

    private $json;
    private $buildDir;
    private $info;
    private $template;
    private $tasks;
    private $filepath;

    public function __construct($buildDir, $info, $template, $tasks, $filepath)
    {

        $this->json = json_decode(file_get_contents("/Applications/MAMP/htdocs/bondedUI/builder/exec/config.json"));
        $this->buildDir = $buildDir;
        $this->info = $info;
        $this->template = $template;
        $this->tasks = $tasks;
        $this->filepath = $filepath;

    }

    public static function cacheIsEmpty()
    {

        $content = file_get_contents("/Applications/MAMP/htdocs/bondedUI/builder/exec/cache.bonded");
        $lines = explode("\n", $content);
        $line = $lines[0];

        return ($line == "#empty");

    }

    public static function getConfig()
    {

        return json_decode(file_get_contents("/Applications/MAMP/htdocs/bondedUI/builder/exec/config.json"));

    }

    public static function fromNew($buildDir)
    {

        $info = (object)[];
        $info->name = "";
        $info->sfc_file = "";
        $info->sfc_path = "";
        $info->class_name = "";
        $info->author = "";
        $info->description = "";
        $info->static_only = false;
        $info->dark_light_themed = false;

        $exampledata = (object)[];
        $examplechild = (object)[];
        $exampledata->name = "message";
        $exampledata->type = "object";
        $examplechild->key = "text";
        $examplechild->type = "string";
        $examplechild->default = "";
        $exampledata->children = array($examplechild);

        $template = (object)[];
        $template->html = "<div><h1>{{ message }}</h1></div>";
        $template->data = array($exampledata);
        $template->ui = (object)[];
        $template->ui->methods = [];
        $template->ui->listeners = [];

        $tasks = array();

        return new Builder($buildDir, $info, $template, $tasks);

    }

    public static function fromCache()
    {


    }

    public static function fromName($buildDir, $name) {

        $filepath = "/Applications/MAMP/htdocs/bondedUI/builder/template-setup/configurations/$name";
        $bondedFile = file_get_contents($filepath);
        return self::parse($buildDir, $bondedFile, $filepath);

    }

    public function save() {
        file_put_contents($this->filepath, $this->getHyperFileStr());
    }

    public function getHyperFileStr()
    {

        $content = "";

        $dark_light = "false";
        $static = "false";

        if($this->info->dark_light_themed == true) $dark_light = "true";
        if($this->info->static_only == true) $static = "true";


        $content .= "info { \n";
        $content .= "\t" . "name = \"" . $this->info->name . "\";\n";
        $content .= "\t" . "sfc_file = \"" . $this->info->sfc_file . "\";\n";
        $content .= "\t" . "sfc_path = \"" . $this->info->sfc_path . "\";\n";
        $content .= "\t" . "class_name = \"" . $this->info->class_name . "\";\n";
        $content .= "\t" . "description = \"" . $this->info->description . "\";\n";
        $content .= "\t" . "author = \"" . $this->info->author . "\";\n";
        $content .= "\t" . "static_only = " . $static . ";\n";
        $content .= "\t" . "dark_light_themed = " . $dark_light . ";\n";
        $content .= "} \n\n";

        $html = preg_replace("/\\n/i", "\n\t\t", $this->template->html);

        $content .= "template { \n\n";

        $content .= "\t" . "html { \n";
        $content .= "\t\t\"" . $html . "\"\n";
        $content .= "\t} \n\n";

        $content .= "\t" . "params { \n";
        $content .= "\t\t" . "[]\n";
        $content .= "\t} \n\n";

        $content .= "\t" . "ui { \n";
        $content .= "\t\t" . "methods = [" . "];\n";
        $content .= "\t\t" . "listeners = [" . "];\n";
        $content .= "\t} \n\n";

        $content .= "} ";

        for ($i = 0; $i < count($this->tasks); $i++) {

            $script = $this->tasks[$i];

            $content .= "task { \n";
            //$content .= "\t" . "name = \"" . $this->info->name . "\";\n";
            //$content .= "\t" . "sfc_file = \"" . $this->info->sfc_file . "\";\n";
            //$content .= "\t" . "sfc_path = \"" . $this->info->sfc_path . "\";\n";
            //$content .= "\t" . "class_name = \"" . $this->info->class_name . "\";\n";
            $content .= "} " . $script->name . "\n\n";

        }

        return $content;

    }

    private function findComponentObj($name)
    {

        $components = $this->json->components;
        $limit = count($components);

        for ($i = 0; $i < $limit; $i++) {
            $component = $components[$i];
            $componentName = $component->name;
            if ($componentName == $name)
                return $component;
        }

        return (object)[];

        $component = $this->findComponentObj($name);
        if ($component === false) return;

    }

    public function parseHyperFileFromStr($str)
    {
        $this->parse($str);
    }

    public function parseHyperFile($file)
    {
        $this->parse(file_get_contents($file));
    }

    private static function parse($buildDir, $contents, $filepath)
    {

        $infoRegex = "/info\\s+{((.|\\n)*?)}/i";
        preg_match_all($infoRegex, $contents, $infoMatches);
        $infoStr = $infoMatches[1][0];
        $infoStr = str_replace(" = ", "=", $infoStr);
        $infoStr = substr($infoStr, 0, strlen($infoStr) - 2);
        $infoArr = preg_split("/;/", $infoStr);

        $infoObj = (object)[];

        for($i = 0; $i<count($infoArr); $i++) {

            $param = $infoArr[$i];
            $param = preg_replace("/\\n/", "", $param);
            $param = preg_replace("/[\"\'\\n\\t]|[\s]{2,}/", "", $param);
            $values = preg_split("/=/", $param);
            $key = "" . $values[0];
            $val = "";
            if($values[1] == "true" || $values[1] == "false") {
                $val = ($values[1] == "true") ? true : false;
            } else { $val = $values[1]; }
            $infoObj->$key = $val;

        }

        $templateRegex = "/template\\s+{((.|\\n)*?)\\n}/i";
        preg_match_all($templateRegex, $contents, $templateMatches);
        $templateStr = $templateMatches[1][0];

        $htmlRegex = "/html\\s+{((.|\\n)*?)\t}/i";
        preg_match_all($htmlRegex, $templateStr, $htmlMatches);
        $htmlStr = $htmlMatches[1][0];
        $htmlStr = preg_replace("/([\\n\\t]*)|([\s]{2,})/", "", $htmlStr);
        $htmlStr = substr($htmlStr, 1, strlen($htmlStr) - 2);

        $exampledata = (object)[];
        $examplechild = (object)[];
        $exampledata->name = "message";
        $exampledata->type = "object";
        $examplechild->key = "text";
        $examplechild->type = "string";
        $examplechild->default = "";
        $exampledata->children = array($examplechild);

        $template = (object)[];
        $template->html = "$htmlStr";
        $template->data = array($exampledata);
        $template->ui = (object)[];
        $template->ui->methods = [];
        $template->ui->listeners = [];

        $tasks = array();

        return new Builder($buildDir, $infoObj, $template, $tasks, $filepath);

    }

    public function getInfo()
    {
        return $this->info;
    }

    public function getTemplate()
    {
        return $this->template;
    }

    public function getTasks()
    {
        return $this->tasks;
    }

    public function updateVariable($key, $val) {

        $this->info->$key = $val;

    }

    public function generatePhpComponent()
    {

    }

    private function generateComponentClass()
    {

    }

    private function generateUiMethodsFile()
    {

    }

    private function generateTasksFile()
    {

    }

    private function generateInterface()
    {

    }

    private function generateHyperFileStr()
    {

    }

    private function generateComponentsClass()
    {

    }

}

?>