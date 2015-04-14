function limpiar()
{
	document.form.reset();
}

function eliminar(url)
{
	if (confirm("realmente desea eliminar este registro ?"))
	{
		window.location=url;
	}
}
function volver(url)
{
	
	
		window.location=url;
	
}
//**********ajax****************
function obtiene_http_request()
{
var req = false;
try
  {
    req = new XMLHttpRequest(); /* p.e. Firefox */
  }
catch(err1)
  {
  try
    {
     req = new ActiveXObject("Msxml2.XMLHTTP");
  /* algunas versiones IE */
    }
  catch(err2)
    {
    try
      {
       req = new ActiveXObject("Microsoft.XMLHTTP");
  /* algunas versiones IE */
      }
      catch(err3)
        {
         req = false;
        }
    }
  }
return req;
}
var miPeticion = obtiene_http_request();



function from(id,ide,url)
{
		//para que no guarde la página en el caché...
		var mi_aleatorio=parseInt(Math.random()*99999999);
		//creo la URL dinámica
		var vinculo=url+"?id="+id+"&rand="+mi_aleatorio;
		//alert(vinculo);
		//ponemos true para que la petición sea asincrónica
		miPeticion.open("GET",vinculo,true);
		
		
		//ahora procesamos la información enviada
		miPeticion.onreadystatechange=miPeticion.onreadystatechange=
            function()
            {
               //alert("ready_State="+miPeticion.readyState);
               if (miPeticion.readyState==4)
               {
				   //alert(miPeticion.readyState);
                       //alert("status ="+miPeticion.status);
                       if (miPeticion.status==200)
                       {
                                //alert(miPeticion.status);
                               //var http=miPeticion.responseXML;
                               //alert("http="+http);
                               var http=miPeticion.responseText;
                               document.getElementById(ide).innerHTML= http;

                       }
               }
               
       }
       miPeticion.send(null);

}
/********************************************/
function from_post(id,ide,url)
{
        //para que no guarde la página en el caché...
		var mi_aleatorio=parseInt(Math.random()*99999999);
		//creo la URL dinámica
		var vinculo=url+"?rand="+mi_aleatorio+"&id="+id;
		//alert(vinculo);
		//ponemos true para que la petición sea asincrónica
		miPeticion.open("POST",vinculo,true);
		miPeticion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		miPeticion.send(vinculo);
		
		
		//ahora procesamos la información enviada
		miPeticion.onreadystatechange=miPeticion.onreadystatechange=function(){
               //alert("ready_State="+miPeticion.readyState);
               if (miPeticion.readyState==4)
               {
				   //alert(miPeticion.readyState);
                       //alert("status ="+miPeticion.status);
                       if (miPeticion.status==200)
                       {
                                //alert(miPeticion.status);
                               //var http=miPeticion.responseXML;
                               //alert("http="+http);
                               var http=miPeticion.responseText;
                               document.getElementById(ide).innerHTML= http;

                       }
               }
               
       }
       miPeticion.send(null);
	
}
