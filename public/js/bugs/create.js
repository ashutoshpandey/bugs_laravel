$(function(){

    $.validator.setDefaults({
        submitHandler: function() {
            $(".message").html("Creating bug...");

            return true;
        }
    });

    $(".add-file").click(addFile);

    $("input, textarea").keydown(function(){
        $(".message").html("");
    });

    initializeValidation();

    $("#ifr").load(function(){

        var result = $(this).contents().find('body').html();


        if(result.indexOf('not logged')>-1) {
            window.location.replace(root);
            return;
        }

        if(result.indexOf('duplicate')>-1)
            $(".message").html('Bug title is duplicate');
        else if(result.indexOf('done')>-1) {
            $(".message").html('Bug created successfully');
            $(".single-file").remove();
            $("select[name='users'] option:selected").removeAttr("selected");
            $("input[type='text'], textarea").val('');
        }
    });

});

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

function initializeValidation(){
    $("#form-bug").validate({
        rules: {
            title: "required"
        },
        messages: {
            name: "Please enter project name"
        }
    });
}