<?php

/*error_reporting(0);*/

if ($_COOKIE['gwsl_profile'] == " ") {
    header('Location: hello.php');
}

require_once './config.php';
require 'php/functions.php';

function __autoload($class) {
    require_once 'php/class/' . $class . '.class.php';
}

$api    = new SteamApi();
$loader = new Loader();

$steamID64 = get_steamID64($_COOKIE['gwsl_profile']);
$games     = $api->get_owned_games($steamID64);
$player    = $api->get_player_summaries($steamID64);

if (is_array($games)) {
    usort($games['response']['games'], function($a, $b) {
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
        <?php $loader->get_menu($player); ?>
        <div class="container ptop60">
            <div class="row">
                <div class="col-md-8 expandOpen">
                    <h1><?php echo APPNAME; ?> <small>the better steam libary</small></h1>
                </div>
                <div class="col-md-4">
                    <?php if (is_array($games)): ?>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge"><?php echo $api->get_game_count($games); ?> Games</span>
                            Library
                        </li>
                        <li class="list-group-item">
                            <span class="badge"><?php echo $api->get_playtime_forever($games); ?></span>
                            Total Time
                        </li>
                    </ul>
                    <?php endif;?>
                </div>
            </div>
            <div id="Grid">
            <?php
            $err_count = 0;

            if (is_array($games)) {
                $row_i     = 0;
                $counter   = 0;

                foreach ($games['response']['games'] as $game) {

                    if (!empty($game['img_logo_url'])) {

                        $imgurl      = get_app_img($game['appid']);
                        $playtime_h  = get_playtime_hours($game['playtime_forever']);
                        $playtime2_h = (isset($game['playtime_2weeks'])) ? get_playtime_hours($game['playtime_2weeks']) : '' ;

                        if (isset($playtime2_h) && strlen($playtime2_h) !== 0) {
                            $played_2w = ' w2p';    // filter tag: "Played in last 2 weeks"
                            $p_pt_2w   = '<br>Last 2 weeks:<br>' . $playtime2_h . ' Hours';  // for popover
                            $pt2_h     = round($game['playtime_2weeks']/60, 0);                 // for sorting
                        } else {
                            $played_2w = ' w2np';   // filter tag: "Not played in last 2 weeks"
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
                                        <span style="cursor:pointer" class="pull-right" data-toggle="tooltip" data-html="true" data-placement="left" id="tt' . $counter . '" data-content="Total: ' . $playtime_h . ' Hours' . $p_pt_2w . '"><span class="glyphicon glyphicon-time"></span></span>
                                    </p>
                                    <div class="centered">
                                        <div class="btn-group btn-group-xs">
                                            <a type="button" class="btn btn-primary btn-xs" href="steam://rungameid/' . $game['appid'] . '">Start</a>
                                            <a type="button" class="btn btn-primary btn-xs" target="_blank" href="http://store.steampowered.com/app/' . $game['appid'] . '">Shop</a>
                                            <a type="button" class="btn btn-primary btn-xs" target="_blank" href="http://steamcommunity.com/app/' . $game['appid'] . '">Hub</a>
                                            <a type="button" class="btn btn-primary btn-xs" target="_blank" href="http://store.steampowered.com/dlc/' . $game['appid'] . '">DLCs</a>
                                            <a type="button" class="btn btn-primary btn-xs" target="_blank" href="http://store.steampowered.com/news/?appids=' . $game['appid'] . '">News</a>
                                            <a type="button" class="btn btn-primary btn-xs" target="_blank" href="http://www.steamcardexchange.net/index.php?gamepage-appid-' . $game['appid'] . '">SCE</a>
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
                    <h4>Oops, an error has occurred!.</h4>
                    <h5>SteamID invalid or doesn\'t exist</h5>
                    <p>Make sure you entered your SteamID properly.</p>
                    <br><br>
                    <a href="hello.php" class="btn btn-danger">Back</a>
                </div>';
            }
            ?>
            </div>
            <?php
                if ($err_count > 0) {
                    echo '<br><div class="alert alert-danger">From '.$err_count.' games, no data was found!</div>';
                }
            ?>
        </div>
        <div class="modal fade" id="profile">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">User: <?php echo $player['personaname']?> <?php echo prettify_profilestate($player['personastate'])?></h4>
                    </div>
                    <div class="modal-body">
                        <img src="<?php echo $player['avatarfull']?>" class="pull-right img-thumbnail">

                        <b>Steam ID:</b><br>
                        <?php echo $player['steamid']?>
                        <br><br>
                        <b>Last time online:</b><br>
                        <?php echo date('d.m.Y H:i',$player['lastlogoff'])?>
                        <br><br>
                        <b>Date created:</b><br>
                        <?php echo date('d.m.Y H:i',$player['timecreated'])?>
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <?php $loader->get_footer(); ?>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/1.5.25/jquery.isotope.min.js"></script>
        <script src="//cdn.rawgit.com/js-cookie/js-cookie/master/src/js.cookie.js#2.0.2"></script>

        <script src="js/main.js"></script>
    </body>
</html>
