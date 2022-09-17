<?php


abstract class Mountable {

    private Handler $handler;
    private array $listeners = array();
    private ClientInterface $client;
    private ApiInterface $api;
    private $data;
    private array $ids = array();
    private array $actions = array();
    private array $content = array();
    private array $children = array();
    private string $name;

    public function __construct(...$args) {

        $this->client = new ClientInterface();
        $params = $args[0];

        foreach($params as $param) {
            if($param instanceof stdClass) {
                $this->data = $param->data;
                $this->client->setVariables($param->data);
            }
            if(is_array($param)) {
                if($param[0] == "handle") {
                    if(count($param) == 5) {
                        //a("handle", $listenerName, $type, $functionName, $_params);
                       // __construct($listenerName, $actionType, $functionName, $params)
                        $listener = new JsListener($param[1], $param[2], $param[3], $param[4]);
                        array_push($this->listeners, $listener);
                    } else {
                        //TODO throw exception
                    }
                }
            }
        }

        $this->parseTemplate();

    }

    protected abstract function template();

    public function data() {

        return $this->data;

    }

    public function render() {

        $html = $this->template();
        $html = $this->replaceVarsForRender($html);
        $html = $this->replaceIdsForRender($html);

        return $html;

    }

    private function replaceVarsForRender($html): string {
        $value = $html;
        foreach($this->content as $item) {
            $regex = "/({{)(\\s+)?(" . preg_quote($item[1]) . ")(\\s+)?(}})/";
            $value = preg_replace($regex, $this->getDataVariable($item[1]), $value);
        }
        return $value;
    }

    private function replaceIdsForRender($html): string {
        foreach($this->ids as $item) {
            $regex = "/({{)(\\s+)?(" . preg_quote($item[0]) . ")(\\s+)?(}})/";
            $html = preg_replace($regex, " id='" . $item[1] . "' ", $html);
        }
        return $html;
    }

    protected abstract function getClassname();

    private function getDataVariable($name) {

        $arr = null;

        foreach($this->content as $item) {
            if($item[2] == $name) {
                $arr = $item;
                break;
            }
        }

        if($arr == null) {
            //TODO throw exception
        }

        if($arr[0] == content_t::VARIABLE) {
            return $this->data()->$arr[2];
        } else if($arr[0] == content_t::OBJECT) {
            $keys = $arr[3];
            $dataVariable = $this->data;
            foreach($keys as $key) {
                $key = preg_replace("/\\s+/", "", $key);
                if($key == "data") continue;
                $dataVariable = $dataVariable->{$key};
            }
            return $dataVariable;
        } else if($arr[0] == content_t::ARRAY) {
            $varName = $arr[2];
            $index = $arr[3];
            return $this->data()->$varName[$index];
        } else if($arr[0] == content_t::OBJECT_WITH_ARRAY) {
            //TODO
        }

        return "";

    }

    private function parseTemplate() {

        $regex = "/({{)(\\s+)?([\\$\\@\\.\\#a-zA-Z0-9\\-_\\s]+)(\\s+)?(}})/";
        preg_match_all($regex, $this->template(), $templateMatches);
        $matches = $templateMatches[3];

        foreach($matches as $match) {
            if(str_contains($match, "#") && str_contains($match, "@")) {
                $matchValues = preg_split("/\\s+/", $match);
                $elementId = array();
                $elementListener = array();
                foreach($matchValues as $value) {
                    if(str_contains($value, "#")) {
                        $value = preg_replace("/\\#/", "", $value);
                        $elementId = array($match, $value);
                    } else if(str_contains($value, "@")) {
                        $value = preg_replace("/@/", "", $value);
                        $elementListener = array($match, $value);
                    }
                }
                array_push($elementListener, $elementId[1]);
                array_push($this->ids, $elementId);
                array_push($this->actions, $elementListener);
            } elseif(str_contains($match, "#")) {
                $val = $match;
                $val = preg_replace("/\\#/", "", $val);
                array_push($this->ids, array($match, $val));
            } else if(str_contains($match, "@")) { //TODO delete (action must have id)
                $val = $match;
                $val = preg_replace("/@/", "", $val);
                array_push($this->actions, array($match, $val));
            } else {
                $val = $match;
                if(str_contains($val, "[") && str_contains($val, "]")) {
                    //TODO implement foreach indexes for multiple arrays in object
                    $arrRegex = "/([a-zA-Z0-9\\-_\\.]+)\\[([0-9]+)\\]/";
                    preg_match_all($arrRegex, $val, $arrMatches);
                    $paramName = $arrMatches[1];
                    $paramIndex = intval($arrMatches[2]);
                    $objKeys = array();
                    if(str_contains($paramName, ".")) {
                        $objKeys = preg_split("\\.", $paramName);
                    }
                    $arr = array(
                        (count($objKeys) > 0) ? content_t::OBJECT_WITH_ARRAY : content_t::ARRAY,
                        $match, $paramName, $paramIndex, (count($objKeys) > 0) ? $objKeys : null);
                    array_push($this->content, $arr);
                } else if(str_contains($val, ".")) {
                    $objKeys = preg_split("/\\./", $val);
                    $arr = array(content_t::OBJECT, $match, $val, $objKeys);
                    array_push($this->content, $arr);
                } else {
                    $arr = array(content_t::VARIABLE, $match, $val);
                    array_push($this->content, $arr);
                }
            }

        }

    }

    private function getActionElementId($listenerName) {
        foreach($this->actions as $action) {
            if($action[1] == $listenerName) {
                return $action[2];
            }
        }
    }

    protected function getHandlerClassname() {
        return get_class($this->handler);
    }

    public function getVars() {
        return $this->client->getVariables();
    }

    public function setHandler($handler) {
        $this->handler = $handler;
        foreach(self::getListeners() as $listener) {
            $listener->create(self::getHandlerClassname(), self::getActionElementId($listener->getName()));
            $this->handler::addListener($listener);
        }
        unset($this->listeners);
    }

    private function getElementId() {

    }

    public function style() {

        return "";

    }

    public function scripts() {

        return $this->client->getScripts();

    }

    private function tasks() {



    }

    private function getListeners() {

        return (isset($this->listeners)) ? $this->listeners : $this->handler::getListeners();

    }

}