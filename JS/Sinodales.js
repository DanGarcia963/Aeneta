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
                                    <button class="btn btn-outline-primary descargar"><i class="bi bi-download"></i></button>
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
    });

});