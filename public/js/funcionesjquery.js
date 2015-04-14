$(document).ready(function(){
		$(function() {
			$( "#datepicker" ).datepicker({ altFormat: "yy-mm-dd" });
			$( ".fechajquery" ).datepicker({ altFormat: "yy-mm-dd" });
			
		});
		
		
		
		$("#rete1").on("change", function()
				{  
					var idf = $("#rete1").val();
					$.post("controller/mbusretController.php",{idf:idf},function(data){   $("#retenc1").attr('value', data);    });
					        	
				 })
				   
		setInterval("mueveReloj('contenedor_reloj')",1000);
		
		$( "#dialog" ).dialog(
		   { autoOpen: false,
		    modal:true, 
		    width:350,
			height:300,
			buttons:{
				grabar: function(){
						$('form').submit();	  
								  },
				cerrar: function(){
						$(this).dialog("close");		  
								  }	
					}
			
			});
			$( "#dialog2" ).dialog(
				 { autoOpen: false,
		    modal:true, 
		    width:500,
			height:600,
			buttons:{
				
				cerrar: function(){
						$(this).dialog("close");		  
								  }	
					}
			
			});
		
//**************************llenar tabla en crearecajas***************************************************************	
	 $("#add").click(function() {

	 /* Opción 1 */
	 var n = $('tr:last td', $("#mitabla")).length;

	 var tds = '<tr>';
     //for(var i = 0; i < n; i++){
     
     	 tds += '<td><input type="text" name="cuen[]" class="span2"/></td>';
     	 tds += '<td><input type="text" name="conc[]" class="span3"/></td>';
     	 tds += '<td><input type="text" name="ncheque[]" class="span2"/></td>';
     	 tds += '<td><input type="text" name="banc[]" class="span2"/></td>';
     	 tds += '<td><input type="text" name="valo[]" class="unitario" onblur="calcular_total()"/></td>';
         
    // }
     tds += '</tr>';

     $("#mitabla").append(tds); 	 
     });
     
     
     
     
})
function buscarcliente(identi) {
	//alert('hola'+identi);
	if(identi)
	 { 
		 	$.ajax({
		  	type: 'POST',
		  	url: 'controller/buscarclienteController.php',
		  	data: {
		  			iden:identi	
		  		  }
		  }).done(function(respuesta){
		  	$('#mensaje').text(respuesta);
		  });
	} else
		{
			$('#mensaje').text('');
		}
}
function bucaregreso(identi) {
	if(identi)
	 { 
		 	$.ajax({
		  	type: 'POST',
		  	url: 'controller/buscaregresoController.php',
		  	data: {
		  			negreso:identi	
		  		  }
		  }).done(function(respuesta){
		  	$('#vista').html(respuesta);
		  });
	} else
		{
			$('#vista').html('');
		}
}
function buscaropago(identi) {
	//alert('hola'+identi);
	if(identi)
	 { 
		 	$.ajax({
		  	type: 'POST',
		  	url: 'controller/buscaropagoController.php',
		  	data: {
		  			iden:identi	
		  		  }
		  }).done(function(respuesta){
		  	$('#mensaje').text(respuesta);
		  });
	} else
		{
			$('#mensaje').text('');
		}
}

function eliminar_egreso(ide,ido)
{
	if (confirm("Confirma Eliminar Este Egreso ?"))
	{
		$.ajax({
		  	type: 'POST',
		  	url: 'controller/ajax_eliminar_egresoController.php',
		  	data: {
		  			id_egre:ide, id_opa:ido	
		  		  }
		  }).done(function(respuesta){
		  	volver('?accion=eliminar_egreso');
		  	
		  });
	}
}

function buscarrecaja(identi) {
	//alert('hola'+identi);
	if(identi)
	 { 
		 	$.ajax({
		  	type: 'POST',
		  	url: 'controller/buscarrecajaController.php',
		  	data: {
		  			num:identi	
		  		  }
		  }).done(function(respuesta){
		  	$('#mensaje').text(respuesta);
		  });
	} else
		{
			$('#mensaje').text('');
		}
}

function tipoajuste(tipo) {
	if(tipo==1) 
	{$('#detas').text("AJUSTE POR INGRESO POR CONCEPTO DE");
	}else{
		if(tipo==2) 
		$('#detas').text("AJUSTE POR EGRESO POR CONCEPTO DE");
	}
 
}

function llenardetacon(dato) {
	//alert('hola'+identi);
  $.ajax({
  	type: 'POST',
  	url: 'controller/llenardatoController.php',
  	data: {
  			dato:dato	
  		  }
  }).done(function(respuesta){
  	 $("#detacon").attr('value', respuesta);
  });
}

function repor_egre_exe(fe1,fe2) {
	
  $.ajax({
  	type: 'POST',
  	url: 'controller/ajax_llama_report_egrexelController.php',
  	data: {
  			feini:fe1, fefin: fe2	
  		  }
  }).done(function(respuesta){
  	 $("#repomostrar").html(respuesta);
  	 
  });
}

function buscar_saldo(id) {
	
  $.ajax({
  	type: 'POST',
  	url: 'controller/ajax_buscar_saldoController.php',
  	data: {
  			id:id
  		  }
  }).done(function(respuesta){
  	 $("#saldo").attr('value', respuesta);
  	 
  });
}

function repor_libro_ban(fe1,fe2,id) {
  $.ajax({
  	type: 'POST',
  	url: 'controller/ajax_libro_banController.php',
  	data: {
  			id:id, feini:fe1, fefin:fe2
  		  }
  }).done(function(respuesta){
  	 $("#reporte_lib").html(respuesta);
  	 
  });
}
function reten_proveedor(fe1,fe2,id) {
  $.ajax({
  	type: 'POST',
  	url: 'controller/ajax_reten_proveedorController.php',
  	data: {
  			id:id, feini:fe1, fefin:fe2
  		  }
  }).done(function(respuesta){
  	 $("#reporte_lib").html(respuesta);
  	 
  });
}

function ingresos_recajas(fe1) {
  $.ajax({
  	type: 'POST',
  	url: 'controller/ajax_ingresos_recajaController.php',
  	data: {
  			fec:fe1
  		  }
  }).done(function(respuesta){
  	 $("#buscar").html(respuesta);
  	 
  });
}

function repor_ingreso(fe1,fe2) {
  $.ajax({
  	type: 'POST',
  	url: 'controller/ajax_reporte_ingresoController.php',
  	data: {
  			feini:fe1, fefin:fe2
  		  }
  }).done(function(respuesta){
  	 $("#reporte_lib").html(respuesta);
  	 
  });
}

function repor_recajas(fe1,fe2) {
  $.ajax({
  	type: 'POST',
  	url: 'controller/ajax_reporte_recajasController.php',
  	data: {
  			feini:fe1, fefin:fe2
  		  }
  }).done(function(respuesta){
  	 $("#reporte_lib").html(respuesta);
  	 
  });
}


function calcular_total() { //es de crear recajas calcular suma de inputs
	total = 0
	$(".unitario").each(
		function(index, value) {
			total = total + eval($(this).val());//La función eval ejecuta la instrucción que se le pasa por parámetro
		}
	);
	$("#total").val(total);
}

/*
 la funcion eval se utiliza para transformar una cadena de caracteres a un expresión 
 aritmética , la cual es evaluada.
 ejemplo:
 var cadena="3+4";
 var numero=eval(cadena);
 La respuesta que se asigna a numero sera 7
*/

function crear (v) {
  document.form.reset();
   $( "#dialog" ).dialog( "open" );
	document.form.ideta.value=v;
}		   

function crear2 (v) {
  document.form2.reset();
   $( "#dialog2" ).dialog( "open" );
	document.form2.ideta.value=v;
}	

function mueveReloj(ide){
    momentoActual = new Date()
    hora = momentoActual.getHours()
    minuto = momentoActual.getMinutes()
    segundo = momentoActual.getSeconds()

    horaImprimible = hora + " : " + minuto + " : " + segundo
	if (hora<13) 
	{meri="a.m.";
	}else
		{
			hora=hora - 12
			meri="p.m.";
		};
    document.getElementById(ide).innerHTML='Hora : ' +  horaImprimible+' '+meri
    //window.setTimeout("mueveReloj(ide)", 1000);
   //setInterval("mueveReloj('contenedor_reloj')",1000)
   // setTimeout("mueveReloj('contenedor_relo')",1000)
} 

function volver(url)
{
	
	window.location=url;
	
	
}

function eliminar(id,idd,t,rete,ide,url)
{
	if (confirm("realmente desea eliminar este registro ?"))
	{
		eliminar_deta_op(id,idd,t,rete,ide,url);
	}
}


function calcular()
{
	var f=document.form
	if( f.ret.value>0)
	{
		f.total.value=(f.base.value*(f.ret.value/100)).toFixed(2);
	}
}

function calcular_form()
{
	var f=document.form2
	m16 =parseFloat(f.m16.value);
	iva16=parseFloat(f.iva16.value);
	m5=parseFloat(f.m5.value);
	iva5=parseFloat(f.iva5.value);
	mno=parseFloat(f.mno.value);		
	vconc=parseFloat(f.vconc.value);
	//f.tota.value=(f.m16.value + f.iva16.value + f.m5.value+ f.iva5.value+ f.mno.value).toFixed(2);
	f.tota.value=(m16 + iva16 + m5 + iva5 + mno + vconc).toFixed(2);
	if(m16 > 0)
	 {
	 	mer16="Merc. Gravada 16% "+dar_formato(f.m16.value,2,",",".");
	 }else
	 {
	 	mer16="";
	 }
	if(iva16 > 0) 
	 { 
	 	iv16=" iva 16% "+dar_formato(f.iva16.value,2,",",".");
	 }else
	 {
	 	iv16="";
	 }
	if(m5 > 0)
	  {
	  	 mer5=" Mercancia Gravada 5% "+dar_formato(f.m5.value,2,",",".");
	 }else
	 {
	 	mer5="";
	 }
	 if(iva5 > 0 )
	 { 
	 	iv5=" Iva 5% "+dar_formato(f.iva5.value,2,",",".");
	 }else
	 {
	 	iv5="";
	 }
	 if(mno > 0)
	 { 
	 	mn=" Mercancia no Gravada "+dar_formato(f.mno.value,2,",",".");
	 }else
	 {
	 	mn="";
	 }
	  if(vconc > 0)
	 { 
	 	vconc=" Mercancia en Concesion "+dar_formato(f.vconc.value,2,",",".");
	 }else
	 {
	 	vconc="";
	 }
	document.getElementById('letra').innerHTML =Numero_ALetras(f.tota.value);
	f.conc.value="Ventas de Contado Servitienda No xxx Acta de Arqueo "+f.acta.value+" "+
	f.fecd.value+" asi: "+(mer16)+iv16+mer5+iv5+mn+vconc;
		 
}

function dar_formato(numero, decimales, separador_decimal, separador_miles){ // v2007-08-06
    numero=parseFloat(numero);
    if(isNaN(numero)){
        return "";
    }

    if(decimales!==undefined){
        // Redondeamos
        numero=numero.toFixed(decimales);
    }

    // Convertimos el punto en separador_decimal
    numero=numero.toString().replace(".", separador_decimal!==undefined ? separador_decimal : ",");

    if(separador_miles){
        // Añadimos los separadores de miles
        var miles=new RegExp("(-?[0-9]+)([0-9]{3})");
        while(miles.test(numero)) {
            numero=numero.replace(miles, "$1" + separador_miles + "$2");
        }
    }

    return numero;
}


function Numero_ALetras(num){
  var data = {
    numero: num,
    enteros: Math.floor(num),
    centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
    letrasCentavos: "",
    letrasMonedaPlural: "PESOS",
    letrasMonedaSingular: "PESO"
  };

  if (data.centavos > 0)
    data.letrasCentavos = "CON " + data.centavos + "/100";

  if(data.enteros == 0)
    return "CERO " + data.letrasMonedaPlural + " " + data.letrasCentavos;
  if (data.enteros == 1)
    return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
  else
    return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos;
}//NumeroALetras()
function Unidades(num){

  switch(num)
  {
    case 1: return "UN";
    case 2: return "DOS";
    case 3: return "TRES";
    case 4: return "CUATRO";
    case 5: return "CINCO";
    case 6: return "SEIS";
    case 7: return "SIETE";
    case 8: return "OCHO";
    case 9: return "NUEVE";
  }

  return "";
}

function Decenas(num){

  decena = Math.floor(num/10);
  unidad = num - (decena * 10);

  switch(decena)
  {
    case 1:   
      switch(unidad)
      {
        case 0: return "DIEZ";
        case 1: return "ONCE";
        case 2: return "DOCE";
        case 3: return "TRECE";
        case 4: return "CATORCE";
        case 5: return "QUINCE";
        default: return "DIECI" + Unidades(unidad);
      }
    case 2:
      switch(unidad)
      {
        case 0: return "VEINTE";
        default: return "VEINTI" + Unidades(unidad);
      }
    case 3: return DecenasY("TREINTA", unidad);
    case 4: return DecenasY("CUARENTA", unidad);
    case 5: return DecenasY("CINCUENTA", unidad);
    case 6: return DecenasY("SESENTA", unidad);
    case 7: return DecenasY("SETENTA", unidad);
    case 8: return DecenasY("OCHENTA", unidad);
    case 9: return DecenasY("NOVENTA", unidad);
    case 0: return Unidades(unidad);
  }
}//Unidades()

function DecenasY(strSin, numUnidades){
  if (numUnidades > 0)
    return strSin + " Y " + Unidades(numUnidades)

  return strSin;
}//DecenasY()

function Centenas(num){

  centenas = Math.floor(num / 100);
  decenas = num - (centenas * 100);

  switch(centenas)
  {
    case 1:
      if (decenas > 0)
        return "CIENTO " + Decenas(decenas);
      return "CIEN";
    case 2: return "DOSCIENTOS " + Decenas(decenas);
    case 3: return "TRESCIENTOS " + Decenas(decenas);
    case 4: return "CUATROCIENTOS " + Decenas(decenas);
    case 5: return "QUINIENTOS " + Decenas(decenas);
    case 6: return "SEISCIENTOS " + Decenas(decenas);
    case 7: return "SETECIENTOS " + Decenas(decenas);
    case 8: return "OCHOCIENTOS " + Decenas(decenas);
    case 9: return "NOVECIENTOS " + Decenas(decenas);
  }

  return Decenas(decenas);
}//Centenas()

function Seccion(num, divisor, strSingular, strPlural){
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)

  letras = "";

  if (cientos > 0)
    if (cientos > 1)
      letras = Centenas(cientos) + " " + strPlural;
    else
      letras = strSingular;

  if (resto > 0)
    letras += "";

  return letras;
}//Seccion()

function Miles(num){
  divisor = 1000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)

  strMiles = Seccion(num, divisor, "UN MIL", "MIL");
  strCentenas = Centenas(resto);

  if(strMiles == "")
    return strCentenas;

  return strMiles + " " + strCentenas;

  //return Seccion(num, divisor, "UN MIL", "MIL") + " " + Centenas(resto);
}//Miles()

function Millones(num){
  divisor = 1000000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)

  strMillones = Seccion(num, divisor, "UN MILLON", "MILLONES");
  strMiles = Miles(resto);

  if(strMillones == "")
    return strMiles;

  return strMillones + " " + strMiles;

  //return Seccion(num, divisor, "UN MILLON", "MILLONES") + " " + Miles(resto);
}//Millones()



/*function calculartotal()
{
	alert("hola");
	var re;
    var valor = 0
    $('form').find('.post').each(function(){
        re = $(this).val();
        valor += parseFloat(re)
    });
    $('#Total').val(valor.toFixed(2));
}
	*/


//**********ajax***********************************************************************************
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
/******************************************************/
function from_post_ori(id,ide,url)
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
/********************************************/
function from_post(id,ba,rete,tota,ret,ide,url)
{
        	document.getElementById(ide).innerHTML="Cargando...";
        //para que no guarde la página en el caché...
		var mi_aleatorio=parseInt(Math.random()*99999999);
		//creo la URL dinámica
		var vinculo=url+"?rand="+mi_aleatorio+"&id="+id+"&bas="+ba+"&rete="+rete+"&tota="+tota+"&porcret="+ret;
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
							   document.form.reset();
                       }
               }else
               {
					   //document.getElementById('resultados').style.display="block";
				   	//document.getElementById(ide).innerHTML="<img src='ima/loading.gif' title='cargando...' />";
				   	document.getElementById(ide).innerHTML="Cargando...";
               }
               
       }
       miPeticion.send(null);
	
}

function eliminar_deta_op(id,idd,t,rete,ide,url)
{
        //para que no guarde la página en el caché...
		var mi_aleatorio=parseInt(Math.random()*99999999);
		//creo la URL dinámica
		var vinculo=url+"?rand="+mi_aleatorio+"&id="+id+"&idd="+idd+"&tota="+t+"&rete="+rete;
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

function from_post_datos(id,ide,url)
{
        //para que no guarde la página en el caché...
		var mi_aleatorio=parseInt(Math.random()*99999999);
		//creo la URL dinámica
		var vinculo=url+"?rand="+mi_aleatorio+"&idc="+id;
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
//**************************************************************************************************************
function from_post_detaplan(id,ba,fec,vat,ide,url)
{
        	document.getElementById(ide).innerHTML="Cargando...";
        //para que no guarde la página en el caché...
		var mi_aleatorio=parseInt(Math.random()*99999999);
		//creo la URL dinámica
		var vinculo=url+"?rand="+mi_aleatorio+"&id="+id+"&ban="+ba+"&fe="+fec+"&va="+vat;
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
							   document.form.reset();
                       }
               }else
               {
					   //document.getElementById('resultados').style.display="block";
				   	//document.getElementById(ide).innerHTML="<img src='ima/loading.gif' title='cargando...' />";
				   	document.getElementById(ide).innerHTML="Cargando...";
               }
               
       }
       miPeticion.send(null);
	
}

function eliminarp(idd,id,va,ide,url)
{
	if (confirm("Realmente Desea Eliminar Este Registro ?"))
	{
		elim_deta_pla(idd,id,va,ide,url);
	}
}

function elim_deta_pla(idd,id,va,ide,url)
{
        //para que no guarde la página en el caché...
		var mi_aleatorio=parseInt(Math.random()*99999999);
		//creo la URL dinámica
		var vinculo=url+"?rand="+mi_aleatorio+"&idd="+idd+"&id="+id+"&va="+va;
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

