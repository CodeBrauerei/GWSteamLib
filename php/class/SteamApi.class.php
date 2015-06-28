<?php

class SteamApi {

    function __construct() {

    }

    public function get_owned_games($steamid) {
        $lk = 'http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=' . API_KEY . '&steamid=' . $steamid . '&include_appinfo=1&format=json';
        $data = file_get_contents($lk);

        if ($data) {
            return json_decode($data, true);
        } else {
            return false;
        }

        return false;
    }

    public function get_player_achievements($steamid, $appid) {
        $lk = 'http://api.steampowered.com/ISteamUserStats/GetPlayerAchievements/v0001/?appid=' . $appid . '&key=' . API_KEY . '&steamid=' . $steamid . '&l=english';

        $data = file_get_contents($lk);

        if ($data) {
            return json_decode($data, true);
        } else {
            return false;
        }

        return false;
    }

    public function get_playtime_forever($data) {
        $playtime_forever = 0;
        foreach ($data['response']['games'] as $game) {
            $playtime_forever += $game['playtime_forever'];
        }

        $formatted = number_format(round($playtime_forever / 60, 1), 1, ',', '.') . ' Hours';

        return $formatted;
    }

    public function get_game_count($data) {
        return $data['response']['game_count'];
    }

    public function get_player_summaries($steamid) {
        $lk = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . API_KEY . '&steamids=' . $steamid;

        $data = file_get_contents($lk);

        if ($data) {
            $player = json_decode($data, true);
            if (isset($player['response']['players'][0])) {
                return $player['response']['players'][0];
            }
        } else {
            return false;
        }

        return false;
    }

}

?>
