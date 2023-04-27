<?php
require_once(__DIR__ . "../../partials/nav.php");
reset_session();
?><?php

$db = getDB();
$stmt = $db->prepare("INSERT INTO Prizes (name, img_url, val_dol, val_cent, token_cost, redeem_code) VALUES(:name, :img_url, :val_dol, :val_cent, :token_cost, :redeem_code)");
for ($i = 5; $i<21; $i+=5){
    $stmt->execute([
        ":name"=>"$ $i Starbucks Gift Card",
        ":img_url"=>"/img/starbucks.png",
        ":val_dol"=>$i,
        ":val_cent"=>0,
        ":token_cost"=>$i*1000,
        ":redeem_code"=>1
    ]);
}
?><?php require_once(__DIR__ . "../../partials/flash.php"); ?>