<?php

class userClass{
    public $idUser;
    public $userName;
    public $keyWord1;
    public $keyWord2;
    
    function getIdUser() {
        return $this->idUser;
    }

    function getUserName() {
        return $this->userName;
    }

    function getKeyWord1() {
        return $this->keyWord1;
    }

    function getKeyWord2() {
        return $this->keyWord2;
    }

    function setKeyWord1($keyWord1) {
        $this->keyWord1 = $keyWord1;
    }

    function setKeyWord2($keyWord2) {
        $this->keyWord2 = $keyWord2;
    }

    function setIdUser($idUSer) {
        $this->idUser = $idUSer;
    }

    function setUserName($userName) {
        $this->userName = $userName;
    }
 
}
