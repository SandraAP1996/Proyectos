document.addEventListener("DOMContentLoaded", myFunction);
function myFunction(){

    document.getElementById("user").addEventListener("blur",comprobarBD);
    document.getElementById("email").addEventListener("blur",comprobarBD);
}

function comprobarBD(){
    console.log(""+this.id+"="+this.value);


    if(this.value != ""){
        var id=this.id;
        //GENERAR LA CONEXIÓN ASYNCRONA
        var httpRequest = obtainXMLHttpRequest();

        httpRequest.open("POST", "http://localhost/consultaBD.php", true); // Se abre la conexión
        httpRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        httpRequest.onreadystatechange = function() { // Se define la función manejadora del evento
            if (httpRequest.readyState==2){
                //document.body.innerHTML="NIVEL 2";
            }
            if (httpRequest.readyState==4) { // Si se ha completado
                // Se comprueba el estado de la petición
                if (httpRequest.status==200){ // el código 200 indica que la petición se ha respondido correctamente

                    var resultado=JSON.parse(httpRequest.responseText);
                    
                    if(id == "user"){
                        var img_error=document.getElementById("errorUser").children;
                    }else{
                        var img_error=document.getElementById("errorMail").children;

                    }

                    if(resultado.estado != "false"){
                        console.log("entra FALSE");
                        img_error[1].style.display="block";
                        img_error[2].style.display="block";
                        img_error[0].style.display="none";

                    }else{
                        img_error[0].style.display="block";
                        img_error[1].style.display="none";
                        img_error[2].style.display="none";

                    }
                }
            }
        }

        httpRequest.send("atributo="+this.id+"&valor="+this.value);

    }
}


function obtainXMLHttpRequest(){
    var httpRequest;
    if (window.XMLHttpRequest) //El explorador implementa la interfaz de forma nativa
        httpRequest = new XMLHttpRequest();
    else if (window.ActiveXObject) { //El explorador permite crear objetos ActiveX
        try {
            httpRequest = new ActiveXObject("MSXML2.XMLHTTP");
        } catch (e) {
            try {
                httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
        }
    }
    if (!httpRequest) // Si no se puede crear, devolvemos false. En caso contrario, devolvemos el objeto
        return false;
    else
        return httpRequest;
}