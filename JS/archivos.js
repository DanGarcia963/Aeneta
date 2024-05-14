$(document).ready(() => {
    $('.add').hide();
    $('#TablaRegistros').show();

    listarTodas();

    function listarTodas(){
        $.ajax({
            url : 'PHP/Enlistar_Archivos.php',
            type : 'GET',
            success : function(response){
                // Verificar la respuesta del servidor
                console.log("Respuesta del servidor:", response);
                
                if (response) {
                    let registros = JSON.parse(response);
                    let template = '';
                    let total = 0;
                    
                    registros.forEach(registro => {
                        total++;
                        template += `
                            <tr IdArchivo="${registro.IDArchivo}">
                                <th scope="row" class="align-middle editar_eliminar">
                                    <button class="btn btn-outline-primary visualizar"><i class="bi bi-book"></i></button>
                                    <button class="btn btn-outline-danger eliminar"><i class="bi bi-trash"></i></button>
                                </th>
                                <td class="align-middle">${registro.TrabajoTerminal}</td>
                                <td class="align-middle">${registro.Nombre_Archivo}</td>
                                <td class="align-middle">${registro.Tipo_Archivo}</td>
                            </tr>`;
                    });
                    
                    $('#registros').html(template);
                    $('#total_users').html(total);
                    $('#matches').html("Todos los Archivos adjuntados: ");
                } else {
                    console.log("No se recibió respuesta del servidor.");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error en la llamada AJAX:", status, error);
            }
        });
    }

    function validateFileType(input) {
        const allowedExtensions = /(\.pdf|\.sql|\.js|\.php|\.zip)$/i;
        if (!allowedExtensions.test(input.value)) {
            alert("Solo se permiten archivos PDF, SQL, JavaScript, PHP y ZIP.");
            input.value = ''; // Limpiar el valor del input
        }
    }

    $(document).on('click', '.visualizar', function () {
        let element = $(this)[0].parentElement.parentElement;
        let IDArchivo = $(element).attr('IdArchivo');

        window.open('PHP/VerArchivo.php?IDArchivo=' + IDArchivo, '_blank');
    });

    $(document).on('click', '.eliminar', function () {
        let element = $(this)[0].parentElement.parentElement;
        let IDArchivo = $(element).attr('IdArchivo');

        $.post('PHP/BorrarArchivo.php', {IDArchivo: IDArchivo}, function (response) {
            window.location.reload();
        });
    });
});
