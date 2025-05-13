tags = [];

$(document).on("keydown", "#fakeinput", function (e) {
    var tagname = $("#tags-input").val().replace(",", "");

    if (tagname.length < 1 && e.keyCode == 8) {
        if (tags.length > 0) {
            deleteLastTagFromArray();
        }
    }
});

$(document).on("keyup", "#fakeinput", function (e) {
    var tagname = $("#tags-input").val().replace(",", "");
    if (e.keyCode == 188 || e.keyCode == 13) {
        console.log("enter or comma used");
        if (tagname.length > 2 && !doesTagExist(tagname)) {
            makeTag(tagname);
            addTagToArray(tagname);
        }
    }
});

function doesTagExist(tagname) {
    var o = 0;
    var len = tags.length;
    for (; o < len; o++) {
        if (tagname == tags[o]) {
            return ture;
        }
    }
    return false;
}

function makeTag(tagname) {
    var tagTemplate =
        '<div id="' + tagname + '" class="tag">' + tagname + "</div>";
    $(tagTemplate).insertBefore("#tags-input");
    $("#tags-input").val("");
}

function removeTag(tagname) {
    var tagid = "#" + tagname;
    $(tagid).remove();
}

function addTagToArray(tagname) {
    // code to come
    tags.push(tagname);
    demoUpdateArrayOnScreen();
}

function deleteLastTagFromArray() {
    var last = tags.length - 1;
    var lastTag = tags[last];
    // alert(tags[last]);
    removeTag(lastTag);
    deleteTagFromArray(lastTag);

    demoUpdateArrayOnScreen(); //demo
}

function deleteTagFromArray(tagname) {
    var i = 0;
    var len = tags.length;
    for (; i < len; i++) {
        if (tagname == tags[i]) {
            tags.splice(i, 1);
        }
    }
    demoUpdateArrayOnScreen(); // demo only
}

$(".fake-input--box").on("click", ".tag", function (e) {
    console.log("delete: " + this.id);
    removeTag(this.id);
    deleteTagFromArray(this.id);
});

// demo only
function demoUpdateArrayOnScreen() {
    $("#showarray").val(tags);
    var tree = JSON.stringify(tags, null, 2);
    $("#savearray").val("<pre>" + tree + "</pre>");
}
