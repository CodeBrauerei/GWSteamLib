<?php

/*error_reporting(0);*/

if (!isset($_GET['profile'])) {
    header('Location: hello.php');
}

require_once './config.php';
require 'php/functions.php';

function __autoload($class) {
    require_once 'php/class/' . $class . '.class.php';
}

$api    = new SteamApi();
$loader = new Loader();

$steamID64 = get_steamID64($_GET['profile']);
$data      = $api->get_owned_games($steamID64);

if (is_array($data)) {
    usort($data['response']['games'], function($a, $b) {
        return strcmp($a['name'], $b['name']);
    });
}

?>

<!DOCTYPE html>
<html>
    <head>
        <?php $loader->get_head(); ?>
    </head>
    <body>
        <?php $loader->get_menu(); ?>
        <div class="container ptop60">
            <div class="row">
                <div class="col-md-8 expandOpen">
                    <h1><?= APPNAME ?> <small>the better steam libary</small></h1>
                </div>
                <div class="col-md-4">
                    <?php if (is_array($data)): ?>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge"><?= $api->get_game_count($data); ?> Spiele</span>
                            Spiele in der Bibliothek
                        </li>
                        <li class="list-group-item">
                            <span class="badge"><?= $api->get_playtime_forever($data); ?></span>
                            Gesamtspielzeit
                        </li>
                    </ul>
                    <?php endif;?>
                </div>
            </div>
            <div id="Grid">
            <?php
            $err_count = 0;

            if (is_array($data)) {
                $row_i     = 0;
                $counter   = 0;
                
                foreach ($data['response']['games'] as $game) {
                    
                    if (!empty($game['img_logo_url'])) {

                        $imgurl      = get_app_img($game['appid']);
                        $playtime_h  = get_playtime_hours($game['playtime_forever']);
                        $playtime2_h = (isset($game['playtime_2weeks'])) ? get_playtime_hours($game['playtime_2weeks']) : '' ;

                        if (isset($playtime2_h) && strlen($playtime2_h) !== 0) {
                            $played_2w = ' w2p';    // filter tag: "wurde in den letzten 2 wochen gespielt"
                            $p_pt_2w   = '<br>letzten 2 Wochen:<br>' . $playtime2_h . ' Std.';  // für popover
                            $pt2_h     = round($game['playtime_2weeks']/60, 0);                 // für sortieren
                        } else {
                            $played_2w = ' w2np';   // filter tag: "wurde in den letzten 2 wochen NICHT gespielt"
                            $p_pt_2w   = '';        
                            $pt2_h     = 0;
                        }

                        $itemfilter = ' none';                    
                        
                        $ptf_h      = round($game['playtime_forever']/60, 3);     

                        if ($ptf_h <= 1.9 ) {
                            $itemfilter = ' ptf02';
                        } if ($ptf_h > 1.9 && $ptf_h <= 5.0) {
                            $itemfilter = ' ptf25';
                        } if ($ptf_h == 0.0) {
                            $itemfilter = ' ptf00';
                        }

                        echo '<div class="col-md-3 item'.$itemfilter.$played_2w.'" data-playedtime="'. round($ptf_h,0) .'" data-playedtime2weeks="'.round($pt2_h,0).'">
                                <div class="thumbnail">
                                    <img src="' . $imgurl . '" class="img-rounded">
                                    <p class="gameinfo">
                                        <b class="gamename">' . $game['name'] . '</b> 
                                        <span style="cursor:pointer" class="pull-right" data-toggle="tooltip" data-html="true" data-placement="left" id="tt' . $counter . '" data-content="Gesamt: ' . $playtime_h . ' Std.' . $p_pt_2w . '"><span class="glyphicon glyphicon-time"></span></span>
                                    </p>
                                    <div class="centered">
                                        <div class="btn-group btn-group-xs">
                                            <a type="button" class="btn btn-primary btn-xs" href="steam://rungameid/' . $game['appid'] . '">starten</a>
                                            <a type="button" class="btn btn-primary btn-xs" href="http://store.steampowered.com/app/' . $game['appid'] . '">Shop</a>
                                            <a type="button" class="btn btn-primary btn-xs" href="http://steamcommunity.com/app/' . $game['appid'] . '">Hub</a>
                                            <a type="button" class="btn btn-primary btn-xs" href="http://store.steampowered.com/dlc/' . $game['appid'] . '">DLCs</a>
                                            <a type="button" class="btn btn-primary btn-xs" href="http://store.steampowered.com/news/?appids=' . $game['appid'] . '">News</a>
                                            <a type="button" class="btn btn-primary btn-xs" href="http://www.steamcardexchange.net/index.php?gamepage-appid-' . $game['appid'] . '">SCE</a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    
                    } else {
                        $err_count++;
                    }              

                    unset($playtime2_h);
                    $counter++;
                }
            } else {
                echo '</div>
                <br>
                <div class="alert alert-danger">
                    <h4>Ups! Ein Fehler ist aufgetreten.</h4>
                    Scheinbar ist die angegebene SteamID / Custom URL ungültig.<br>Bitte überprüfe deine Eingabe und stelle sicher das dein Profil öffentlich sichtbar ist.
                    <br><br>
                    <a href="hello.php" class="btn btn-danger">zurück</a>
                </div>';
            }
            ?>
            </div>
            <?php
                if ($err_count > 0) {
                    echo '<br><div class="alert alert-danger">Von '.$err_count.' Spiel(en) konnten keine Daten gefunden werden.</div>';
                }
            ?>
        </div>

        <?php $loader->get_footer(); ?>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.isotope.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>