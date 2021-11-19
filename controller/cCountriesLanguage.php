<?php
include_once '../model/countryLanguageModel.php';
$data=json_decode(file_get_contents("php://input"),true);

$response=array();

$Language=$data['language'];

$country = new countryLanguageModel();
$country->Language=$Language;
$countries = $country->setListByOfficialLanguage();


for($i=0; $i<sizeof($countries); $i++) {
    $c = new countryModel();
    $c->Code = $countries[$i]->CountryCode;
    $c->findIdCountry();
    $countries[$i]->objCountry= $c;
}

$response['list']=$countries;

echo json_encode($response);

unset($response);