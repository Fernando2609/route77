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

Programa:          Módulo de Inventario
Fecha:             25-Marzo-2022
Programador:       Kevin Alfredo Rodríguez Zúniga
descripción:       Módulo que gestiona la existencia de productos en el sistema

-----------------------------------------------------------------------*/
let tableInventario;
let rowTable="";
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function () {
      tableInventario = $("#tableInventarios").dataTable({
        aProcessing: true,
        aServerSide: true,
        language: {
          url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
        },

        ajax: {
          url: " " + base_url + "/Inventario/getInventarios",
          dataSrc: "",
        },

        columns: [
          { data: "COD_PRODUCTO" },
          { data: "COD_BARRA" },
          { data: "NOMBRE" },
          { data: "STOCK" },
          { data: "CANT_VENTA" },
          { data: "CANT_COMPRA" },
          { data: "CANT_MINIMA" },
          { data: "options" },
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
              columns: [0, 1, 2, 3, 4, 5, 6],
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
              columns: [0, 1, 2, 3, 4, 5, 6],
              modifier: {},
            },
          },
          {
            extend: "pdfHtml5",
            text: "<i class='fas fa-file-pdf'></i> PDF",
            titleAttr: "Exportar a PDF",
            className: "btn btn-danger mr-1 mb-2",
            filename: "EMPRESA",
            download: "open",
            orientation: "landscape",
            pageSize: "letter",
            title: "Reporte de Empresa",
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
                "30%",
                "15%",
                "15%",
                "15%",
                "20%",
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
                text: "ROUTE 77",
                alignment: "right",
                margin: [0, 20, 20, 100],
              };
              cols[2] = {
                fontSize: 11,
                text: fecha.toLocaleDateString("es-hn", {
                  weekday: "short",
                  year: "numeric",
                  month: "short",
                  day: "numeric",
                }),
                alignment: "right",
                margin: [0, 20, 20, 0],
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
              columns: [0, 1, 2, 3, 4, 5, 6],
              modifier: {},
            },
          },
          {
            extend: "csvHtml5",
            text: "<i class='fas fa-file-csv'></i> CSV",
            titleAttr: "Exportar a CSV",
            className: "btn btn-info mr-1 mb-2",
            exportOptions: {
              margin: [0, 20, 20, 20],
              columns: [0, 1, 2, 3, 4, 5, 6],
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
              columns: [0, 1, 2, 3, 4, 5, 6],
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
      if (document.querySelector("#formInventario")) {
      
        let formInventario = document.querySelector("#formInventario");
        formInventario.onsubmit = function (e) {
         e.preventDefault();
         console.log(formInventario);
          let intstock = document.querySelector("#stockupdate").value;
          if (intstock == "") {
            swal.fire("Atención", "Todos los campos son obligatorios.", "error");
            return false;
           }
           
           swal.fire({
               title: "Inventario",
               text: "¿Realmente desea eliminar " +intstock+" productos?",
               icon: "warning",
               showClass: {
                 popup: "animate__animated animate__fadeInDown",
               },
               hideClass: {
                 popup: "animate__animated animate__fadeOutUp",
               },
               showCancelButton: true,
               confirmButtonText: "!Si, Eliminar!",
               cancelButtonText: "!No, Cancelar!",
               closeOnConfirm: false,
               closeOnCancel: true,
             })
             .then((result) => {
               if (result.isConfirmed) {
                 divLoading.style.display = "flex";

                 let request = window.XMLHttpRequest
                   ? new XMLHttpRequest()
                   : new ActiveXObject("Microsoft.XMLHTTP");
                 let ajaxUrl = base_url + "/Inventario/setInventario";
                 let formData = new FormData(formInventario);
                 request.open("POST", ajaxUrl, true);
                 request.send(formData);
                 request.onreadystatechange = function () {
                   if (request.readyState == 4 && request.status == 200) {
                     let objData = JSON.parse(request.responseText);
                     if (objData.status) {
                       tableInventario.api().ajax.reload();
                       $("#modalEditInventario").modal("hide");
                       formInventario.reset();
                       swal.fire("Inventario", objData.msg, "success");
                     } else {
                       swal.fire("Error", objData.msg, "error");
                     }
                   }
                   divLoading.style.display = "none";
                   return false;
                 };
               }
             });
           
        };
      }
      

}, false)

function fntViewInfo(COD_PRODUCTO){
    
   let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Inventario/getInventario/'+COD_PRODUCTO;
    request.open("GET",ajaxUrl,true);
    request.send();
    $('#modalViewUser').modal('show');
     request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            console.log(objData);
            if(objData.status)
            {
              
                document.querySelector("#celproducto").innerHTML = objData.data.NOMBRE;
                document.querySelector("#celstock").innerHTML = objData.data.STOCK;
                document.querySelector("#celCant_Vent").innerHTML = objData.data.CANT_VENTA;
                document.querySelector("#celCant_Comp").innerHTML = objData.data.CANT_COMPRA;
                document.querySelector("#celCant_Min").innerHTML = objData.data.CANT_MINIMA; 
                $('#modalViewInventario').modal('show');
            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    } 
} 
/* function fntEditInfo(element,COD_PRODUCTO){
  rowTable=element.parentNode.parentNode.parentNode;
  let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
  let ajaxUrl = base_url+'/Inventario/getInventario/'+COD_PRODUCTO;
  request.open("GET",ajaxUrl,true);
  request.send();
  $('#modalViewUser').modal('show');
   request.onreadystatechange = function(){
      if(request.readyState == 4 && request.status == 200){
          let objData = JSON.parse(request.responseText);
          console.log(objData);
          if(objData.status)
          {
            
              document.querySelector("#celproducto").innerHTML = objData.data.NOMBRE;
              document.querySelector("#celstock").innerHTML = objData.data.STOCK;
              document.querySelector("#celCant_Vent").innerHTML = objData.data.CANT_VENTA;
              document.querySelector("#celCant_Comp").innerHTML = objData.data.CANT_COMPRA;
              document.querySelector("#celCant_Min").innerHTML = objData.data.CANT_MINIMA; 
              $('#modalEditInventario').modal('show');
          }else{
              swal.fire("Error", objData.msg , "error");
          }
      }
  } 
}
 */

function fntEditInfo(element,COD_PRODUCTO){
  rowTable=element.parentNode.parentNode.parentNode;
  console.log(rowTable);

  document.querySelector('#titleModal').innerHTML ="Actualizar Stock";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-success", "btn-warning");
    document.querySelector('#btnText').innerHTML ="Actualizar";

    stock=document.querySelector("#stockupdate");
  let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
  let ajaxUrl = base_url+'/Inventario/getInventario/'+COD_PRODUCTO;
  request.open("GET",ajaxUrl,true);
  request.send();
  $('#modalViewUser').modal('show');
   request.onreadystatechange = function(){
      if(request.readyState == 4 && request.status == 200){
          let objData = JSON.parse(request.responseText);
          console.log(objData);
          if(objData.status)
          {
            document.querySelector('#stockupdate').max =objData.data.STOCK;
            document.querySelector("#titleModalEdit").innerHTML = "Inventario de "+ objData.data.NOMBRE;
            document.querySelector("#idInventario").value = objData.data.COD_PRODUCTO; 

              $('#modalEditInventario').modal('show');
          }else{
              swal.fire("Error", objData.msg , "error");
          }
      }
  } 
}












function openModal()
{
    rowTable = "";
    document.querySelector('#idUsuario').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-warning", "btn-success");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Inventario";
    document.querySelector("#formInventario").reset();
    $('#modalFormInventario').modal('show');
};   
