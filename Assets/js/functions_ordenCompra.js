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
           console.log(objData);
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

})