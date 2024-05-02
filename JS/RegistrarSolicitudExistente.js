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
    


    listarAceptados();


function listarAceptados(){
    $.ajax({
        url : 'PHP/Enlistar_Todas_Solicitudes.php',
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
                                    <button class="btn btn-outline-primary visualizar"><i class="bi bi-book"></i></button>                                 
                                    <button class="btn btn-outline-success registrar"><i class="bi bi-arrow-up-right-square"></i></button>
                                    </th>
                                <td class="align-middle">${registro.TrabajoTerminal}</td>
                                <td class="align-middle">${registro.NombresAlumnos}</td>
                                <td class="align-middle">${registro.CorreosAlumnos}</td>
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



$(document).on('click', '.registrar', function () {
    let element = $(this)[0].parentElement.parentElement;
    let IDTT = $(element).attr('IdTT');

        $.ajax({
            url: 'PHP/Modificar_Registrar_Solicitud.php',
            type: 'POST',
            data: {IDTT},
            success: function(response){
                console.log("Registro modificado correctamente");

                window.location.href = 'index.php';
                
            }
        });
})

$(document).on('click', '.visualizar', function () {
    $('#TablaRegistros').hide();
    $('.add').show();
    $('#cancelar').show();
    //$('#agregar').hide();
    //$('#curp').prop('disabled', false);
    $('.barra_buscar').hide();
    let element = $(this)[0].parentElement.parentElement;
    let IDTT = $(element).attr('IdTT');

    $.post('PHP/VisualizarSolicitudes.php', {IDTT}, function (response) {
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