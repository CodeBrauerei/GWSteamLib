<?php
const APPNAME = 'GWSteamLib';

function __autoload($class) {
    require_once 'class/' . $class . '.class.php';
}

$api          = new SteamApi();
$x            = $api->get_owned_games('76561198051267973');
$playtime_ges = 0.0;
$games_c      = 0;

foreach ($x['response']['games'] as $game) {
    $playtime_ges += $game['playtime_forever'];
    $games_c++;
}

usort($x['response']['games'], function($a, $b) {
    return strcmp($a['name'], $b['name']);
});

?>

<!DOCTYPE html>
<html>
    <head>
        <title><?= APPNAME ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/custom.css" rel="stylesheet" media="screen">
        <link href="css/animations.css" rel="stylesheet" media="screen">
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
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Bibliothek</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <form class="navbar-form navbar-left" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Suchen...">
                            </div>
                        </form>
                    </ul>
                    
                </div><!--/.nav-collapse -->
            </div>
        </div>
        <div class="container ptop60">

            <h1></h1>
            
            <div class="row">
                <div class="col-md-8 expandOpen">
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
            $counter = 0;
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

                    if (isset($playtime2_h)) {
                        $p_pt_2w = '<br>letzten 2 Wochen:<br>' . $playtime2_h . ' Std.';
                    } else {
                        $p_pt_2w = '';
                    }

                    echo '<div class="col-md-3">
                            <div class="thumbnail">
                                <img src="' . $imgurl . '" class="img-rounded">
                                <p class="gameinfo">
                                    <b>' . $game['name'] . '</b> 
                                    <a href="#" class="pull-right" data-toggle="tooltip" data-html="true" data-placement="right" id="tt'.$counter.'" title="Gesamt: ' . $playtime_h . ' Std.'.$p_pt_2w.'">Spielzeit</a>
                                </p>
                                <div class="btn-group btn-group-xs">
                                    <a type="button" class="btn btn-default btn-xs" href="steam://rungameid/' . $game['appid'] . '">starten</a>
                                    <a type="button" class="btn btn-default btn-xs" href="http://store.steampowered.com/app/' . $game['appid'] . '">Shop</a>
                                    <a type="button" class="btn btn-default btn-xs" href="http://steamcommunity.com/app/' . $game['appid'] . '">Hub</a>
                                    <a type="button" class="btn btn-default btn-xs" href="http://store.steampowered.com/dlc/' . $game['appid'] . '">DLCs</a>
                                    <a type="button" class="btn btn-default btn-xs" href="http://store.steampowered.com/news/?appids=' . $game['appid'] . '">News</a>
                                    <a type="button" class="btn btn-default btn-xs" href="http://www.steamcardexchange.net/index.php?gamepage-appid-' . $game['appid'] . '">SCE</a>
                                </div>
                                
                            </div>
                        </div>';
                }

                if ($row_i == 3) {
                    $row_i = 0;
                    echo "</div>\n";
                } else {
                    $row_i++;
                }

                unset($playtime2_h);
                $counter++;
            }
            ?>
        </div>
        <div class="container" style="text-align: center;padding-top: 15px;padding-bottom: 5px;">
            <a href="https://github.com/GabrielWanzek/GWSteamLib" class="btn btn-info btn-xs">GWSteamLib v0.1</a>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            $(function () { $("[data-toggle='tooltip']").tooltip(); });
        </script>
    </body>
</html>