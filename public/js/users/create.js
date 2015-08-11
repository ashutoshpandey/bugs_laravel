$(function(){
    $.validator.setDefaults({
        submitHandler: function() {
            createUser();

            return false;
        }
    });

    $("input, textarea").keydown(function(){
        $(".message").html("");
    });

    initializeValidation();
});

function createUser(){

    $(".message").html("Create user...");

    var data = $("#form-create-user").serialize();

    $.ajax({
        url: root + 'save-user',
        data: data,
        type: 'post',
        success: function(result){

            if(result.indexOf('not logged')>-1) {
                window.location.replace(root);
                return;
            }

            $(".message").html(result);

            $("input[type='text'], input[type='password'], textarea").val('');
        }
    })
}

function initializeValidation(){
    $("#form-create-user").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            name: "required",
            password: "required",
            confirm_password: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            email: "Please enter a valid email",
            name: "Please enter name",
            password: "Please enter password",
            confirm_password: {
                required: "Please provide a password",
                equalTo: "Please enter the same password as above"
            }
        }
    });
}