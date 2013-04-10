<?php
	include("includes/getNews.php"); 
	$xml = simplexml_load_file("http://cancilleria.gov.co//rss.xml");
	$result = $xml->channel->item;
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link type="image/x-icon" href="images/framework_favicon.ico" rel="shortcut icon">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ministerio de Relaciones Exteriores</title>
</head>

<body>
<div id="header">
	<div id="back_header">
    	<div id="logo"><a href="index.php"><img width="290px" src="images/logo.png" /></a></div>
    </div> 
    <div class="clear"></div>
    <div class="main_menu">
    	<div class="menu_item"><a href="acercade.php">ACERCA DEL MINISTERIO</a> | <a href="politica.php">POL&Iacute;TICA EXTERIOR</a> | <a href="trarmite.php">TR&Aacute;MITES Y SERVICIOS MRE</a> | <a href="index.php">NOTICIAS</a> | <a href="https://correo.cancilleria.gov.co/exchange">CORREO INSTITUCIONAL</a></div>
    </div>
</div>