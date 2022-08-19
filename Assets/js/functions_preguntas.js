let tablePreguntas;
let rowTable="";
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function () {

tablePreguntas = $("#tablePreguntas").dataTable({
      aProcessing: true,
      aServerSide: true,
      language: {
        url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
      },
      
      ajax: {
        url: " " + base_url + "/Preguntas/getPreguntas",
        dataSrc: "",
      },

      columns: [
        {data:"COD_PREGUNTA"},
        {data:"PREGUNTA"},
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
          filename: "PREGUNTAS",
          download: "open",
          //orientation: "landscape",
          pageSize: "letter",
          title: "Reporte de Preguntas",
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


 if (document.querySelector("#formPreguntas")) {
        let formPreguntas=document.querySelector("#formPreguntas");
        formPreguntas.onsubmit=function(e){
            e.preventDefault();
            //let strIdentificacion = document.querySelector('#txtIdentificacion').value;
            let strPreguntas = document.querySelector('#txtPreguntas').value;
    
            
            if(strPreguntas == '' )
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
            let ajaxUrl = base_url+'/Preguntas/setPreguntas'; 
            let formData = new FormData(formPreguntas);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){ 
                if(request.readyState == 4 && request.status == 200){
                    //console.log(request.responseText); 
                    let objData = JSON.parse(request.responseText); 
                    
                    if(objData.status)
                    { 
                         if (rowTable == "") {
                             tablePreguntas.api().ajax.reload();
                         } else {  
                             rowTable.cells[1].textContent = strPreguntas;
                             rowTable = "";
                         }
 
                        $('#ModalFormPreguntas').modal("hide");
                        formPreguntas.reset();
                            swal.fire("Preguntas", objData.msg ,"success");
                            tablePreguntas.api().ajax.reload();
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

function fntViewInfo(cod){
    
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Preguntas/getPreguntasSeguridad/'+cod;
    request.open("GET",ajaxUrl,true);
    request.send();
     request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            //console.log(objData);
            if(objData.status)
            {
              console.log(objData);

                document.querySelector("#celPreguntas").innerHTML = objData.data.PREGUNTA; 
                $('#modalViewPreguntas').modal('show');
              }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    }  
}

function fntEditInfo(element,idPreguntas){
    rowTable=element.parentNode.parentNode.parentNode;
    //console.log(rowTable);
    document.querySelector('#titleModal').innerHTML ="Actualizar Pregunta";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-success", "btn-warning");
    document.querySelector('#btnText').innerHTML ="Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Preguntas/getPreguntasSeguridad/'+idPreguntas;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {

                document.querySelector("#idPreguntas").value = objData.data.COD_PREGUNTA;
                document.querySelector("#txtPreguntas").value = objData.data.PREGUNTA;
            }
        }
        $('#ModalFormPreguntas').modal('show');
    } 
}

function fntDelInfo(idPreguntas){

    swal.fire({
        title: "Eliminar Pregunta",
        text: "¿Realmente quiere eliminar la Pregunta?",
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
            let ajaxUrl = base_url + '/Preguntas/delPreguntas/';
            let strData = "idPreguntas=" + idPreguntas;
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
                        tablePreguntas.api().ajax.reload();
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
    document.querySelector('#idPreguntas').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-warning", "btn-success");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Pregunta";
    document.querySelector("#formPreguntas").reset();
    $('#ModalFormPreguntas').modal('show');
}