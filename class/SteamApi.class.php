<?php

class SteamApi {
	
	function __construct() {
		require './config.php';
	}

	public function get_owned_games($steamid) {
		$lk = 'http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=' . API_KEY . '&steamid='.$steamid.'&include_appinfo=1&format=json';
		
		//$data = file_get_contents($lk);
		$data = file_get_contents('data/76561198051267973.json');
		
		return json_decode($data, true);
	}

	public function get_player_achievements($steamid, $appid) {
		$lk = 'http://api.steampowered.com/ISteamUserStats/GetPlayerAchievements/v0001/?appid='.$appid.'&key=' . API_KEY . '&steamid='.$lksteamid.'&l=german';

		$data = file_get_contents($lk);
		
		return json_decode($data, true);
	}

}

?>