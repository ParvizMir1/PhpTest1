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
if(!empty($check["Data"][0])){
  $params = [
	"CashId"=>Config::CashID,
	"Language"=>"ru",
	"Params"=>[
		Config::CashID,
		$value["Data"][0][0],
	  	$_GET["user_id"],
        $_GET["code"],
  		"ru"
  	],
  	"Token"=>$value["0"]["Token"],
  	"UserId"=>$value["0"]["UserId"]
  	];
	$json = $req->sendRequest(Config::without_url,json_encode($params));
	echo $json;
}else{
  echo "error userid";
}