<?php
include "Request.php";
include "Config.php";
include "Datas.php";

$datas = new Datas();
$req = new Requests();

$value = $datas->getDatas();

$params = [
"CashId" => Config::CashID,
"Params" => [
Config::CashID
],
"Token" => $value["0"]["Token"],
"UserId" => $value["0"]["UserId"]
];

$check = json_decode($req->sendRequest(Config::check_bal,json_encode($params)),true);

echo $check['Data'][0][3];