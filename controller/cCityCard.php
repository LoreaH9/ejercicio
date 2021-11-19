<?php
include_once '../model/cityModel.php';
$data=json_decode(file_get_contents("php://input"),true);

$response=array();

$idCity = $data['idCity'];

$city = new cityModel();
$city->ID=$idCity;
$response['ID']=$city->ID;
$city->findIdCity();
$response['city']=$city;


echo json_encode($response);

unset($response);
