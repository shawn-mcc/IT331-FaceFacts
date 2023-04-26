<?php
function pass_team_url($team_id, $base_url)
{
    $url = get_url($base_url). "?team_id=" . $team_id;
    return $url;
}
function get_url_params($param)
{
    $components = parse_url($_SERVER['REQUEST_URI']);
    parse_str($components['query'], $params);
    return $params[$param];

}
function parse_team_id(){
    $team_id = get_url_params("team_id");
    return $team_id;
}
?>