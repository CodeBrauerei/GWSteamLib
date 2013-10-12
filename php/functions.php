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

?>