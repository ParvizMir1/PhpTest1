<?php
include "Request.php";
include "Config.php";
include "Datas.php";

$datas = new Datas();
$req = new Requests();

$params = [
"CashId" => Config::CashID,
"Version" => 2,
"Login" => Config::Login,
"Password" => Config::Password
];

$json = json_decode($req->sendRequest(Config::login_url,json_encode($params)),true);


if($json["Success"]===true){
unlink("values.json");
$datas->addDatas($json["Value"]);

$params = [
"CashId" => Config::CashID,
"Params" => [
1,
1
],
"Token" => $json["Value"]["Token"],
"UserId" => $json["Value"]["UserId"]
];


$session = json_decode($req->sendRequest(Config::session_url,json_encode($params)),true);
echo "Всё ок";
$datas->addExtraData("Data",$session["Value"]["Data"]);
}else{
echo json_encode($json, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}