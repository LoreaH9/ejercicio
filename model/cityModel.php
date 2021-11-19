<?php
include_once 'cityClass.php';
include_once 'countryModel.php';
include_once 'connect_data.php';

class cityModel extends cityClass{
    
    public $link;
    public $countryObject;
 
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
         try
         { 
           $this->link->close();
         }
         catch(Exception $e)
        {
         echo $e->getMessage();
        }  
    }
    
    public function setList()
    {
        $this->OpenConnect();
        $list=array();
        $sql="SELECT * from city";
        
        $result = $this->link->query($sql);    
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $new=new cityClass();
            $new->ID=$row['ID'];
            $new->Name=$row['Name'];
            $new->CountryCode=$row['CountryCode'];
            $new->Population=$row['Population'];
    
            array_push($list, $new);   
        }

        mysqli_free_result($result);
        $this->CloseConnect();

        return $list;
    }
    public function findIdCity() // fill city : $this
    {
        $this->OpenConnect();  
        $ID=$this->ID;
        $sql = "select * from city where ID=$ID";
        
        $result = $this->link->query($sql);    
        if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
         {    
            $this->Name=$row['Name'];
            $this->CountryCode=$row['CountryCode'];
            $this->Population=$row['Population'];
            
            $countryObject= new countryModel();
            $countryObject->Code=$row['CountryCode'];
            $countryObject->findIdCountry();
            
            $this->countryObject=$countryObject;
        }

        mysqli_free_result($result); 
        $this->CloseConnect();

    }
}
