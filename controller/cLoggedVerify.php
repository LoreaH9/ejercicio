<?php
session_start(); 
$response=array();

if (isset($_SESSION['idUser']) && isset($_SESSION['userName']))
{
    $response["idUser"]=$_SESSION['idUser'];
    $response["userName"]=$_SESSION['userName'];
    $response["error"]="logged";
}else{
    $response["error"]="not logged";
}

echo json_encode($response);

unset($response);