<?php
include "Request.php";
include "Config.php";
include "Datas.php";

$datas = new Datas();
$req = new Requests();

$value = $datas->getDatas();


$params = [
	"Vers"=>4,
	"CashId"=>Config::CashID,
	"Language"=>"ru",
	"Params"=>[
		Config::CashID,
		$value["Data"][0][0],
		$_GET["user_id"],
        $_GET["summa"],
		null
	],
	"Token"=>$value["0"]["Token"],
	"UserId"=>$value["0"]["UserId"]	
];

$json = $req->sendRequest(Config::add_deposit_url,json_encode($params));
$tekst = json_decode($json, true);
$echo = $tekst['Data'][0][3];
if ($echo == "Депозит на сумму {0} игроку № {1} уже был проведен, повторить платеж можно будет через 5 минут.") {
	$var = $tekst['Data'][0][5];
	$ex = explode (";", $var);
	$echo = str_replace (["{0}", "{1}"], [$ex[0], $ex[1]], $echo);
	
	
}
echo $echo;

if ($echo == "Операция прошла успешно") {
	$base = json_decode(file_get_contents("base.json"), true);
	$base['id'] = $base['id'] + 1;
	$base['summa'] = $base['summa'] + $_GET['summa'];
	file_put_contents("base.json", json_encode($base));
	$base = json_decode(file_get_contents("base.json"), true);
	$text = "<b>To'lov qilindi</b>: <code>" . $base['id'] . " martta pul to'langan</code>\n<b>to'langan summa</b>: <code>" . number_format($_GET['summa'], 0, '.', ' ') . " so'm</code>\n<b>Ja'mi</b>: <code>" . number_format($base['summa'], 0, '.', ' ') . " so'm to'langan</code>";


}