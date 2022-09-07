(function (global, factory) {
    if (typeof define === "function" && define.amd) {
        define("/pages/code-editor", ["jquery", "Site"], factory);
    } else if (typeof exports !== "undefined") {
        factory(require("jquery"), require("Site"));
    } else {
        var mod = {
            exports: {}
        };
        factory(global.jQuery, global.Site);
        global.pagesCodeEditor = mod.exports;
    }
})(this, function (_jquery, _Site) {
    "use strict";

    _jquery = babelHelpers.interopRequireDefault(_jquery);

    var _items;

    (0, _jquery.default)(document).ready(function ($$$1) {
        (0, _Site.run)();
    }); // Treeview
    // ---------

    (function () {
        var data = [{
            text: 'hyperUI Configuration',
            href: '#package.json',
            icon: 'fa fa-file-code-o',
        }, {
            text: 'Component Info',
            href: '#css',
            icon: 'fa fa-info'
        },
            {
                text: 'Template',
                href: '#css',
                icon: 'fa fa-paint-brush',
                state: {
                    expanded: true
                },
                nodes: [
                    {
                        text: 'HTML',
                        href: '#css',
                        icon: 'fa fa-code'
                    },
                    {
                        text: 'Data',
                        href: '#css',
                        icon: 'fa fa-file-text'
                    },
                    {
                        text: 'UI Methods',
                        href: '#css',
                        icon: 'fa fa-object-group'
                    }],
            },
            {
                text: 'JavaScript Tasks',
                href: '#css',
                icon: 'fa fa-terminal'
            }
        ];
        var defaults = Plugin.getDefaults("treeview");

        var options = _jquery.default.extend({}, defaults, {
            levels: 1,
            color: false,
            backColor: false,
            borderColor: false,
            onhoverColor: false,
            selectedColor: false,
            selectedBackColor: false,
            searchResultColor: false,
            searchResultBackColor: false,
            data: data,
            highlightSelected: true
        });

        (0, _jquery.default)('#filesTree').treeview(options);
    })(); // Codemirror
    // ----------


    CodeMirror.fromTextArea(document.getElementById('code'), {
        lineNumbers: !0,
        theme: 'eclipse',
        mode: 'text/html',
        scrollbarStyle: "simple"
    }); // Contextmenu
    // -----------

    _jquery.default.contextMenu({
        selector: '#filesTree',
        // callback: function(key, options) {
        //   var m = "clicked: " + key;
        //   window.console && console.log(m) || alert(m);
        // },
        items: (_items = {
            "rename": {
                name: "Rename ...",
                icon: function icon() {
                    return 'context-menu-icon context-menu-extend-icon wb-pencil';
                }
            },
            "search": {
                name: "Find in...",
                icon: function icon() {
                    return 'context-menu-icon context-menu-extend-icon wb-search';
                }
            },
            "sep1": "---------",
            "new": {
                name: "New File",
                icon: function icon() {
                    return 'context-menu-icon context-menu-extend-icon wb-file';
                }
            },
            "new-folder": {
                name: "New Folder",
                icon: function icon() {
                    return 'context-menu-icon context-menu-extend-icon wb-folder';
                }
            }
        }, babelHelpers.defineProperty(_items, "sep1", "---------"), babelHelpers.defineProperty(_items, "delete", {
            name: "Delete",
            icon: function icon() {
                return 'context-menu-icon context-menu-extend-icon wb-close';
            }
        }), _items)
    });
});