<?php
include_once '../model/UserModel.php';

$data=json_decode(file_get_contents("php://input"),true);

$user = new userModel();
$user->userName=$data["userName"];
$user->keyWord1=$data["keyWord"];
$user->keyWord2=$data["keyWord"];


$response=array();
$userExits=$user->setUserData();

if($userExits){
    if (!isset($_SESSION))
    {
      session_start();
    }
    $_SESSION['idUser']=$user->idUser;
    $_SESSION['userName']=$user->userName;
    $response['error']='no error';
}
else{
    if($user->findUserName()){
        $response['error']='WRONG KEYWORD';
    }else{
        $response['error']='WRONG USERNAME';
    }
}

echo json_encode($response);

unset($response);
	
	
