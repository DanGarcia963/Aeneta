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
                <tr IdTT="${registro.ID_Terminal}">
                                <th scope="row" class="align-middle editar_eliminar_visualizar">                                   
                                    <button class="btn btn-outline-primary visualizar"><i class="bi bi-book"></i></button>
                                    <button class="btn btn-outline-primary aceptar"><i class="bi bi-check-circle "></i></button>
                                    <button class="btn btn-outline-primary rechazar"><i class="bi bi-x-circle"></i></button>
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

$(document).on('click', '.aceptar', function () {
    let element = $(this)[0].parentElement.parentElement;
    let IDTT = $(element).attr('IdTT');

        $.ajax({
            url: 'PHP/Modificar_Aceptar.php',
            type: 'POST',
            data: {IDTT},
            success: function(response){
                console.log("Registro modificado correctamente");

                    window.location.reload();
                
            }
        });
})

$(document).on('click', '.rechazar', function () {
    let element = $(this)[0].parentElement.parentElement;
    let IDTT = $(element).attr('IdTT');

        $.ajax({
            url: 'PHP/Modificar_Rechazar.php',
            type: 'POST',
            data: {IDTT},
            success: function(response){
                console.log("Registro modificado correctamente");
                    window.location.reload();
                
            }
        });
})

$(document).on('click', '.visualizar', function () {
    let element = $(this)[0].parentElement.parentElement;
    let curp = $(element).attr('NombreTT');

    $.post('php/Visualizar.php', {curp}, function (response) {
        let registro = JSON.parse(response);
        
})
});

});