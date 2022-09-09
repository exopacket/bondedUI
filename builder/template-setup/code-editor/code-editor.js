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
            text: 'bondedUI Configuration',
            href: 'javascript: getEditorUpdate(0)',
            icon: 'fa fa-file-code-o',
        }, {
            text: 'HTML',
            href: 'javascript: getEditorUpdate(1)',
            icon: 'fa fa-code'
        },
            {
                text: 'Data',
                href: 'javascript: getEditorUpdate(2)',
                icon: 'fa fa-file-text'
            },
            {
                text: 'UI Methods',
                href: 'javascript: getEditorUpdate(3)',
                icon: 'fa fa-object-group'
            },
            {
                text: 'Tasks',
                href: 'javascript: getEditorUpdate(4)',
                icon: 'fa fa-terminal',
            }
        ];
        var defaults = Plugin.getDefaults("treeview");

        var options = _jquery.default.extend({}, defaults, {
            levels: 1,
            color: false,
            backColor: false,
            borderColor: false,
            onhoverColor: true,
            selectedColor: false,
            selectedBackColor: false,
            searchResultColor: false,
            searchResultBackColor: false,
            data: data,
            highlightSelected: false,
            enableLinks: true,
        });

        (0, _jquery.default)('#filesTree').treeview(options);
    })(); // Codemirror
    // ----------// Contextmenu
    // -----------
});