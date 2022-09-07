<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.101.0">
    <title>HyperUI Builder</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/dist/code-editor/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/dist/code-editor/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="assets/dist/code-editor/css/site.min.css">

    <!-- Plugins -->
    <link rel="stylesheet" href="assets/dist/code-editor/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="assets/dist/code-editor/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="assets/dist/code-editor/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="assets/dist/code-editor/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="assets/dist/code-editor/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="assets/dist/code-editor/vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="assets/dist/code-editor/vendor/bootstrap-treeview/bootstrap-treeview.css">
    <link rel="stylesheet" href="assets/dist/code-editor/vendor/codemirror/codemirror.css">
    <link rel="stylesheet" href="assets/dist/code-editor/vendor/codemirror/addon/scroll/simplescrollbars.css">
    <link rel="stylesheet" href="assets/dist/code-editor/vendor/jquery-contextmenu/jquery.contextMenu.css">
    <link rel="stylesheet" href="assets/dist/code-editor/examples/css/pages/code-editor.css">


    <!-- Fonts -->
    <link rel="stylesheet" href="assets/dist/code-editor/fonts/font-awesome/font-awesome.css">
    <link rel="stylesheet" href="assets/dist/code-editor/fonts/web-icons/web-icons.min.css">
    <link rel="stylesheet" href="assets/dist/code-editor/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    <!--[if lt IE 9]>
    <script src="assets/dist/code-editor/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="assets/dist/code-editor/vendor/media-match/media.match.min.js"></script>
    <script src="assets/dist/code-editor/vendor/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="assets/dist/code-editor/vendor/breakpoints/breakpoints.js"></script>
    <script>
        Breakpoints();
    </script>

</head>

<body class="animsition page-code-editor page-aside-scroll page-aside-left"
      style="padding: 0px; height: calc(100% - 150px)">

<div class="site-gridmenu">
    <div>
        <div>
            <ul>
                <li>
                    <a href="../apps/mailbox/mailbox.html">
                        <i class="icon wb-envelope"></i>
                        <span>Mailbox</span>
                    </a>
                </li>
                <li>
                    <a href="../apps/calendar/calendar.html">
                        <i class="icon wb-calendar"></i>
                        <span>Calendar</span>
                    </a>
                </li>
                <li>
                    <a href="../apps/contacts/contacts.html">
                        <i class="icon wb-user"></i>
                        <span>Contacts</span>
                    </a>
                </li>
                <li>
                    <a href="../apps/media/overview.html">
                        <i class="icon wb-camera"></i>
                        <span>Media</span>
                    </a>
                </li>
                <li>
                    <a href="../apps/documents/categories.html">
                        <i class="icon wb-order"></i>
                        <span>Documents</span>
                    </a>
                </li>
                <li>
                    <a href="../apps/projects/projects.html">
                        <i class="icon wb-image"></i>
                        <span>Project</span>
                    </a>
                </li>
                <li>
                    <a href="../apps/forum/forum.html">
                        <i class="icon wb-chat-group"></i>
                        <span>Forum</span>
                    </a>
                </li>
                <li>
                    <a href="../index.html">
                        <i class="icon wb-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

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
        <div class="page-content">
          <textarea id="code"><!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <p>Hello world! This is HTML5 Boilerplate.</p>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery//jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html></textarea>
        </div>
    </div>


</div>

</body>

<script src="assets/dist/code-editor/vendor/babel-external-helpers/babel-external-helpers.js"></script>
<script src="assets/dist/code-editor/vendor/jquery/jquery.js"></script>
<script src="assets/dist/code-editor/vendor/popper-js/umd/popper.min.js"></script>
<script src="assets/dist/code-editor/vendor/bootstrap/bootstrap.js"></script>
<script src="assets/dist/code-editor/vendor/animsition/animsition.js"></script>
<script src="assets/dist/code-editor/vendor/mousewheel/jquery.mousewheel.js"></script>
<script src="assets/dist/code-editor/vendor/asscrollbar/jquery-asScrollbar.js"></script>
<script src="assets/dist/code-editor/vendor/asscrollable/jquery-asScrollable.js"></script>
<script src="assets/dist/code-editor/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>

<!-- Plugins -->
<script src="assets/dist/code-editor/vendor/switchery/switchery.js"></script>
<script src="assets/dist/code-editor/vendor/intro-js/intro.js"></script>
<script src="assets/dist/code-editor/vendor/screenfull/screenfull.js"></script>
<script src="assets/dist/code-editor/vendor/slidepanel/jquery-slidePanel.js"></script>
<script src="assets/dist/code-editor/vendor/bootstrap-treeview/bootstrap-treeview.min.js"></script>
<script src="assets/dist/code-editor/vendor/codemirror/codemirror.js"></script>
<script src="assets/dist/code-editor/vendor/codemirror/addon/scroll/simplescrollbars.js"></script>
<script src="assets/dist/code-editor/vendor/codemirror/mode/xml/xml.js"></script>
<script src="assets/dist/code-editor/vendor/codemirror/mode/css/css.js"></script>
<script src="assets/dist/code-editor/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="assets/dist/code-editor/vendor/jquery-contextmenu/jquery.contextMenu.js"></script>

<!-- Scripts -->
<script src="assets/dist/code-editor/js/Component.js"></script>
<script src="assets/dist/code-editor/js/Plugin.js"></script>
<script src="assets/dist/code-editor/js/Base.js"></script>
<script src="assets/dist/code-editor/js/Config.js"></script>

<script src="assets/dist/code-editor/js/Section/Menubar.js"></script>
<script src="assets/dist/code-editor/js/Section/GridMenu.js"></script>
<script src="assets/dist/code-editor/js/Section/Sidebar.js"></script>
<script src="assets/dist/code-editor/js/Section/PageAside.js"></script>
<script src="assets/dist/code-editor/js/Plugin/menu.js"></script>

<script src="assets/dist/code-editor/js/config/colors.js"></script>
<script src="assets/dist/code-editor/js/config/tour.js"></script>
<script>Config.set('assets', 'assets');</script>

<!-- Page -->
<script src="assets/dist/code-editor/js/Site.js"></script>
<script src="assets/dist/code-editor/js/Plugin/asscrollable.js"></script>
<script src="assets/dist/code-editor/js/Plugin/slidepanel.js"></script>
<script src="assets/dist/code-editor/js/Plugin/switchery.js"></script>
<script src="assets/dist/code-editor/js/Plugin/bootstrap-treeview.js"></script>

<script src="assets/dist/code-editor/examples/js/pages/code-editor.js"></script>

</html>

