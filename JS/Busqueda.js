document.getElementById('opciones').addEventListener('change', function() {
    const placeholder = this.options[this.selectedIndex].text.split(' ').slice(2).join(' ');
    document.getElementById('search').placeholder = `Buscar por ${placeholder}`;
});
$(document).ready(() => {
        $('.add').hide();
        $('#TablaRegistros').show();
        $('#cancelar').hide();
    
        $('#cancelar').click(function () {
            $('#TablaRegistros').show();
            $('.add').hide();
            $('#cancelar').hide();
            $('.barra_buscar').show();
            $('#search').val('');
            //$('#search').prop('disabled', true);
            listarTodas();
        });
    $('#search').prop('disabled', true);
    listarTodas();
    function listarTodas(){
        //$('#search').prop('disabled', true);
        //$('#search').val("");
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
                                <tr IdTT="${registro.ID_Terminal}">
                                    <th scope="row" class="align-middle editar_eliminar">
                                    <button class="btn btn-outline-primary visualizar"><i class="bi bi-book"></i></button>
                                    <button class="btn btn-outline-primary descargar"><i class="bi bi-download"></i></button>
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
    $(document).on('click', '.visualizar', function () {
        $('#TablaRegistros').hide();
        $('.add').show();
        $('#cancelar').show();
        //$('#agregar').hide();
        //$('#curp').prop('disabled', false);
        $('.barra_buscar').hide();
        let element = $(this)[0].parentElement.parentElement;
        let IDTT = $(element).attr('IdTT');
    
        $.post('PHP/Visualizar.php', {IDTT}, function (response) {
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

        // Evento change para el select
        $('#opciones').change(function() {
            // Obtener el valor seleccionado
            let opcionSeleccionada = $(this).val();
            if (opcionSeleccionada == "" || opcionSeleccionada == null || opcionSeleccionada == "Seleccionar") {
                listarTodas();
                $('#search').prop('disabled', true);
                $('#search').val("");
            } else {
                $('#search').prop('disabled', false);
            }
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
                                                        <tr IdTT="${registro.ID_Terminal}">
                                                            <th scope="row" class="align-middle editar_eliminar">
                                                                <button class="btn btn-outline-primary visualizar"><i class="bi bi-book"></i></button>
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
                                        $('#matches').html("Coincidencias: ");
                                    }
                                });
                            }
                        });
                    break;

                    case"2":

                    $('#search').keyup(function(){
                        if($('#search').val() == ""){
                            listarTodas();
                        }
                        let search = $('#search').val();
                        let total = 0;
                        if($("#search").val()){
                            $.ajax({
                                url: 'PHP/Buscar_NombreAlumno.php',
                                type: 'POST',
                                data: {search},
                                success: function(response){
                                    let registros = JSON.parse(response);
                                    let template = '';
                                    registros.forEach(registro => {
                                        total++;
                                        template += `
                                                    <tr IdTT="${registro.ID_Terminal}">
                                                        <th scope="row" class="align-middle editar_eliminar">
                                                            <button class="btn btn-outline-primary visualizar"><i class="bi bi-book"></i></button>
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
                                    $('#matches').html("Coincidencias: ");
                                }
                            });
                        }
                    });
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
                                                    <tr IdTT="${registro.ID_Terminal}">
                                                        <th scope="row" class="align-middle editar_eliminar">
                                                        <button class="btn btn-outline-primary visualizar"><i class="bi bi-book"></i></button>
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
                                    $('#matches').html("Coincidencias: ");
                                }
                            });
                        }
                    });
                    break;

                    case "4":
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
                                                        <tr IdTT="${registro.ID_Terminal}">
                                                            <th scope="row" class="align-middle editar_eliminar">
                                                            <button class="btn btn-outline-primary visualizar"><i class="bi bi-book"></i></button>
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