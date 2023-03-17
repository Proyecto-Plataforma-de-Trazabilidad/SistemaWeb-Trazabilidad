$('frmlogin').submit(function (e) {
    e.preventDefault();

    var email = $.trim($('#floatingInput').val());
    var psw = $.trim($('#floatingPassword').val());

    if (email.length == "" || psw.length == "") {
        Swal.fire({
            type: 'warning',
            title: 'Llene todos los campos'
        });
        return false;
    }
});