$(function(){
    $.validator.setDefaults({
        submitHandler: function() {
            updateProject();

            return false;
        }
    });

    $("input, textarea").keydown(function(){
        $(".message").html("");
    });

    initializeValidation();
});

function updateProject(){

    $(".message").html("Updating project...");

    var data = $("#form-update-project").serialize();

    $.ajax({
        url: root + 'update-project',
        data: data,
        type: 'post',
        success: function(result){

            if(result.indexOf('not logged')>-1) {
                window.location.replace(root);
                return;
            }

            if(result.indexOf('done')>-1)
                $(".message").html('Project updated successfully');
            else
                $(".message").html('There was some error');
        }
    })
}

function initializeValidation(){
    $("#form-update-project").validate({
        rules: {
            name: "required"
        },
        messages: {
            name: "Please enter project name"
        }
    });
}