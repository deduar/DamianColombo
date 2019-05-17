

function validar04() {

	if (document.calform.email.value=="")
	{
		alert("Ingrese Email.");
		document.calform.email.focus();
		return false;
	}

	if (document.calform.nombre.value=="")
	{
		alert("Ingrese Nombre.");
		document.calform.nombre.focus();
		return false;
	}
	if (document.calform.telefono.value=="")
	{
		alert("Ingrese Telefono.");
		document.calform.telefono.focus();
		return false;
	}


	if (document.calform.pass.value=="")
	{
		alert("Ingrese Codigo.");
		document.calform.pass.focus();
		return false;
	}


	return true;

}

	function registracion() {

	if (document.calform.email.value=="")
	{
		alert("Ingrese Email.");
		document.calform.email.focus();
		return false;
	}
	if (document.calform.razon.value=="")
	{
		alert("Ingrese Raz&oacute;n Social");
		document.calform.razon.focus();
		return false;
	}
	if (document.calform.nombreFantasia.value=="")
	{
		alert("Ingrese Nombre de Fantasia");
		document.calform.nombreFantasia.focus();
		return false;
	}
	if (document.calform.nombre.value=="")
	{
		alert("Ingrese Nombre");
		document.calform.nombre.focus();
		return false;
	}	
	if (document.calform.direccion.value=="")
	{
		alert("Ingrese Direcci&oacute;n");
		document.calform.direccion.focus();
		return false;
	}			
	if (document.calform.localidad.value=="")
	{
		alert("Ingrese Localidad");
		document.calform.localidad.focus();
		return false;
	}

	if (document.calform.provincia.value=="")
	{
		alert("Ingrese Provincia");
		document.calform.provincia.focus();
		return false;
	}
	if (document.calform.codTelefono.value=="")
	{
		alert("Ingrese Cod. Area");
		document.calform.codTelefono.focus();
		return false;
	}
	if (document.calform.telefono.value=="")
	{
		alert("Ingrese Telefono.");
		document.calform.telefono.focus();
		return false;
	}	
	if (document.calform.codCelular.value=="")
	{
		alert("Ingrese Cod. Area Celular");
		document.calform.codCelular.focus();
		return false;
	}
	if (document.calform.celular.value=="")
	{
		alert("Ingrese Celular.");
		document.calform.celular.focus();
		return false;
	}			
	if (document.calform.cuit.value=="")
	{
		alert("Ingrese CUIT");
		document.calform.cuit.focus();
		return false;
	}	
	return true;

}	
		$(document).ready(function() {
			/*
			*   Examples - images
			*/

			$("a#example1").fancybox();

			$("a#example2").fancybox({
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic'
			});

			$("a#example3").fancybox({
				'transitionIn'	: 'none',
				'transitionOut'	: 'none'	
			});

			$("a#example4").fancybox({
				'opacity'		: true,
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'none'
			});

			$("a#example5").fancybox();

			$("a#example6").fancybox({
				'titlePosition'		: 'outside',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.9
			});

			$("a#example7").fancybox({
				'titlePosition'	: 'inside'
			});

			$("a#example8").fancybox({
				'titlePosition'	: 'over'
			});

			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});

			/*
			*   Examples - various
			*/

			$("#various1").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});

			$("#various2").fancybox();

			$("#various3").fancybox({
				'width'				: '75%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});

			$("#various4").fancybox({
				'padding'			: 0,
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});

	$("#various5").fancybox({
		'width'				: '75%',
		'height'			: '75%',
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});			

				$("#various6").fancybox({
	    'padding'           : 0,
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none'
	});

				$("#various7").fancybox({
	    'padding'           : 0,
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none'
	});

$("#various8").fancybox({
	    'padding'           : 0,
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none'
	});

	$("#various10").fancybox({
		'width'				: '75%',
		'height'			: '75%',
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});		
	$("#various11").fancybox({
		'width'				: '75%',
		'height'			: '75%',
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});		
	$("#various12").fancybox({
		'width'				: '75%',
		'height'			: '75%',
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});		
	$("#various13").fancybox({
		'width'				: '75%',
		'height'			: '75%',
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});		
			
	$("#various14").fancybox({
		'width'				: '75%',
		'height'			: '75%',
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});		
	$("#various15").fancybox({
		'width'				: '75%',
		'height'			: '75%',
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});		
	$("#various16").fancybox({
		'width'				: '75%',
		'height'			: '75%',
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});		
	$("#various17").fancybox({
		'width'				: '75%',
		'height'			: '75%',
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe'
	});		

		});




var colors = new Array(	"#7b7b7b", "#7b7b7b" , "#ffffff");

//	Set the basic color
var basicColor = "#7b7b7b";

//	Set the global vars to their initial state
var curColIdx = 0;
var curElem;

var	mousePosX = 0;
var mousePosY = 0;

//	Set the glow speed
var speed = 1;

//	Initialize glower scripts
function init()
{
	//	ie only :p

	if (!document.layers)
	{
		document.onmouseover = determine_tag;
		document.onmouseout = end_glow;
		check_state();
	}
}

//	Stop the glowing of a link
function end_glow()
{
	if (curElem)
	{
		//	Reset values
		curElem.style.color = basicColor;
		curColIdx = 0;
		curElem = false;
	}
}

//	Stop the glowing of a link
function start_glow(ev)
{
		// If element does not exist, return
		if (!curElem) return;
		ev = curElem;

		//	determine which color is being used
		tempCol = ev.style.color;
		if (tempCol == basicColor)
		{
			//	Reset colorindex
			curColIdx = 0;
		}
		if (!tempCol)
		{
			//	Color not yet set, set index to 0
			curColIdx = 0;
			tempCol = basicColor;
		}
		else
		{
			// 	Search current color
			itemN = colors.length;
			for (f = 0; f < itemN; f++)
			{
				if (colors[f] == tempCol)
				{
					//	Color found, update counter
					if (f >= (itemN-1))
					{
						// Jump to first color
						curColIdx = 0;
					}
					else
					{
						//	Increase color index with one
						curColIdx = f + 1;
					}

				} // end if: check for color

			}//	end if: search color

		}//	end if: initiate search

		//	set color
		ev.style.color = colors[curColIdx];

}

function determine_tag()
{
	ev = window.event.srcElement;
	mousePosX = window.event.offsetX;
	mousePosY = window.event.offsetY;

	tag = ev.tagName;

	//	Respond to anchor tags only
	if (tag == "A")
	{
		if (curElem)
		{
			curElem = false;
			return;
		}
		curElem = ev;
	}
	else
	{
		curElem = false;
	}
}

function check_state()
{
	if (curElem)
	{
		start_glow();
	}

		//	Object is selected, glow
	if (!curElem) end_glow();//	Object is not selected, do not glow


	//	Set timer
	window.setTimeout("check_state()", speed);
}














/////////////////////////////////

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}




function ojo2()
{
	var a=confirm("Se borrar&aacute; este registro")
	if (a==1) {return true;}
	else {return false;}
}

function ojo3()
{
	var a=confirm("Se borrar&aacute; la novedad.")
	if (a==1) {return true;}
	else {return false;}
}


//-------------------------------------------
// Cambia el estilo de los Links cuando se hace click

function ClickMenu(i,cont, estilo)
{
 for (n=1; n<(cont+1); n++)
 {
	 var menux = document.getElementById('menu_'+n);  
	 menux.className = estilo;
 }
 var Idmenu = document.getElementById('menu_'+i); 
 Idmenu.className = 'MenuClick'

}






//-------------------------------------------------------
// solo numeros, si no es numero devuelve false ----------

	function numero(cadena)
	{
	 var str = "1234567890";
	 for(cont = 0;cont < cadena.length;cont++)
		{
		tmp = cadena.substring(cont,cont+1);
		if (str.indexOf (tmp,0)== -1)
		return(false);
		}
	 return(true); 
	}
//---------------------------------------------------------








// FUNCION PARA EL MENU DE ACCESOS --------

	function Acceso(URL,WinName,Opciones)
	{
		if (URL != '' )		
		{	
		
			var combo = document.getElementById('ACCESOS');  
			
			window.open(URL,WinName,Opciones);			
			combo.selectedIndex = 0
			
		}
	}

//--------------------------------------------






// abre ventana nueva segun parametros recibidos--------

	function NewWin(URL,WinName,Opciones)

	{	window.open(URL,WinName,Opciones); }

//--------------------------------------------






// maximiza ventana --------------------------------

	function maxi() 
	{
	window.innerWidth = screen.width;
	window.innerHeight = screen.height;
	window.screenX = 0;
	window.screenY = 0;
	alwaysLowered = false;
	}

//--------------------------------------------





// imprimir -------------------------------------

	function WinImprime()

	{	
		window.print();
		window.close();

	}

//--------------------------------------------







//---------------------------------------------------------------


function redir(url)
{  
	if (url != '' )
	 { 	this.location.replace(url);  } 
	 
}  


//---------------------------------------------------------------





//---------------------------------------------------------------


function RedirParam(url,param)
{  
	if (param != '' )
	 { 
	 	//alert(url+param);
	 	this.location.replace(url+param);
	 } 
	 
}  



//---------------------------------------------------------------







//--------------------------------------------

function CheckMail(emailStr) 

{

	var emailPat=/^(.+)@(.+)$/
	var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
	var validChars="\[^\\s" + specialChars + "\]"
	var firstChars=validChars
	var quotedUser="(\"[^\"]*\")"
	var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
	var atom="(" + firstChars + validChars + "*" + ")"
	var word="(" + atom + "|" + quotedUser + ")"
	var userPat=new RegExp("^" + word + "(\\." + word + ")*$")
	var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$")
	var matchArray=emailStr.match(emailPat)

	if (matchArray==null) return false;

	var user=matchArray[1]
	var domain=matchArray[2]

	if (user.match(userPat)==null) return false;

	var domainArray=domain.match(domainPat)

	if (domainArray==null) return false;

	var atomPat=new RegExp(atom,"g")
	var domArr=domain.match(atomPat)
	var len=domArr.length

	if (domArr[domArr.length-1].length<2 ||
			domArr[domArr.length-1].length>3) return false;

	if (domArr[domArr.length-1].length==3 && len<2) return false;

}

//--------------------------------------------







// *********** FUNCIONES DE FECHA **********************************

// año bisiesto, si es bisiesto devuelve true ----------

	function bisiesto(Vanio) 

	{
		if (Vanio % 4 == 0) 
			return true; 
		else 
			return false; 
	}

//--------------------------------------------




//cantidad de dias para cada mes---------------

	function dias_mes(vMES, vANIO) 
	
	{
	
	var vm = parseInt(vMES);
	
		switch (vm) 
		{
			case 1: 
				return 31;
				break;
			case 2: 
				return 29;
				break;
			case 3: 
				return 31;
				break;
			case 4: 
				return 30;
				break;
			case 5: 
				return 31;
				break;
			case 6: 
				return 30;
				break;
			case 7: 
				return 31;
				break;
			case 8: 
				return 31;
				break;
			case 9: 
				return 30;
				break;
			case 10: 
				return 31;
				break;
			case 11: 
				return 30;
				break;
			case 12: 
				return 31;
				break;
			default:
				return 31;
			
		}
		
	}




// valida fechas----------------------------------------

	function validafecha(REQ,dia,mes,anio) 

	{
	
		if ( (REQ==1) && ( (dia=="") || (mes=="") || (anio=="") ) )
		{ return (false);	}


		if ( dia > dias_mes(mes) )
		{	  return (false);		}


		if ((mes == 2) && ( (bisiesto(anio) == false) && (dia > 28) ) )
		{  return (false);		}

			
	}


// ******************************************************







// EXPANDE O CONTRAE OBJETOS ----------------------

function Expandir(NomObj,estilo) 
{ 
 
 var objeto = document.getElementById(NomObj);
 
 if ( objeto.className == 'contraido' ) 
 	  objeto.className = estilo ;
 else
 		objeto.className = 'contraido';
 
 
 //objeto.className = objeto.className == "contraido" ? estilo : "contraido";
 //tblDepo.className = tblDepo.className == "contraido" ? "expandido" : "contraido";


}

//-----------------------------------------------





// Confirma la eliminaci&oacute;n de items en CheckBox ----------
function CheckBorrar(form)
{
var cant = form.contador.value;
var n=0;

	for (i=1;i<=cant;i=i+1)
	{
		var chbox = form.elements["Borrar_"+i];
		if (chbox.checked)
		{ n = (n+1); }
	}

	if (n>0)
	{ return confirm("¿ Confirma que va a ELIMINAR los Items seleccionados ?"); }

}

//-----------------------------------------------






// Valida Campos Requeridos ----------

function esVacio(FormName,campo,txtalerta)
{

	var campo = document.forms[FormName].elements[campo];
	var trimcampo = campo.value.replace(/^\s+|\s+$/g,'');

		
	if (trimcampo=='')
	{
	alert("Debe completar " + txtalerta);
	campo.focus();
	return (true);
	}

}

//-----------------------------------------------



// solo numeros, NUEVO!! ----------

	function NoEsNumero(FormName,campo,txtalerta)
	{
	 var campo = document.forms[FormName].elements[campo];
	 var cadena = campo.value;
	 var ERROR = false;
	 var str = "1234567890";
	 
	 for(cont = 0;cont < cadena.length;cont++)
		{
		tmp = cadena.substring(cont,cont+1);
		if (str.indexOf (tmp,0)== -1)
		ERROR=true;
		}	
		
		if (ERROR==true)
		{
		alert('Debe completar ' +txtalerta+ ' con N&uacute;meros' );
		campo.focus();
		return(true);
		}

	}
	
//---------------------------------------------------------






// valida fechas NUEVO!! -----------------------------------

	function evalFecha(REQ,FormName,DIA,MES,ANIO) 

	{

	  var ERROR = false;
	  var campo = document.forms[FormName].elements[DIA];
	  
	 	var dia = document.forms[FormName].elements[DIA].value;
	 	var mes = document.forms[FormName].elements[MES].value;
	 	var anio = document.forms[FormName].elements[ANIO].value;
	
		if ( (REQ==1) && ( (dia=='') || (mes=='') || (anio=='') ) )
		{ ERROR=true; }
		
		if ( dia > dias_mes(mes) )
		{	ERROR=true; }

		if ((mes == 2) && ( (bisiesto(anio) == false) && (dia > 28) ) )
		{ ERROR=true; }

		if (ERROR==true)
		{
		alert('La Fecha es incorrecta');
		campo.focus();
		return(true);
		}

			
	}












//-----------------------------------------------------------------
//------------------------RICARDO ---------------------------------
//-----------------------------------------------------------------

// En campos TEXTAREA PERMITE HASTA CIERTA CANTIDAD DE CARACTERES 

function textCounter(field,cntfield,maxlimit) {
if (field.value.length > maxlimit) 
field.value = field.value.substring(0, maxlimit);
else
cntfield.value = maxlimit - field.value.length;
}


// EMPLEOS

function CheckAll()
{
 for (var i=0;i<document.MultiOp.elements.length;i++)
 {
  var e=document.MultiOp.elements[i];
  if (e.name != 'allbox')
   e.checked=document.MultiOp.allbox.checked;
 }
}

function check()
{
var aux;
	for (var i=0; i<document.formulario.elements.length; i++)
	{
		if (document.formulario.elements[i].name.substring(0,1)=="#")
		{
			if (document.formulario.elements[i].checked==true)
			{
				aux=1;
			}
		}
	}
	if (aux!=1)
	{
		alert("Debe elegir al menos un alumno");
		return false;
	}
	else
	{
		return true;
	}
}

function CheckAll()
{
 for (var i=0;i<document.formulario.elements.length;i++)
 {
  var e=document.formulario.elements[i];
  if (e.name != 'allbox')
   e.checked=document.formulario.allbox.checked;
 }
}


function formu()
{
	if (check(document.formulario))
	{
		document.formulario.action="_SistemaBusqueda3.asp?flag=1";
		document.formulario.submit();
	}
}


//////////////////////////////////////



browserType=navigator.appName.charAt(0)+navigator.appVersion.charAt(0)




function launchWindow(myURL,myWidth,myHeight) {
        if (browserType=="N2") {

siteWindow=window.open("","","toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=0,width="+myWidth+",height="+myHeight);

                siteWindow.opener=self;
                siteWindow=myURL
        }
        if (browserType.charAt(0)=="M") {

siteWindow=window.open(myURL,"","toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=0,width="+myWidth+",height="+myHeight);

                siteWindow.opener=self;
        }
        else {

siteWindow=window.open(myURL,"","toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=0,width="+myWidth+",height="+myHeight);

                siteWindow.opener=self;
        }
	setTimeout("siteWindow.focus();",200);

}


/////////////

function check(formu)
{
var iano1
var eano1
var iano2
var eano2
var iano3
var eano3
var iano4
var eano4


		if (formu.elements.iano1.value > formu.elements.eano1.value) 
		{
			alert("Fecha de Egreso Erronea "+formu.elements.iano1.value + " " + formu.elements.eano1.value);
			formu.elements.iano1.focus();
			return false
		}

		if (formu.elements.iano2.value > formu.elements.eano2.value) 
		{
			alert("Fecha de Egreso Erronea "+formu.elements.iano2.value + " " + formu.elements.eano2.value);
			formu.elements.iano2.focus();
			return false
		}

		if (formu.elements.iano3.value > formu.elements.eano3.value) 
		{
			alert("Fecha de Egreso Erronea "+formu.elements.iano3.value + " " + formu.elements.eano3.value);
			formu.elements.iano3.focus();
			return false
		}

				if (formu.elements.iano4.value > formu.elements.eano4.value) 
		{
			alert("Fecha de Egreso Erronea "+formu.elements.iano4.value + " " + formu.elements.eano4.value);
			formu.elements.iano4.focus();
			return false
		}
}

//-------------------------------------------
// 


function AddText(form, Action)
{
var AddTxt="";
var txt="";
if(Action==1){
	txt=prompt("Texto para el Encabezado 1.","Texto");
	if(txt!=null)
		AddTxt="<h4>"+txt+"</h4>\r\n";
	}

if(Action==2){
	txt=prompt("Texto para el Encabezado 2.","Texto");
	if(txt!=null)
		AddTxt="<h5>"+txt+"</h5>\r\n";
	}

if(Action==3){
	txt=prompt("Texto para el Encabezado 3.","Texto");
	if(txt!=null)
		AddTxt="<h3>"+txt+"</h3>\r\n";
	}

if(Action==4){
	txt=prompt("Texto en Negrita.","Texto");
	if(txt!=null)
		AddTxt="<b>"+txt+"</b>";
	}

if(Action==5){
	txt=prompt("Texto en Cursiva","Texto");
	if(txt!=null)
		AddTxt="<i>"+txt+"</i>";
	}

if(Action==6)
	AddTxt="\r\n<p>";

if(Action==7)
	AddTxt="<br>\r\n";

if(Action==8)
	AddTxt="<hr>\r\n";

if(Action==9){
	txt=prompt("URL del V&iacute;nculo.","http://");
	if(txt!=null){
		AddTxt="<a href="+txt+">";
		txt=prompt("Texto que debe Mostrar el V&iacute;nculo","Texto");
		AddTxt+=txt+"</a>\r\n";
		}
	}

if(Action==10){
	txt=prompt("E-mail:","");
	if(txt!=null){
		AddTxt="<a href=mailto:"+txt+">";
		txt=prompt("Texto que debe Mostrar el V&iacute;nculo del e-mail","Texto");
		AddTxt+=txt+"</a>\r\n";
		}
	}

form.Descripcion.value+=AddTxt;



}

function ojo()
{
	var a=confirm("Se borrar&aacute; el registro")
	if (a==1) {return true;}
	else {return false;}
}

function vacio(test)
{
	if (test.ingreso.value=="")
	{alert ("Debe ingresar una Secci&oacute;n")
	return false;}
	else
	{return true;}
}

function check_posicion(formu)
{
	var ar = new Array();
	var igual=0;
	for (var i=0; i<formu.elements.length; i++){
		if (formu.elements[i].name.substring(0,1)=="#"){
			if (formu.elements[i].value==""){
				alert("Debe completar todas las posiciones de las secciones"); // + formu.elements[i].name.substr(1));
				formu.elements[i].focus()
				return false;
				break;
			}
			for (j=0; j<formu.elements[i].value.length; j++)
			{
				if ((formu.elements[i].value.substring(j,j+1) != "0") && (formu.elements[i].value.substring(j,j+1) != "1") && (formu.elements[i].value.substring(j,j+1) != "2") && (formu.elements[i].value.substring(j,j+1) != "3") && (formu.elements[i].value.substring(j,j+1) != "4") && (formu.elements[i].value.substring(j,j+1) != "5") && (formu.elements[i].value.substring(j,j+1) != "6") && (formu.elements[i].value.substring(j,j+1) != "7") && (formu.elements[i].value.substring(j,j+1) != "8") && (formu.elements[i].value.substring(j,j+1) != "9"))
				{
					alert("Debe completar las posiciones con un n&uacute;mero");
					formu.elements[i].focus()
					return false;
					break;
				}
			}
			for (var j=0; j<i; j++)
			{
				if (formu.elements[i].value==ar[j])
				{
					igual=1;
				}
			}
			if (igual==1)
			{
				alert("Dos Secciones no pueden tener la misma posici&oacute;n");
				formu.elements[i].focus()
				return false;
				break;
			}
			else
			{
				ar[i] = formu.elements[i].value;
			}
		}
	}

}






function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}




////////////////////////////////////////////////////////////////////////////////////////



function checkrequired(which) {
	var pass=true;
	if (document.images) {
		for (i=0;i<which.length;i++) {
			var tempobj=which.elements[i];
			if (tempobj.name.substring(0,8)=="required") {
				if (((tempobj.type=="text"||tempobj.type=="textarea")&&
				tempobj.value=='')||(tempobj.type.toString().charAt(0)=="s"&&
				tempobj.selectedIndex==0)) {
				pass=false;
			break;
         }
      }
   }
}
if (!pass) {
shortFieldName=tempobj.name.substring(8,30).toUpperCase();

if(shortFieldName=="CODNOVIOS"){
	shortFieldName= "Codigo ";
}

if(shortFieldName=="DATEBOX"){
	shortFieldName= "FECHA DEL ALTA ";
}

if(shortFieldName=="DATEBOX2"){
	shortFieldName= "FECHA DE BAJA ";
}

if(shortFieldName=="DATEBOX3"){
	shortFieldName= "FECHA DE CUMPLEAÑOS NOVIO ";
}

if(shortFieldName=="DATEBOX4"){
	shortFieldName= "FECHA DE CUMPLEAÑOS NOVIA ";
}

if(shortFieldName=="DATEBOX5"){
	shortFieldName= "FECHA DE ENLACE ";
}


if(shortFieldName=="APELLIDONOVIO"){
	shortFieldName= "APELLIDO DEL NOVIO ";
}


if(shortFieldName=="NOMBRENOVIO"){
	shortFieldName= "NOMBRE DEL NOVIO ";
}

if(shortFieldName=="APELLIDONOVIA"){
	shortFieldName= "APELLIDO DE LA NOVIA ";
}

if(shortFieldName=="NOMBRENOVIA"){
	shortFieldName= "NOMBRE DE LA NOVIA ";
}

if(shortFieldName=="EMAILNOVIO"){
	shortFieldName= "EMAIL DEL NOVIO ";
}

if(shortFieldName=="EMAILNOVIA"){
	shortFieldName= "EMAIL DE LA NOVIA ";
}

if(shortFieldName=="PASSWORDNOVIOS"){
	shortFieldName= "PASSWORD DE LOS NOVIOS ";
}

if(shortFieldName=="PASSWORDINVITADOS"){
	shortFieldName= "PASSWORD DE LOS INVITADOS ";
}



alert("Completar "+shortFieldName+".");
return false;
}
else
return true;
}



function checkrequired2(which) {
	var pass=true;
	if (document.images) {
		for (i=0;i<which.length;i++) {
			var tempobj=which.elements[i];
			if (tempobj.name.substring(0,8)=="required") {
				if (((tempobj.type=="text"||tempobj.type=="textarea")&&
				tempobj.value=='')||(tempobj.type.toString().charAt(0)=="s"&&
				tempobj.selectedIndex==0)) {
				pass=false;
			break;
         }
      }
   }
}
if (!pass) {
shortFieldName=tempobj.name.substring(8,30).toUpperCase();


alert("Completar "+shortFieldName+".");
return false;
}
else
return true;
}


