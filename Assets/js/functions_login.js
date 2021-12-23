$('.login-content [data-toggle="flip"]').click(function() {
    $('.login-box').toggleClass('flipped');
    return false;
});

//Capturar los datos del formulario
//document.addEventListener: Índica que se van a agregar todos los eventos que irán dentro de la función al moemnto de cargar todo el documento
document.addEventListener('DOMContentLoaded', function(){
//valida si existe el formulario del login
    if (document.querySelector("#formLogin")){

        let formLogin = document.querySelector("#formLogin");
        formLogin.onsubmit = function(e) {
            e.preventDefault();

            let strEmail = document.querySelector('#txtEmail').value;
            let strPassword = document.querySelector('#txtPasssword').value;
        
            if(strEmail=="" || strPassword=="")
            {
                swal.fire("Por favor", "Escribe usuario y contraseña.", "error");
                return false;
            }else{
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = base_url+'/Login/LoginUser';
                var formData = new FormData(formLogin);
                request.open("POST", ajaxUrl, true);
                request.send(formData);

                console.log(request);
            }            
        }     
    }
}, false);
