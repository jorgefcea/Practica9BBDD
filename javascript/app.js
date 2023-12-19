$(document).ready(function(){
    $("#loginForm").bind("submit", function(){
        $.ajax({
            type: $(this).attr("method"),
            url: $(this).attr("action"),
            data: $(this).serialize(),
            beforeSend:function(){
                $("#loginForm button[type=submit]").html("ENVIANDO...");
                $("#loginForm button[type=submit]").attr("disabled", "disabled");
            },
            success: function(response) {
                if(response.estado == "true") {
                    $("body").overhang({
                        type: "success",
                        message: "¡Inicio de sesión exitoso! En breves, será redirigid@ a la página principal.",
                        callback: function() {
                            window.location.href = "admin.php";
                        }
                    });
                }else {
                    $("body").overhang({
                        type: "error",
                        message: "Hubo un error en el inicio de sesión."
                    });
                }
                $("#loginForm button[type=submit]").html("INICIAR SESIÓN");
                $("#loginForm button[type=submit]").removeAttr("disabled");
            },
            error: function() {
                $("body").overhang({
                    type: "error",
                    message: "Hubo un error en el inicio de sesión."
                });
                $("#loginForm button[type=submit]").html("INICIAR SESIÓN");
                $("#loginForm button[type=submit]").removeAttr("disabled");
            }
        });

        return false;
    });
});

