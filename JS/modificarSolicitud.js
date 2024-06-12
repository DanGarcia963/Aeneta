window.onload = function () {
    // Variables para la validacion
    const formulario = document.forms['form_oculto'];
    const inputs = document.querySelectorAll('#formulario input');
    // Expresiones regulares
    const expresiones = {
        nombreTT: /^[a-zA-ZÀ-ÿ\s]{1,200}$/,
        descripcionTT: /^[a-zA-ZÀ-ÿ\s]{1,2500}$/,
        palabrasclave:/^[a-zA-ZÀ-ÿ\s]{1,50}$/,
    }
    // Lista para saber que todo se ha validado
    const campos = {
        nombreTT: false,
        descripcionTT: false,
        palabrasclave: false,
    }
    // Funcion validar formulario
    // Que lleva el switch para validar según el campo
    const validarFormulario = (event) => {
        switch (event.target.name) {
            case "nombreTT":
                validardato(expresiones.nombreTT, event.target, event.target.name);
            break;
            case "descripcionTT":
                validardato(expresiones.descripcionTT, event.target, event.target.name);
            break;
            case "palabrasclave":
                validardato(expresiones.palabrasclave, event.target, event.target.name);
            break;
        }
    };
    // Funcion validar dato que ejecutará la validación correspondiente a la entrada de su parámetro (nombre del campo)
    // Y hará los cambios de estilo correspondientes
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
        console.log("Dato:", nombre ,", estado:",campos[nombre] ,"nombreTT:",campos.nombreTT, "descripcion:", campos.descripcionTT,  "palabras:", campos.palabrasclave);
};
    // No recuerdo porqué valdidamos fecha por separado pero creo que en el switch no me dejaba
    // O quizá solo fue experimento y así lo dejé

    // Mandamos validar cada campo cada que se levanta una tecla o se da click fuera del input
    inputs.forEach((input) => {
        input.addEventListener('keyup', validarFormulario);
        input.addEventListener('blur', validarFormulario);
    });

    // Cuando se presiona editar, se valida todo el formulario
    let editar = document.getElementById('edit');
    editar.addEventListener('click', function(){
        inputs.forEach((campo) => {
            validardato(expresiones[campo.name], campo, campo.name);
        });
    });
    
    let boton = document.getElementById("enviar");

    boton.addEventListener("click", function(){
        formulario.action = "enviar_datos_solicitud.php";
        formulario.submit();
    });

    formulario.addEventListener('submit', function(event){
        // El submit se desactiva hasta nuevo aviso
        event.preventDefault();
        const Area = document.getElementById('area');
        const TipTit = document.getElementById('Tipo_Titulacion');
        const alum2 = document.getElementById('alumno2');
        const alum3 = document.getElementById('alumno3');
        const alum4 = document.getElementById('alumno4');
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