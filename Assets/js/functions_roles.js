var tableRoles;

document.addEventListener('DOMContentLoaded',function(){

 tableRoles = $('#TableRoles').DataTable(  {
"aProcessing":true, 
"aServerSide":true,
"language": {   
     "url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
   },

   "ajax":{
    "url": " "+base_url+"/Roles/getRoles",
    "dataSrc":""
      },

        "columns": [
            { "data": "Id_Rol" },
            { "data": "nombreRol" },
            { "data": "descripcion" },
            { "data": "status" }
           
          ],
          
          "resonsieve":"true",
          "bDestroy":"true",
          "iDisplayLength": 10,
          "order":[[0,"desc"]]

          });
        });
          
function openModal(){
    $('#ModalFormRol').modal('show'); 
}