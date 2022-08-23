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

Programa:          Módulo OrdenCompra
Fecha:             14-May-2022
Programador:       Jose Fernando Ortiz Santos
descripción:       Proceso donde se registran la cantidad de productos 
                   a ingresar al sistema

-----------------------------------------------------------------------*/
$(document).ready(function(){
   
  $("#idProducto").keyup(function(e){
    e.preventDefault();

    
    var producto=$(this).val();
    if (producto!='') {
       let request = window.XMLHttpRequest
         ? new XMLHttpRequest()
         : new ActiveXObject("Microsoft.XMLHTTP");
       let ajaxUrl = base_url + "/OrdenCompra/getProducto/" + producto;
       request.open("GET", ajaxUrl, true);
       request.send();
       request.onreadystatechange = function () {
         if (request.readyState == 4 && request.status == 200) {
           let objData = JSON.parse(request.responseText);
           //console.log(objData);
           if (objData.status) {
             document.querySelector("#nombre").innerHTML = objData.data.NOMBRE;
             document.querySelector("#txtCategoria").innerHTML =
               objData.data.CATEGORÍA;
              $("#txtCantidad").removeAttr("disabled");
               $("#txtPrecio").removeAttr("disabled");
               document.querySelector("#add_product_Compra").classList.remove("notBlock");
           } else {
              document.querySelector("#nombre").innerHTML ='-';
              document.querySelector("#txtCategoria").innerHTML =
              '-';
              $("#txtCantidad").attr("disabled", "disabled");
              $("#txtPrecio").attr("disabled", "disabled");
              document
                .querySelector("#add_product_Compra")
                .classList.add("notBlock");
           }
         }
       }; 
    }else{
       document.querySelector("#nombre").innerHTML = "-";
       document.querySelector("#txtCategoria").innerHTML = "-";
       $("#txtCantidad").attr("disabled", "disabled");
       $("#txtPrecio").attr("disabled", "disabled");
       document.querySelector("#add_product_Compra").classList.add("notBlock");
    }
   
   
  })

  let precio;
  let cantidad;
  let precioTotal;
  //Calcular cantidad del producto antes de agregar
  $("#txtCantidad").keyup(function(e){
    e.preventDefault();
     cantidad = $(this).val();
    precioTotal = (precio*cantidad);
    if (isNaN(precioTotal)) {
        document.querySelector("#txtPrecioTotal").innerHTML = "0.00";
    }else{

      document.querySelector("#txtPrecioTotal").innerHTML = precioTotal;
    }
    if($(this).val()<1 || isNaN($(this).val())){
      document.querySelector("#add_product_Compra").classList.add("notBlock");

    }else{
    document.querySelector("#add_product_Compra").classList.remove("notBlock");

    }
     
    
    //$("#txtPrecioTotal").html(precioTotal);
  })

   $("#txtPrecio").keyup(function (e) {
      precio = $(this).val();
      precioTotal=parseFloat(precio*cantidad).toFixed(2);
     if (isNaN(precioTotal)) {
       document.querySelector("#txtPrecioTotal").innerHTML = "0.00";
     } else {
       document.querySelector("#txtPrecioTotal").innerHTML = precioTotal;
     }
     if($(this).val()<1 || isNaN($(this).val())){
      document.querySelector("#add_product_Compra").classList.add("notBlock");

    }else{
    document.querySelector("#add_product_Compra").classList.remove("notBlock");

    }
   });
   
  $("#add_product_Compra").click(function (e) {
    e.preventDefault;
    if ($("#txtCantidad").val()>0) {

      let COD_PRODUCTO = $("#idProducto").val();
      let cantidad = $("#txtCantidad").val();
      let precio = $("#txtPrecio").val();
      let precioTotal = $("#txtPrecioTotal").html();
      let checkISV = document.querySelector("#checkISV").checked;

      let request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      let ajaxUrl = base_url + "/OrdenCompra/detalleCompra";
       let formData = new FormData();
       formData.append("idProducto", COD_PRODUCTO);
       formData.append("txtCantidad", cantidad);
       formData.append("txtPrecio", precio);
       formData.append("txtPrecioTotal", precioTotal);
       formData.append("checkISV", checkISV);

      request.open("POST", ajaxUrl, true);
      request.send(formData);
      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          let objData = JSON.parse(request.responseText);
          
          if (objData.status) {
            

            document.querySelector("#tablaCompra").innerHTML =objData.htmlCompras;
            //document.querySelector("#detalle_venta").innerHTML=objData.data.detalle;
            document.querySelector("#detalle_totales").innerHTML=objData.htmlTotales;


             document.querySelector("#idProducto").value = "";
             document.querySelector("#nombre").innerHTML = "-";
             document.querySelector("#txtCategoria").innerHTML = "-";
             document.querySelector("#txtPrecioTotal").innerHTML = "-";
             document.querySelector("#txtCantidad").value = "0";
             document.querySelector("#txtPrecio").value = "0";
             $("#txtCantidad").attr("disabled", "disabled");
             $("#txtPrecio").attr("disabled", "disabled");
             document
               .querySelector("#add_product_Compra")
               .classList.add("notBlock");
             Swal.fire({
               toast: true,
               iconColor: "white",
               customClass: {
                 popup: "colored-toast",
               },
               position: "top-right",
               icon: "success",
               title: objData.msg,
               showConfirmButton: false,
               timer: 1500,
               timerProgressBar: true,
             });
             viewProcesar();

           /*  document.querySelector("#nombre").innerHTML = objData.data.NOMBRE;
            document.querySelector("#txtCategoria").innerHTML =
              objData.data.CATEGORÍA;
            $("#txtCantidad").removeAttr("disabled");
            $("#txtPrecio").removeAttr("disabled");
            document
              .querySelector("#add_product_Compra")
              .classList.remove("notBlock"); */
          } else {
            console.log('error');
            /* document.querySelector("#nombre").innerHTML = "-";
            document.querySelector("#txtCategoria").innerHTML = "-";
            $("#txtCantidad").attr("disabled", "disabled");
            $("#txtPrecio").attr("disabled", "disabled");
            document
              .querySelector("#add_product_Compra")
              .classList.add("notBlock"); */
          }
        }
      }; 
    }

    
  });
  

  $("#btn_anular_compra").click(function(e){
    e.preventDefault();
    var rows=$('#tablaCompra tr').length;
    if (rows>0) {
       let request = window.XMLHttpRequest
         ? new XMLHttpRequest()
         : new ActiveXObject("Microsoft.XMLHTTP");
       let ajaxUrl = base_url + "/OrdenCompra/anularCompra";
       let formData = new FormData();
       //formData.append("idProducto", id);

       request.open("POST", ajaxUrl, true);
       request.send();
       request.onreadystatechange = function () {
         if (request.readyState == 4 && request.status == 200) {
           let objData = JSON.parse(request.responseText);
           console.log(objData);
           if (objData.status) {
             location.reload();
           }
           viewProcesar();
         }
       };
    }
  });

 $("#btn_facturar_compra").click(function (e) {
   e.preventDefault;
   var rows = $("#tablaCompra tr").length;
   if (rows > 0) {
     let factura = $("#txtFactura").val();
     let proveedor = document.querySelector("#codProveedor").value;
     if (proveedor=="") {
      swal.fire("Atención", "Seleccione un Proveedor.", "error");
     }
     checkISV = document.querySelector("#checkISV").checked;
      let elementsValid = document.getElementsByClassName("valid");
      for (let i = 0; i < elementsValid.length; i++) {
        if (elementsValid[i].classList.contains("is-invalid")) {
          swal.fire(
            "Atención",
            "Por favor verifique los campos en rojo.",
            "error"
          );
          return false;
        }
      }
     /* let precio = $("#txtPrecio").val();
    let precioTotal = $("#txtPrecioTotal").html(); */

     let request = window.XMLHttpRequest
       ? new XMLHttpRequest()
       : new ActiveXObject("Microsoft.XMLHTTP");
     let ajaxUrl = base_url + "/OrdenCompra/procesarCompra";
     let formData = new FormData();
     formData.append("txtFactura", factura);
     formData.append("idProveedor", proveedor);
      formData.append("checkISV", checkISV);
     request.open("POST", ajaxUrl, true);
     request.send(formData);
     request.onreadystatechange = function () {
       if (request.readyState == 4 && request.status == 200) {
         let objData = JSON.parse(request.responseText);

         if (objData.status) {
           window.location = base_url + "/Compras/";
         } else {
           swal.fire(
             "Atención",
             objData.msg,
             "error"
           );
           /* document.querySelector("#nombre").innerHTML = "-";
            document.querySelector("#txtCategoria").innerHTML = "-";
            $("#txtCantidad").attr("disabled", "disabled");
            $("#txtPrecio").attr("disabled", "disabled");
            document
              .querySelector("#add_product_Compra")
              .classList.add("notBlock"); */
         }
       }
     };
   }
 });
  

});
  $("#checkISV").on("change", function () {
      let checkISV = document.querySelector("#checkISV").checked;
     let request = window.XMLHttpRequest
       ? new XMLHttpRequest()
       : new ActiveXObject("Microsoft.XMLHTTP");
     let ajaxUrl = base_url + "/OrdenCompra/Totales";
     let formData = new FormData();
     formData.append("checkISV", checkISV);
     request.open("POST", ajaxUrl, true);
     request.send(formData);
      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          let objData = JSON.parse(request.responseText);
          console.log(objData);
          if (objData.status) {
             document.querySelector("#detalle_totales").innerHTML =
               objData.htmlTotales;

          }else{
            swal.fire('error','error','error');
          }

        }
      };
  });

function del_product_detalle(id) {
  checkISV = document.querySelector("#checkISV").checked;
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/OrdenCompra/delCompra";
   let formData = new FormData();
   formData.append("idProducto", id);
     formData.append("checkISV", checkISV);
   

  request.open("POST", ajaxUrl, true);
  request.send(formData);
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);
      console.log(objData);
      if (objData.status) {
        document.querySelector("#tablaCompra").innerHTML = objData.htmlCompras;
        //document.querySelector("#detalle_venta").innerHTML=objData.data.detalle;
        document.querySelector("#detalle_totales").innerHTML =
          objData.htmlTotales;
          Swal.fire({
            toast: true,
            iconColor: "white",
            customClass: {
              popup: "colored-toast",
            },
            position: "top-right",
            icon: "warning",
            title: objData.msg,
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
          });
      } else {
        Swal.fire({
          toast: true,
          iconColor: "white",
          customClass: {
            popup: "colored-toast",
          },
          position: "top-right",
          icon: "error",
          title: "Error",
          showConfirmButton: false,
          timer: 1500,
          timerProgressBar: true,
        });
      }
      viewProcesar();
    }
  };
}
function viewProcesar() {
  if ($("#tablaCompra tr" ).length>0) {
    document.querySelector("#btn_facturar_compra").classList.remove("notBlock");
  }else{
    document.querySelector("#btn_facturar_compra").classList.add("notBlock");
  }
};
//Cargar las clases desde el load
window.addEventListener('load', function() {
   viewProcesar();
   fntProveedores();
    document.querySelector("#checkISV").checked=true;
}, false);



function fntProveedores(){
  
      let ajaxUrl = base_url + "/OrdenCompra/getSelectProveedores";
      let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
      request.open("GET",ajaxUrl,true);
      request.send();
      request.onreadystatechange = function(){
          if(request.readyState == 4 && request.status == 200){
              document.querySelector("#listProveedor").innerHTML =
                request.responseText;
              document.querySelector("#listProveedor").value = 1;
              $("#listProveedor").selectpicker("render");
          }
  }
 }

 
function modalProveedores() {
  $("#tableProveedores").dataTable({
    aProcessing: true,
    aServerSide: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },

    ajax: {
      url: " " + base_url + "/OrdenCompra/getProveedores",
      dataSrc: "",
    },

    columns: [
      { data: "COD_PROVEEDOR" },
      { data: "NOMBRE_EMPRESA" },
      { data: "RTN" },
      { data: "EMAIL" },
      //{ data: "TELEFONO" },
      { data: "options" },
    ],
    dom:
      "<'row d-flex'<'col-sm-12 mb-2 col-md-5'l ><'col-md-7 mb-2 align-self-end'f>>" +
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
        title: "Reporte de Inventario",
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
            "10%",
            "15%",
            "25%",
            "30%",
            "20%",
          ];
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
                        "Página " + currentPage.toString() + " de " + pageCount,
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
        charset: "utf-8",
        bom: true,
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
    iDisplayLength: 5,
    order: [[0, "desc"]],
    autoWidth: false,
    lengthMenu: [
      [5,10, 25, 50, -1],
      ["5 ","10 ", "25 ", "50 ", "Todo"],
    ],
  });
  $("#modalProveedores").modal("show",function () {
       var table = $("#tableProveedores").DataTable();
       table.columns.adjust();
   });
};


function fntProveedorSelect(codProveedor,nombreEmpresa) {
  
  document.querySelector("#txtProveedor").value = nombreEmpresa;
  document.querySelector("#codProveedor").value = codProveedor;
  $("#modalProveedores").modal("hide");
}


