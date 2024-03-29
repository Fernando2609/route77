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

Programa:          Módulo de Redes sociales
Fecha:             02-Abril-2022
Programador:       Gabriela Giselh Maradiaga Amador
descripción:       Se administran las redes sociales de la empresa

-----------------------------------------------------------------------*/
let tableredesSociales;
let rowTable="";
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function () {

tableredesSociales = $("#tableredesSociales").dataTable({
      aProcessing: true,
      aServerSide: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },
      
      ajax: {
        url: " " + base_url + "/RedesSociales/getredesSociales",
        dataSrc: "",
      },

      columns: [
        {data:"COD_RED_SOCIAL"},
        {data:"DESCRIPCION"},
        {data:"ENLACE"},
        {data:"options"},
      ],
      dom:
        "<'row d-flex'<'col-sm-12 mb-2 col-md-5'l B><'col-md-7 mb-2 align-self-end'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
      buttons: [
        {
          extend: "copyHtml5",
          text: "<i class='far-copy'></i> Copiar",
          titleAttr: "Copiar",
          className: "btn btn-secondary mr-1 mb-2",

          exportOptions: {
            margin: [0, 20, 20, 20],
            columns: [0, 1, 2],
            modifier: {},
          },
        },
        {
          extend: "excelHtml5",
          text: "<i class='fas fa-file-excel'></i> Excel",
          titleAttr: "Exportar a Excel",
          className: "btn btn-success mr-1 mb-2",
          excelStyles: [
            {
              template: "green_medium",
            },
            {
              cells: "2",
              style: {
                fill: {
                  pattern: {
                    type: "solid",
                    color: "3c6a8c",
                  },
                },
              },
            },
          ],
          exportOptions: {
            margin: [0, 20, 20, 20],
            columns: [0, 1, 2],
            modifier: {},
          },
        },
        {
          extend: "pdfHtml5",
          text: "<i class='fas fa-file-pdf'></i> PDF",
          titleAttr: "Exportar a PDF",
          className: "btn btn-danger mr-1 mb-2",
          filename: "RED SOCIAL",
          download: "open",
          //orientation: "landscape",
          pageSize: "letter",
          title: "Reporte de Red Social",
          customize: function (doc) {
            doc.content[1].margin = [0, 40, 120, 20];
            doc.content[0].margin = [0, 20, 0, 0];
            doc.content[0].alignment = "center";
            //orientacion vertical
            //doc.content[1].table.widths = [ '5%', '25%', '20%', '40%', '20%', '20%', '11%']
            //orientacion Horizontal
            doc.content[1].table.widths = [
              "5%",
              "20%",
              "20%",
              "30%",
              "15%",
              "20%",
              "11%",
            ];
            doc.content[1].table.body[0].forEach(function (h) {
              //h.alignment='left';
              h.fillColor = "#81ae39";
              h.color = "white";
              h.fontSize = 12;
            });
            let cols = [];
            cols[0] = {
              image: imgB64,
              alignment: "left",
              margin: [20, 5, 10, 20],
              width: 100,
            };
            const fecha = new Date();
            cols[1] = {
              fontSize: 11,
              text: nombreEmpresa,
              alignment: "right",
              margin: [0, 20, 20, 100],
            };

            cols[2] = {
               fontSize: 11,
               text: [
                 {
                   text:
                     fecha.toLocaleDateString("es-hn", {
                       weekday: "short",
                       year: "numeric",
                       month: "short",
                       day: "numeric",
                     }) +
                     "  " +
                     fecha.toLocaleTimeString("es-hn", {
                       hour: "2-digit",
                       minute: "2-digit",
                       //second: "2-digit",
                     }) +
                     "\n",
                 },
                 {
                   text: "Generado por: " + nombreUsuario,
                 },
               ],
               alignment: "right",
               margin: [0, 10, 20, 0],
             };

            let objheader = {};
            objheader["columns"] = cols;
            doc["header"] = function (page) {
              if (page == 1) return objheader;
              else
                return (cols[2] = {
                  fontSize: 11,
                  text: fecha.toLocaleDateString(),
                  alignment: "right",
                  margin: [0, 20, 20, 0],
                });
            };
            // Splice the image in after the header, but before the table

            /* var cols2 = [];
                                  cols2[0] = {fontSize: 13,text:  , alignment: 'center', margin:[0,0,0,0] };
                                  
                                  var objfooter = {};
                                  objfooter['columns'] = cols2;*/
            doc["footer"] = function (currentPage, pageCount) {
              return {
                margin: 10,
                columns: [
                  {
                    fontSize: 10,
                    text: [
                      {
                        text:
                          "--------------------------------------------------------------------------" +
                          "\n",
                        margin: [0, 20],
                      },
                      {
                        text:
                          "Página " +
                          currentPage.toString() +
                          " de " +
                          pageCount,
                      },
                    ],
                    alignment: "center",
                  },
                ],
              };
            };
          },
          exportOptions: {
            margin: [0, 20, 20, 20],
            columns: [0, 1, 2],
            modifier: {},
          },
        },
        {
          extend: "csvHtml5",
          text: "<i class='fas fa-file-csv'></i> CSV",
          titleAttr: "Exportar a CSV",
          className: "btn btn-info mr-1 mb-2",
          charset: "utf-8",
          bom: true,
          exportOptions: {
            margin: [0, 20, 20, 20],
            columns: [0, 1, 2],
            modifier: {},
          },
        },
        {
          extend: "print",
          text: "<i class='fa fa-print'></i> Imprimir",
          titleAttr: "Imprimir",
          className: "btn btn-warning mr-1 mb-2",
          exportOptions: {
            margin: [0, 20, 20, 20],
            columns: [0, 1, 2],
            modifier: {},
          },
        },
      ],
      responsive: true,
      bDestroy: true,
      iDisplayLength: 10,
      order: [[0, "desc"]],
      autoWidth: false,
      lengthMenu: [
        [10, 25, 50, -1],
        ["10 ", "25 ", "50 ", "Todo"],
    ],
   
    });


 if (document.querySelector("#formredesSociales")) {
        let formredesSociales=document.querySelector("#formredesSociales");
        formredesSociales.onsubmit=function(e){
            e.preventDefault();
            //let strIdentificacion = document.querySelector('#txtIdentificacion').value;
            let strDescripcion = document.querySelector('#txtDescripcion').value;
            let strEnlace = document.querySelector('#txtEnlace').value;
    
            
            if(strDescripcion == '' || strEnlace == '')
                {
                    swal.fire("Atención", "Todos los campos son obligatorios." , "error");
                    return false;
            }
    
            let elementsValid = document.getElementsByClassName("valid");
            for (let i = 0; i < elementsValid.length; i++) {
                if (elementsValid[i].classList.contains('is-invalid')) {
                    swal.fire("Atención", "Por favor verifique los campos en rojo.", "error");
                    return false;
                }
            }
            
            divLoading.style.display="flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/RedesSociales/setredesSocial'; 
            let formData = new FormData(formredesSociales);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){ 
                if(request.readyState == 4 && request.status == 200){
                    //console.log(request.responseText); 
                    let objData = JSON.parse(request.responseText); 
                    
                    if(objData.status)
                    { 
                         if (rowTable == "") {
                             tableredesSociales.api().ajax.reload();
                         } else {  
                             rowTable.cells[1].textContent = strDescripcion;
                             rowTable.cells[2].textContent = strEnlace;
                             rowTable = "";
                         }
 
                        $('#modalFormredesSociales').modal("hide");
                        formredesSociales.reset();
                            swal.fire("Redes Sociales", objData.msg ,"success");
                            tableredesSociales.api().ajax.reload();
                        }else{
                            swal.fire("Error", objData.msg , "error");
                    }
                
                }else{
                    console.log('Error');
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }


}, false)

function fntViewInfo(idpersona){
    
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/RedesSociales/getredsocial/'+idpersona;
    request.open("GET",ajaxUrl,true);
    request.send();
     request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            //console.log(objData);
            if(objData.status)
            {
                document.querySelector("#celDescripcion").innerHTML = objData.data.DESCRIPCION;
                document.querySelector("#celEnlace").innerHTML = objData.data.ENLACE; 
                $('#modalViewredesSociales').modal('show');
            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    }  
}

function fntEditInfo(element,idUsuario){
    rowTable=element.parentNode.parentNode.parentNode;
    //console.log(rowTable);
    document.querySelector('#titleModal').innerHTML ="Actualizar Red Social";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-success", "btn-warning");
    document.querySelector('#btnText').innerHTML ="Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/redesSociales/getredSocial/'+idUsuario;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {

                document.querySelector("#idUsuario").value = objData.data.COD_RED_SOCIAL;
                document.querySelector("#txtDescripcion").value = objData.data.DESCRIPCION;
                document.querySelector("#txtEnlace").value = objData.data.ENLACE;
            }
        }
        $('#modalFormredesSociales').modal('show');
    } 
}

function fntDelInfo(idUsuario){

    swal.fire({
        title: "Eliminar Red Social",
        text: "¿Realmente quiere eliminar la Red Social?",
        icon: "warning",
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
        showCancelButton: true,
        confirmButtonText: "Si, ¡eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    
    }).then((result) => {
        if (result.isConfirmed) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/RedesSociales/delredSocial/';
            let strData = "idUsuario=" + idUsuario;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal.fire({
                            title: "¡Eliminar!",
                            text: objData.msg,
                            icon: "success",
                            showClass: {
                                popup: 'animate__animated animate__flipInY'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__flipOutY'
                            }
                        });
                        tableredesSociales.api().ajax.reload();
                    } else {
                        swal.fire("Atención!", objData.msg, "error");
                    }
    
                }
            }
        }
    });
 }

function openModal()
{
    rowTable = "";
    document.querySelector('#idUsuario').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-warning", "btn-success");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Red Social";
    document.querySelector("#formredesSociales").reset();
    $('#modalFormredesSociales').modal('show');
}