$(document).ready(()=>{
    const validarFormLogin = new JustValidate("#formLogin",{
      tooltip: {
        position: "bottom"
      }
    });
  
    validarFormLogin
    .addField("#boleta",[
      {
        rule:"required",
        errorMessage:"Por favor escribe tu boleta",
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
    ]).addField("#contrasena",[
      {
        rule:"required",
        errorMessage:"Escribe tu contraseña"
      },
      {
        rule:"password",
        errorMessage:"Revisa que tu contraseña. Formato incorrecto"
      }
    ])
    .onSuccess((evt)=>{
      evt.preventDefault();
      $.ajax({
        url:"../PHP/login/index_AX.php",
        method:"post",
        data:$("#formLogin").serialize(),
        cacahe:false,
        success:(respAX)=>{
          let objRespAX = JSON.parse(respAX);
          Swal.fire({
            title:"login",
            text:objRespAX.msj,
            icon:objRespAX.icono,
            footer:objRespAX.log,
            didDestroy:()=>{
              if(objRespAX.cod == 1){
                window.location.href = "./php/alumno.php";
              }else{
                window.location.reload();
              }
            }
          });
        }
      });
    });
});