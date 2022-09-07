<?php

error_reporting(0);

header("Content-Type: application/javascript");

if(isset($_GET['filepath'])) {

    $template = "";
    $script = "";
    $style = "";
    $data = "";

    $doc = new DOMDocument('1.0', 'iso-8859-1');
    $doc->loadHTMLFile("../vue-components/" . urlencode($_GET['filepath']));
    $items = $doc->getElementsByTagName("template");
    if(sizeof($items) == 1) {
        $item = $items->item(0);
        $template = $item->C14N();
        $template = str_replace("<template>", "", $template);
        $template = str_replace("</template>", "", $template);
    }
    $scripts = $doc->getElementsByTagName("script");
    if(sizeof($scripts) == 1) {
        $_script = $scripts->item(0);
        $script = $_script->C14N();
        $script = str_replace("<script>", "", $script);
        $script = str_replace("</script>", "", $script);
        $script = str_replace("export default ", "", $script);
        $script = str_replace("};", "}", $script);
        $script = preg_replace("/\\s+/i", " ", $script);
        $script = preg_replace("/\\n/i", " ", $script);
        $script = preg_replace("/^\\s+/i", "", $script);
        $script = preg_replace("/\\s+$/i", "", $script);
        $script = str_replace("&lt;", "<", $script);
        $script = str_replace("&gt;", ">", $script);
    }

    $styles = $doc->getElementsByTagName("style");
    if(sizeof($styles) == 1) {
        $_style = $styles->item(0);
        $style = $_style->C14N();
    }

    $data = $script;
    $template = addslashes($template);
    $template = preg_replace("/\\n/i", "", $template);
    $data = preg_replace("/^{\\s/i", "{ template: \"" . $template . "\", ", $data);

    echo "finishLoading($data)";

}

?>