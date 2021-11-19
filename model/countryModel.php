<?php
include_once 'countryClass.php';
include_once 'connect_data.php';
include_once 'cityModel.php';

class countryModel extends countryClass{

    public $link;
    public $objCapital;
    
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
       
    function findIdCountry() // fill country
    {
        $code=$this->Code;

        $this->OpenConnect();
        $sql="select * from country where Code='$code'";

        $result = $this->link->query($sql);    
         if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
         {    
            $this->Name=$row['Name'];
            $this->Continent=$row['Continent'];
            $this->SurfaceArea=$row['SurfaceArea'];
            $this->IndepYear=$row['IndepYear'];
            $this->Population=$row['Population'];
            $this->LifeExpectancy=$row['LifeExpectancy'];
            $this->Capital=$row['Capital'];
         }
         
        mysqli_free_result($result);
        $this->CloseConnect();
    }
    
    function setListByContinent()  // fill country 
    {  
        $this->OpenConnect();
        $continent=$this->Continent;
        
        $sql="select * from country where Continent='$continent'order by name";
         
        $result = $this->link->query($sql);    
        
        $list=array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {    
           $newCountry=new countryModel();
           $newCountry->Code=$row['Code'];
           $newCountry->Name=$row['Name'];
           $newCountry->Continent=$row['Continent'];
           $newCountry->SurfaceArea=$row['SurfaceArea'];
           $newCountry->IndepYear=$row['IndepYear'];
           $newCountry->Population=$row['Population'];
           $newCountry->LifeExpectancy=$row['LifeExpectancy'];
           $newCountry->Capital=$row['Capital']; 
            
            
           array_push($list, $newCountry);
        }
        
        
        mysqli_free_result($result); 
       $this->CloseConnect();
       
       return $list;
    }
}
