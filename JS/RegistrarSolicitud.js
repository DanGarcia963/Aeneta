window.onload = function () {
    // Variables para la validacion
    const formulario = document.forms['formulario'];
    const inputs = document.querySelectorAll('#formulario input');
    // Variables necesarias para cambiar de secciones
    const primera_seccion = document.getElementById('fsection');
    const segunda_seccion = document.getElementById('ssection');
    // Displays iniciales
    primera_seccion.style.display = 'block';
    segunda_seccion.style.display = 'none';
    // Botones de cada seccion
    const boton_primero = document.getElementById('fbtn');
    const tboton_anterior = document.getElementById('tbtn_anterior');

    const expresiones = {
        nombreTT: /^[a-zA-ZÀ-ÿ\s]{1,100}$/,
        descripcionTT: /^[a-zA-ZÀ-ÿ\s]{1,200}$/,
    }

    const campos = {
        nombreTT: false,
        descripcionTT: false,
    }

    const validarFormulario = (event) => {
        switch (event.target.name) {
            case "nombreTT":
                validardato(expresiones.nombreTT, event.target, event.target.name);
            break;
            case "descripcionTT":
                validardato(expresiones.descripcionTT, event.target, event.target.name);
            break;
        }
    };

    const validardato = (expresion, target, nombre) => {
            if(expresion.test(target.value)){
                document.getElementById(nombre).classList.add('is-valid');
                document.getElementById(nombre).classList.remove('is-invalid');
                campos[nombre] = true;
            }else{
                document.getElementById(nombre).classList.add('is-invalid');
                document.getElementById(nombre).classList.remove('is-valid');
                campos[nombre] = false;
            }
            console.log("Dato:", nombre ,", estado:",campos[nombre] ,"nombreTT:",campos.nombreTT, "descripcion:", campos.descripcionTT);
    };

    inputs.forEach((input) => {
        input.addEventListener('keyup', validarFormulario);
        input.addEventListener('blur', validarFormulario);
    });

    // Botones para cambiar de secciones
    // No se cambia de seccion a menos que se haya llenado todo
    // Excepto por las listas

    boton_primero.addEventListener('click', function(event){
        event.preventDefault();
        if(campos.nombreTT && campos.descripcionTT){
            primera_seccion.style.display = 'none';
            segunda_seccion.style.display = 'block';
        }else{
            alert("Faltan campos por llenar 1");
        }
    });

    tboton_anterior.addEventListener('click', function(event){
        event.preventDefault();
        primera_seccion.style.display = 'block';
        segunda_seccion.style.display = 'none'; 
    });


    // Aqui modifico la clase de las secciones porque cada que se muestran los campos ocultos
    // se pierden las proporciones de la seccion, entonces debo modificar su altura a " auto"
    // Fuera de eso quiero que siempre las secciones tengan exactamente la misma altura por 
    // cuestiones de estética

    formulario.addEventListener('submit', function(event){
        // El submit se desactiva hasta nuevo aviso
        event.preventDefault();
        // Checkboxes palomeadas
        //const chk = document.querySelectorAll('#formulario input:checked');
        // Check valid es en sí el mensaje de error
        // Quiero validar si las listas no se han dejado en "Select" porque claro, pasarán la validación
        // de expresión regular, pero no quiero que dejen sin seleccionar
        const Area = document.getElementById('area');
        const TipTit = document.getElementById('Tipo_Titulacion');
        const dir1 = document.getElementById('director1');
        const dir2 = document.getElementById('director2');

        if(campos.nombreTT && campos.descripcionTT){
            // Si hay más de una checkbox palomeada
           if((Area.value == "Seleccionar") || (TipTit.value == "Seleccionar") || (dir1.value == "Seleccionar")|| (dir2.value == "Seleccionar")){
                alert("Faltan campos por llenar 2");

            }else{
                formulario.submit();
            }
        }else{
            alert("Faltan campos por llenar 3");
        }
    });
}
$(document).ready(()=>{
    $("#discapacidad").change(function(){
        if($("#discapacidad").val() == 6){
            $(".otra_discapacidad").show();
        }
    });
});