<?php

Class Datas{
public function addDatas($dataa){
$data = file_exists("values.json") ? json_decode(file_get_contents("values.json"),true) : [];
$data[] = $dataa;
file_put_contents("values.json",json_encode($data));
}

public function addExtraData($key, $value){
$data = file_exists("values.json") ? json_decode(file_get_contents("values.json"),true) : [];
$data[$key] = $value;
file_put_contents("values.json",json_encode($data));
}

public function getDatas(){
$data = json_decode(file_get_contents("values.json"),true);
return $data;
}
}