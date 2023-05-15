<?php
include "Request.php";
include "Config.php";
include "Datas.php";

$datas = new Datas();
$req = new Requests();

$value = $datas->getDatas();

$params = [
	"Vers" => 2,
	"CashId" => Config::CashID,
	"Language" => "ru",
	"Params" => [
		$_GET["user_id"],
		216
	],
	"Token" => $value["0"]["Token"],
	"UserId" => $value["0"]["UserId"]	
];
	
$check = json_decode($req->sendRequest(Config::check_id,json_encode($params)),true);
if (!$check) {
    file_get_contents("https://site.uz/token.php");
    $datas = new Datas();
    $req = new Requests();

    $value = $datas->getDatas();

    $params = [
        "Vers" => 2,
        "CashId" => Config::CashID,
        "Language" => "ru",
        "Params" => [
            $_GET["user_id"],
            216
        ],
        "Token" => $value["0"]["Token"],
        "UserId" => $value["0"]["UserId"]	
    ];

    $check = json_decode($req->sendRequest(Config::check_id,json_encode($params)),true);
    echo json_encode($check, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    exit;
}
echo json_encode($check, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);