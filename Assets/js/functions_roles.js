let tableRoles;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");
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
      { "data": "COD_ROL" },
      { "data": "NOM_ROL" },
      { "data": "DESCRIPCION" },
      { "data": "status" },
      { "data": "options" }
           
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
                      columns: [ 0, 1, 2, 3],
                        modifier: {
                        }
                    }
              }, {
                  "extend": "excelHtml5",
                  "text": "<i class='fas fa-file-excel'></i> Excel",
                  "titleAttr": "Exportar a Excel",
                  "className": "btn btn-success mr-1 mb-2",
                  exportOptions: {
          
                      margin: [0, 20,20,20],
                      columns: [ 0, 1, 2, 3],
                        modifier: {
                        }
                    },
              }, {
                  "extend": "pdfHtml5",
                  "text": "<i class='fas fa-file-pdf'></i> PDF",
                  "titleAttr": "Exportar a PDF",
                  "className": "btn btn-danger mr-1 mb-2",
                  filename:'ROLES',
                  download:'open',
                  pageSize:'A4',
                  title:'Reporte de Roles',
                  customize: function ( doc ) {
                      doc.content[1].margin = [ 20, 40, 30, 20 ]
                      doc.content[0].margin = [ 0, 20, 0, 0 ]
                      doc.content[0].alignment = 'center'
                      doc.content[1].table.widths = [ '5%', '25%', '50%', '20%']
                      doc.content[1].table.body[0].forEach(function(h){
                        //h.alignment='left';  
                        h.fillColor = '#81ae39';
                        h.color='white';
                        h.fontSize=12;
                      })
                      let cols = [];
                        cols[0] = { 
                          image: imgB64                              , alignment: 'left', margin:[20,5,10,20],width:100 };
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
                        
                        /* let cols2 = [];
                        cols2[0] = {fontSize: 13,text:  , alignment: 'center', margin:[0,0,0,0] };
                        
                        let objfooter = {};
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
                      columns: [ 0, 1, 2, 3],
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
                      columns: [ 0, 1, 2, 3],
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
                      columns: [ 0, 1, 2, 3],
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
          //Creacion de un nuevo rol
          let formRol = document.querySelector("#formRol");
          formRol.onsubmit = function(e){
            e.preventDefault();

             let intIdRol = document.querySelector('#idRol').value;
             let strNombre = document.querySelector('#txtNombre').value;
             let strDescripcion = document.querySelector('#txtDescripcion').value;
             let intStatus = document.querySelector('#listStatus').value;        
             if(strNombre == '' || strDescripcion == '' || intStatus == ''){
                swal.fire("Atención", "Todos los campos son obligatorios." , "error");
                return false;
             }
                divLoading.style.display="flex";  
                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');;
                let ajaxUrl = base_url+'/Roles/setRol'; 
                let formData = new FormData(formRol);
                request.open("POST",ajaxUrl,true);
                request.send(formData);
                request.onreadystatechange = function(){
                  if(request.readyState == 4 && request.status == 200){
                    console.log(request.responseText);
                    let objData = JSON.parse(request.responseText);
                    
                    console.log(objData.status);

                    if(objData.status){
                      if(rowTable ==""){
                        tableRoles.api().ajax.reload(function(){
                          
                        });
                      }else{
                        htmlStatus = intStatus == 1 ? 
                            '<span class="badge badge-success">Activo</span>' : 
                            '<span class="badge badge-danger">Inactivo</span>';
                        rowTable.cells[1].textContent = strNombre;
                        rowTable.cells[2].textContent = strDescripcion;
                        rowTable.cells[3].innerHTML =  htmlStatus;
                        //rowTable.cells[3].textContent;
                        rowTable =="";
                      }

                    $('#ModalFormRol').modal("hide");
                    formRol.reset();
                    swal.fire("Roles de usuario", objData.msg ,"success");
                    //toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
                    //tableRoles.api().ajax.reload(function(){ 
                      /* fntEditRol();
                      fntDelRol();
                      fntPermisos(); */
                    //});

                    }else{
                      swal.fire("Error", objData.msg , "error");

                    }
                  }
                  divLoading.style.display = "none";
                  return false;
              }           
        }
});         
      


function openModal(){
    rowTable = "";
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


function fntEditRol(element, idrol){
  rowTable = element.parentNode.parentNode.parentNode;
  /* console.log(rowTable); */
  document.querySelector('#titleModal').innerHTML ="Actualizar Rol";
  document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
  document.querySelector('#btnActionForm').classList.replace("btn-success", "btn-warning");
  document.querySelector('#btnText').innerHTML ="Actualizar";
  
      /* let idrol=idrol; */
      let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
      let ajaxUrl  =base_url+'/Roles/getRol/'+idrol;
      request.open("GET",ajaxUrl,true);
      request.send();
      console.log(request);
      request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
          
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                document.querySelector("#idRol").value = objData.data.COD_ROL;
                document.querySelector("#txtNombre").value = objData.data.NOM_ROL;
                document.querySelector("#txtDescripcion").value = objData.data.DESCRIPCION;

                if(objData.data.COD_STATUS == 1)
                {
                    var optionSelect = '<option value="1" selected class="notBlock">Activo</option>';
                }else{
                    var optionSelect = '<option value="2" selected class="notBlock">Inactivo</option>';
                }
                let htmlSelect = `${optionSelect}
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
  /* let idrol = idrol; */
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
      let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Roles/delRol/';
            let strData = "idrol="+idrol;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
              let objData = JSON.parse(request.responseText);
  
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
                          
                          
                
                        });
            } else{
              swal.fire("Atención!", objData.msg , "error");
            }
    
          }
       }
    })
  };

function fntPermisos(idrol){
  /* let idrol = idrol; */
  let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
  let ajaxUrl = base_url+'/Permisos/getPermisosRol/'+idrol;
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
  let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
  let ajaxUrl = base_url+'/Permisos/setPermisos'; 
  let formElement = document.querySelector("#formPermisos");
  let formData = new FormData(formElement);
  request.open("POST",ajaxUrl,true);
  request.send(formData);

  request.onreadystatechange = function(){
      if(request.readyState == 4 && request.status == 200){
          let objData = JSON.parse(request.responseText);
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
