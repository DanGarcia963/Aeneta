$(document).ready(()=>{
    const validarCrearCuenta = new JustValidate("#formCrearCuenta",{
      tooltip: {
        position: "bottom"
      }
    });
  
    validarCrearCuenta
    .addField("#boleta",[
      {
        rule:"required",
        errorMessage:"Falta tu número de boleta"
      },
      {
        rule:"integer",
        errorMessage:"La boleta es de solo digitos"
      },
      {
        rule: "maxLength",
        value: 10,
        errorMessage:"La boleta no debe tener más de 10 digitos"
      },
      {
        rule: "minLength",
        value: 8,
        errorMessage:"La boleta debe tener al menos 8 digitos"
      }
    ])
    .addField("#nombre",[
      {
        rule:"required",
        errorMessage:"Falta tu nombre."
      }
    ])
    .addField("#primerApe",[
      {
        rule:"required",
        errorMessage:"Falta tu primer apellido."
      }
    ])
    .addField("#segundoApe",[
      {
        rule:"required",
        errorMessage:"Falta tu segundo apellido."
      }
    ])
    .addField("#correo",[
      {
        rule:"required",
        errorMessage:"Falta tu correo."
      },
      {
        rule:"email",
        errorMessage:"Revisa el formato de tu correo."
      }
    ])
    .addField("#CURP",[
        {
          rule:"required",
          errorMessage:"Falta el CURP"
        },
        {
          rule: "maxLength",
          value: 18,
          errorMessage:"Los CURP tienen 18 digitos"
        },
        {
          rule: "minLength",
          value: 18,
          errorMessage:"Los CURP tienen 18 digitos"
        }
      ])
    .addField("#contrasena",[
      {
        rule:"required",
        errorMessage:"Falta tu contraseña."
      },
      {
        rule:"password",
        errorMessage:"Deben ser al menos 8 caracteres incluyendo digitos."
      }
    ])
    .onSuccess((evt)=>{
      evt.preventDefault();
      $.ajax({
        url:"./../PHP/crearCuenta_AX.php",
        method:"post",
        data:$("#formCrearCuenta").serialize(),
        cache:false,
        success:(respAX)=>{
          let objRespAX = JSON.parse(respAX);
          Swal.fire({
            title:"Registro",
            text:objRespAX.msj,
            icon:objRespAX.icono,
            footer:objRespAX.log,
            didDestroy:()=>{
              if(objRespAX.cod == 1){
                window.location.href = "./../";
              }
            }
          });
        }
      });
    })
  });