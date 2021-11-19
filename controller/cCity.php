<?php

include_once '../model/cityModel.php';

$response=array();

$city = new cityModel();

$response['list']=$city->setList();
echo json_encode($response);

unset($response);