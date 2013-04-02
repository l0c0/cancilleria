<? 
try { 
    $options = array( 
    'exceptions'=>true, 
    'trace'=>1, 
    ); 
$client = new SoapClient('http://tramites.cancilleria.gov.co/wsdirectoriomisiones/Misiones.svc?wsdl', $options); 
    // Note where 'Get' and 'request' tags are in the XML 
        } catch (Exception $e) { 
            echo "<h2>Exception Error!</h2>"; 
            echo $e->getMessage(); 
        } 
 try { 
   $response=$client->consultarTodasMisiones(); 
} 
catch (Exception $e) 
{ 
    echo 'Caught exception: ',  $e->getMessage(), "\n"; 
} 

while (list($clave, $valor) = each($response)){
	
	echo "<pre>";
	print_r($clave);
	echo "</pre>";
	echo "<br>";
	echo "<pre>";
	print_r($valor);
	echo "</pre>";
}
?>



