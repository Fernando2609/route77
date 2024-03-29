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

Programa:          Módulo Compras
Fecha:             19-Mayo-2022
Programador:       Jose Fernando Ortiz Santos
descripción:       Muestra las compras realizadas por el usuario administrador

-----------------------------------------------------------------------*/

let tableCompras;
document.addEventListener(
  "DOMContentLoaded",
  function () {
    tableCompras = $("#tableCompras").dataTable({
      aProcessing: true,
      aServerSide: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },

      ajax: {
        url: " " + base_url + "/Compras/getCompras",
        dataSrc: "",
      },

      columns: [
        { data: "COD_ORDEN" },
        { data: "NO_FACTURA" },
        { data: "MONTO" },
        { data: "FECHA_COMPRA" },
        { data: "NOMBRE_EMPRESA" },
        { data: "options" },
      ],
      columnDefs: [
        { className: "textcenter", targets: [2] },
        { className: "textright", targets: [3] },
        { className: "textcenter", targets: [4] },
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
          fnClick: function ( nButton, oConfig, oFlash ) {
                        alert( 'Mouse click' );
                    },
          exportOptions: {
            margin: [0, 20, 20, 20],
            columns: [0, 1, 2, 3,4],
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
            columns: [0, 1, 2, 3,4],
            modifier: {},
          },
        },
        
        {
          extend: "pdfHtml5",
          text: "<i class='fas fa-file-pdf'></i> PDF",
          titleAttr: "Exportar a PDF",
          className: "btn btn-danger mr-1 mb-2",
          filename: "Compras",
          download: "open",
          //orientation: 'landscape',
          pageSize: "letter",
          title: "Reporte de Compras",
          customize: function (doc) {
            doc.content[1].margin = [0, 40, 120, 20];
            doc.content[0].margin = [0, 20, 0, 0];
            doc.content[0].alignment = "center";
            doc.content[1].alignment = "left";
            //orientacion vertical
            //doc.content[1].table.widths = [ '5%', '25%', '20%', '40%', '20%', '20%', '11%']
            //orientacion Horizontal
            doc.content[1].table.widths = ["10%", "25%", "25%", "30%","40%"];
            doc.content[1].table.body[0].forEach(function (h) {
              h.alignment = "left";
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

            /* let cols2 = [];
                                  cols2[0] = {fontSize: 13,text:  , alignment: 'center', margin:[0,0,0,0] };
                                  
                                  let objfooter = {};
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
            columns: [0, 1, 2, 3,4],
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
            columns: [0, 1, 2, 3,4],
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
            columns: [0, 1, 2, 3,4],
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
  },
  
 
  false
);
var minDate, maxDate;
 $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {

 var min = minDate.val();
 var max = maxDate.val();
 var date = new Date(data[3]);
 minimo = moment(min, "MM-DD-YYYY");
console.log(max);
   if (
     (min === null && max === null) ||
     (min === null && date <= max) ||
     (min <= date && max === null) ||
     (min <= date && date <= max)
   ) {
     return true;
   }
   return false;
 })
   $(document).ready(function () {
     
     // Create date inputs
      minDate = new DateTime($("#min"), {
        format: "DD-MM-YYYY",
      });
      maxDate = new DateTime($("#max"), {
        format: "DD-MM-YYYY",
      });

     // Refilter the table
     $("#min, #max").on("change", function () {

       tableCompras.api().ajax.reload();
      
     });

      /*  minDate = new DateTime($("#min"), {
         format: "MMMM Do YYYY",
       });
       maxDate = new DateTime($("#max"), {
         format: "MMMM Do YYYY",
       }); */
   });
function fntUtilidadG() {
  let Finicio = document.querySelector(".Finicio").value;
  let Ffinal = document.querySelector(".fFinal").value;

  if (Finicio == "" || Ffinal == "") {
    swal.fire(
      "",
      "Seleccione Fecha inicial y Fecha final para las utilidades",
      "error"
    );
    return false;
  } else {
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    let ajaxUrl = base_url + "/Pedidos/Utilidad/" + Finicio + "/" + Ffinal;
    divLoading.style.display = "flex";
    let formData = new FormData();
    formData.append("fechaInicio", Finicio);
    formData.append("fechaFinal", Ffinal);
    request.open("POST", ajaxUrl, true);
    request.send(formData);

    request.onreadystatechange = function () {
      if (request.readyState != 4) return;
      if (request.status == 200) {
        window.open(
          base_url + "/Pedidos/Utilidad/" + Finicio + "/" + Ffinal,
          "_blank"
        );

        divLoading.style.display = "none";
        return false;

        //$("#pagosMesAnio").html(request.responseText);
      }
    };
  }
}

function fntUtilidadB() {
  let Finicio = document.querySelector(".Finicio").value;
  let Ffinal = document.querySelector(".fFinal").value;

  if (Finicio == "" || Ffinal == "") {
    swal.fire(
      "",
      "Seleccione Fecha inicial y Fecha final para las utilidades",
      "error"
    );
    return false;
  } else {
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    let ajaxUrl = base_url + "/Pedidos/UtilidadB/" + Finicio + "/" + Ffinal;
    divLoading.style.display = "flex";
    let formData = new FormData();
    formData.append("fechaInicio", Finicio);
    formData.append("fechaFinal", Ffinal);
    request.open("POST", ajaxUrl, true);
    request.send(formData);

    request.onreadystatechange = function () {
      if (request.readyState != 4) return;
      if (request.status == 200) {
        window.open(
          base_url + "/Pedidos/UtilidadB/" + Finicio + "/" + Ffinal,
          "_blank"
        );

        divLoading.style.display = "none";
        return false;

        //$("#pagosMesAnio").html(request.responseText);
      }
    };
  }
}