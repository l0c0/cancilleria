<?php

try { 
    $options = array( 
    'exceptions'=>true, 
    'trace'=>1, 
    'cache_wsdl' => WSDL_CACHE_NONE
    ); 
$client = new SoapClient('http://tramites.cancilleria.gov.co/wsdirectoriomisiones/Misiones.svc?wsdl', $options); 
    // Note where 'Get' and 'request' tags are in the XML 
        } catch (Exception $e) { 
            echo "<h2>Exception Error!</h2>"; 
            echo $e->getMessage(); 
        } 
 try { 
   $response=$client->consultarTramitesConsulados(); 
} 
catch (Exception $e) 
{ 
    echo 'Caught exception: ',  $e->getMessage(), "\n"; 
} 



?>

<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Tramites de Consulados de Colombia</title>
    
    <style type="text/css">

      .tooltip{
          font-family: arial;
          font-size: 11px;
          height: 100px;
      }

    </style>

    <link href="default.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script language="javascript">
    
      function initialize() {
        var mapOptions = {
          zoom: 2,
          center: new google.maps.LatLng(40, -80),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var position;
        
        var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

        <?php
		$i=1;

		$objeto = $response->consultarTramitesConsuladosResult;
		
		$o_mision = $objeto->Mision;
		
		while (list($indice, $o_datos) = each($o_mision)){
			
			$mision = $o_datos->tipoMision->descripcion;
			$titulo = chop($o_datos->ciudad->descripcion);
		
            $txtSitio = "<div class='tooltip'>";

			if ($mision == "Embajada"){	
				$txtSitio .= "Embajada $titulo";
			}else{
				$txtSitio .= "Consulado $titulo";
			}
			
			$nombreTramite = $o_datos->tramites->Tramite->descripcion;
			$cantidadTramite = $o_datos->tramites->Tramite->cantidad;
			
					
			//$txtSitio .= "<br>" . $o_datos->pais->descripcion . ", " . $o_datos->ciudad->descripcion . "<br>". $o_datos->direccion . "<br>" . "email: " . $o_datos->correoElectronico;
		
			$txtSitio .= "<br>" . $o_datos->pais->descripcion;
		
			$txtSitio .= "<br>Tramite: " . $nombreTramite . "<br>Cantidad: " . $cantidadTramite;
			
			$txtSitio = str_replace("'", "", $txtSitio);

			$txtSitio .= "</div>";
			            
			$lat = $o_datos->ciudad->latitud;
			$lon = $o_datos->ciudad->longitud;
			
			print ("	position = new google.maps.LatLng($lat, $lon);\n");
			
			if ($mision == "Embajada"){	
				print ("	var marker = new google.maps.Marker({position: position,map: map,icon: 'http://www.cancilleria.gov.co/maps/blue.png'});\n");
				print ("	marker.setTitle('Embajada $titulo');\n");
			}else{
				print ("	var marker = new google.maps.Marker({position: position,map: map,icon: 'http://www.cancilleria.gov.co/maps/red.png'});\n");
				print ("	marker.setTitle('Consulado $titulo');\n");
			}
				
        	print ("	attachSecretMessage(marker, '$txtSitio');\n\n");
			$i++;

		}

		
		/*
			$o_tramite = $o_datos->tramites;
		
			while (list($indice2, $o_datos2) = each($o_tramite)){
				$tramite = $o_datos2->tr
			}
			
		*/
	
			
		?>

      }


      function attachSecretMessage(marker, txt){
		var infowindow = new google.maps.InfoWindow({ content: txt });


        google.maps.event.addListener(marker, 'click', function() {
          infowindow.open(marker.get('map'), marker);
        });
      }

     google.maps.event.addDomListener(window, 'load', initialize);
      
    </script>
  </head>
  
  <body>
 
    <div id="map_canvas"></div>

  </body>
</html>
