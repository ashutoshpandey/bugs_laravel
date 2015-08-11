$(function(){

    getBugComments();

    $(".add-file").click(addFile);

    $("#ifr").load(function(){

        $(".single-file").remove();
        $("textarea").val('');

        getBugComments();
    });
});

function checkComment(){

    var comment = $("textarea[name='comment']").val();

    return comment.length>0;
}

function getBugComments(){

    $.ajax({
        url: root + 'data-list-bug-comments',
        type: 'get',
        dataType: 'json',
        success: function(result){

            if(result.message.indexOf('not logged')>-1) {
                window.location.replace = root;
                return;
            }

            var comments = getBugTable(result);

            if(comments!=null){

                $("#bug-comments").html(comments);
            }
            else
                $("#bug-comments").html("No comments added");
        }
    });
}

function getBugTable(data){

    if(data==undefined || data.found==undefined || data.found==false || data.comments==undefined)
        return null;
    else{

        var str = '';

        for(var i=0; i<data.comments.length;i++){

            var comment = data.comments[i];

            if(i<data.comments.length-1)
                str += '<div class="comment-data bottom-border">';
            else
                str += '<div class="comment-data">';

                str += '<div class="comment-by">' + comment.user.name + '</div>';
                str += '<div class="comment-date">' + comment.created_at + '</div>';

                str += '<div>' + comment.comment + '</div>';

                if(comment.bug_comment_files!=undefined && comment.bug_comment_files.length>0){

                    for(var j=0; j<comment.bug_comment_files.length; j++){

                        var bugCommentFile = comment.bug_comment_files[j];

                        str += '<div class="bug-comment-file"><a href="' + root + '/public/uploads/' + bugCommentFile.saved_file_name + '" target="_blank">' + bugCommentFile.file_name + '</a></div>';
                    }
                }

            str += '</div>';
        }

        return str;
    }
}

function addFile(){

    var file = "<div class='single-file'>";
    file += "<input type='file' name='file[]'/>";
    file += "<img class='remove-file icon' src='" + root + "public/images/remove.png'/>";
    file += "</div>";

    $(".file-container").append(file);

    $(".remove-file").unbind('click');
    $(".remove-file").click(removeFile);
}

function removeFile(){
    $(this).parent().remove();
}
