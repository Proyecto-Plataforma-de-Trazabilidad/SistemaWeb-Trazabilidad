console.log("llego al js");
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
        
    }else{
      console.log("usuario:");
      console.log(user);
      console.log("Contraseña");
      console.log(pass);
      $.ajax({
        url:"loggin/validar.php",
        type:"POST",
        datatype:"json",
        data:{user:user, pass:pass},
        success:function(data){
          if(data == "null"){
            Swal.fire({
              type:'error',
              title:'Usuario y/o contraseña incorrecta',
            });
          }else{
            Swal.fire({
              type:'success',
              title:'Bienvenido',
              confirmButtonColor:'#3085d6',
              confirmButtonText:'Ingresar'
            }).then((result) => {
              if(result.value){
                window.location.href = "inicio.php";
              }
            })
          }
        }
      })
    }
});