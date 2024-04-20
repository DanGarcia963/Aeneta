document.getElementById('opciones').addEventListener('change', function() {
    const placeholder = this.options[this.selectedIndex].text.split(' ').slice(2).join(' ');
    document.getElementById('search').placeholder = `Buscar por ${placeholder}`;
});
$(document).ready(() => {
        $('#TablaRegistros').show();
        


    listarTodas();

    function listarTodas(){
        $.ajax({
            url : 'PHP/Enlistar_Todo.php',
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
                                        <button class="btn btn-outline-primary editar"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-outline-danger mx-2 eliminar"><i class="bi bi-trash3"></i></button>
                                    </th>
                                    <td class="align-middle">${registro.TrabajoTerminal}</td>
                                    <td class="align-middle">${registro.NombresAlumnos}</td>
                                    <td class="align-middle">${registro.NombresDirectores}</td>
                                </tr>
                                `
                });
                $('#registros').html(template);
                $('#total_users').html(total);
                $('#matches').html("Todos los Trabajos Terminales: ");
            }
        });
    }




    

        // Evento change para el select
        $('#opciones').change(function() {
            // Obtener el valor seleccionado
            let opcionSeleccionada = $(this).val();

            $('#search').off('keyup'); // Elimina todos los eventos keyup asociados al campo de búsqueda

            // Ejecutar la función correspondiente según la opción seleccionada
            switch(opcionSeleccionada) {
                case "1":
                        /*Fatima*/
                        //Busqueda por nombre de Trabajo Terminal
                        $('#search').keyup(function(){
                            if($('#search').val() == ""){
                                listarTodas();
                            }
                            let search = $('#search').val();
                            let total = 0;
                            if($("#search").val()){
                                $.ajax({
                                    url: 'PHP/Buscar_Nombre.php',
                                    type: 'POST',
                                    data: {search},
                                    success: function(response){
                                        let registros = JSON.parse(response);
                                        let template = '';
                                        registros.forEach(registro => {
                                            total++;
                                            template += `
                                                        <tr>
                                                            <th scope="row" class="align-middle editar_eliminar">
                                                                <button class="btn btn-outline-primary editar"><i class="bi bi-pencil"></i></button>
                                                                <button class="btn btn-outline-danger mx-2 eliminar"><i class="bi bi-trash3"></i></button>
                                                            </th>
                                                            <td class="align-middle">${registro.TrabajoTerminal}</td>
                                                            <td class="align-middle">${registro.NombresAlumnos}</td>
                                                            <td class="align-middle">${registro.NombresDirectores}</td>
                                                        </tr>
                                                        `
                                        });
                                        $('#registros').html(template);
                                        $('#total_users').html(total);
                                        $('#matches').html("Coincidencias: ");
                                    }
                                });
                            }
                        });
                    break;

                    case"2":

                    break;

                case "3":
                        //Busqueda por nombres de Directores
                    $('#search').keyup(function(){
                        if($('#search').val() == ""){
                            listarTodas();
                        }
                        let search = $('#search').val();
                        let total = 0;
                        if($("#search").val()){
                            $.ajax({
                                url: 'PHP/buscar_Directores.php',
                                type: 'POST',
                                data: {search},
                                success: function(response){
                                    let registros = JSON.parse(response);
                                    let template = '';
                                    registros.forEach(registro => {
                                        total++;
                                        template += `
                                                    <tr>
                                                        <th scope="row" class="align-middle editar_eliminar">
                                                            <button class="btn btn-outline-primary editar"><i class="bi bi-pencil"></i></button>
                                                            <button class="btn btn-outline-danger mx-2 eliminar"><i class="bi bi-trash3"></i></button>
                                                        </th>
                                                        <td class="align-middle">${registro.TrabajoTerminal}</td>
                                                        <td class="align-middle">${registro.NombresAlumnos}</td>
                                                        <td class="align-middle">${registro.NombresDirectores}</td>
                                                    </tr>
                                                    `
                                    });
                                    $('#registros').html(template);
                                    $('#total_users').html(total);
                                    $('#matches').html("Coincidencias: ");
                                }
                            });
                        }
                    });
                    break;

                    case 4:
                        //Busqueda por Tipo de Trabajo Terminal
                        $('#search').keyup(function(){
                            if($('#search').val() == ""){
                                listarTodas();
                            }
                            let search = $('#search').val();
                            let total = 0;
                            if($("#search").val()){
                                $.ajax({
                                    url: 'PHP/Buscar_TipoTT.php',
                                    type: 'POST',
                                    data: {search},
                                    success: function(response){
                                        let registros = JSON.parse(response);
                                        let template = '';
                                        registros.forEach(registro => {
                                            total++;
                                            template += `
                                                        <tr>
                                                            <th scope="row" class="align-middle editar_eliminar">
                                                                <button class="btn btn-outline-primary editar"><i class="bi bi-pencil"></i></button>
                                                                <button class="btn btn-outline-danger mx-2 eliminar"><i class="bi bi-trash3"></i></button>
                                                            </th>
                                                            <td class="align-middle">${registro.TrabajoTerminal}</td>
                                                            <td class="align-middle">${registro.NombresAlumnos}</td>
                                                            <td class="align-middle">${registro.NombresDirectores}</td>
                                                        </tr>
                                                        `
                                        });
                                        $('#registros').html(template);
                                        $('#total_users').html(total);
                                        $('#matches').html("Coincidencias: ");
                                    }
                                });
                            }
                        });
                        break;

                // Puedes agregar más casos según las opciones del select
                default:
                    // Si ninguna opción coincide, puedes hacer algo aquí
                    break;
            }
        });
});