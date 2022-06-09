function controlTag(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true;
    else if (tecla==0||tecla==9) return true;
    patron =/[0-9\s]/;
    n = String.fromCharCode(tecla);
    return patron.test(n);
}

function controlTagPrecio(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true;
    else if (tecla==0||tecla==9) return true;
    patron =/[0-9.\s]/;
    n = String.fromCharCode(tecla);
    return patron.test(n);
}

function controlTagLetraNumero(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true;
    else if (tecla==0||tecla==9) return true;
    patron =/[a-zA-ZÑñÁáÉéÍíÓóÚúÜü0-9\s]/;
    n = String.fromCharCode(tecla);
    return patron.test(n);
}

function controlTagNumeroEmpresa(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true;
    else if (tecla==0||tecla==9) return true;
    patron =/[0-9+\s]/;
    n = String.fromCharCode(tecla);
    return patron.test(n);
}

function controlTagImagenes(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true;
    else if (tecla==0||tecla==9) return true;
    patron =/[0-9,\s]/;
    n = String.fromCharCode(tecla);
    return patron.test(n);
}



function testEntero(intCant) {
  var intCantidad = new RegExp(/^([0-9])*$/);
  if (intCantidad.test(intCant)) {
    return true;
  } else {
    return false;
  }
}
function testText(txtString){
    var stringText = new RegExp(/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü]+(\s[a-zA-ZÑñÁáÉéÍíÓóÚúÜü]+)*$/);
    if(stringText.test(txtString)){
        return true;
    }else{
        return false;
    }
}
function testContraseña(txtString) {
  var stringText = new RegExp(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@#$!%*.?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/);
  if (stringText.test(txtString)) {
    return true;
  } else {
    return false;
  }
}

function testImg(txtString) {
  var stringText = new RegExp(
    /^(?=.*\d)(?=.*[$@#$!%*.?&])$/
  );
  if (stringText.test(txtString)) {
    return true;
  } else {
    return false;
  }
}


function testEnteroDni(intCant) {
    var intCantidad = new RegExp(/^([0-9]{13})$/);
    if (intCantidad.test(intCant)){
        return true;
    }else{
        return false;
    }
}
function testEnteroRtn(intCant) {
    var intCantidad = new RegExp(/^([0-9]{14})$/);
    if (intCantidad.test(intCant)){
        return true;
    }else{
        return false;
    }
}
//FUncion de entero y longitud Telefono
function testEnteroTel(intCant) {
    var intCantidad = new RegExp(/^([0-9]{8})$/);
    if (intCantidad.test(intCant)){
        return true;
    }else{
        return false;
    }
}



function testPrecio(intCant) {

    var intCantidad = new RegExp(/^([0-9]{1,6})\.{0,1}(([0-9]{0,2}))$/);


    if (intCantidad.test(intCant)){
        return true;
    }else{
        return false;
    }
}

function fntEmailValidate(email) {
    var stringEmail = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/);
    if (stringEmail.test(email) == false){
        return false;
    }else{
        return true;
    }  
}

function fntValidImg() {
  let ValidImg = document.querySelectorAll(".ValidImg");
  ValidImg.forEach(function (ValidImg) {
    ValidImg.addEventListener("keyup", function () {
      let inputValue = this.value;
      if (!testImg(inputValue)) {
        this.classList.add("is-invalid");
        /*  this.classList.remove('is-valid'); */
      } else {
        this.classList.remove("is-invalid");
        /*       this.classList.add('is-valid'); */
      }
    });
  });
}
    
function fntValidContra(){
    let ValidContra = document.querySelectorAll(".ValidContra");
    ValidContra.forEach(function(ValidContra) {
        ValidContra.addEventListener('keyup', function (){
            let inputValue = this.value;
            if (!testContraseña(inputValue)) {
              this.classList.add("is-invalid");
              /*  this.classList.remove('is-valid'); */
            } else {
              this.classList.remove("is-invalid");
              /*       this.classList.add('is-valid'); */
            }
        });
    });
}
function fntValidText(){
    let validText = document.querySelectorAll(".validText");
    validText.forEach(function(validText) {
        validText.addEventListener('keyup', function (){
            let inputValue = this.value;
            if(!testText(inputValue)){
                this.classList.add('is-invalid');
               /*  this.classList.remove('is-valid'); */
            }else{
                this.classList.remove('is-invalid');
          /*       this.classList.add('is-valid'); */
                
            }
        });
    });
}

function fntValidNumberDni(){
    let validNumberDni = document.querySelectorAll(".validNumberDni");
    validNumberDni.forEach(function(validNumberDni) {
        validNumberDni.addEventListener('keyup', function (){
            let inputValue = this.value;
            if (!testEnteroDni(inputValue)){
                this.classList.add('is-invalid');
            }else{
                this.classList.remove('is-invalid');
            
            }
        });
    });
}

function fntValidNumberRtn(){
    let validNumberRtn = document.querySelectorAll(".validNumberRtn");
    validNumberRtn.forEach(function(validNumberRtn) {
        validNumberRtn.addEventListener('keyup', function (){
            let inputValue = this.value;
            if (!testEnteroRtn(inputValue)){
                this.classList.add('is-invalid');
            }else{
                this.classList.remove('is-invalid');
            
            }
        });
    });
}

function fntValidNumberPrecio(){
    let validNumberPrecio = document.querySelectorAll(".validNumberPrecio");
    validNumberPrecio.forEach(function(validNumberPrecio) {
        validNumberPrecio.addEventListener('keyup', function (){
            let inputValue = this.value;
            if (!testPrecio(inputValue)){
                this.classList.add('is-invalid');
            }else{
                this.classList.remove('is-invalid');
            
            }
        });
    });
}
//Funcion validacion telefono
function fntValidNumberTel(){
    let validNumberTel = document.querySelectorAll(".validNumberTel");
    validNumberTel.forEach(function(validNumberTel) {
        validNumberTel.addEventListener('keyup', function (){
            let inputValue = this.value;
            if (!testEnteroTel(inputValue)){
                this.classList.add('is-invalid');
            }else{
                this.classList.remove('is-invalid');
            
            }
        });
    });
}

function fntValidEmail(){
    let validEmail = document.querySelectorAll(".validEmail");
    validEmail.forEach(function(validEmail) {
        validEmail.addEventListener('keyup', function () {
            let inputValue = this.value;
            if (!fntEmailValidate(inputValue)){
                this.classList.add('is-invalid');
            }else {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
        });
    });
}
function fntValidNumber() {
  let validNumber = document.querySelectorAll(".validNumber");
  validNumber.forEach(function (validNumber) {
    validNumber.addEventListener("keyup", function () {
      let inputValue = this.value;
      if (!testEntero(inputValue)) {
        this.classList.add("is-invalid");
      } else {
        this.classList.remove("is-invalid");
      }
    });
  });
}



//Llamado de las Funciones
window.addEventListener('load', function() {
  fntValidText();
  fntValidNumber();
  fntValidEmail();
  fntValidNumberDni();
  fntValidNumberTel();
  fntValidNumberPrecio();
  fntValidNumberRtn();
  if (document.querySelector("#notificacion")) {
    fntViewProductos();
  }
  fntValidContra();
  fntValidImg();
  //modaal Preguntas
  if (document.querySelector("#modalUserNew")) {
    $("#modalUserNew").modal({ backdrop: "static", keyboard: false });
  }

  //preguntas
  //Actulizar desde perfil
  if (document.querySelector("#formPreguntasSeguridad")) {
    let formPreguntas = document.querySelector("#formPreguntasSeguridad");
    formPreguntas.onsubmit = function (e) {
      e.preventDefault();
     
      // let strIdentificacion = document.querySelector('#txtIdentificacion').value;
      let respuesta1 = document.querySelector("#txtPregunta1").value;
      let strPassword = document.querySelector('#txtPassword').value;
      let strPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;
      //let respuesta2 = document.querySelector("#txtPregunta2").value;

      if (respuesta1 == "" || strPassword=="" || strPasswordConfirm=="") {
        swal.fire("Atención", "Todos los campos son obligatorios.", "error");
        return false;
      }

      if( strPassword != strPasswordConfirm ){
          swal.fire("Atención", "Las contraseñas no son iguales." , "info");
          return false;
        }        
      //longitud de la contraseña   
      if(strPassword.length < 8 ){
          swal.fire("Atención", "La contraseña debe tener un mínimo de 8 caracteres." , "info");
          return false;
      }

      let contraseñaValid = document.querySelector("#txtPassword");
           
        if (contraseñaValid.classList.contains("is-invalid")) {
          swal.fire(
            "Atención",
            "La contraseña debe de contener al menos 8 caracteres, una letra mayúscula, una letra minúscula, un número, un caracter especial y sin espacios",
            "error"
          );
          return false;
        }
      let elementsValid = document.getElementsByClassName("valid");
      for (let i = 0; i < elementsValid.length; i++) {
          if (elementsValid[i].classList.contains('is-invalid')) {
              swal.fire("Atención", "Por favor verifique los campos en rojo.", "error");
              return false;
          }
      }
      divLoading.style.display = "flex";
      let request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      let ajaxUrl = base_url + "/Dashboard/preguntasSeguridad";
      let formData = new FormData(formPreguntas);
      request.open("POST", ajaxUrl, true);
      request.send(formData);
      request.onreadystatechange = function () {
        if (request.readyState != 4) return;
        if (request.status == 200) {
          console.log(request.responseText);
          let objData = JSON.parse(request.responseText);
          if (objData.status) {
            //$("#modalformPreguntas").modal("hide");
            swal.fire({
              title: "Datos Guardados",
              text: objData.msg,
              icon: "success",
              confirmButtonText: "Aceptar",
              closeOnConfirm: false,
              timer: 3000,
              willClose: () => {
                location.reload();
              },
            });
                
          } else {
            swal.fire("Error", objData.msg, "error");
          }
        }
        divLoading.style.display = "none";
        return false;
      };
    };
  }
}, false);
function openModal()
{
    rowTable = "";
    document.querySelector('#idUsuario').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-warning", "btn-success");
    document.querySelector('#btnText').innerHTML ="Guardar";
    
}
//preguntas de seguridada

//Funcion de checkbox
//let validNumber = document.querySelectorAll(".validNumber");
/* function checharVer(){
//$('#checkedTrue').click(function() {
  let validCheck = document.querySelector("#checkedTrue");
  if ($(this).prop('checked')) {
     
      $('.checar').prop('checked', true);
  } else {
      
      $('.checar').prop('checked', false);
  }
}); */

/* $("#selectAll").on("click", function() {  
  $(".checar").prop("checked", this.checked);  
  });  
 
  $(".checar").on("click", function() {  
    if ($(".checar").length == $(".checar:checked").length) {  
      $("#selectAll").prop("checked", true);  
    } else {  
      $("#selectAll").prop("checked", false);  
    }  
}); */

/* function checkAll() {
  document.querySelectorAll('#selectAll input[type=checkbox]').forEach(function(checkElement){
      checkElement.checked("#unchecked") = true;
  });
}

function uncheckAll() {
  document.querySelectorAll('#selectAll input[type=checkbox]').forEach(function(checkElement) {
      checkElement.checked("#unchecked") = false;
  });
} */




if (document.querySelector("#notificacion")) {
  function fntViewProductos() {
    let prevImg = document.querySelector("#notificacion");
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    let ajaxUrl = base_url + "/Dashboard/getProductos/";
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        let objData = JSON.parse(request.responseText);
        var cant = 0;

        for (let i = 0; i < objData.length; i++) {
          const producto = objData[i];
          if (producto.STOCK <= producto.CANT_MINIMA) {
            console.log("hola");
          }
          //console.log(producto.CANT_MINIMA>producto.STOCK);
        }
      }
    };
  }
}