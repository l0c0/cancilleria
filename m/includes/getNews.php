<?php
	date_default_timezone_set('America/Bogota');
	setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
	function printNews($result)
	{
		//print_r($result);
		for ($i = 0; $i < sizeof($result); $i++)
		{
			$news = $result[$i];
			preg_match_all('/http:[^>]+jpg/i',$news->description, $image);
			if (isset($image[0][0]))
				echo "<div class='news_img'><a href='noticia.php?id=".urlencode($news->pubDate)."'><img width='100px' src='".$image[0][0]."' /></a></div>";
			echo "<div class='news_date'>"; echo getMonth(strtotime($news->pubDate))." ".date("j", strtotime($news->pubDate))." de ".date("Y", strtotime($news->pubDate))."</div>
			<div class='news_title'>".$news->title."</div>";
			echo "<span class='ver'><a href='noticia.php?id=".urlencode($news->pubDate)."'>VER</a></span>
			<div class='separator'></div>";
		}
	}
	
	function imprimirNoticia($name, $result)
	{
		for($i = 0; $i < sizeof($result); $i++)
		{
			$news = $result[$i];
			if ($news->pubDate == $name)
			{
				echo "<div class='art_title'>".$news->title."</div>";
				$charpos=strpos($news->description, '<div class="field field-type-computed field-field-search">');
				$descriptionfiltered= substr($news->description,0,$charpos);
				preg_match_all('/http:[^>]+jpg/i',$descriptionfiltered, $image);
				if (isset($image[0][0]))
					echo "<div class='art_img'><img class='art_img' src='".$image[0][0]."' /></div>";
					$description = str_replace($news->title, '', strip_tags($descriptionfiltered, "<p><a><br>"));
					
				echo "<div class='art_description'>".$description."</div>
				<div class='clear'></div>";
			}
		}
	}
	
	function getMonth ($month)
	{
		$mes = array(1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre");
		return $mes[date("n",$month)];
	}
?>