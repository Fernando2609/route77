/*
-----------------------------------------------------------------------
Universidad Nacional Autónoma de Honduras (UNAH)
    Facultad de Ciencias Economicas
Departamento de Informatica administrativa
     Analisis, Programacion y Evaluacion de Sistemas
                Segundo Periodo 2022


Equipo:
Jose Fernando Ortiz Santos .......... (jfortizs@unah.hn)
Hugo Alejandro Paz Izaguirre..........(hugo.paz@unah.hn)
Kevin Alfredo Rodríguez Zúniga........(karodriguezz@unah.hn)
Leonela Yasmin Pineda Barahona........(lypineda@unah)
Reynaldo Jafet Giron Tercero..........(reynaldo.giron@unah.hn)
Gabriela Giselh Maradiaga Amador......(ggmaradiaga@unah.hn)
Alejandrino Victor García Bustillo....(alejandrino.garcia@unah.hn)

Catedrático:
Lic. Karla Melisa Garcia Pineda 

---------------------------------------------------------------------

Programa:          Módulo Dashboard
Fecha:             12-Abril-2022
Programador:       Kevin Alfredo Rodríguez Zúniga
descripción:       Módulo que muestra las estadisticas de compras, pedidos 
                   tipo de pago , clientes y productos de la tienda

-----------------------------------------------------------------------*/
$('.date-picker').datepicker( {
    closeText: 'Cerrar',
	prevText: '<Ant',
	nextText: 'Sig>',
	currentText: 'Hoy',
	monthNames: ['1 -', '2 -', '3 -', '4 -', '5 -', '6 -', '7 -', '8 -', '9 -', '10 -', '11 -', '12 -'],
	monthNamesShort: ['Enero','Febrero','Marzo','Abril', 'Mayo','Junio','Julio','Agosto','Septiembre', 'Octubre','Noviembre','Diciembre'],
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: 'MM yy',
    showDays: true,
    onClose: function(dateText, inst) {
        $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
    }

});
function fntSearchPagos(){
    let fecha = document.querySelector(".pagoMes").value;
    if (fecha == ""){ 
        swal.fire("", "Seleccione mes y año" , "error");
        return false;
    }else{
        let request =(window.XMLHttpRequest) ?
        new  XMLHttpRequest() :
        new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Dashboard/tipoPagoMes';
        divLoading.style.display= "flex";
        let formData = new FormData();
        formData.append('fecha',fecha);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
            if(request.readyState != 4) return;
            if(request.status == 200){
 
                $("#pagosMesAnio").html(request.responseText);
                 divLoading.style.display= "none";
                return false;
            }
        }
    }
}
function fntSearchVmes(){
    let fecha = document.querySelector(".ventasMes").value;
    if (fecha == ""){ 
        swal.fire("", "Seleccione mes y año" , "error");
        return false;
    }else{
        let request =(window.XMLHttpRequest) ?
        new  XMLHttpRequest() :
        new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Dashboard/ventasMes';
        divLoading.style.display= "flex";
        let formData = new FormData();
        formData.append('fecha',fecha);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
            if(request.readyState != 4) return;
            if(request.status == 200){
 
                $("#graficaMes").html(request.responseText);
                 divLoading.style.display= "none";
                return false;
            }
        }
    }
}
function fntSearchVanio(){
    let anio = document.querySelector(".ventasAnio").value;
    if (anio == ""){ 
        swal.fire("", "Ingrese año" , "error");
        return false;
    }else{
        let request =(window.XMLHttpRequest) ?
        new  XMLHttpRequest() :
        new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = base_url+'/Dashboard/ventasAnio';
        divLoading.style.display= "flex";
        let formData = new FormData();
        formData.append('anio',anio);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
            if(request.readyState != 4) return;
            if(request.status == 200){
 
                $("#graficaAnio").html(request.responseText);
                 divLoading.style.display= "none";
                return false;
            }
        }
    }
}