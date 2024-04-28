document.addEventListener("DOMContentLoaded", function() {
const sessionData = document.getElementById("session-data");
        
// Accedemos al valor de la sesión utilizando el atributo data-*
 const IDUsuario = sessionData.dataset.nombre;
 console.log("Nombre de usuario:", IDUsuario);
});
$(document).ready(() => {
        $('.add').show();
        $('#cancelar').show();

            // Obtenemos el elemento que contiene el valor de la sesión

        
    
        $.post('PHP/VisualizarSolicitud.php', {IDUsuario}, function (response) {
            let registro = JSON.parse(response);
            $('#nombreTT').val(registro.TrabajoTerminal);
            $('#descripcion').val(registro.Description);
            $('#alumnos').val(registro.NombresAlumnos);
            $('#directores').val(registro.NombresDirectores);
            $('#TipoTitulacion').val(registro.TipoTitulacion);
            $('#area').val(registro.AreaTT);
            $('#nombreTT').prop('disabled', true);
            $('#descripcion').prop('disabled', true);
            $('#alumnos').prop('disabled', true);
            $('#directores').prop('disabled', true);
            $('#TipoTitulacion').prop('disabled', true);
            $('#area').prop('disabled', true);
    })


});