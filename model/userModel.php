<?php
require_once 'connect_data.php';
require_once 'userClass.php';


class userModel extends userClass{
    public $link; 
 
    public function OpenConnect()
    {
        $konDat=new connect_data();
        try
        {
            $this->link=new mysqli($konDat->host,$konDat->userbbdd,$konDat->passbbdd,$konDat->ddbbname);
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
        $this->link->set_charset("utf8"); // honek behartu egiten du aplikazio eta
        //                  //databasearen artean UTF -8 erabiltzera datuak trukatzeko
    }
    
    public function CloseConnect()
    {
        mysqli_close ($this->link);
        
    }
    
    ////////////////////////////////////////////////
    
// used to check the keywords to 'login'    
public function setUserData() {

    $this->OpenConnect();
    $userExists=false;

    $userName=$this->userName;
    $keyWord1=$this->keyWord1;
    $keyWord2=$this->keyWord2;

    $sql="SELECT * FROM users WHERE (userName='$userName' AND keyWord1='$keyWord1') OR (userName='$userName' AND keyWord2='$keyWord2')";    
    

    $result = $this->link->query($sql);    
    
    if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){   
       $this->idUser=$row['idUser']; 
       $userExists=true;
    }
    mysqli_free_result($result);
    $this->CloseConnect();
    
    return $userExists;   //TRUE O FALSE
}

public function findUserName(){
    $this->OpenConnect();
    $userExists=false;

    $userName=$this->userName;

    $sql="SELECT * FROM users WHERE userName='$userName'";    
    

    $result = $this->link->query($sql);    
    
    if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){   
       $userExists=true;
    }
    mysqli_free_result($result);
    $this->CloseConnect();
    
    return $userExists;   //TRUE O FALSE
}
}
