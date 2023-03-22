$('#frmlogin').submit(function (e) {
    e.preventDefault();

    var email = $.trim($('#floatingInput').val());
    var psw = $.trim($('#floatingPassword').val());

    if (email.length == "" || psw.length == "") {
        Swal.fire({
            type: 'warning',
            title: 'Llene todos los campos'
        });
        return false;
    } else{
        $.ajax({
            url: 'login/login.php',
            type: 'POST',
            datatype: 'json',
            data: {usuario:usuario, psw:psw},
            success: function(data){
                if(data == 'null'){
                    Swal.fire({
                        type: 'error',
                        title: 'Usuario y/o contraseña incorrectas',
                        text: 'Favor de verificar e intentarlo de nuevo',
                    });
                } else{
                    Swal.fire({
                        type: 'success',
                        title: 'Bienvenido',
                        confirmButtonText: 'Ingresar'
                    }).then((result) => {
                        if(result.value){
                            window.location.href = '../inicio.php';
                        }
                    })
                }
            }
        });
    }
});