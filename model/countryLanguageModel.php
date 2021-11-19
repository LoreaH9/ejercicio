<?php
include_once 'countryLanguageClass.php';
include_once 'countryModel.php';
include_once 'connect_data.php';

class countryLanguageModel extends countryLanguageClass{
    public $link;
    public $objCountry;
    
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
    
    function setListByOfficialLanguage() // fill countryLanguage
    {
        $this->OpenConnect();
        
        $Language=$this->Language;
        
        $sql="SELECT * from countrylanguage where Language='$Language' AND IsOfficial='T'";
        $result = $this->link->query($sql);    
        
        $list=array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { 

            $newCountry=new countryLanguageClass();
            $newCountry->CountryCode=$row['CountryCode'];
            $newCountry->Percentage=$row['Percentage'];
            $newCountry->Language=$row['Language'];
            $newCountry->IsOfficial=$row['IsOfficial'];

            array_push($list, $newCountry);
         }
        
        

        
        mysqli_free_result($result); 

       $this->CloseConnect();
       return $list;
    } 
}
