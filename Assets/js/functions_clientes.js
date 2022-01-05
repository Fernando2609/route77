let tableClientes;
let rowTable="";
let divLoading = document.querySelector("#divLoading");
document.all
document.addEventListener('DOMContentLoaded',function () {

    tableClientes = $('#tableClientes').dataTable(  {
        "aProcessing":true, 
        "aServerSide":true,
        "language": {   
             "url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
           },
        
           "ajax":{
            "url": " "+base_url+"/Clientes/getClientes",
            "dataSrc":""
              },
        
                "columns": [
                    {"data":"idUsuario"},
                    {"data":"dni"},
                    {"data":"nombres"},
                    {"data":"apellidos"},
                    {"data":"email"},
                    {"data":"telefono"},
                    {"data":"status"},
                    {"data":"options"}
                   
                  ],
                    'dom': "<'row d-flex'<'col-sm-12 mb-2 col-md-5'l B><'col-md-7 mb-2 align-self-end'f>>"+ "<'row'<'col-sm-12'tr>>" +"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    'buttons': [
                        {
                            "extend": "copyHtml5",
                            "text": "<i class='far-copy'></i> Copiar",
                            "titleAttr": "Copiar",
                            "className": "btn btn-secondary mr-1 mb-2",
                            
                           
                            exportOptions: {

                                margin: [0, 20,20,20],
                                columns: [ 0, 1, 2, 3, 4,5,6],
                                  modifier: {
                                  }
                              }
                        }, {
                            "extend": "excelHtml5",
                            "text": "<i class='fas fa-file-excel'></i> Excel",
                            "titleAttr": "Exportar a Excel",
                            "className": "btn btn-success mr-1 mb-2",
                            "excelStyles": [
                                {
                                    "template": "green_medium"
                                },
                                {
                                    "cells": "2",
                                    "style": {
                                        "fill": {
                                            "pattern": {
                                                "type": "solid",
                                                "color": "3c6a8c"
                                            }
                                        }
                                    }
                                }
                            ],
                            exportOptions: {
                   
                                margin: [0, 20,20,20],
                                columns: [ 0, 1, 2, 3, 4,5,6],
                                  modifier: {
                                  }
                              },
                              
                        }, {
                            "extend": "pdfHtml5",
                            "text": "<i class='fas fa-file-pdf'></i> PDF",
                            "titleAttr": "Exportar a PDF",
                            "className": "btn btn-danger mr-1 mb-2",
                            filename:'CLIENTES',
                            download:'open',
                            orientation: 'landscape',
                            pageSize:'letter',
                            title:'Reporte de Clientes',
                            customize: function ( doc ) {
                                doc.content[1].margin = [ 0, 40, 120, 20 ]
                                doc.content[0].margin = [ 0, 20, 0, 0 ]
                                doc.content[0].alignment = 'center'
                                //orientacion vertical 
                                //doc.content[1].table.widths = [ '5%', '25%', '20%', '40%', '20%', '20%', '11%']
                                //orientacion Horizontal 
                                doc.content[1].table.widths = [ '5%', '20%', '20%', '30%', '15%', '20%', '11%']
                                doc.content[1].table.body[0].forEach(function(h){
                                  //h.alignment='left';  
                                  h.fillColor = '#81ae39';
                                  h.color='white';
                                  h.fontSize=12;
                                })
                                let cols = [];
                                  cols[0] = { 
                                    image: imgB64                
                                    , alignment: 'left', margin:[20,5,10,20],width:100 };
                                  const fecha = new Date();
                                  cols[1] = {fontSize: 11,text: 'ROUTE 77' , alignment: 'right', margin:[0,20,20,100] };
                                  cols[2] = {fontSize: 11,text: fecha.toLocaleDateString('es-hn',{ weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' }) , alignment: 'right', margin:[0,20,20,0] }
                                  let objheader = {};
                                  objheader['columns'] = cols;
                                  doc['header']=function(page) { 
                                  if (page == 1) 
                                    return objheader
                                else
                                    return cols[2] = {fontSize: 11,text: fecha.toLocaleDateString() , alignment: 'right', margin:[0,20,20,0] }
                                 };
                                  // Splice the image in after the header, but before the table
                                  
                                  /* var cols2 = [];
                                  cols2[0] = {fontSize: 13,text:  , alignment: 'center', margin:[0,0,0,0] };
                                  
                                  var objfooter = {};
                                  objfooter['columns'] = cols2;*/
                                  doc['footer']= function(currentPage, pageCount) {
                                  return {
                                    margin:10,
                                    columns: [{
                                        fontSize: 10,
                                        text:[{
                                        text: '--------------------------------------------------------------------------'+'\n',
                                        margin: [0, 20]
                                        },
                                        {
                                        text: 'Página ' + currentPage.toString() + ' de ' + pageCount,
                                        }],
                                        alignment: 'center'
                                    }]
                                };
                    
                             }
                            }, exportOptions: {
                            
                                margin: [0, 20,20,20],
                                columns: [ 0, 1, 2, 3, 4,5,6],
                                modifier: {
                                }
                            },
                                 
                        }, {
                            "extend": "csvHtml5",
                            "text": "<i class='fas fa-file-csv'></i> CSV",
                            "titleAttr": "Exportar a CSV",
                            "className": "btn btn-info mr-1 mb-2",
                            exportOptions: {

                                margin: [0, 20,20,20],
                                columns: [ 0, 1, 2, 3, 4,5,6],
                                  modifier: {
                                  }
                              }
                        }, {
                            "extend": "print",
                            "text": "<i class='fa fa-print'></i> Imprimir",
                            "titleAttr": "Imprimir",
                            "className": "btn btn-warning mr-1 mb-2",
                            exportOptions: {

                                margin: [0, 20,20,20],
                                columns: [ 0, 1, 2, 3, 4,5,6],
                                  modifier: {

                                  }
                              }
                        }
                    ],
                  "responsive":true,
                  "bDestroy":true,
                  "iDisplayLength": 10,
                  "order":[[0,"desc"]],
                  "autoWidth": false,
                  lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 ', '25 ', '50 ', 'Todo']
                ],
                
                
    });

    if (document.querySelector("#formCliente")) {
        let formCliente=document.querySelector("#formCliente");
        formCliente.onsubmit=function(e){
            e.preventDefault();
            let strIdentificacion = document.querySelector('#txtIdentificacion').value;
            let strNombre = document.querySelector('#txtNombre').value;
            let strApellido = document.querySelector('#txtApellido').value;
            let strEmail = document.querySelector('#txtEmail').value;
            let intTelefono = document.querySelector('#txtTelefono').value;
            /* let intTipousuario = document.querySelector('#listRolid').value; */
            let intNacionalidad = document.querySelector('#listNacionalidadCliente').value;
            let intGenero = document.querySelector('#listGenero').value;
            let intEstadoC = document.querySelector('#listEstadoC').value;
            let strFechaN = document.querySelector('#fechaNacimiento').value;
            let strPassword = document.querySelector('#txtPassword').value;
            let intStatus = document.querySelector('#listStatus').value;
    
            if(strIdentificacion == '' || strApellido == '' || strNombre == '' || strEmail == '' || intTelefono == ''|| intNacionalidad == '' || intGenero == ''/* || intEstadoC == '' || strFechaN == ''|| strPassword == '' || intStatus == '' */)
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
            let ajaxUrl = base_url+'/Clientes/setCliente'; 
            let formData = new FormData(formCliente);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){ 
                if(request.readyState == 4 && request.status == 200){
                   /*  console.log(request.responseText); */
                    let objData = JSON.parse(request.responseText); 
                    
                    if(objData.status)
                    { 
                       
                        $('#modalFormCliente').modal("hide");
                        formCliente.reset();
                            swal.fire("Clientes", objData.msg ,"success");
                            tableClientes.api().ajax.reload();
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

}, false);

function fntViewInfo(idpersona){
    
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Clientes/getCliente/'+idpersona;
    request.open("GET",ajaxUrl,true);
    request.send();
     request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
                /* console.log(objData.data.status); */
                let estadoUsuario = objData.data.status == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>'; 

                document.querySelector("#celIdentificacion").innerHTML = objData.data.dni;
                document.querySelector("#celNombre").innerHTML = objData.data.nombres;
                document.querySelector("#celApellido").innerHTML = objData.data.apellidos;
                document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
                document.querySelector("#celEmail").innerHTML = objData.data.email;
                /* document.querySelector("#celTipoUsuario").innerHTML = objData.data.nombreRol; */
                document.querySelector("#celNacionalidad").innerHTML = objData.data.nacionalidad;
                document.querySelector("#celGenero").innerHTML = objData.data.genero;
                 document.querySelector("#celSucursal").innerHTML = objData.data.sucursal; 
                document.querySelector("#celNacimiento").innerHTML = objData.data.fechaNacimiento;
                document.querySelector("#celEstadoC").innerHTML = objData.data.estadocivil;
                document.querySelector("#celEstado").innerHTML = estadoUsuario;
                document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro;
                document.querySelector("#celDateModificado").innerHTML = objData.data.datemodificado; 
                document.querySelector("#celDateLogin").innerHTML = objData.data.datelogin;  
                $('#modalViewCliente').modal('show');
            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    }  
}
function fntEditInfo(element,idUsuario){
    rowTable=element.parentNode.parentNode.parentNode;
    //console.log(rowTable);
    document.querySelector('#titleModal').innerHTML ="Actualizar Cliente";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Clientes/getCliente/'+idUsuario;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {

                document.querySelector("#idUsuario").value = objData.data.idUsuario;
                document.querySelector("#txtIdentificacion").value = objData.data.dni;
                document.querySelector("#txtNombre").value = objData.data.nombres;
                document.querySelector("#txtApellido").value = objData.data.apellidos;
                document.querySelector("#txtTelefono").value = objData.data.telefono;
                document.querySelector("#txtEmail").value = objData.data.email;
                document.querySelector("#listNacionalidadCliente").value =objData.data.idNacionalidad;
                document.querySelector("#listSucursal").value =objData.data.idsucursal;
                document.querySelector("#listGenero").value =objData.data.idGenero;
                document.querySelector("#listEstadoC").value =objData.data.idEstado;
                document.querySelector("#fechaNacimiento").value=objData.data.fechaNaci;
                console.log(objData.data.fechaNaci);
                
                $('#listGenero').selectpicker('render');
                $('#listEstadoC').selectpicker('render');
                $('#listGenero').selectpicker('render');
                $('#listSucursal').selectpicker('render');
                 if(objData.data.status == 1){
                   document.querySelector("#listStatus").value = 1;
                }else{
                   document.querySelector("#listStatus").value = 2;
               }
                $('#listStatus').selectpicker('render'); 
            }
        }
        $('#modalFormCliente').modal('show');
    } 
}

function fntDelInfo(idUsuario){

    swal.fire({
        title: "Eliminar Cliente",
        text: "¿Realmente quiere eliminar el Cliente?",
        icon: "warning",
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        },
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    
    }).then((result) => {
        if (result.isConfirmed) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Clientes/delCliente/';
            let strData = "idUsuario=" + idUsuario;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal.fire({
                            title: "Eliminar!",
                            text: objData.msg,
                            icon: "success",
                            showClass: {
                                popup: 'animate__animated animate__flipInY'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__flipOutY'
                            }
                        });
                        tableClientes.api().ajax.reload();
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
    document.querySelector('#titleModal').innerHTML = "Nuevo Cliente";
    document.querySelector("#formCliente").reset();
    $('#modalFormCliente').modal('show');
}

window.addEventListener('load', function() {
   
     fntNacionalidadCliente();
     fntGeneroCliente();
     fnEstadoCCliente();
     fnSucursalUsuario();

}, false);
//Funcion para traer Las sucursales
function fnSucursalUsuario(){
  
    let ajaxUrl = base_url+'/Clientes/getSelectSucursal';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            document.querySelector('#listSucursal').innerHTML = request.responseText;
            document.querySelector('#listSucursal').value=1;
            $('#listSucursal').selectpicker('render');
        }
    }

}
//Funcion para traer la nacionalidad 
function fntNacionalidadCliente(){
    
    let ajaxUrl = base_url+'/Clientes/getSelectNacionalidadCliente';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            document.querySelector('#listNacionalidadCliente').innerHTML = request.responseText;
            document.querySelector('#listNacionalidadCliente').value=1;
            $('#listNacionalidadCliente').selectpicker('render');
        }
    }

}

//Funcion para traer el genero
function fntGeneroCliente(){
  
    let ajaxUrl = base_url+'/Clientes/getSelectGeneroCliente';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            document.querySelector('#listGenero').innerHTML = request.responseText;
            document.querySelector('#listGenero').value=1;
            $('#listGenero').selectpicker('render');
        }
    }

}
//Funcion para traer el Estado Civil
function fnEstadoCCliente(){
  
    let ajaxUrl = base_url+'/Clientes/getSelectEstadoCCliente';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            document.querySelector('#listEstadoC').innerHTML = request.responseText;
            document.querySelector('#listEstadoC').value=1;
            $('#listEstadoC').selectpicker('render');
        }
    }

}