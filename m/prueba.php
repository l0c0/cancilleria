<?php 
	$xml = simplexml_load_file("http://cancilleria.gov.co//rss.xml");
	$result = $xml->channel->item;
	//print_r($result);
	for ($i = 0; $i < sizeof($result); $i++)
		{
			$news = $result[$i];
			$description = str_replace($news->title, '', strip_tags($news->description));
		}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>