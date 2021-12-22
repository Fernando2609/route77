var tableUsuarios;


document.addEventListener('DOMContentLoaded',function () {
    tableUsuarios = $('#tableUsuarios').dataTable(  {
        "aProcessing":true, 
        "aServerSide":true,
        "language": {   
             "url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
           },
        
           "ajax":{
            "url": " "+base_url+"/Usuarios/getUsuarios",
            "dataSrc":""
              },
        
                "columns": [
                    {"data":"idUsuario"},
                    {"data":"nombres"},
                    {"data":"apellidos"},
                    {"data":"email"},
                    {"data":"telefono"},
                    {"data":"nombreRol"},
                    {"data":"status"},
                    {"data":"options"}
                   
                  ],
                    'dom': 'lBfrtip',
                    'buttons': [
                        {
                            "extend": "copyHtml5",
                            "text": "<i class='far-copy'></i> Copiar",
                            "titleAttr": "Copiar",
                            "className": "btn btn-secondary"
                        }, {
                             "extend": "excelHtml5",
                            "text": "<i class='fas fa-file-excel'></i> Excel",
                            "titleAttr": "Exportar a Excel",
                            "className": "btn btn-success"
                        }, {
                         "extend": "pdfHtml5",
                            "text": "<i class='fas fa-file-pdf'></i> PDF",
                            "titleAttr": "Exportar a PDF",
                            "className": "btn btn-danger"
                        }, {
                        "extend": "csvHtml5",
                            "text": "<i class='fas fa-file-csv'></i> CSV",
                            "titleAttr": "Exportar a CSV",
                            "className": "btn btn-info"
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
    var formUsuario=document.querySelector("#formUsuario");
    formUsuario.onsubmit=function(e){
        e.preventDefault();
        let strIdentificacion = document.querySelector('#txtIdentificacion').value;
        let strNombre = document.querySelector('#txtNombre').value;
        let strApellido = document.querySelector('#txtApellido').value;
        let strEmail = document.querySelector('#txtEmail').value;
        let intTelefono = document.querySelector('#txtTelefono').value;
        let intTipousuario = document.querySelector('#listRolid').value;
        let intNacionalidad = document.querySelector('#listNacionalidad').value;
        let intGenero = document.querySelector('#listGenero').value;
        let intEstadoC = document.querySelector('#listEstadoC').value;
        let strFechaN = document.querySelector('#fechaNacimiento').value;
        let strPassword = document.querySelector('#txtPassword').value;
        let intStatus = document.querySelector('#listStatus').value;

        if(strIdentificacion == '' || strApellido == '' || strNombre == '' || strEmail == '' || intTelefono == '' || intTipousuario == '' || intNacionalidad == ''|| intGenero == '' )
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
        
            
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Usuarios/setUsuario'; 
        let formData = new FormData(formUsuario);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){ 
            if(request.readyState == 4 && request.status == 200){
                console.log(request.responseText);
                let objData = JSON.parse(request.responseText); 
                
                if(objData.status)
                { 
                    $('#modalFormUsuario').modal("hide");
                        formUsuario.reset();
                        swal.fire("Usuarios", objData.msg ,"success");
                    tableUsuarios.api().ajax.reload(
                    );
                    }else{
                        swal.fire("Error", objData.msg , "error");
                }
            
            }else{
                console.log('Error');
            }
        }
    }
},false)

//Cargar las clases desde el load
window.addEventListener('load', function() {
    fntRolesUsuario();
     fntNacionalidadUsuario();
     fntGeneroUsuario();
     fnEstadoCUsuario();
     fnSucursalUsuario();
}, false);
//Funcion para traer los roles de usuario
function fntRolesUsuario(){
  
        let ajaxUrl = base_url+'/Roles/getSelectRoles';
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#listRolid').innerHTML = request.responseText;
                document.querySelector('#listRolid').value=1;
                $('#listRolid').selectpicker('render');
            }
        }
    
}

//Funcion para traer la nacionalidad 
function fntNacionalidadUsuario(){
  
    let ajaxUrl = base_url+'/Roles/getSelectNacionalidad';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            document.querySelector('#listNacionalidad').innerHTML = request.responseText;
            document.querySelector('#listNacionalidad').value=1;
            $('#listNacionalidad').selectpicker('render');
        }
    }

}
//Funcion para traer el genero
function fntGeneroUsuario(){
  
    let ajaxUrl = base_url+'/Roles/getSelectGenero';
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
function fnEstadoCUsuario(){
  
    let ajaxUrl = base_url+'/Roles/getSelectEstadoC';
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

//Funcion para traer Las sucursales
function fnSucursalUsuario(){
  
    let ajaxUrl = base_url+'/Roles/getSelectSucursal';
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


function fntViewUsuario(idpersona){
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Usuarios/getUsuario/'+idpersona;
    request.open("GET",ajaxUrl,true);
    request.send();
    $('#modalViewUser').modal('show');
     request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
               let estadoUsuario = objData.data.status == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#celIdentificacion").innerHTML = objData.data.dni;
                document.querySelector("#celNombre").innerHTML = objData.data.nombres;
                document.querySelector("#celApellido").innerHTML = objData.data.apellidos;
                document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
                document.querySelector("#celEmail").innerHTML = objData.data.email;
                document.querySelector("#celTipoUsuario").innerHTML = objData.data.nombreRol;
                document.querySelector("#celNacionalidad").innerHTML = objData.data.nacionalidad;
                document.querySelector("#celGenero").innerHTML = objData.data.genero;
                document.querySelector("#celSucursal").innerHTML = objData.data.sucursal;
                document.querySelector("#celNacimiento").innerHTML = objData.data.fechaNacimiento;
                document.querySelector("#celEstadoC").innerHTML = objData.data.estadocivil;
                document.querySelector("#celEstado").innerHTML = estadoUsuario;
                document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro; 
                $('#modalViewUser').modal('show');
            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    } 
}
function fntEditUsuario(idUsuario){
    document.querySelector('#titleModal').innerHTML ="Actualizar Usuario";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-success", "btn-warning");
    document.querySelector('#btnText').innerHTML ="Actualizar";
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Usuarios/getUsuario/'+idUsuario;
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
                document.querySelector("#listRolid").value =objData.data.Id_Rol;
                document.querySelector("#listSucursal").value =objData.data.idsucursal;
                document.querySelector("#listNacionalidad").value =objData.data.idNacionalidad;
                document.querySelector("#listGenero").value =objData.data.idGenero;
                document.querySelector("#listEstadoC").value =objData.data.idEstado;
                document.querySelector("#fechaNacimiento").value=objData.data.fechaNaci;
               
                $('#listRolid').selectpicker('render');
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
        $('#modalFormUsuario').modal('show');
    } 
}

function fntDelUsuario(idUsuario){
  var idUsuario = idUsuario;
    swal.fire({
        title: "Eliminar Usuario",
        text: "¿Realmente quiere eliminar el Usuario?",
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
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Usuarios/delUsuario/';
            var strData = "idUsuario=" + idUsuario;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var objData = JSON.parse(request.responseText);
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
                        tableUsuarios.api().ajax.reload();
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
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    document.querySelector("#formUsuario").reset();
    $('#modalFormUsuario').modal('show');
}