window.onload = function () {
    // Variables para la validacion
    const formulario = document.forms['form_oculto'];
    const inputs = document.querySelectorAll('#formulario input');
    // Expresiones regulares
    const expresiones = {
        boleta: /^((PP{1}|PE{1}|[0-9]{2})+[0-9]{8})$/,
        nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
        apellidoP: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
        apellidoM: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
        rfc: /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
        correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]+$/,
        contra: /^[a-zA-Z0-9À-ÿ\s]{1,40}$/,
    }
    // Lista para saber que todo se ha validado
    const campos = {
        boleta: false,
        nombre: false,
        apellidoP: false,
        apellidoM: false,
        rfc: false,
        correo: false,
        contra: false,
    }
    // Funcion validar formulario
    // Que lleva el switch para validar según el campo
    const validarFormulario = (event) => {
        switch (event.target.name) {
            case "boleta":
                validardato(expresiones.boleta, event.target, event.target.name);
            break;
            case "nombre":
                validardato(expresiones.nombre, event.target, event.target.name);
            break;
            case "apellidoP":
                validardato(expresiones.apellidoP, event.target, event.target.name);
            break;
            case "apellidoM":
                validardato(expresiones.apellidoM, event.target, event.target.name);
            break;
            case "rfc":
                validardato(expresiones.rfc, event.target, event.target.name);
            break;
            case "correo":
                validardato(expresiones.correo, event.target, event.target.name);
            break;
            case "contra":
                validardato(expresiones.contra, event.target, event.target.name);
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
        } else {
            document.getElementById(nombre).classList.add('is-invalid');
            document.getElementById(nombre).classList.remove('is-valid');
            campos[nombre] = false;
        }
        console.log("Dato:", nombre ,", estado:",campos[nombre] ,"boleta:",campos.boleta, "nombre:", campos.nombre, " apellidoP:", campos.apellidoP," apellidoM:", campos.apellidoM ," rfc:", campos.rfc ," correo:", campos.correo ," contraseña:", campos.contra);
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
        formulario.action = "enviar_datos_profesor.php";
        formulario.submit();
    });

    formulario.addEventListener('submit', function(event){
        // El submit se desactiva hasta nuevo aviso
        event.preventDefault();
        const Area = document.getElementById('area');


        if(campos.boleta && campos.nombre && campos.apellidoP && campos.apellidoM && campos.rfc && campos.correo && campos.contra){
            if((Area.value == "Seleccionar")){
                alert("Faltan campos por llenar 2");

            }else{
                formulario.submit();
            }
        }else{
            alert("Faltan campos por llenar");
        }
    });
}