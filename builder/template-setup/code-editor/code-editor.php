<?php
/*
   editor.src = "code-editor/code-editor.php?name="
            + encodeURIComponent(name) + "&onload=" + ((isOnLoad) ? "true" : "false");
 */

$isOnLoad = false;
$componentName = "";

if(isset($_GET['onload'])) {
    if($_GET['onload'] == "true") $isOnLoad = true;
}

$filename = "";

if(isset($_GET['name'])) {

    $filename = $_GET['name'];

} else { die(); }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.101.0">
    <title>bondedUI Builder</title>

    <!-- Stylesheets -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/dist/code-editor/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="../assets/dist/code-editor/css/site.min.css">

    <!-- Plugins -->
    <link rel="stylesheet" href="../assets/dist/code-editor/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="../assets/dist/code-editor/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="../assets/dist/code-editor/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="../assets/dist/code-editor/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="../assets/dist/code-editor/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="../assets/dist/code-editor/vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="../assets/dist/code-editor/vendor/bootstrap-treeview/bootstrap-treeview.css">
    <link rel="stylesheet" href="../assets/dist/code-editor/vendor/codemirror/codemirror.css">
    <link rel="stylesheet" href="../assets/dist/code-editor/vendor/codemirror/addon/scroll/simplescrollbars.css">
    <link rel="stylesheet" href="../assets/dist/code-editor/vendor/jquery-contextmenu/jquery.contextMenu.css">
    <link rel="stylesheet" href="../assets/dist/code-editor/examples/css/pages/code-editor.css?v=2">

    <!-- Fonts -->
    <link rel="stylesheet" href="../assets/dist/code-editor/fonts/font-awesome/font-awesome.css">
    <link rel="stylesheet" href="../assets/dist/code-editor/fonts/web-icons/web-icons.min.css">
    <link rel="stylesheet" href="../assets/dist/code-editor/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <!--[if lt IE 9]>
    <script src="../assets/dist/code-editor/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="../assets/dist/code-editor/vendor/media-match/media.match.min.js"></script>
    <script src="../assets/dist/code-editor/vendor/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="editor-ctl.js?v=<?php echo time(); ?>"></script>
    <script src="../assets/dist/code-editor/vendor/breakpoints/breakpoints.js"></script>
    <script>
        Breakpoints();
    </script>

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

<body class="animsition page-code-editor page-aside-scroll page-aside-left"
      style="padding: 0px; height: calc(100% - 150px)">

<div class="page" style="height: 100%;">
    <div class="page-aside">
        <div class="page-aside-switch">
            <i class="icon wb-chevron-left" aria-hidden="true"></i>
            <i class="icon wb-chevron-right" aria-hidden="true"></i>
        </div>
        <div class="page-aside-inner page-aside-scroll">
            <div data-role="container">
                <div data-role="content">
                    <section class="page-aside-section">
                        <h4 class="page-aside-title">Code Editor</h4>
                        <div id="filesTree"></div>
                        <!-- Your custom menu with dropdown-menu as default styling -->
                    </section>
                </div>
            </div>
        </div>
    </div>

    <div class="page-main">
        <div class="page-content" id="code-view-only">

            <div class="row" style="height: 100%; align-content: baseline;">

                <div id="configuration-options" style="display: none;">
                    <nav id="configuration-nav" class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="navbar-brand" href="#">bondedUI Builder</a>
                        <div class="navbar-nav mr-auto" style="margin-left: auto; margin-right: 25px !important;">
                            <ul class="nav navbar-nav">

                            </ul>
                        </div>
                    </nav>
                </div>
                <div id="html-options" style="display: none;">
                    <nav id="configuration-nav" class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="navbar-brand" href="#">HTML Template</a>
                    </nav>
                </div>
                <div id="data-options" style="display: none">
                    <nav id="configuration-nav" class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="navbar-brand" href="#">Data Object</a>
                        <div class="navbar-nav mr-auto" style="margin-left: auto; margin-right: 25px !important;">
                            <ul class="nav navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">New Field</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div id="ui-options" style="display:none;">
                    <nav id="configuration-nav" class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="navbar-brand" href="#">UI Methods</a>
                        <div class="navbar-nav mr-auto" style="margin-left: auto; margin-right: 25px !important;">
                            <ul class="nav navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">New Method</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div id="tasks-options" style="display: none;">
                    <nav id="configuration-nav" class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="navbar-brand" href="#">Tasks</a>
                        <div class="navbar-nav mr-auto" style="margin-left: auto; margin-right: 25px !important;">
                            <ul class="nav navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">New Task</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div id="variables-options" style="display: none;">
                    <nav id="configuration-nav" class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="navbar-brand" href="#">Global Variables</a>
                        <div class="navbar-nav mr-auto" style="margin-left: auto; margin-right: 25px !important;">
                            <ul class="nav navbar-nav">

                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col" style="height: 100%; display: none;" id="code-editor-container">
                    <textarea id="code-view-only-content"></textarea>
                </div>
                <div class="col" style="height: 100%; padding: 30px;" id="variables-form">
                    <form>

                        <h5 class="mb-3">Component Information</h5>

                        <hr class="my-4">

                        <div class="row g-3" style="margin-bottom: 20px;">
                            <div class="col-sm-6">
                                <label for="component-name" class="form-label">Component Name</label>
                                <input type="text" class="form-control" id="component-name" placeholder="dashboard" value="" required onkeyup="updateVariables(this)">
                            </div>
                            <div class="col-sm-6">
                                <label for="component-classname" class="form-label">Component Class Name</label>
                                <input type="text" class="form-control" id="component-classname" placeholder="Dashboard" value="" required onkeyup="updateVariables(this)">
                            </div>
                        </div>

                        <div class="row g-3" style="margin-bottom: 20px;">
                            <div class="col-sm-6">
                                <label for="sfc-path" class="form-label">Single-File Components Path</label>
                                <input type="text" class="form-control" id="sfc-path" placeholder="/path/to/vue/components" value="" required onkeyup="updateVariables(this)">
                            </div>
                            <div class="col-sm-6">
                                <label for="sfc-file" class="form-label">Single-File Component Filename</label>
                                <input type="text" class="form-control" id="sfc-file" placeholder="light-with-header-icons.vue" value="" required onkeyup="updateVariables(this)">
                            </div>
                        </div>

                        <div class="row g-3" style="margin-bottom: 30px;">
                            <div class="col-sm-12">
                                <label for="component-description" class="form-label">Component Description</label>
                                <textarea class="form-control" id="component-description" placeholder="Light Themed Dashboard with Header and Icons" value="" required onkeyup="updateVariables(this)"></textarea>
                            </div>
                        </div>

                        <div class="row g-3" style="margin-bottom: 30px;">
                            <div class="col-sm-12">
                                <label for="component-author" class="form-label">Author</label>
                                <input type="text" class="form-control" id="component-author" placeholder="John Doe (@john)" value="" required onkeyup="updateVariables(this)">
                            </div>
                        </div>

                        <h5 class="mb-3">Other Variables</h5>

                        <hr class="my-4">

                        <div class="form-check">
                            <input type="checkbox" class="" id="static-content" onchange="updateVariablesCheckbox(this)">
                            <label class="form-check-label" for="static-content">Static content only</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="" id="dark-light-themed" onchange="updateVariablesCheckbox(this)">
                            <label class="form-check-label" for="dark-light-themed">Dark and Light themed</label>
                        </div>

                    </form>
                </div>
                <div id="right-list-group" class="col-4"
                     style="margin-right: 20px; margin-top: 5px; overflow: scroll; height: calc(100% - 100px); display: none;">
                    <h5 style="margin-bottom: 15px;">Data</h5>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action
                             list-group-item-success list-group-item-heading" style="padding-bottom: 9px">
                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-auto flex-fill">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" style="vertical-align: -3.75px;margin-right: 5px;"
                                             class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                        <div class="inline text-left">
                                            <strong>message</strong>.title [string]
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             style="vertical-align: -3.75px;margin-right: 5px; margin-left: auto;"
                                             class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                        </svg>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action
                             list-group-item-info list-group-item-heading" style="padding-bottom: 9px">
                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-auto flex-fill">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" style="vertical-align: -3.75px;margin-right: 5px;"
                                             class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                        <div class="inline text-left">
                                            <strong>message</strong>.icon [string]
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             style="vertical-align: -3.75px;margin-right: 5px; margin-left: auto;"
                                             class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                        </svg>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action
                             list-group-item-info list-group-item-heading" style="padding-bottom: 9px">
                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-auto flex-fill">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" style="vertical-align: -3.75px;margin-right: 5px;"
                                             class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                        <div class="inline text-left">
                                            <strong>message</strong>.text [string]
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             style="vertical-align: -3.75px;margin-right: 5px; margin-left: auto;"
                                             class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                        </svg>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action
                             list-group-item-info list-group-item-heading" style="padding-bottom: 9px">
                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-auto flex-fill">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" style="vertical-align: -3.75px;margin-right: 5px;"
                                             class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                        <div class="inline text-left">
                                            <strong>message</strong>.text [string]
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             style="vertical-align: -3.75px;margin-right: 5px; margin-left: auto;"
                                             class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                        </svg>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action
                             list-group-item-info list-group-item-heading" style="padding-bottom: 9px">
                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-auto flex-fill">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" style="vertical-align: -3.75px;margin-right: 5px;"
                                             class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                        <div class="inline text-left">
                                            <strong>message</strong>.text [string]
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             style="vertical-align: -3.75px;margin-right: 5px; margin-left: auto;"
                                             class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                        </svg>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action
                             list-group-item-info list-group-item-heading" style="padding-bottom: 9px">
                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-auto flex-fill">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" style="vertical-align: -3.75px;margin-right: 5px;"
                                             class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                        <div class="inline text-left">
                                            <strong>message</strong>.text [string]
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             style="vertical-align: -3.75px;margin-right: 5px; margin-left: auto;"
                                             class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                        </svg>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action
                             list-group-item-info list-group-item-heading" style="padding-bottom: 9px">
                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-auto flex-fill">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" style="vertical-align: -3.75px;margin-right: 5px;"
                                             class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                        <div class="inline text-left">
                                            <strong>message</strong>.text [string]
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             style="vertical-align: -3.75px;margin-right: 5px; margin-left: auto;"
                                             class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                        </svg>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action
                             list-group-item-info list-group-item-heading" style="padding-bottom: 9px">
                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-auto flex-fill">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" style="vertical-align: -3.75px;margin-right: 5px;"
                                             class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                        <div class="inline text-left">
                                            <strong>message</strong>.text [string]
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             style="vertical-align: -3.75px;margin-right: 5px; margin-left: auto;"
                                             class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                        </svg>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action
                             list-group-item-info list-group-item-heading" style="padding-bottom: 9px">
                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-auto flex-fill">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" style="vertical-align: -3.75px;margin-right: 5px;"
                                             class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                        <div class="inline text-left">
                                            <strong>message</strong>.text [string]
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             style="vertical-align: -3.75px;margin-right: 5px; margin-left: auto;"
                                             class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                        </svg>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action
                             list-group-item-info list-group-item-heading" style="padding-bottom: 9px">
                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-auto flex-fill">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" style="vertical-align: -3.75px;margin-right: 5px;"
                                             class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                        <div class="inline text-left">
                                            <strong>message</strong>.text [string]
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             style="vertical-align: -3.75px;margin-right: 5px; margin-left: auto;"
                                             class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                        </svg>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action
                             list-group-item-info list-group-item-heading" style="padding-bottom: 9px">
                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-auto flex-fill">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" style="vertical-align: -3.75px;margin-right: 5px;"
                                             class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                        <div class="inline text-left">
                                            <strong>message</strong>.text [string]
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             style="vertical-align: -3.75px;margin-right: 5px; margin-left: auto;"
                                             class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                        </svg>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action
                             list-group-item-info list-group-item-heading" style="padding-bottom: 9px">
                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-auto flex-fill">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" style="vertical-align: -3.75px;margin-right: 5px;"
                                             class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                        <div class="inline text-left">
                                            <strong>message</strong>.text [string]
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             style="vertical-align: -3.75px;margin-right: 5px; margin-left: auto;"
                                             class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                        </svg>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action
                             list-group-item-info list-group-item-heading" style="padding-bottom: 9px">
                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-auto flex-fill">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" style="vertical-align: -3.75px;margin-right: 5px;"
                                             class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                        <div class="inline text-left">
                                            <strong>message</strong>.text [string]
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             style="vertical-align: -3.75px;margin-right: 5px; margin-left: auto;"
                                             class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                        </svg>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action
                             list-group-item-info list-group-item-heading" style="padding-bottom: 9px">
                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-auto flex-fill">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" style="vertical-align: -3.75px;margin-right: 5px;"
                                             class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                        <div class="inline text-left">
                                            <strong>message</strong>.text [string]
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             style="vertical-align: -3.75px;margin-right: 5px; margin-left: auto;"
                                             class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                        </svg>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action
                             list-group-item-info list-group-item-heading" style="padding-bottom: 9px">
                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-auto flex-fill">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" style="vertical-align: -3.75px;margin-right: 5px;"
                                             class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                        <div class="inline text-left">
                                            <strong>message</strong>.text [string]
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             style="vertical-align: -3.75px;margin-right: 5px; margin-left: auto;"
                                             class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                        </svg>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action
                             list-group-item-info list-group-item-heading" style="padding-bottom: 9px">
                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-auto flex-fill">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" style="vertical-align: -3.75px;margin-right: 5px;"
                                             class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                        <div class="inline text-left">
                                            <strong>message</strong>.text [string]
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             style="vertical-align: -3.75px;margin-right: 5px; margin-left: auto;"
                                             class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                        </svg>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action
                             list-group-item-info list-group-item-heading" style="padding-bottom: 9px">
                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-auto flex-fill">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" style="vertical-align: -3.75px;margin-right: 5px;"
                                             class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                        <div class="inline text-left">
                                            <strong>message</strong>.text [string]
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             style="vertical-align: -3.75px;margin-right: 5px; margin-left: auto;"
                                             class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                        </svg>
                                    </div>

                                </div>

                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action
                             list-group-item-info list-group-item-heading" style="padding-bottom: 9px">
                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-auto flex-fill">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" style="vertical-align: -3.75px;margin-right: 5px;"
                                             class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                        <div class="inline text-left">
                                            <strong>message</strong>.text [string]
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             style="vertical-align: -3.75px;margin-right: 5px; margin-left: auto;"
                                             class="bi bi-link-45deg" viewBox="0 0 16 16">
                                            <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                                            <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                                        </svg>
                                    </div>

                                </div>

                            </div>
                        </a>

                    </div>
                </div>

            </div>

        </div>
    </div>


</div>

</body>

<script src="../assets/dist/code-editor/vendor/babel-external-helpers/babel-external-helpers.js"></script>
<script src="../assets/dist/code-editor/vendor/jquery/jquery.js"></script>
<script src="../assets/dist/code-editor/vendor/popper-js/umd/popper.min.js"></script>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/dist/code-editor/vendor/animsition/animsition.js"></script>
<script src="../assets/dist/code-editor/vendor/mousewheel/jquery.mousewheel.js"></script>
<script src="../assets/dist/code-editor/vendor/asscrollbar/jquery-asScrollbar.js"></script>
<script src="../assets/dist/code-editor/vendor/asscrollable/jquery-asScrollable.js"></script>
<script src="../assets/dist/code-editor/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>

<!-- Plugins -->
<script src="../assets/dist/code-editor/vendor/switchery/switchery.js"></script>
<script src="../assets/dist/code-editor/vendor/intro-js/intro.js"></script>
<script src="../assets/dist/code-editor/vendor/screenfull/screenfull.js"></script>
<script src="../assets/dist/code-editor/vendor/slidepanel/jquery-slidePanel.js"></script>
<script src="../assets/dist/code-editor/vendor/bootstrap-treeview/bootstrap-treeview.min.js"></script>
<script src="../assets/dist/code-editor/vendor/codemirror/codemirror.js"></script>
<script src="../assets/dist/code-editor/vendor/codemirror/addon/scroll/simplescrollbars.js"></script>
<script src="../assets/dist/code-editor/vendor/codemirror/mode/xml/xml.js"></script>
<script src="../assets/dist/code-editor/vendor/codemirror/mode/css/css.js"></script>
<script src="../assets/dist/code-editor/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="../assets/dist/code-editor/vendor/jquery-contextmenu/jquery.contextMenu.js"></script>

<!-- Scripts -->
<script src="../assets/dist/code-editor/js/Component.js"></script>
<script src="../assets/dist/code-editor/js/Plugin.js"></script>
<script src="../assets/dist/code-editor/js/Base.js"></script>
<script src="../assets/dist/code-editor/js/Config.js"></script>

<script src="../assets/dist/code-editor/js/Section/Menubar.js"></script>
<script src="../assets/dist/code-editor/js/Section/GridMenu.js"></script>
<script src="../assets/dist/code-editor/js/Section/Sidebar.js"></script>
<script src="../assets/dist/code-editor/js/Section/PageAside.js"></script>
<script src="../assets/dist/code-editor/js/Plugin/menu.js"></script>

<script src="../assets/dist/code-editor/js/config/colors.js"></script>
<script src="../assets/dist/code-editor/js/config/tour.js"></script>
<script>Config.set('assets', 'assets');</script>

<!-- Page -->
<script src="../assets/dist/code-editor/js/Site.js"></script>
<script src="../assets/dist/code-editor/js/Plugin/asscrollable.js"></script>
<script src="../assets/dist/code-editor/js/Plugin/slidepanel.js"></script>
<script src="../assets/dist/code-editor/js/Plugin/switchery.js"></script>
<script src="../assets/dist/code-editor/js/Plugin/bootstrap-treeview.js"></script>

<script>

    let currentFilename = "<?php echo $filename; ?>";

</script>

<script src="./code-editor.js?v=11"></script>


<script>

    window.onload = function () {
        getEditorUpdate();
        console.log("test");
    }

</script>

</html>

