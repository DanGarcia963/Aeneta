$(document).ready(() => {
        $('.add').hide();
        $('#TablaRegistros').show();
        $('#cancelar').hide();
    
        $('#cancelar').click(function () {
            $('#TablaRegistros').show();
            $('.add').hide();
            $('#cancelar').hide();
            listarTodas();
        });

    listarTodas();

    function listarTodas(){
        $.ajax({
            url : 'PHP/Enlistar_Todo_Sinodales.php',
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
                                    <button class="btn btn-outline-success ElegirTT"><i class="bi bi-check-circle"></i></button>
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
                $('#matches').html("Todos los Trabajos Terminales: ");
            }
        });
    }

    $(document).on('click', '.ElegirTT', function () {
        let element = $(this)[0].parentElement.parentElement;
        let IDTT = $(element).attr('IdTT');
    
            $.ajax({
                url: 'PHP/Registrar_Sinodal.php',
                type: 'POST',
                data: {IDTT: IDTT},
                success: function(response){
                    console.log("Registro modificado correctamente");
    
                        window.location.reload();
                    
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
    
        $.post('PHP/Sinodales.php', {IDTT}, function (response) {
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