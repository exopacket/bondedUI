<?php

$filename = "blank-template";

$contents = file_get_contents("../exec/cache.hyper");
$lines = explode("\n", $contents);

$firstLine = $lines[0];

if ($firstLine != "#empty") {
    $filename = str_replace("#", "", $firstLine);
}

$componentsDir = "../vue-components/";

$files = scandir($componentsDir);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>hyperUI Builder</title>

    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>

</head>
<body style="overflow: scroll;">

<div class="py-3 container container-fluid">
    <header>
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-4">hyperUI Builder</span>
            </a>

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">

                <div class="dropdown" id="search-dropdown" style="width: auto; margin-right: 20px;">

                    <input aria-label="Vue.js Component File" class="form-control me-2" id="file-input"
                           placeholder="Vue.js Component File"
                           type="search"
                           value="<?php echo $filename; ?>"
                           onfocus="showSuggestions()"
                           onblur="hideSuggestions()"
                           onchange="updateSuggestions()"
                    >

                    <ul class="dropdown-menu" id="file-selection">

                        <?php

                        for ($i = 0; $i < count($files); $i++) {

                            $file = $files[$i];
                            if (str_contains($file, ".vue")) {
                                $_file = str_replace(".vue", "", $file);
                                echo "<li><a class=\"dropdown-item\" href=\"javascript: selectSuggestion('$_file')\">$_file</a></li>";
                            }

                        }

                        ?>

                    </ul>

                </div>

                <a id="load-file-btn" class="me-3 py-2 text-dark text-decoration-none btn btn-outline-primary btn-sm"
                   href="javascript: loadFile()"
                   style="width: 100px;">Load File</a>
                <div class="vr" style="background-color: #000; opacity: 0.30; margin-right: 15px;"></div>
                <a id="preview-btn" class="me-3 py-2 text-dark text-decoration-none btn btn-info btn-sm"
                   href="javascript: preview()" style="width: 100px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye"
                         viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                    </svg>
                    &nbsp;&nbsp;Preview
                </a>
                <a id="editor-btn" class="me-3 py-2 text-dark text-decoration-none btn btn-info btn-sm"
                   href="javascript: editor()" style="width: 100px; display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-braces" viewBox="0 0 16 16">
                        <path d="M2.114 8.063V7.9c1.005-.102 1.497-.615 1.497-1.6V4.503c0-1.094.39-1.538 1.354-1.538h.273V2h-.376C3.25 2 2.49 2.759 2.49 4.352v1.524c0 1.094-.376 1.456-1.49 1.456v1.299c1.114 0 1.49.362 1.49 1.456v1.524c0 1.593.759 2.352 2.372 2.352h.376v-.964h-.273c-.964 0-1.354-.444-1.354-1.538V9.663c0-.984-.492-1.497-1.497-1.6zM13.886 7.9v.163c-1.005.103-1.497.616-1.497 1.6v1.798c0 1.094-.39 1.538-1.354 1.538h-.273v.964h.376c1.613 0 2.372-.759 2.372-2.352v-1.524c0-1.094.376-1.456 1.49-1.456V7.332c-1.114 0-1.49-.362-1.49-1.456V4.352C13.51 2.759 12.75 2 11.138 2h-.376v.964h.273c.964 0 1.354.444 1.354 1.538V6.3c0 .984.492 1.497 1.497 1.6z"/>
                    </svg>
                    &nbsp;&nbsp;Editor
                </a>
                <a id="export-btn" class="me-3 py-2 text-white text-decoration-none btn btn-success btn-sm"
                   href="javascript: exportTemplate()"
                   style="width: 100px;">
                    <svg class="bi bi-box-arrow-right" fill="currentColor" height="16" style="padding-top: 1.5px;"
                         viewBox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"
                              fill-rule="evenodd"/>
                        <path d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"
                              fill-rule="evenodd"/>
                    </svg>
                    &nbsp;&nbsp;Export
                </a>

            </nav>
        </div>
    </header>
    <div class="container-fluid" style="display:none;">
        <main class="row justify-content-center">

            <iframe id="main-iframe" style="min-height: 100vh" scrolling="no"></iframe>

        </main>
    </div>
    <div class="container-fluid">
        <main class="row justify-content-center">

            <iframe id="editor-iframe" scrolling="no" style="min-height: 100vh"></iframe>


        </main>
    </div>
</div>

<script>

    window.onload = function () {
        loadVue(true);
    }

    function loadVue(isOnLoad) {

        const name = "<?php echo $filename; ?>";
        const val = name + ".vue";

        const frame = document.getElementById("main-iframe");
        frame.src = "iframe-src.php?filepath=" + encodeURIComponent(val);

        frame.onload = function () {

            frame.style.height =
                frame.contentWindow.document.body.scrollHeight + 'px';

            frame.style.width =
                frame.contentWindow.document.body.scrollWidth + 'px';

        }

        const editor = document.getElementById("editor-iframe");
        editor.src = "code-editor/code-editor.php?name="
            + encodeURIComponent(name) + "&onload=" + ((isOnLoad) ? "true" : "false");

        editor.onload = function () {

            editor.style.height =
                editor.contentWindow.document.body.scrollHeight + 'px';

            editor.style.width =
                editor.contentWindow.document.body.scrollWidth + 'px';

        }

    }

    function preview() {

        $("#preview-btn").hide();
        $("#editor-btn").show();

        $("#main-iframe").show();
        $("#editor-iframe").hide();

        loadVue(false);

    }

    function editor() {

        $("#preview-btn").show();
        $("#editor-btn").hide();

        $("#main-iframe").hide();
        $("#editor-iframe").show();

        loadVue(false);

    }

    function loadFile() {

    }

    function exportTemplate() {

    }

    let isWaitingToHide = false;

    function showSuggestions() {

        window.isWaitingToHide = false;
        $("#search-dropdown .dropdown-menu").toggle(true)

    }

    function updateSuggestions() {

    }

    function hideSuggestions() {
        window.isWaitingToHide = true;
        setTimeout(function () {
            if (window.isWaitingToHide) {
                $("#search-dropdown .dropdown-menu").toggle(false)
            }
        }, 1000);
    }

    function selectSuggestion(selected) {
        $("#file-input").val(selected);
        $("#search-dropdown .dropdown-menu").toggle()
    }

</script>


</body>
</html>
