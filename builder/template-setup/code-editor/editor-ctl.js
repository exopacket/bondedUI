let codeMirrorEditor;

function getEditorUpdate(index) {

    console.log("TEST");

    $.get("get-builder.php", {
            request_type: "update"
        },
        function (data) {

            console.log(index);

            let obj = data;//JSON.parse(data);

            switch (index) {
                case 0:
                    displayView(0, obj["hyper_file"]);
                    break;
                case 1:
                    displayView(1, obj);
                    break;
                default:
                    displayView(0, obj["hyper_file"]);
                    break;
            }

        }
    )

    console.log("tested");

}

function displayView(index, data) {

    let rightListGroup = $("#right-list-group");
    let tasksOptions = $("#tasks-options");
    let uiOptions = $("#ui-options");
    let dataOptions = $("#data-options");
    let htmlOptions = $("#html-options");
    let configOptions = $("#configuration-options");

    let txt_codeOnly = $("#code-view-only-content");

    if (index == 0) {

        rightListGroup.hide();
        tasksOptions.hide();
        uiOptions.hide();
        dataOptions.hide();
        htmlOptions.hide();
        configOptions.show();

        if (codeMirrorEditor) {
            codeMirrorEditor.setValue(data);
            codeMirrorEditor.clearHistory();
            //codeMirrorEditor.setMode("text/x-csrc");
            codeMirrorEditor.on("keyup", function (cm, event) {
                //getHtmlDataSidebar(data);
            })
        } else {

            txt_codeOnly.val(data);

            codeMirrorEditor = CodeMirror.fromTextArea(document.getElementById("code-view-only-content"), {
                theme: 'eclipse',
                mode: 'text/x-csrc',
                scrollbarStyle: "simple",
                styleActiveLine: true,
                lineNumbers: true,
                matchBrackets: true
            })

        }

    } else if (index == 1) {

        rightListGroup.show();
        tasksOptions.hide();
        uiOptions.hide();
        dataOptions.hide();
        htmlOptions.show();
        configOptions.hide();

        if (codeMirrorEditor) {
            codeMirrorEditor.setValue(data["template"]["html"]);
            codeMirrorEditor.clearHistory();
            //codeMirrorEditor.mode("text/html");
            codeMirrorEditor.on("keyup", function (cm, event) {
                console.log("keyup");
                getHtmlDataSidebar(data);
            })
        }

    } else if (index == 2) {

        rightListGroup.show();
        tasksOptions.hide();
        uiOptions.hide();
        dataOptions.show();
        htmlOptions.hide();
        configOptions.hide();

        if (codeMirrorEditor) {
            codeMirrorEditor.setValue(data);
            codeMirrorEditor.clearHistory();
            //codeMirrorEditor.setMode("text/html");
            codeMirrorEditor.on("keyup", function (cm, event) {
                console.log("keyup");
                getHtmlDataSidebar(data);
            })
        }

    }

}

function getHtmlDataSidebar(obj) {

    let data = obj['template']['data'];

    let inArr = [];

    let htmlStr = "";

    for (i = 0; i < data.length; i++) {

        let entry = data[i];

        if (entry['type'] == "object") {

            let children = entry['children'];

            for (x = 0; x < children.length; x++) {

                let child = children[x];
                let name = entry['name'];
                let key = child['key'];
                let type = child['type'];
                let defaultVal = child['default'];
                //let listeners

                let res = getInTemplateHtml(obj, name, key);
                let listItem = getListGroupItemHtml(name, key, type, defaultVal, -1, res[0], res[1]);
                htmlStr += listItem;
                let curr = name + (key == "") ? "" : ("." + key);
                inArr.push(curr);

            }

        } else {

            let name = entry['name'];
            let key = "";
            let type = entry['type'];
            let defaultVal = entry['default'];
            //let listeners

            let res = getInTemplateHtml(obj, name, key);
            let listItem = getListGroupItemHtml(name, key, type, defaultVal, -1, res[0], res[1]);
            htmlStr += listItem;
            let curr = name + (key == "") ? "" : ("." + key);
            inArr.push(curr);

        }

    }

    const re = /{{(\s+)?([a-zA-Z0-9\.]+)(\s+)?}}/g;
    const str = codeMirrorEditor.getValue();
    let matchArr = str.match(re);

    if (matchArr) {

        let found = false;

        for (i = 0; i < matchArr.length; i++) {

            let match = matchArr[i].replace(/({{(\s+)?)|((\s+)?}})/g, "");

            for (x = 0; x < inArr.length; x++) {

                if (match == inArr[x]) {
                    found = true;
                    break;
                }

            }

            if (!found) {

                let name = "";
                let key = "";

                if (match.indexOf('.') > 0) {
                    const arr = match.split('.');
                    name = arr[0];
                    key = arr[1];
                } else {
                    name = match;
                }

                let res = getInTemplateHtml(obj, name, key);
                let listItem = getListGroupItemHtml(name, key, "other", "", -1, res[0], res[1]);
                htmlStr += listItem;

            }

        }

    }

    $("#right-list-group .list-group").html(htmlStr);

}

function getInTemplateHtml(obj, name, key) {

    let data = obj['template']['data'];

    let res = [false, false];

    let curr = name + (key == "") ? "" : ("." + key);

    const re = /{{(\s+)?([a-zA-Z0-9\.]+)(\s+)?}}/g;
    const str = codeMirrorEditor.getValue();
    let matchArr = str.match(re);

    if (matchArr) {

        for (i = 0; i < matchArr.length; i++) {

            let match = matchArr[i].replace(/({{(\s+)?)|((\s+)?}})/g, "");
            console.log("found match! == " + match)

            if (match == curr) {
                res[1] = true;
                break;
            }

        }

    } else {
        console.log("no match");
    }

    for (i = 0; i < data.length; i++) {

        let entry = data[i];

        if (entry['type'] == "object") {

            let children = entry['children'];
            let flag = false;

            for (x = 0; x < children.length; x++) {

                let child = children[x];
                let name = entry['name'];
                let key = child['key'];

                let val = name + "." + key;

                if (val == curr) {
                    flag = true;
                    res[0] = true;
                    break;
                }

            }

            if (flag) {
                break;
            }

        } else {

            let name = entry['name'];

            if (name == curr) {
                res[0] = true;
                break;
            }

        }

    }

    return res;

}

function getListGroupItemHtml(name, key, type, defaultVal, listeners, inSchema, inTemplate) {

    let icon = "";

    let _type = type;
    let classStr = "";

    if (!inSchema && inTemplate) {
        classStr = "list-group-item-danger";
    } else if (inSchema && inTemplate) {
        classStr = "list-group-item-success";
    } else if (inSchema && !inTemplate) {
        classStr = "list-group-item-info";
    }

    if (_type == "string") {
        icon = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" style=\"vertical-align: -3.75px;margin-right: 5px;\" class=\"bi bi-card-text\" viewBox=\"0 0 16 16\">\n" +
            "                                            <path d=\"M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z\"/>\n" +
            "                                            <path d=\"M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z\"/>\n" +
            "                                        </svg>";
    } else if (_type == "integer") {
        icon = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" style=\"vertical-align: -3.75px;margin-right: 5px;\" class=\"bi bi-123\" viewBox=\"0 0 16 16\">\n" +
            "  <path d=\"M2.873 11.297V4.142H1.699L0 5.379v1.137l1.64-1.18h.06v5.961h1.174Zm3.213-5.09v-.063c0-.618.44-1.169 1.196-1.169.676 0 1.174.44 1.174 1.106 0 .624-.42 1.101-.807 1.526L4.99 10.553v.744h4.78v-.99H6.643v-.069L8.41 8.252c.65-.724 1.237-1.332 1.237-2.27C9.646 4.849 8.723 4 7.308 4c-1.573 0-2.36 1.064-2.36 2.15v.057h1.138Zm6.559 1.883h.786c.823 0 1.374.481 1.379 1.179.01.707-.55 1.216-1.421 1.21-.77-.005-1.326-.419-1.379-.953h-1.095c.042 1.053.938 1.918 2.464 1.918 1.478 0 2.642-.839 2.62-2.144-.02-1.143-.922-1.651-1.551-1.714v-.063c.535-.09 1.347-.66 1.326-1.678-.026-1.053-.933-1.855-2.359-1.845-1.5.005-2.317.88-2.348 1.898h1.116c.032-.498.498-.944 1.206-.944.703 0 1.206.435 1.206 1.07.005.64-.504 1.106-1.2 1.106h-.75v.96Z\"/>\n" +
            "</svg>";
    } else if (_type == "decimal") {
        icon = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" style=\"vertical-align: -3.75px;margin-right: 5px;\" class=\"bi bi-123\" viewBox=\"0 0 16 16\">\n" +
            "  <path d=\"M2.873 11.297V4.142H1.699L0 5.379v1.137l1.64-1.18h.06v5.961h1.174Zm3.213-5.09v-.063c0-.618.44-1.169 1.196-1.169.676 0 1.174.44 1.174 1.106 0 .624-.42 1.101-.807 1.526L4.99 10.553v.744h4.78v-.99H6.643v-.069L8.41 8.252c.65-.724 1.237-1.332 1.237-2.27C9.646 4.849 8.723 4 7.308 4c-1.573 0-2.36 1.064-2.36 2.15v.057h1.138Zm6.559 1.883h.786c.823 0 1.374.481 1.379 1.179.01.707-.55 1.216-1.421 1.21-.77-.005-1.326-.419-1.379-.953h-1.095c.042 1.053.938 1.918 2.464 1.918 1.478 0 2.642-.839 2.62-2.144-.02-1.143-.922-1.651-1.551-1.714v-.063c.535-.09 1.347-.66 1.326-1.678-.026-1.053-.933-1.855-2.359-1.845-1.5.005-2.317.88-2.348 1.898h1.116c.032-.498.498-.944 1.206-.944.703 0 1.206.435 1.206 1.07.005.64-.504 1.106-1.2 1.106h-.75v.96Z\"/>\n" +
            "</svg>";
    } else if (_type == "currency") {
        icon = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" style=\"vertical-align: -3.75px;margin-right: 5px;\" fill=\"currentColor\" class=\"bi bi-cash\" viewBox=\"0 0 16 16\">\n" +
            "  <path d=\"M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z\"/>\n" +
            "  <path d=\"M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z\"/>\n" +
            "</svg>"
    } else if (_type == "datetime") {
        icon = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" style=\"vertical-align: -3.75px;margin-right: 5px;\" fill=\"currentColor\" class=\"bi bi-clock-fill\" viewBox=\"0 0 16 16\">\n" +
            "  <path d=\"M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z\"/>\n" +
            "</svg>"
    } else if (_type == "picture") {
        icon = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" style=\"vertical-align: -3.75px;margin-right: 5px;\" fill=\"currentColor\" class=\"bi bi-image\" viewBox=\"0 0 16 16\">\n" +
            "  <path d=\"M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z\"/>\n" +
            "  <path d=\"M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z\"/>\n" +
            "</svg>"
    } else if (_type == "color") {
        icon = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" style=\"vertical-align: -3.75px;margin-right: 5px;\" fill=\"currentColor\" class=\"bi bi-palette\" viewBox=\"0 0 16 16\">\n" +
            "  <path d=\"M8 5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm4 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM5.5 7a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm.5 6a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z\"/>\n" +
            "  <path d=\"M16 8c0 3.15-1.866 2.585-3.567 2.07C11.42 9.763 10.465 9.473 10 10c-.603.683-.475 1.819-.351 2.92C9.826 14.495 9.996 16 8 16a8 8 0 1 1 8-8zm-8 7c.611 0 .654-.171.655-.176.078-.146.124-.464.07-1.119-.014-.168-.037-.37-.061-.591-.052-.464-.112-1.005-.118-1.462-.01-.707.083-1.61.704-2.314.369-.417.845-.578 1.272-.618.404-.038.812.026 1.16.104.343.077.702.186 1.025.284l.028.008c.346.105.658.199.953.266.653.148.904.083.991.024C14.717 9.38 15 9.161 15 8a7 7 0 1 0-7 7z\"/>\n" +
            "</svg>"
    } else if (_type == "other") {
        icon = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" style=\"vertical-align: -3.75px;margin-right: 5px;\" fill=\"currentColor\" class=\"bi bi-question-circle-fill\" viewBox=\"0 0 16 16\">\n" +
            "  <path d=\"M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z\"/>\n" +
            "</svg>"
    }

    return "<a href=\"#\" class=\"list-group-item list-group-item-action\n" +
        "                             " + classStr + " list-group-item-heading\" style=\"padding-bottom: 9px\">\n" +
        "                            <div class=\"container-fluid\">\n" +
        "\n" +
        "                                <div class=\"row\">\n" +
        "\n" +
        "                                    <div class=\"col-md-auto flex-fill\">\n" +
        "                                        \n" + icon +
        "                                        <div class=\"inline text-left\">\n" +
        "                                            <strong>message</strong>.text [string]\n" +
        "                                        </div>\n" +
        "                                    </div>\n" +
        "                                    <div class=\"col-md-auto\">\n" +
        "                                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" style=\"vertical-align: -3.75px;margin-right: 5px; margin-left: auto;\" class=\"bi bi-link-45deg\" viewBox=\"0 0 16 16\">\n" +
        "                                            <path d=\"M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z\"/>\n" +
        "                                            <path d=\"M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z\"/>\n" +
        "                                        </svg>\n" +
        "                                    </div>\n" +
        "\n" +
        "                                </div>\n" +
        "\n" +
        "                            </div>\n" +
        "                        </a>";

}

function getEditorData() {


}