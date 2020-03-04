<?php include_once("_include-config.php"); ?>
<script language="JavaScript" type="text/javascript">

var xmlhttp = false ;

if (!xmlhttp && typeof XMLHttpRequest != 'undefined')
{
  try {
	xmlhttp = new XMLHttpRequest ();
  }
  catch (e) {
  xmlhttp = false}
}


function myXMLHttpRequest (){
  var xmlhttplocal;
  try {
  	xmlhttplocal = new ActiveXObject ("Msxml2.XMLHTTP")}
  catch (e) {
	try {
	xmlhttplocal = new ActiveXObject ("Microsoft.XMLHTTP")}
	catch (E) {
	  xmlhttplocal = false;
	}
  }

  if (!xmlhttplocal && typeof XMLHttpRequest != 'undefined') {
	try {
	  var xmlhttplocal = new XMLHttpRequest ();
	}
	catch (e) {
	  var xmlhttplocal = false;
	}
  }
  return (xmlhttplocal);
}

var mnmxmlhttp = Array ();
var mnmString = Array ();
var mnmPrevColor = Array ();
var responsestring = Array ();
var myxmlhttp = Array ();
var responseString = new String;

var i=0;
var ii = 0;

function ajax_update2(myUrl, myDiv, rate){

    target2 = document.getElementById(myDiv);
	ii = i++;

	var content = "i=" + ii ;

	mnmxmlhttp = new myXMLHttpRequest ();
	if (mnmxmlhttp) {
			mnmxmlhttp.open ("POST", myUrl, true);
			mnmxmlhttp.setRequestHeader ('Content-Type',
					   'application/x-www-form-urlencoded');

			mnmxmlhttp.send (content);
			errormatch = new RegExp ("^ERROR:");

			target2 = document.getElementById(myDiv);

			mnmxmlhttp.onreadystatechange = function () {
				if (mnmxmlhttp.readyState == 4) {
					mnmString = mnmxmlhttp.responseText;

					if (mnmString.match (errormatch)) {
						mnmString = mnmString.substring (6, mnmString.length);

						target = document.getElementById (myDiv);
						target2.innerHTML = mnmString;

					} else {
						target = document.getElementById (myDiv);
						target2.innerHTML = mnmString;
					}
				}
			}
		}

	d=setTimeout('ajax_update(\'' + myUrl + '\',\'' + myDiv + '\',\'' + rate + '\');', rate);
	clearTimeout(d);
}
</script>
<script language="JavaScript" type="text/javascript">

var xmlhttp = false ;

if (!xmlhttp && typeof XMLHttpRequest != 'undefined')
{
  try {
	xmlhttp = new XMLHttpRequest ();
  }
  catch (e) {
  xmlhttp = false}
}


function myXMLHttpRequest (){
  var xmlhttplocal;
  try {
  	xmlhttplocal = new ActiveXObject ("Msxml2.XMLHTTP")}
  catch (e) {
	try {
	xmlhttplocal = new ActiveXObject ("Microsoft.XMLHTTP")}
	catch (E) {
	  xmlhttplocal = false;
	}
  }

  if (!xmlhttplocal && typeof XMLHttpRequest != 'undefined') {
	try {
	  var xmlhttplocal = new XMLHttpRequest ();
	}
	catch (e) {
	  var xmlhttplocal = false;
	}
  }
  return (xmlhttplocal);
}

var mnmxmlhttp = Array ();
var mnmString = Array ();
var mnmPrevColor = Array ();
var responsestring = Array ();
var myxmlhttp = Array ();
var responseString = new String;

var i=0;
var ii = 0;

function ajax_update(myUrl, myDiv, rate){

    target2 = document.getElementById(myDiv);
	ii = i++;

	var content = "i=" + ii ;

	mnmxmlhttp = new myXMLHttpRequest ();
	if (mnmxmlhttp) {
			mnmxmlhttp.open ("POST", myUrl, true);
			mnmxmlhttp.setRequestHeader ('Content-Type',
					   'application/x-www-form-urlencoded');

			mnmxmlhttp.send (content);
			errormatch = new RegExp ("^ERROR:");

			target2 = document.getElementById(myDiv);

			mnmxmlhttp.onreadystatechange = function () {
				if (mnmxmlhttp.readyState == 4) {
					mnmString = mnmxmlhttp.responseText;

					if (mnmString.match (errormatch)) {
						mnmString = mnmString.substring (6, mnmString.length);

						target = document.getElementById (myDiv);
						target2.innerHTML = mnmString;

					} else {
						target = document.getElementById (myDiv);
						target2.innerHTML = mnmString;
					}
				}
			}
		}

	setTimeout('ajax_update(\'' + myUrl + '\',\'' + myDiv + '\',\'' + rate + '\');', rate);

}
</script>
<script language="JavaScript">
//page refresh functie
function refresh()
{
    window.location.reload( false );
}
//einde page refresh
</script>
<script language="JavaScript">
function showMenu(id) {
var temp1="2-"+id //is -
var temp2="1-"+id // is +

  if(document.getElementById(id).style.visibility == "hidden") {
    document.getElementById(id).style.position		= "static";
    document.getElementById(id).style.visibility	= "visible";
	document.getElementById(temp1).style.position	= "static";
	document.getElementById(temp2).style.visibility	= "hidden";
	document.getElementById(temp1).style.visibility	= "visible";
	document.getElementById(temp2).style.position	= "absolute";
    document.getElementById(temp2).style.left		= -100;
    document.getElementById(temp2).style.top		= -100;
	
  }
  else {
  
    document.getElementById(id).style.visibility	= "hidden";
    document.getElementById(id).style.position		= "absolute";
    document.getElementById(id).style.left			= -100;
    document.getElementById(id).style.top			= -100;
	document.getElementById(temp1).style.visibility	= "hidden";
	document.getElementById(temp1).style.position	= "absolute";
    document.getElementById(temp1).style.left		= -100;
    document.getElementById(temp1).style.top		= -100;
	document.getElementById(temp2).style.visibility	= "visible";
	document.getElementById(temp2).style.position	= "static";
  }
}
</script>
<!-- Begin voor het advertentie gedeelte  -->
<script language="JavaScript">
function showAdsMenu(id) {

  if(document.getElementById(id).style.visibility == "hidden") 
  	{
     document.getElementById(id).style.visibility	= "visible";
	 document.getElementById(id).style.position	= "static";
	 document.getElementById(id).style.visibility	= "visible";
  }
  else 
  {
  
    document.getElementById(id).style.visibility	= "hidden";
    document.getElementById(id).style.position		= "absolute";
    document.getElementById(id).style.left			= -1000;
    document.getElementById(id).style.top			= -1000;
  }
}
</script>
<script language="JavaScript">
function hideads(id) 
{

  if(document.getElementById(id).style.visibility != "hidden") 
  	{
	document.getElementById(id).style.visibility	= "hidden";
    document.getElementById(id).style.position		= "absolute";
    document.getElementById(id).style.left			= -1000;
    document.getElementById(id).style.top			= -1000;
  	}

}
</script>
<!--Einde voor het advertentie gedeelte -->
<?php
if(! function_exists("timeInterval"))
{
    function timeInterval($start, $end)
    {
        $inter = $end - $start;
        $var = "";
        //Jaren
        $jaar = floor($inter / 31536000);
        if($jaar > 0)
        {
            $var .= $jaar;
            $inter = $inter - ($jaar * 31536000);
        }
        //Maanden
        $maand = floor($inter / 2628000);
        if($maand > 0)
        {
            $var .= $maand;
            $inter = $inter - $maand * 2628000;
        }
        //Dagen
        $dag = floor($inter / 86400);
        if($dag > 0)
        {
            if($dag == 1)
            {
                $var .= $dag . " ".$gevmsg1.", ";
            }
            else
            {
                $var .= $dag . " ".$gevmsg2.", ";
            }
            $inter = $inter - $dag * 86400;
        }
        //Uren
        $uur = floor($inter / 3600);
        if($uur > 0)
        {
            if($uur == 1)
            {
                $var .= $uur . ":";
            }
            else
            {
                $var .= $uur . ":";
            }
            $inter = $inter - $uur * 3600;
        }
        //Minuten
        $min = floor($inter / 60);
        if($min > 0)
        {
            if($min == 1)
            {
                $var .= $min . ":";
            }
            elseif($min > 1 && $min < 10 )
            {
                $var .= "0".$min . ":";
            }
			else
            {
                $var .= $min . ":";
            }
		}
		else
		{
		 $var .="00:";
		}
        $sec = $inter - $min * 60;
		if($sec > 0)
        {
         if($sec > 0 && $sec < 10 )
            {
                $var .= "0".$sec;
            }
			else
            {
                $var .= $sec;
            }
        }
		else
		{
		 $var .="00";
		}
        //Seconden [kun je eventueel weghalen]
        return $var;
    }
}
//Voorbeeld
//Dit geeft iets als: "2 uur en 56 minuten en 3 seconden"



?> 