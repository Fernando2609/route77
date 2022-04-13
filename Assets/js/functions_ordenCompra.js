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
           //console.log(objData);
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

  let precio;
  let cantidad;
  let precioTotal;
  //Calcular cantidad del producto antes de agregar
  $("#txtCantidad").keyup(function(e){
    e.preventDefault();
     cantidad = $(this).val();
    precioTotal = precio * cantidad;
    if (isNaN(precioTotal)) {
        document.querySelector("#txtPrecioTotal").innerHTML = "0.00";
    }else{

      document.querySelector("#txtPrecioTotal").innerHTML = precioTotal;
    }
    if($(this).val()<1 || isNaN($(this).val())){
      document.querySelector("#add_product_Compra").classList.add("notBlock");

    }else{
    document.querySelector("#add_product_Compra").classList.remove("notBlock");

    }
     
    
    //$("#txtPrecioTotal").html(precioTotal);
  })
   $("#txtPrecio").keyup(function (e) {
      precio = $(this).val();
      precioTotal=precio*cantidad
     if (isNaN(precioTotal)) {
       document.querySelector("#txtPrecioTotal").innerHTML = "0.00";
     } else {
       document.querySelector("#txtPrecioTotal").innerHTML = precioTotal;
     }
     if($(this).val()<1 || isNaN($(this).val())){
      document.querySelector("#add_product_Compra").classList.add("notBlock");

    }else{
    document.querySelector("#add_product_Compra").classList.remove("notBlock");

    }
   });
  $("#add_product_Compra").click(function (e) {
    e.preventDefault;
    if ($("#txtCantidad").val()>0) {

      let COD_PRODUCTO = $("#idProducto").val();
       let cantidad = $("#txtCantidad").val();
        let precio = $("#txtPrecio").val();
         let precioTotal = $("#txtPrecioTotal").html();


      let request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      let ajaxUrl = base_url + "/OrdenCompra/detalleCompra";
       let formData = new FormData();
       formData.append("idProducto", COD_PRODUCTO);
       formData.append("txtCantidad", cantidad);
       formData.append("txtPrecio", precio);
       formData.append("txtPrecioTotal", precioTotal);

      request.open("POST", ajaxUrl, true);
      request.send(formData);
      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          let objData = JSON.parse(request.responseText);
          
          if (objData.status) {
            

            document.querySelector("#tablaCompra").innerHTML =objData.htmlCompras;
            //document.querySelector("#detalle_venta").innerHTML=objData.data.detalle;
            document.querySelector("#detalle_totales").innerHTML=objData.htmlTotales;


             document.querySelector("#idProducto").value = "";
             document.querySelector("#nombre").innerHTML = "-";
             document.querySelector("#txtCategoria").innerHTML = "-";
             document.querySelector("#txtPrecioTotal").innerHTML = "-";
             document.querySelector("#txtCantidad").value = "0";
             document.querySelector("#txtPrecio").value = "0";
             $("#txtCantidad").attr("disabled", "disabled");
             $("#txtPrecio").attr("disabled", "disabled");
             document
               .querySelector("#add_product_Compra")
               .classList.add("notBlock");


           /*  document.querySelector("#nombre").innerHTML = objData.data.NOMBRE;
            document.querySelector("#txtCategoria").innerHTML =
              objData.data.CATEGORÍA;
            $("#txtCantidad").removeAttr("disabled");
            $("#txtPrecio").removeAttr("disabled");
            document
              .querySelector("#add_product_Compra")
              .classList.remove("notBlock"); */
          } else {
            console.log('error');
            /* document.querySelector("#nombre").innerHTML = "-";
            document.querySelector("#txtCategoria").innerHTML = "-";
            $("#txtCantidad").attr("disabled", "disabled");
            $("#txtPrecio").attr("disabled", "disabled");
            document
              .querySelector("#add_product_Compra")
              .classList.add("notBlock"); */
          }
        }
      }; 
    }

  });

});

function del_product_detalle(id) {

 

  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = base_url + "/OrdenCompra/delCompra";
   let formData = new FormData();
   formData.append("idProducto", id);
   

  request.open("POST", ajaxUrl, true);
  request.send(formData);
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);
      console.log(objData);
      if (objData.status) {
        document.querySelector("#tablaCompra").innerHTML = objData.htmlCompras;
        //document.querySelector("#detalle_venta").innerHTML=objData.data.detalle;
        document.querySelector("#detalle_totales").innerHTML =
          objData.htmlTotales;
      } else {
        /* console.log("error"); */
      }
    }
  };
}