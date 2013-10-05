<?php
require 'config.php';

const APPNAME = 'XunoCore\'s Steam Libary';

$api = 'http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key='.API_KEY.'&steamid=76561198051267973&include_appinfo=1&format=json';

//$data = file_get_contents($api);
$data = file_get_contents('data/76561198051267973.json');
$x = json_decode($data, true);

?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?=APPNAME?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link href='http://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>

        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
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
                        $imgurl = 'http://cdn.steampowered.com/v/gfx/apps/'.$game['appid'].'/header.jpg'; // 460x215                        
                        // $imgurl = 'http://media.steampowered.com/steamcommunity/public/images/apps/'.$game['appid'].'/'.$game['img_logo_url'].'.jpg';   // 184x69
                        $playtime_h = number_format(round($game['playtime_forever']/60,1), 1,',','.');
                        if (isset($game['playtime_2weeks'])) {
                            $playtime2_h = number_format(round($game['playtime_2weeks']/60,1), 1,',','.');
                        }
                        
                        echo '<div class="game">
                                <img src="'.$imgurl.'">
                                <b>'.$game['name'].'</b>
                                <br>
                                ('.$playtime_h.' Std.)
                                <br>
                                <a href="steam://rungameid/'.$game['appid'].'">starten</a>
                              </div>';
                    }               
                }
            ?>
            <div class="clearfix"></div>
        </div>
        <script src="js/vendor/jquery-1.10.1.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
