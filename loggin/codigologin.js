
$('#frmlogin').submit(function (e) {
  e.preventDefault();

  var user = $.trim($('#user').val());
  var pass = $.trim($('#pass').val());

  if (user.length == "" || pass.length == "") {
    Swal.fire({
      type: 'warning',
      title: 'Llene todos los campos',
    });
    return false;

  } else {
    $.ajax({
      url: "loggin/validar.php",
      type: "POST",
      datatype: "json",
      data: { user: user, pass: pass },
      success: function (data) {
        if (data == "null") {
          Swal.fire({
            type: 'error',
            title: 'Usuario y/o contraseña incorrecta',
          });
        } else {
          Swal.fire({
            type: 'success',
            title: 'Bienvenido',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ingresar'
          }).then((result) => {
            if (result.value) {
              window.location.href = "inicio.php";
            }
          });
        }
      }
    })
  }
});

$('#frmrecovery').submit(function (e) {
  e.preventDefault();

  var nuevapsw = $('#nuevapsw').val();
  var reppswpsw = $('#reppsw').val();

  if (nuevapsw.length == "" || reppsw.length == "") {
    Swal.fire({
      type: 'warning',
      title: 'Llene todos los campos',
    });
    return false;
  }else{
    $.ajax({
      url: 'login/respsw.php',
      type: 'POST',
      datatype: 'json',
      data: {nuevapsw : nuevapsw, reppsw:reppsw},
      success: function(data){
        console.log(data);
        if (data == "null") {
          Swal.fire({
            type: 'error',
            title: 'Las contraseñas no coinciden.',
            text: 'Intentar de nuevo.',
          });  
        }else{
          window.location.href = "index.php?message=success_psw";
        }
      }
    });
  }



});