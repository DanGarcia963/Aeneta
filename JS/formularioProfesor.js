window.onload = function () {
    // Variables para la validacion
    const formulario = document.forms['formulario'];
    const inputs = document.querySelectorAll('#formulario input');
    // Variables necesarias para cambiar de secciones
    const primera_seccion = document.getElementById('fsection');
    // Displays iniciales
    primera_seccion.style.display = 'block';
    // Botones de cada seccion

    const expresiones = {
        boleta: /^((PP{1}|PE{1}|[0-9]{2})+[0-9]{8})$/,
        nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
        apellidoP: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
        apellidoM: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
        rfc: /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
        correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]+$/,
        contra: /^[a-zA-Z0-9À-ÿ\s]{1,40}$/,
    }

    const campos = {
        boleta: false,
        nombre: false,
        apellidoP: false,
        apellidoM: false,
        rfc: false,
        correo: false,
        contra: false,
    }

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
    inputs.forEach((input) => {
        input.addEventListener('keyup', validarFormulario);
        input.addEventListener('blur', validarFormulario);
    });


    formulario.addEventListener('submit', function(event){
        // El submit se desactiva hasta nuevo aviso
        event.preventDefault();
        const Area = document.getElementById('area');

        //console.log(campos.correo);
        if(campos.boleta && campos.nombre && campos.apellidoP && campos.apellidoM && campos.rfc && campos.correo && campos.contra){
            // Si hay más de una checkbox palomeada
            if((Area.value == "Seleccionar")){
                alert("Faltan campos por llenar");

            }else{
                formulario.submit();
            }
        }else{
            alert("Faltan campos por llenar");
        }
    });
}
