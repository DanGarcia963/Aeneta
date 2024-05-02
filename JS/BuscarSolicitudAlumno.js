$(document).ready(() => {


    $('#cancelar').click(function () {
        window.location.href = 'index.php';
    });
    


    listarAceptados();


function listarAceptados(){
    $.ajax({
        url : 'PHP/SolicitudAlumno.php',
        type : 'POST',
        success : function(response){
            let registros = JSON.parse(response);
            let template = '';
            let total = 0;
            registros.forEach(registro => {
                total++;
                template += `
                <tr IdAlumno="${registro.IDAlumno}">
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
                                <td class="align-middle">${registro.EstadoTT}</td>
                            </tr>
                            `
            });
            $('#registros').html(template);
            $('#total_users').html(total);
            $('#matches').html("Todas las Solicitudes: ");
            let primerRegistro = registros[0];
                $('#nombreTT').val(primerRegistro.TrabajoTerminal);
                $('#descripcion').val(primerRegistro.Description);
                $('#alumnos').val(primerRegistro.NombresAlumnos);
                $('#directores').val(primerRegistro.NombresDirectores);
                $('#TipoTitulacion').val(primerRegistro.TipoTitulacion);
                $('#area').val(primerRegistro.AreaTT);
                $('#estado').val(primerRegistro.EstadoTT);
                $('#nombreTT, #descripcion, #alumnos, #directores, #TipoTitulacion, #area, #estado').prop('disabled', true);
            
        }
    });
}


    $('#TablaRegistros').hide();
    $('.add').show();
    $('#cancelar').show();
    $('.barra_buscar').hide();

});