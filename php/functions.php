<?php

/**
 * input steamID64 or customurl
 * returns steamID64 for web api v0002
 */
function get_steamID64($profile) {
    if (!is_numeric($profile) || strlen($profile) !== 17) {
        $profile_xml = simplexml_load_file('http://steamcommunity.com/id/' . $profile . '/?xml=1');
        return $profile_xml->steamID64;
    } else {
        return $profile;
    }
}

/**
 * calc and format playtime_min to playtime in hours
 */
function get_playtime_hours($min) {
    return number_format(round($min / 60, 1), 1, ',', '.');
}

/**
 * get img url of an app
 */
function get_app_img($appid) {
    $url = 'http://cdn.steampowered.com/v/gfx/apps/' . $appid . '/header.jpg';
    return $url;
}


/**
 * returns a pretty bootstrap badge
 */
function prettify_profilestate($state) {
    switch ($state) {
		case 0: $pps = '<span class="label label-default">Offline</span>'; break;
		case 1: $pps = '<span class="label label-primary">Online</span>'; break;
		case 2: $pps = '<span class="label label-primary">Beschäftigt</span>'; break;
		case 3: $pps = '<span class="label label-primary">Abwesend</span>'; break;
		case 4: $pps = '<span class="label label-primary">Abwesend</span>'; break;
		case 5: $pps = '<span class="label label-info">Bereit zum Handeln</span>'; break;
		case 6: $pps = '<span class="label label-info">Bereit zum Spielen</span>'; break;
    }

    return $pps;
}

?>