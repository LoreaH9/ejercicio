<?php

include_once '../model/countryModel.php';
include_once '../model/cityModel.php';

$data=json_decode(file_get_contents("php://input"),true);

$response=array();

$continent=$data['continent'];

$country = new countryModel();
$country->Continent=$continent;
$countries = $country->setListByContinent();
for($i=0; $i<sizeof($countries); $i++) {
    $c = new cityModel();

    if( $countries[$i]->Capital!=NULL){
        $c->ID = $countries[$i]->Capital;
        $c->findIdCity();
        $countries[$i]->objCapital= $c;
    }else{
        $c->Name ="NO CAPITAL";
    }
    $countries[$i]->objCapital=$c;

}
$response['list']= $countries;




echo json_encode($response);

unset($response);