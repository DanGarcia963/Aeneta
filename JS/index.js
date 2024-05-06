$(document).ready(() => {
    // Se inicia ocultando los recuadros de log-in y mostrando los botones
    $('.buttons').show();
    $('.err_cred').hide();
    $('#formulario').hide();
    $('#form_recupera').hide();
    // Click en Regresar y se oculta el formulario
    $('.back').click(() => {
        $('.buttons').show();
        $('#formulario').hide();
        $('#form_recupera').hide();
    });
    // Click en Administrados y se muestra el formulario
    $('#adminbtn').click(() => {
        $('.buttons').hide();
        $('#formulario').show();
    });
    // Click en Recuperar y se muestra el formulario
    $('.btnpdf').click(() => {
        $('.buttons').hide();
        $('#form_recupera').show();
    });
   
    // Click en Recuperar y se mandan datos a la generación del PDF
    $('#login').click(() => {
        if ($('#correo').val() === 'root' && $('#contra').val() === 'root') {
            $.post('PHP/sesiones.php', {usuario : 'root'}, function (response) {
                alert(response);
                window.location.href = 'index.php';
            })
        }else{
        let correo = $('#correo').val();
        let contra = $('#contra').val();
        $.post('PHP/Iniciar_Sesion.php', {correo : correo, contra : contra}, function (response) {
            if (response == 'Error') {
                alert('Usuario inexistente');
                $('.err_cred').show();
            }else{
            window.location.href = 'index.php';
            }
        })}
    });
    // Botón de Cerrar Sesión que manda al mismo archivo pero cambio de usuario
    $('.btnsalir').click(() => {
        $.post('php/sesiones.php', {usuario : 'invitado'}, function (response) {
            alert(response);
            window.location.href = 'index.php';
        })
    });
});
