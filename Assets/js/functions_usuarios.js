var tableUsuarios;


document.addEventListener('DOMContentLoaded',function () {
    
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