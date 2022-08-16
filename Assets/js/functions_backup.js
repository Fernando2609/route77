/*
-----------------------------------------------------------------------
Universidad Nacional Autónoma de Honduras (UNAH)
    Facultad de Ciencias Economicas
Departamento de Informatica administrativa
     Analisis, Programacion y Evaluacion de Sistemas
                Segundo Periodo 2022


Equipo:
Jose Fernando Ortiz Santos .......... (jfortizs@unah.hn)
Hugo Alejandro Paz Izaguirre..........(hugo.paz@unah.hn)
Kevin Alfredo Rodríguez Zúniga........(karodriguezz@unah.hn)
Leonela Yasmin Pineda Barahona........(lypineda@unah)
Reynaldo Jafet Giron Tercero..........(reynaldo.giron@unah.hn)
Gabriela Giselh Maradiaga Amador......(ggmaradiaga@unah.hn)
Alejandrino Victor García Bustillo....(alejandrino.garcia@unah.hn)

Catedrático:
Lic. Karla Melisa Garcia Pineda 
---------------------------------------------------------------------

Programa:          Módulo de respaldo y recuperación 
Fecha:             06-may-2022
Programador:       Jose Fernando Ortiz Santos
descripción:       Crea una copia de seguridad del sistema para poder restablecer la información

-----------------------------------------------------------------------*/  
let fileValue;
document.addEventListener(
  "DOMContentLoaded",
  function () {
    if (document.querySelector("#formBD")) {
      let formUsuario = document.querySelector("#formBD");
      formBD.onsubmit = function (e) {
        e.preventDefault();
        fileValue = document.querySelector("#fileBD").value;

        if (fileValue == "") {
          swal.fire(
            "Atención",
            "Selecciona un archivo para la restauración",
            "error"
          );
          return false;
        }
      swal.fire({
          title: "¿Restaurar Base de datos?",
          text: "¿Realmente quiere Restaurar la Base de datos?",
          icon: "warning",
          showClass: {
            popup: "animate__animated animate__fadeInDown",
          },
          hideClass: {
            popup: "animate__animated animate__fadeOutUp",
          },
          showCancelButton: true,
          confirmButtonText: "Si, Restaurar!",
          cancelButtonText: "No, Cancelar!",
          closeOnConfirm: false,
          closeOnCancel: true,
        })
        .then((result) => {
          if (result.isConfirmed) {
             divLoading.style.display = "flex";
             let request = window.XMLHttpRequest
               ? new XMLHttpRequest()
               : new ActiveXObject("Microsoft.XMLHTTP");
             let ajaxUrl = base_url + "/Backup/restoreMysqlDB";
             let formData = new FormData(formBD);
             request.open("POST", ajaxUrl, true);
             request.send(formData);
             request.onreadystatechange = function () {
               if (request.readyState == 4 && request.status == 200) {
                 //console.log(request.responseText);
                 let objData = JSON.parse(request.responseText);

                 if (objData.status) {
                   swal.fire("Restauración", objData.msg, "success");
                   //tableUsuarios.api().ajax.reload();
                 } else {
                   swal.fire("Error", objData.msg, "error");
                 }
               } else {
                 console.log("Error");
               }
               divLoading.style.display = "none";
               return false;
             };
          }
        });
       
      };
    }
  },
  false
);
$("#fileBD").on("change", function () {

   fileValue = document.querySelector("#fileBD").value;
   namefile = fileValue.split("\\");
   
   if (enviroment == 1) {
     namefile = fileValue.split("/");
     fechaArray = namefile[8].split("_");
   } else {
     fechaArray = namefile[5].split("_");
   }
  console.log(fechaArray);
   var horaArray = fechaArray[3].match(/.{1,2}/g); 
   dia = new Date(
     fechaArray[2] + " " + horaArray[0] + ":" + horaArray[1] + ":" + horaArray[2] + ":"
   ).toLocaleString("es-ES", {
     weekday: "long",
     year: "numeric",
     month: "long",
     day: "numeric",
   });
   hora = new Date(
     fechaArray[2] + " " + horaArray[0] + ":" + horaArray[1] + ":" + horaArray[2] + ":"
   ).toLocaleTimeString("es-ES");
   console.log(dia);
   swal.fire("BD seleccionada","Respaldo seleccionado con fecha "+dia+" a la hora "+hora, "info");
 
});

function fntRespaldo() {
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/Backup/CopiaSeguridad";
  divLoading.style.display = "flex";
  request.open("GET", ajaxUrl, true);
  request.send();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      console.log(request.responseText);
      let objData = JSON.parse(request.responseText);
      if (objData.status) {
        divLoading.style.display = "none";
        /* swal.fire(objData.msg, objData.data, "success"); */
        swal
          .fire({
            title: objData.msg,
            allowOutsideClick: () => {
              const popup = Swal.getPopup()
              popup.classList.remove('swal2-show')
              setTimeout(() => {
                popup.classList.add('animate__animated', 'animate__headShake')
              })
              setTimeout(() => {
                popup.classList.remove('animate__animated', 'animate__headShake')
              }, 500)
              return false
            },
            text: objData.data,
            icon: "success",
      
           /*  showCancelButton: false,
            confirmButtonText: "Ok", */
            //cancelButtonText: "No, Cancelar!",
            /* closeOnConfirm: false,
            closeOnCancel: true, */
          })
          .then((result) => {
            if (result.isConfirmed) {
               location.reload();
            }
          });
       
      } else {
        swal.fire("Error", objData.msg, "error");
      }
    }
  };
}

