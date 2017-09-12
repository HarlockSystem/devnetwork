

function snippetCopy() {

    document.execCommand('copy');
}


function snippetSelectAll() {
    var nber = $(this).data("editor");
    if ($("#editor" + nber ).data("snippet")) {
        editor[nber].selectAll();
        editor[nber].focus();
    }
    else if(!$("#editor"+nber).data("snippet"))
    {
        var doc = document.getElementById("editor" + nber);
        window.getSelection().selectAllChildren( doc );
    }
}

$(".select_all").click(snippetSelectAll);

$(".copy").click(snippetCopy);