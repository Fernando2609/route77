


document.addEventListener('DOMContentLoaded', function() {

  let formulario=document.querySelector("form");  
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    editable:true,
    
    initialView: 'dayGridMonth',
    //selectable: true,
    locale:"es",
    headerToolbar:{
        left:"prev,next today",
        center:"title",
        right:"dayGridMonth,timeGridWeek,listWeek"
    },
  
   
    dateClick:function(info,jsEvent,view){
        $('#tituloEvento').html("Nuevo Evento "+ info.dateStr);
        $('#btnGuardar').prop("disabled",false);
        $('#btnModificar').prop("disabled",true);
        $('#btnEliminar').prop("disabled",true);
        document.querySelector("#formCaledario").reset();
        //document.getElementById('btnGuardar').style.visibility="visible";
        document.querySelector("#inicio").value = info.dateStr;
        document.querySelector("#end").value = info.dateStr;
        console.log(info);
        console.log(info.dateStr);
        $("#modalFormCalendar").modal("show");
    },


    events: 'http://localhost:8080/route77/Calendario/mostrarCalendario',
    
   eventClick:function(calEvent,jsEvent,view){
   
    $('#tituloEvento').html(calEvent.event.title);
       console.log(calEvent.event);
      
      
 
       $('#btnGuardar').prop("disabled",true);
        $('#btnModificar').prop("disabled",false);
        $('#btnEliminar').prop("disabled",false);
     /*   document.querySelector("#id").value = calEvent.event.id;
       document.querySelector("#title").value = calEvent.event.title;
       document.querySelector("#descripcion").value = calEvent.event.extendedProps.descripcion;
       document.querySelector("#start").value = calEvent.event.start;
       document.querySelector("#end").value = calEvent.event.end;
       document.querySelector("#color").value = calEvent.event.color; */
       inicio=calEvent.event.startStr;
       final=calEvent.event.endStr;
       $('#id').val(calEvent.event.id);
       $('#title').val(calEvent.event.title);
       $('#descripcion').val(calEvent.event.extendedProps.descripcion);
       $('#end').val(final);
       document.querySelector("#inicio").value = inicio;
       $('#color').val(calEvent.event.backgroundColor);
       $('#colorText').val(calEvent.event.textColor);
       $('#start').val(calEvent.event.start);
       $("#modalFormCalendar").modal("show");
       
       console.log(calEvent.event.textColor);
       console.log(calEvent.event.backgroundColor);
        
   },
   eventDrop:function(calEvent){
        inicio=calEvent.event.startStr;
        final=calEvent.event.endStr;
        $('#id').val(calEvent.event.id);
        $('#title').val(calEvent.event.title);
       $('#descripcion').val(calEvent.event.extendedProps.descripcion);
       $('#end').val(final);
       document.querySelector("#inicio").value = inicio;
       $('#color').val(calEvent.event.backgroundColor);
       $('#colorText').val(calEvent.event.textColor);
       $('#start').val(calEvent.event.start);
       updateEvento(calEvent.event.id);
   }
   
  });
  calendar.render();




  
  /* events: base_url+'/Calendario/mostrarCalendario';



  var formUsuario=document.querySelector("#formCaledario");
    formUsuario.onsubmit=function(e){
        
        let strtitle = document.querySelector('#title').value;
        let strDescripcion = document.querySelector('#descripcion').value;
        let strStart= document.querySelector('#start').value;
        let strEnd = document.querySelector('#end').value;
        

        if(strtitle == '' || strDescripcion == '' || strStart == '' || strEnd == '' )
            {
                swal.fire("Atención", "Todos los campos son obligatorios." , "error");
                return false;
        }

            

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Calendario/setCalendario'; 
        let formData = new FormData(formUsuario);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){ 
            if(request.readyState == 4 && request.status == 200){
                console.log(request.responseText);
                let objData = JSON.parse(request.responseText); 
                
                if(objData.status)
                { 
                    $('#modalFormCalendar').modal("hide");
                        formUsuario.reset();
                        swal.fire("Evento", objData.msg ,"success");
                   
                    }else{
                        swal.fire("Error", objData.msg , "error");
                }
            
            }else{
                console.log('Error');
            }
        } 
    }
     */

});
function openModal()
{
    $('#tituloEvento').html("Nuevo Evento ");
    $('#btnGuardar').prop("disabled",false);
    $('#btnModificar').prop("disabled",true);
    $('#btnEliminar').prop("disabled",true);
    document.querySelector("#formCaledario").reset();
    //document.getElementById('btnGuardar').style.visibility="visible";
    $('#modalFormCalendar').modal('show');
}
function agregarEvento(){
    var formUsuario=document.querySelector("#formCaledario");
    
        
        let strtitle = document.querySelector('#title').value;
        let strDescripcion = document.querySelector('#descripcion').value;
        let strStart= document.querySelector('#inicio').value;
        let strEnd = document.querySelector('#end').value;
        

        if(strtitle == '' || strDescripcion == '' || strStart == '' )
            {
                swal.fire("Atención", "Todos los campos son obligatorios." , "error");
                return false;
        }

            

         let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Calendario/setCalendario'; 
        let formData = new FormData(formUsuario);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){ 
            console.log(request);
            if(request.readyState == 4 && request.status == 200){
                console.log(request.responseText);
                let objData = JSON.parse(request.responseText); 
                
                if(objData.status)
                { 
                    $('#modalFormCalendar').modal("hide");
                        formUsuario.reset();
                        swal.fire({
                            title: "Evento",
                            text: objData.msg,
                            icon: "success",
                            showClass: {
                              popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                              popup: 'animate__animated animate__fadeOutUp'
                            },
                            showCancelButton: false,
                            confirmButtonText: "Aceptar",
                            //cancelButtonText: "No, cancelar!",
                            closeOnConfirm: false,
                            closeOnCancel: true,
                            allowOutsideClick: false
                        }).then((result) => {
                          if (result.isConfirmed) {  
                            location.reload();
                          }});
                      
                    }else{
                        swal.fire("Error", objData.msg , "error");
                }
            
            }else{
                console.log('Error');
            }
        }  
    
}
function updateEvento(idEvento) {


   
    var formUsuario=document.querySelector("#formCaledario");
    
        
        let strtitle = document.querySelector('#title').value;
        let strDescripcion = document.querySelector('#descripcion').value;
        let strStart= document.querySelector('#inicio').value;
        let strEnd = document.querySelector('#end').value;
        

        if(strtitle == '' || strDescripcion == '' || strStart == '' )
            {
                swal.fire("Atención", "Todos los campos son obligatorios." , "error");
                return false;
        }

            

         let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Calendario/updateCalendario/'+idEvento; 
        let formData = new FormData(formUsuario);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){ 
           /*  console.log(request); */
            if(request.readyState == 4 && request.status == 200){
                /* console.log(request.responseText); */
                let objData = JSON.parse(request.responseText); 
                
                if(objData.status)
                { 
                    $('#modalFormCalendar').modal("hide");
                        formUsuario.reset();
                        
                        
                        swal.fire({
                            title: "Evento",
                            text: objData.msg,
                            icon: "success",
                            showClass: {
                              popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                              popup: 'animate__animated animate__fadeOutUp'
                            },
                            showCancelButton: false,
                            confirmButtonText: "Aceptar",
                            //cancelButtonText: "No, cancelar!",
                            closeOnConfirm: false,
                            closeOnCancel: true,
                            allowOutsideClick: false
                        }).then((result) => {
                          if (result.isConfirmed) {  
                            location.reload();
                          }});
                      
                    }else{
                        swal.fire("Error", objData.msg , "error");
                }
            
            }/* else{
                console.log('Error');
            } */
        }  
}
function deleteEvento(idEvento) {


   
    var formUsuario=document.querySelector("#formCaledario");
    
        
        let strtitle = document.querySelector('#title').value;
        let strDescripcion = document.querySelector('#descripcion').value;
        let strStart= document.querySelector('#inicio').value;
        let strEnd = document.querySelector('#end').value;
        

        if(strtitle == '' || strDescripcion == '' || strStart == '' )
            {
                swal.fire("Atención", "Todos los campos son obligatorios." , "error");
                return false;
        }

            

         let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Calendario/delCalendario/'+idEvento; 
        let formData = new FormData(formUsuario);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){ 
            console.log(request);
            if(request.readyState == 4 && request.status == 200){
                console.log(request.responseText);
                let objData = JSON.parse(request.responseText); 
                
                if(objData.status)
                { 
                    $('#modalFormCalendar').modal("hide");
                        formUsuario.reset();
                        
                        
                        swal.fire({
                            title: "Evento",
                            text: objData.msg,
                            icon: "success",
                            showClass: {
                              popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                              popup: 'animate__animated animate__fadeOutUp'
                            },
                            showCancelButton: false,
                            confirmButtonText: "Aceptar",
                            //cancelButtonText: "No, cancelar!",
                            closeOnConfirm: false,
                            closeOnCancel: true,
                            allowOutsideClick: false
                        }).then((result) => {
                          if (result.isConfirmed) {  
                            location.reload();
                          }});
                      
                    }else{
                        swal.fire("Error", objData.msg , "error");
                }
            
            }else{
                console.log('Error');
            }
        }  
}
//Cargar las clases desde el load

