//Dark mode
let btnSwitch=document.querySelector('.switch');
btnSwitch.addEventListener('click',()=>{
    document.body.classList.toggle('dark-mode');
    //document.querySelector('#navegacion').classList.replace("navbar-white", "navbar-dark")
    $(".navbar-light").toggleClass("navbar-dark navbar-white")
    btnSwitch.classList.toggle('active');
    //Guardar en localStorage
    if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('dark','true')
    }else{
        localStorage.setItem('dark','false')
    }
});
//Saber el modo actual del switch
if (localStorage.getItem('dark')==='true') {
    document.body.classList.add('dark-mode');
    btnSwitch.classList.add('active');
    document.querySelector('#navegacion').classList.replace("navbar-white", "navbar-dark")
}else{
    document.body.classList.remove('dark-mode');
    btnSwitch.classList.remove('active');
    document.querySelector('#navegacion').classList.remove("navbar-dark")
    document.querySelector('#navegacion').classList.add("navbar-white")
}

//Nav bar collapse, guardar en locale Storage
let btnNav=document.querySelector('#nav-bar');
btnNav.addEventListener('click',()=>{
     document.body.classList.toggle('nav-Activa');
    
    if (document.body.classList.contains('nav-Activa')) {
        localStorage.setItem('barra','true')
    }else{
        localStorage.setItem('barra','false')
    }
});
//Saber el modo actual de la barra
if (localStorage.getItem('barra')==='true') {
    document.body.classList.add('sidebar-collapse');
    document.body.classList.add('nav-Activa');
}else{
    document.body.classList.remove('sidebar-collapse');
  
}

function controlTag(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true;
    else if (tecla==0||tecla==9) return true;
    patron =/[0-9\s]/;
    n = String.fromCharCode(tecla);
    return patron.test(n);
}

function testText(txtString){
    var stringText = new RegExp(/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/);
    if(stringText.test(txtString)){
        return true;
    }else{
        return false;
    }
}

function testEntero(intCant) {
    var intCantidad = new RegExp(/^([0-9])*$/);
    if (intCantidad.test(intCant)){
        return true;
    }else{
        return false;
    }
}

function fntEmailValidate(email) {
    var stringEmail = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
    if (stringEmail.test(email) == false){
        return false;
    }else{
        return true;
    }  
}
    
function fntValidText(){
    let validText = document.querySelectorAll(".validText");
    validText.forEach(function(validText) {
        validText.addEventListener('keyup', function (){
            let inputValue = this.value;
            if(!testText(inputValue)){
                this.classList.add('is-invalid');
               /*  this.classList.remove('is-valid'); */
            }else{
                this.classList.remove('is-invalid');
          /*       this.classList.add('is-valid'); */
                
            }
        });
    });
}

function fntValidNumber(){
    let validNumber = document.querySelectorAll(".validNumber");
    validNumber.forEach(function(validNumber) {
        validNumber.addEventListener('keyup', function (){
            let inputValue = this.value;
            if (!testEntero(inputValue)){
                this.classList.add('is-invalid');
            }else{
                this.classList.remove('is-invalid');
            
            }
        });
    });
}

function fntValidEmail(){
    let validEmail = document.querySelectorAll(".validEmail");
    validEmail.forEach(function(validEmail) {
        validEmail.addEventListener('keyup', function () {
            let inputValue = this.value;
            if (!fntEmailValidate(inputValue)){
                this.classList.add('is-invalid');
            }else {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
        });
    });
}
//Llamado de las Funciones
window.addEventListener('load', function() {
    fntValidText();
    fntValidEmail();
    fntValidNumber();
}, false);
