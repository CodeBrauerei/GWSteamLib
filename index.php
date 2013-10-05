<?php
require 'config.php';

const APPNAME = 'GWSteamLib';

$api = 'http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=' . API_KEY . '&steamid=76561198051267973&include_appinfo=1&format=json';

//$data = file_get_contents($api);
$data = file_get_contents('data/76561198051267973.json');
$x    = json_decode($data, true);

$playtime_ges = 0.0;
$games_c      = 0;

foreach ($x['response']['games'] as $game) {
    $playtime_ges += $game['playtime_forever'];
    $games_c++;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title><?= APPNAME ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="css/custom.css">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <!--[if lt IE 9]>
          <script src="../../assets/js/html5shiv.js"></script>
          <script src="../../assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?= APPNAME ?></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Bibliothek</a></li>
                        <li><a href="#version">Version 0.1</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
        <div class="container ptop60">

            <h1></h1>
            
            <div class="row">
                <div class="col-md-8">
                    <h1><?= APPNAME ?> <small>the better steam libary</small></h1>
                </div>
                <div class="col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge"><?= $x['response']['game_count'] ?> Spiele</span>
                            Spiele in der Bibliothek
                        </li>
                        <li class="list-group-item">
                            <span class="badge"><?=number_format(round($playtime_ges / 60, 1), 1, ',', '.')?> Std.</span>
                            Gesamtspielzeit
                        </li>
                    </ul>
                </div>
            </div>

            <?php
            $row_i = 0;
            foreach ($x['response']['games'] as $game) {
                if ($row_i == 0) {
                    echo '<div class="row mb30">';
                }

                if (!empty($game['img_logo_url'])) {
                    $imgurl = 'http://cdn.steampowered.com/v/gfx/apps/' . $game['appid'] . '/header.jpg'; // 460x215                        
                    // $imgurl = 'http://media.steampowered.com/steamcommunity/public/images/apps/'.$game['appid'].'/'.$game['img_logo_url'].'.jpg';   // 184x69
                    $playtime_h = number_format(round($game['playtime_forever'] / 60, 1), 1, ',', '.');
                    if (isset($game['playtime_2weeks'])) {
                        $playtime2_h = number_format(round($game['playtime_2weeks'] / 60, 1), 1, ',', '.');
                    }

                    echo '<div class="col-md-3">
                            <div class="thumbnail">
                                <img src="' . $imgurl . '">
                                <b>' . $game['name'] . '</b>
                                <br>
                                (' . $playtime_h . ' Std.)
                                <br>
                                <a href="steam://rungameid/' . $game['appid'] . '">starten</a>
                            </div>
                        </div>';
                }

                if ($row_i == 3) {
                    $row_i = 0;
                    echo "</div>\n";
                } else {
                    $row_i++;
                }  
            }
            ?>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>