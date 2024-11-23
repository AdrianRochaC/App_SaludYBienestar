const nombre=document.getElementById("name")
const apellido=document.getElementById("last_name")
const email=document.getElementById("username")
const opciones=document.getElementById("opciones")
const direction=document.getElementById("direction")
const telefono=document.getElementById("telefono")
const form=document.getElementById("form")
const parrafo=document.getElementById("warnings")

form.addEventListener("submit", e=>{
  e.preventDefault() // Evitar el envío del formulario
  let warnings=""
  let entrar=false
  let regexEmail=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/ // Validar el formato del correo electrónico
  parrafo.innerHTML=""
  if(nombre.value.length<3){ // Validar la longitud del nombre
    warnings += `El nombre no es válido <br><br>`
    entrar=true
  }
  if(apellido.value.length<3){ // Validar la longitud del apellido
    warnings += `El apellido no es válido <br><br>`
    entrar=true
  }
  if(!regexEmail.test(email.value)){ // Validar el formato del correo electrónico
    warnings += `El email no es válido <br><br>`
    entrar=true
  }
  if(opciones.value === "inicio"){ // Validar la selección de una opción
    warnings += `Seleccione una opción de pago válida <br><br>`
    entrar=true
  }
  if(direction.value.length<5){ // Validar la longitud de la dirección
    warnings += `La dirección no es válida <br><br>`
    entrar=true
  }
  if(!telefono.value.match(/[0-9\s\+\-]+/)){ // Validar el formato del número de teléfono
    warnings += `El número de teléfono no es válido <br><br>`
    entrar=true
  }
  if(entrar){
    parrafo.innerHTML=warnings
  }else{
    parrafo.innerHTML="Pago completado" // Mensaje de éxito
    setTimeout(()=>{ // Redirigir a login.html después de 2 segundos
      window.location.href="login.html"
    },2000)
  }
});