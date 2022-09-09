<?php

namespace builder;

class Builder
{

    private $json;
    private $buildDir;
    private $info;
    private $template;
    private $tasks;

    public function __construct($buildDir, $info, $template, $tasks)
    {
        $this->json = json_decode(file_get_contents("/Applications/MAMP/htdocs/bondedUI/builder/exec/config.json"));
        $this->buildDir = $buildDir;
        $this->info = $info;
        $this->template = $template;
        $this->tasks = $tasks;
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
        $info->name = "example";
        $info->sfc_file = "example.vue";
        $info->sfc_path = "vue-components/";
        $info->class_name = "Example";

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
        $template->fetch = (object)[];
        $template->fetch->render_side = "client";
        $template->fetch->method = "fetch";
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

    public function getHyperFileStr()
    {

        $content = "";

        $content .= "info { \n";
        $content .= "\t" . "name = \"" . $this->info->name . "\";\n";
        $content .= "\t" . "sfc_file = \"" . $this->info->sfc_file . "\";\n";
        $content .= "\t" . "sfc_path = \"" . $this->info->sfc_path . "\";\n";
        $content .= "\t" . "class_name = \"" . $this->info->class_name . "\";\n";
        $content .= "} \n\n";

        $html = preg_replace("/\\n/i", "\n\t\t", $this->template->html);

        $content .= "template { \n\n";

        $content .= "\t" . "html { \n";
        $content .= "\t\t" . $html . "\n";
        $content .= "\t} \n\n";

        $content .= "\t" . "fetch { \n";
        $content .= "\t\t" . "render_side = \"" . $this->template->fetch->render_side . "\";\n";
        $content .= "\t\t" . "method = \"" . $this->template->fetch->method . "\";\n";
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

    private function parse($contents)
    {


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