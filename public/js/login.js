$(function(){
   $("input[name='btn-login']").click(checkLogin);

    $("input").keydown(function(){
        $(".message").html("");
    });
});

function checkLogin(){

    var frm = $("#form-login").serialize();

    $(".message").html("Checking...");

    $.ajax({
        url: root + 'is-valid-user',
        type: 'post',
        data: frm,
        success: function(data){

            if(data.indexOf('invalid')>-1)
                $(".message").html('Invalid email or password');
            else
                window.location.replace(root + 'user-section');
        }
    });
}