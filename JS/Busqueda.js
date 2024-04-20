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
    /*Fatima*/
    $('#search').keyup(function(){
        if($('#search').val() == ""){
            listarTodas();
        }
        let search = $('#search').val();
        let total = 0;
        if($("#search").val()){
            $.ajax({
                url: 'PHP/Buscar_Nombre.php', /*Nombre de TT */
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

    $('#search').keyup(function(){
        if($('#search').val() == ""){
            listarTodas();
        }
        let search = $('#search').val();
        let total = 0;
        if($("#search").val()){
            $.ajax({
                url: 'PHP/Buscar_TipoTT.php', /*Tipo de TT */
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
});