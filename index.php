<?php
	function celsius ($arg)
	{
		return ($arg-273.15) . '&#176C';
	}
    
	function pressure ($arg)
	{
		return round(($arg *7.5006/10)) . ' мм рт. ст.';
	}

	function wind ($arg)
	{
		switch (true) {
			case ($arg > 12.25 and $arg < 34.75):
				return 'ССВ';
				break;
			case ($arg >= 34.75 and $arg <= 57.25):
				return 'СВ';
				break;
			case ($arg > 57.25 and $arg < 79.75):
				return 'ВСВ';
				break;	
			case ($arg >= 79.75 and $arg <= 102.25):
				return 'В';
				break;		
			case ($arg > 102.25 and $arg < 124.75):
				return 'ВЮВ';
				break;	
			case ($arg >= 124.75 and $arg <= 147.25):
				return 'ЮВ';
				break;	
			case ($arg > 147.25 and $arg < 169.75):
				return 'ЮЮВ';
				break;	
			case ($arg >= 169.75 and $arg <= 192.25):
				return 'Ю';
				break;	
			case ($arg > 192.25 and $arg < 214.75):
				return 'ЮЮЗ';
				break;	
			case ($arg >= 214.75 and $arg <= 237.25):
				return 'ЮЗ';
				break;	
			case ($arg > 237.25 and $arg < 259.75):
				return 'ЗЮЗ';
				break;		
			case ($arg >= 259.75 and $arg <= 282.25):
				return 'З';
				break;	
			case ($arg > 282.25 and $arg < 304.75):
				return 'ЗСЗ';
				break;	
			case ($arg >= 304.75 and $arg <= 327.25):
				return 'СЗ';
				break;	
			case ($arg > 327.25 and $arg < 349.75):
				return 'ССЗ';
				break;
			case ($arg >= 349.75 and $arg <= 12.25):
				return 'С';
				break;				
		}
	}

	$filename='http://api.openweathermap.org/data/2.5/weather?id=498817&APPID=2e1da782eed5f92f3cf8970c7daff111';
	$json=file_get_contents($filename);
	// file_put_contents('json.txt', $json);
	// $array=json_decode(file_get_contents('json.txt'),true);
	$array=json_decode($json,true);
	echo '<h1>Погода в : ' . $array['name'] . '</h1>';
	echo '<p>Температура: ' . celsius($array['main']['temp']) . '</p>';
	echo '<p>Температура min: ' . celsius($array['main']['temp_min']) . '</p>';
	echo '<p>Температура max: ' . celsius($array['main']['temp_max']) . '</p>';
	echo '<p>Давление: ' . pressure($array['main']['pressure']) . '</p>';;
	echo '<p>Влажность: ' . pressure($array['main']['humidity']) . ' %' . '</p>';;
	echo '<p>Скорость ветра: ' . pressure($array['wind']['speed']) . ' м/с' . '</p>';;
	echo '<p>Ветер: ' . wind($array['wind']['deg']);
	echo '<p>Облачность: ' . $array['clouds']['all'] . ' %' . '</p>';;
	date_default_timezone_set('UTC');
	$time = $array['dt'];
	$time += 3 * 3600;
	echo '<p>Дата / время: ' . date('d.m.Y H:i:s',$time) . '</p>';;
	// echo "<pre>";
	// print_r($array);
	// echo "</pre>";
?>