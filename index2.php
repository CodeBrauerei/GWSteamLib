<?php

const APPNAME = 'XunoCore\'s Steam Libary';
const API_KEY = "64CDF653E45DFF6144F74EE6501C43A5";

$api = 'http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key='.API_KEY.'&steamid=76561198051267973&include_appinfo=1&format=json';
// http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=64CDF653E45DFF6144F74EE6501C43A5&steamid=76561198051267973&format=json

//$data = file_get_contents($api);
$data = file_get_contents('76561198051267973.json');
$x = json_decode($data, true);



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?=APPNAME?></title>
	<link href='http://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
	<link href="lib.css" rel="stylesheet">
	<script src="script.js"></script>
</head>
<body>
	<div class="container">
		<h1><?=APPNAME?></h1>
		<p><?=$x['response']['game_count']?> Games</p>

		<ul id="sort-by" class="sorter">
			<li><a href="#name">Name</a></li>
			<li><a href="#hours">Spielzeit</a></li>
			<li><a href="#hours2">Spielzeit (letzte 2 Wochen)</a></li>
		</ul>
		<?php
			foreach ($x['response']['games'] as $game) {
				if (!empty($game['img_logo_url'])) {
					// 184x69 $imgurl = 'http://media.steampowered.com/steamcommunity/public/images/apps//'.$game['img_logo_url'].'.jpg';
					$imgurl = 'http://cdn.steampowered.com/v/gfx/apps/'.$game['appid'].'/header.jpg';	// 460x215
					$playtime_h = number_format(round($game['playtime_forever']/60,1), 1,',','.');
					if (isset($game['playtime_2weeks'])) {
						$playtime2_h = number_format(round($game['playtime_2weeks']/60,1), 1,',','.');
					}
					
					echo '<div class="game">
							<img src="'.$imgurl.'">
							<b>'.$game['name'].'<br>('.$playtime_h.' Std.)</b>
							<br>
							<br>
							<a href="steam://rungameid/'.$game['appid'].'">starten</a>
						  </div>';
				}				
			}
		?>
		<div class="clear"></div>
	</div>
</body>
</html>

<?
// http://isotope.metafizzy.co/



?>