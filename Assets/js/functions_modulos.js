let tableModulos;
let rowTable = "";
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded',function(){

    tableModulos = $('#tableModulos').dataTable({
      "aProcessing": true,
      "aServerSide": true,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
      },
  
      "ajax": {
        "url": " " + base_url + "/Modulos/getModulos",
        "dataSrc": ""
      },
  
      "columns": [
        { "data": "COD_MODULO" },
        { "data": "NOMBRE" },
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
                    title:'Reporte de Modulos',
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
            //Creacion de un nuevo Modulo
            let formModulo = document.querySelector("#formModulo");
            formModulo.onsubmit = function(e){
              e.preventDefault();
  
               let intIdModulo = document.querySelector('#idModulo').value;
               let strNombre = document.querySelector('#txtNombreModulo').value;
               let strDescripcion = document.querySelector('#txtDescripcionModulo').value;
               let intStatus = document.querySelector('#listStatus').value;        
               if(strNombre == '' || strDescripcion == '' || intStatus == ''){
                  swal.fire("Atención", "Todos los campos son obligatorios." , "error");
                  return false;
               }
                  divLoading.style.display="flex";  
                  let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');;
                  let ajaxUrl = base_url+'/modulos/setModulo'; 
                  let formData = new FormData(formModulo);
                  request.open("POST",ajaxUrl,true);
                  request.send(formData);
                  request.onreadystatechange = function(){
                    if(request.readyState == 4 && request.status == 200){
                      console.log(request.responseText);
                      let objData = JSON.parse(request.responseText);
                      
                      console.log(objData.status);

                      if(objData.status){
                        if(rowTable ==""){
                          tableModulos.api().ajax.reload(function(){

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
                      $('#modalFormModulo').modal("hide");
                      formModulo.reset();
                      swal.fire("Módulos", objData.msg ,"success");
                      //toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
                      //tableModulos.api().ajax.reload(function(){ 
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
 
  /* function fntViewInfo(idModulo){
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Usuarios/getUsuario/'+idpersona;
    request.open("GET",ajaxUrl,true);
    request.send();
    $('#modalViewUser').modal('show');
     request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            console.log(objData);
            if(objData.status)
            {
              let CREADO_POR =
                objData.data.CREADO_POR == null
                  ? "Registro en Tienda"
                  : objData.data.CREADO_POR;
              let MODIFICADO_POR =
                objData.data.MODIFICADO_POR == null
                  ? "Sin Modificar"
                  : objData.data.MODIFICADO_POR;
               let estadoUsuario = objData.data.COD_STATUS == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#celIdentificacion").innerHTML = objData.data.DNI;
                document.querySelector("#celNombre").innerHTML = objData.data.NOMBRES;
                document.querySelector("#celApellido").innerHTML = objData.data.APELLIDOS;
                document.querySelector("#celTelefono").innerHTML = objData.data.TELEFONO;
                document.querySelector("#celEmail").innerHTML = objData.data.EMAIL;
                document.querySelector("#celTipoUsuario").innerHTML = objData.data.ROL;
                
                document.querySelector("#celGenero").innerHTML = objData.data.GENERO;
                document.querySelector("#celSucursal").innerHTML = objData.data.SUCURSAL;
                document.querySelector("#celEstado").innerHTML = estadoUsuario;
                document.querySelector("#celFechaRegistro").innerHTML = objData.data.FECHA_CREACION;
                document.querySelector("#celCreadoPor").innerHTML = objData.data.CREADO_POR;
                document.querySelector("#celDateModificado").innerHTML = objData.data.FECHA_MODIFICACION;
                document.querySelector("#celModPor").innerHTML = objData.data.MODIFICADO_POR; 
                document.querySelector("#celDateLogin").innerHTML = objData.data.DATE_LOGIN;  
                $('#modalViewUser').modal('show');
            }else{
                swal.fire("Error", objData.msg , "error");
            }
        }
    } 
} */


  function fntEditModulo(element, idModulo){
    rowTable = element.parentNode.parentNode.parentNode;
    /* console.log(rowTable); */
    document.querySelector('#titleModal').innerHTML ="Actualizar Módulo";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-success", "btn-warning");
    document.querySelector('#btnText').innerHTML ="Actualizar";
    
        /* let idModulo=idModulo; */
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl  =base_url+'/modulos/getModulo/'+idModulo;
        request.open("GET",ajaxUrl,true);
        request.send();
        console.log(request);
        request.onreadystatechange = function(){
          if(request.readyState == 4 && request.status == 200){
            
              let objData = JSON.parse(request.responseText);
              if(objData.status)
              {
                  document.querySelector("#idModulo").value = objData.data.COD_MODULO;
                  document.querySelector("#txtNombreModulo").value = objData.data.NOMBRE;
                  document.querySelector("#txtDescripcionModulo").value = objData.data.DESCRIPCION;
  
                  if(objData.data.COD_STATUS == 1)
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
                  $('#modalFormModulo').modal('show');
              }else{
                  swal("Error", objData.msg , "error");
              }
          }
      }
        $('#modalFormModulo').modal('show'); 
        
  
  }

  function fntDelModulo(idModulo){
    /* let idModulo = idModulo; */
    swal.fire({
        title: "Eliminar Módulo",
        text: "¿Realmente quiere eliminar el Módulo?",
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
                let ajaxUrl = base_url+'/Modulos/delModulo/';
                let strData = "idModulo="+idModulo;
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
                            tableModulos.api().ajax.reload(function(){
                                
                               
                            });
                } else{
                    swal.fire("Atención!", objData.msg , "error");
                }
        
                }
            }
        })
    };


function openModal()
{
    rowTable = "";
    document.querySelector('#idModulo').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-warning", "btn-success");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Módulo";
    document.querySelector("#formModulo").reset();
    $('#modalFormModulo').modal('show');
}

window.addEventListener('load', function() {
    /*fntEditRol()
    fntDelRol();*/
    //fntPermisos();
}, false);