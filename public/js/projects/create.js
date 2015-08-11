$(function(){

    $.validator.setDefaults({
        submitHandler: function() {
            createProject();
        }
    });

    $("input, textarea").keydown(function(){
        $(".message").html("");
    });

    initializeValidation();
});

function createProject(){

    $(".message").html("Creating project...");

    var data = $("#form-project").serialize();

    $.ajax({
        url: root + 'save-project',
        data: data,
        type: 'post',
        success: function(result){

            if(result.indexOf('not logged')>-1) {
                window.location.replace(root);
                return;
            }

            if(result.indexOf('duplicate')>-1)
                $(".message").html('Project title is duplicate');
            else if(result.indexOf('done')>-1){
                $("input[type='text'], textarea").val('');
                $(".message").html('Project created successfully');
            }
        }
    });

    return false;
}

function initializeValidation(){
    $("#form-project").validate({
        rules: {
            name: "required"
        },
        messages: {
            name: "Please enter project name"
        }
    });
}