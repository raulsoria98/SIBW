
function comentario()
{
    var comentarios = document.getElementById("comentarios");

    if(comentarios.style.display == "none")
        comentarios.style.display = "block";
    else
        comentarios.style.display = "none";
}

function validar()
{
    var formulario = document.getElementById("formulario");
    var elementos = formulario.elements;
    var valido = true;

    for(i = 0; i < elementos.length - 1; i++)
    {
        if(elementos[i].type == "text")
        {
            if(!elementos[i].value.length)
            {
                alert("Campo de texto " + elementos[i].name + " vacío");
                valido = false;
            }
        }
        else if(elementos[i].type == "email")
        {
            if(!elementos[i].value.length || elementos[i].checkValidity() == false)
            {
                alert("Introduzca una dirección de correo válida");
                valido = false;
            }
        }
        else if(elementos[i].id == "mensaje")
        {
            if(!elementos[i].value.length)
            {
                alert("Escriba un mensaje");
                valido = false;
            }
        }
    }

    return valido;
}

function censurarNombre()
{
    mensaje = document.getElementById("nombre").value
    var nueva = mensaje.replace(/joder/gi,"*****")
    document.getElementById("nombre").value = nueva

    mensaje = document.getElementById("nombre").value
    var nueva = mensaje.replace(/tonto/gi,"*****")
    document.getElementById("nombre").value = nueva

    mensaje = document.getElementById("nombre").value
    var nueva = mensaje.replace(/gilipollas/gi,"**********")
    document.getElementById("nombre").value = nueva

    mensaje = document.getElementById("nombre").value
    var nueva = mensaje.replace(/puta/gi,"****")
    document.getElementById("nombre").value = nueva

    mensaje = document.getElementById("nombre").value
    var nueva = mensaje.replace(/cabron/gi,"******")
    document.getElementById("nombre").value = nueva

    mensaje = document.getElementById("nombre").value
    var nueva = mensaje.replace(/imbecil/gi,"*******")
    document.getElementById("nombre").value = nueva

    mensaje = document.getElementById("nombre").value
    var nueva = mensaje.replace(/subnormal/gi,"*********")
    document.getElementById("nombre").value = nueva

    mensaje = document.getElementById("nombre").value
    var nueva = mensaje.replace(/nazi/gi,"****")
    document.getElementById("nombre").value = nueva

    mensaje = document.getElementById("nombre").value
    var nueva = mensaje.replace(/maricon/gi,"*******")
    document.getElementById("nombre").value = nueva

    mensaje = document.getElementById("nombre").value
    var nueva = mensaje.replace(/capullo/gi,"*******")
    document.getElementById("nombre").value = nueva
}

function censurarTexto()
{
    mensaje = document.getElementById("mensaje").value
    var nueva = mensaje.replace(/joder/gi,"*****")
    document.getElementById("mensaje").value = nueva

    mensaje = document.getElementById("mensaje").value
    var nueva = mensaje.replace(/tonto/gi,"*****")
    document.getElementById("mensaje").value = nueva

    mensaje = document.getElementById("mensaje").value
    var nueva = mensaje.replace(/gilipollas/gi,"**********")
    document.getElementById("mensaje").value = nueva

    mensaje = document.getElementById("mensaje").value
    var nueva = mensaje.replace(/puta/gi,"****")
    document.getElementById("mensaje").value = nueva

    mensaje = document.getElementById("mensaje").value
    var nueva = mensaje.replace(/cabron/gi,"******")
    document.getElementById("mensaje").value = nueva

    mensaje = document.getElementById("mensaje").value
    var nueva = mensaje.replace(/imbecil/gi,"*******")
    document.getElementById("mensaje").value = nueva

    mensaje = document.getElementById("mensaje").value
    var nueva = mensaje.replace(/subnormal/gi,"*********")
    document.getElementById("mensaje").value = nueva

    mensaje = document.getElementById("mensaje").value
    var nueva = mensaje.replace(/nazi/gi,"****")
    document.getElementById("mensaje").value = nueva

    mensaje = document.getElementById("mensaje").value
    var nueva = mensaje.replace(/maricon/gi,"*******")
    document.getElementById("mensaje").value = nueva

    mensaje = document.getElementById("mensaje").value
    var nueva = mensaje.replace(/capullo/gi,"*******")
    document.getElementById("mensaje").value = nueva
}

function new_mensaje()
{
    if(validar())
    {
        var mensaje = document.getElementById("mensaje");
        var nombre = document.getElementById("nombre");
        var email = document.getElementById("email");
        var comentarios = document.getElementById("old");
        var br = document.createElement("BR")
        var hr = document.createElement("HR")

        var div = document.createElement("DIV")
        div.classList.add("comentario")

        var nuevoMensaje = document.createElement("P");
        nuevoMensaje.classList.add("mensaje");
        var contenidoMensaje = document.createTextNode(mensaje.value)
        nuevoMensaje.appendChild(contenidoMensaje)
        
        var nuevoNombre = document.createElement("P");
        nuevoNombre.classList.add("nombre");
        var contenidoNombre = document.createTextNode(nombre.value)
        nuevoNombre.appendChild(contenidoNombre)

        var nuevaFecha = document.createElement("P");
        nuevaFecha.classList.add("fecha");
        var fecha = new Date()
        var contenidoFecha = fecha.toLocaleDateString() + ' ' + fecha.toLocaleTimeString();
        var contenidoFecha = document.createTextNode(contenidoFecha)
        nuevaFecha.appendChild(contenidoFecha)
        
        div.appendChild(hr)
        div.appendChild(br)
        div.appendChild(nuevoMensaje);
        div.appendChild(nuevoNombre)
        div.appendChild(nuevaFecha)
        comentarios.appendChild(div)

        comentarios.scroll(0,10000);
    }
}