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
      success: function(dato){
        console.log(dato);
        if (data == "null") {
          Swal.fire({
            type: 'error',
            title: 'Las contraseñas no coinciden.',
            text: 'Intentar de nuevo.',
          });  
        }
      }
    });
  }



});