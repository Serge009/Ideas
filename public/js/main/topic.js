url = "/ideas/";
button   = null;
textarea = null;
mass_mark = [2, 4, 6, 8, 10];

$(document).ready(function() {
    $(document).on("tap", "input.send", function() {
        button = $(this);
        textarea = $(button).closest("form").find("textarea.comment");
        var comment = $(textarea).val();
        var id_topic = $(button).closest("[data-id-discussion]").attr("data-id-discussion");
        if(comment == "") {
            alert("Fill in the comment field!");
            return;
        }
        sendComment(comment, id_topic);
    });

    $(document).on("tap", ".evaluate_star i", function() {
        var mark = +$(this).attr("mark");

        changeClassStar($(this));

        if($.inArray(mark, mass_mark) == -1) {
            return;
        }

        var id_topic = $(this).closest("[data-id-discussion]").attr("data-id-discussion");
        sendDataVote(mark, id_topic);
    });
});

function sendComment(comment, id_topic) {
    //alert(id_topic);
    //alert(comment);
    var tr = $(button).closest("tr");

    $.ajax({
        dataType: "json",
        url:      url + "main/createComment",
        type:     "POST",
        data:  {
            "topic":    id_topic,
            "comment":  comment
        },
        success: function(responce) {
            if(("status" in responce) && responce.status == false) {
                alert("Error");
                return;
            }
            if(("status" in responce) && responce.status == true) {
                var tr = $(button).closest("tr");
                $(tr).before(
                    '<tr>' +
                        '<td class="author_comment">' +
                        '<span>'+ responce.name + ' ' + responce.surname +'</span>' +
                        '</td>' +
                        '<td class="comment">' +
                        '<span>'+ comment +'</span>' +
                        '</td>' +
                        '</tr>');
                $(textarea).val("");
            }
        }

    });

}

function sendDataVote(mark, id_topic) {
    //alert(mark);
    //alert(id_topic);
    $.ajax({
        dataType: "json",
        url:      url + "main/createVote",
        type:     "POST",
        data:  {
            "topic":    id_topic,
            "mark":     mark
        },
        success: function(responce) {
            if(responce == 1) {
                //alert("Your vote took");
            }
            if(responce == 0) {
                alert("Error!");
            }
        }
    });
}

function changeClassStar(elem) {
    var i = $(elem).closest(".evaluate_star").find("i");
    var index_elem = $(i).index($(elem));
    //alert(index_elem);
    var i_full = $(i).slice(0, index_elem + 1);
    $.each(i_full, function(index, value) {
        $(value).addClass("full");
    });

    var i_empty = $(i).slice(index_elem + 1);
    $.each(i_empty, function(index, value) {
        if($(value).hasClass("full")) {
            $(value).removeClass("full");
        }
        $(value).addClass("empty");
    });
}