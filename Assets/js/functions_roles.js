var tableRoles;

document.addEventListener('DOMContentLoaded',function(){

  tableRoles = $('#tableRoles').dataTable({
    "aProcessing": true,
    "aServerSide": true,
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },

    "ajax": {
      "url": " " + base_url + "/Roles/getRoles",
      "dataSrc": ""
    },

    "columns": [
      { "data": "Id_Rol" },
      { "data": "nombreRol" },
      { "data": "descripcion" },
      { "data": "status" },
      { "data": "options" }
           
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
          //Creacion de un nuevo rol
          var formRol = document.querySelector("#formRol");
          formRol.onsubmit = function(e){
            e.preventDefault();

             var intIdRol = document.querySelector('#idRol').value;
             var strNombre = document.querySelector('#txtNombre').value;
             var strDescripcion = document.querySelector('#txtDescripcion').value;
             var intStatus = document.querySelector('#listStatus').value;        
             if(strNombre == '' || strDescripcion == '' || intStatus == ''){
                swal.fire("Atención", "Todos los campos son obligatorios." , "error");
                return false;
             }
             var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = base_url+'/Roles/setRol'; 
                var formData = new FormData(formRol);
                request.open("POST",ajaxUrl,true);
                request.send(formData);
                request.onreadystatechange = function(){
                  if(request.readyState == 4 && request.status == 200){
                    console.log(request.responseText);
                    var objData = JSON.parse(request.responseText);
                    
                    console.log(objData.status);
                    if(objData.status){

                    $('#ModalFormRol').modal("hide");
                    formRol.reset();
                    swal.fire("Roles de usuario", objData.msg ,"success");
                    //toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
                    tableRoles.api().ajax.reload(function(){ 
                      fntEditRol();
                      fntEdelRol();
                      fntPermisos();
                    });
                    }else{
                      swal.fire("Error", objData.msg , "error");

                    }
                  }
              }           
        }
});         
      


function openModal(){
    document.querySelector('#idRol').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-warning", "btn-success");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Rol";
    document.querySelector("#formRol").reset();
    $('#ModalFormRol').modal('show');
};

window.addEventListener('load', function() {
  /*fntEditRol()
  fntDelRol();*/
  //fntPermisos();
}, false);


function fntEditRol(idrol){
  document.querySelector('#titleModal').innerHTML ="Actualizar Rol";
  document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
  document.querySelector('#btnActionForm').classList.replace("btn-success", "btn-warning");
  document.querySelector('#btnText').innerHTML ="Actualizar";
  
      var idrol=idrol;
      var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
      var ajaxUrl  =base_url+'/Roles/getRol/'+idrol;
      request.open("GET",ajaxUrl,true);
      request.send();
      console.log(request);
      request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
          
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                document.querySelector("#idRol").value = objData.data.Id_Rol;
                document.querySelector("#txtNombre").value = objData.data.nombreRol;
                document.querySelector("#txtDescripcion").value = objData.data.descripcion;

                if(objData.data.status == 1)
                {
                    var optionSelect = '<option value="1" selected class="notBlock">Activo</option>';
                }else{
                    var optionSelect = '<option value="2" selected class="notBlock">Inactivo</option>';
                }
                var htmlSelect = `${optionSelect}
                                  <option value="1">Activo</option>
                                  <option value="2">Inactivo</option>
                                `;
                document.querySelector("#listStatus").innerHTML = htmlSelect;
                $('#modalFormRol').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
      $('#ModalFormRol').modal('show'); 
      

}

function fntDelRol(idrol){
  var idrol = idrol;
  swal.fire({
      title: "Eliminar Rol",
      text: "¿Realmente quiere eliminar el Rol?",
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
            var ajaxUrl = base_url+'/Roles/delRol/';
            var strData = "idrol="+idrol;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
              var objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal.fire({ title:"Eliminar!", 
                        text: objData.msg,
                        icon:"success",
                        showClass: {
                          popup: 'animate__animated animate__flipInY'
                        },
                        hideClass: {
                          popup: 'animate__animated animate__flipOutY'
                        }});
                        tableRoles.api().ajax.reload(function(){
                          
                          fntEdelRol();
                          fntPermisos()
                        });
            } else{
              swal.fire("Atención!", objData.msg , "error");
            }
    
          }
       }
    })
  };

function fntPermisos(idrol){
  var idrol = idrol;
  var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
  var ajaxUrl = base_url+'/Permisos/getPermisosRol/'+idrol;
  request.open("GET",ajaxUrl,true);
  request.send();

  request.onreadystatechange = function(){
      if(request.readyState == 4 && request.status == 200){
          //console.log(request.responseText);
          document.querySelector('#contentAjax').innerHTML = request.responseText;
          $('.modalPermisos').modal('show');
          document.querySelector('#formPermisos').addEventListener('submit',fntSavePermisos,false);
      }
  }
};
function fntSavePermisos(evnet){
  evnet.preventDefault();
  var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
  var ajaxUrl = base_url+'/Permisos/setPermisos'; 
  var formElement = document.querySelector("#formPermisos");
  var formData = new FormData(formElement);
  request.open("POST",ajaxUrl,true);
  request.send(formData);

  request.onreadystatechange = function(){
      if(request.readyState == 4 && request.status == 200){
          var objData = JSON.parse(request.responseText);
          if(objData.status)
          {
            swal.fire({ title:"Permisos de Usuarios", 
            text: objData.msg,
            icon:"success",
            showClass: {
              popup: 'animate__animated animate__bounceInDown'
            },
            hideClass: {
              popup: 'animate__animated animate__bounceOutUp'
            }});
          }else{
              swal.fire("Error", objData.msg , "error");
          }
      }
  }
  
};
