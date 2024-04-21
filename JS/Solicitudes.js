$(document).ready(() => {
    $('#TablaRegistros').show();
    


listarTodas();

function listarTodas(){
    $.ajax({
        url : 'PHP/Enlistar_Solicitudes.php',
        type : 'GET',
        success : function(response){
            let registros = JSON.parse(response);
            let template = '';
            let total = 0;
            registros.forEach(registro => {
                total++;
                template += `
                            <tr>
                                <th scope="row" class="align-middle editar_eliminar">                                   
                                    <button class="btn btn-outline-primary editar"><i class="bi bi-book"></i></button>
                                    <button class="btn btn-outline-primary editar"><i class="bi bi-check-circle "></i></button>
                                    <button class="btn btn-outline-primary editar"><i class="bi bi-x-circle"></i></button>
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
});