<?php
	function celsius ($arg)
	{
		return ($arg-273.15) . ' &#176C';
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
    
  date_default_timezone_set('UTC');
	$filename_local='cache.txt';
	$city_id=498817;
	$user_id='2e1da782eed5f92f3cf8970c7daff111';
	$filename_external="http://api.openweathermap.org/data/2.5/weather?id=$city_id&APPID=$user_id";

	$filename=$filename_external;

	if (is_readable($filename_local)) {
			
		if (((time()-filemtime($filename_local))/60)<=60) {
			$filename=$filename_local;
		}
	}

	$json=file_get_contents($filename);

	if ($filename==$filename_external) {
		file_put_contents($filename_local, $json);
	}
	
	$array=json_decode($json,true);
	$time = $array['dt'];
	$time += 3 * 3600;
?>

<style type="text/css">
	td {
		padding-right: 30px;
	}
</style>

<h1><?='Погода в : ' . $array['name']?></h1>

<table>
	<tr>
		<td>Температура</td>
		<td><?=celsius($array['main']['temp'])?></td>
	</tr>
	<tr>
		<td>Температура min</td>
		<td><?=celsius($array['main']['temp_min'])?></td>
	</tr>
	<tr>
		<td>Температура max</td>
		<td><?=celsius($array['main']['temp_max'])?></td>
	</tr>
	<tr>
		<td>Давление</td>
		<td><?=pressure($array['main']['pressure'])?></td>
	</tr>
	<tr>
		<td>Влажность</td>
		<td><?=$array['main']['humidity'] . ' %'?></a></td>
	</tr>
	<tr>
		<td>Скорость ветра</td>
		<td><?=$array['wind']['speed'] . ' м/с'?></td>
	</tr>
	<tr>
		<td>Ветер</td>
		<td><?=wind($array['wind']['deg'])?></td>
	</tr>
	<tr>
		<td>Облачность</td>
		<td><?=$array['clouds']['all'] . ' %'?></td>
	</tr>
	<tr>
		<td>Дата / время</td>
		<td><?=date('d.m.Y H:i:s',$time)?></td>
	</tr>
</table>