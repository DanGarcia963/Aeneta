$(document).ready(() => {
    $('.add').hide();
    $('#TablaRegistros').show();
    $('#cancelar').hide();

    $('#cancelar').click(function () {
        $('#TablaRegistros').show();
        $('.add').hide();
        $('#cancelar').hide();
        $('.barra_buscar').show();
        $('#opciones').val('Seleccionar');
        //$('#search').val('');
        //$('#search').prop('disabled', true);
        listarTodas();
    });
    


listarTodas();

function listarTodas(){
    $.ajax({
        url : 'PHP/Enlistar_Solicitudes_Profesores.php',
        type : 'GET',
        success : function(response){
            let registros = JSON.parse(response);
            let template = '';
            let total = 0;
            registros.forEach(registro => {
                total++;
                template += `
                <tr IdTT="${registro.ID_Terminal}">
                                <th scope="row" class="align-middle editar_eliminar">                                   
                                    <button class="btn btn-outline-primary calificar"><i class="bi bi-book"></i></button>
                                    <button class="btn btn-outline-success descargar"><i class="bi bi-download "></i></button>
                                </th>
                                <td class="align-middle">${registro.TrabajoTerminal}</td>
                                <td class="align-middle">${registro.NombresAlumnos}</td>
                                <td class="align-middle">${registro.NombresDirectores}</td>
                                <td class="align-middle">${registro.TipoTitulacion}</td>
                                <td class="align-middle">${registro.AreaTT}</td>
                            </tr>
                            `
            });
            $('#registros').html(template);
            $('#total_users').html(total);
            $('#matches').html("Todas las Solicitudes: ");
        }
    });
}



$(document).on('click', '.descargar', function () {
    let element = $(this)[0].parentElement.parentElement;
    let IDTT = $(element).attr('IdTT');
    console.log('IDTT:', IDTT); // Verifica el valor de IDTT antes de enviarlo
    
    // Enviar datos por POST y redirigir
    fetch('recupera.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ IDTT: IDTT })
    })
    .then(response => response.json())
    .then(data => {
        // Verifica la respuesta del servidor
        console.log('Response data:', data);
        // Redirigir a recupera.php después de enviar los datos
        window.location.href = 'recupera.php';
    })
    .catch(error => console.error('Error:', error));
})


$(document).on('click', '.calificar', function () {
    $('#TablaRegistros').hide();
    $('.add').show();
    $('#cancelar').show();
    $('.barra_buscar').hide();
    let element = $(this)[0].parentElement.parentElement;
    let IDTT = $(element).attr('IdTT');
    console.log(IDTT);
    $.post('PHP/Visualizar_Sinodal.php', {IDTT}, function (response) {
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

});