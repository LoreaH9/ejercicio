document.addEventListener("DOMContentLoaded", function (event) {
    
	loggedVerify();
	
});
function loggedVerify()
{
   	var url = "../controller/cLoggedVerify.php";

	fetch(url, {
	  method: 'GET',  
	})
	.then(res => res.json()).then(result => {
       		
		console.log(result);
		
	    if (result.error !== "logged")
	    {
	        alert(result.error);
	        window.location.href="../index.html"
	   
	    } else {
	        	alert("Your login is " + result.userName);
	        	
	        	loadCitiesList();
	        	document.getElementById("cmbContinent").addEventListener("change",continentCountries); 
	        	document.getElementById("cmbLanguage").addEventListener("change",countriesLanguage); 
	        	document.getElementById("cmbCity").addEventListener("change",cityCard); 
	        	document.getElementById("logout").addEventListener("click",logout); 
	    }
	})
	.catch(error => console.error('Error status:', error));	   
}	

function loadCitiesList(){
	var url = "../controller/cCity.php";

	fetch(url, {
	  method: 'GET', 
	})
	.then(res => res.json()).then(result => {
	
		console.log(result.list);
		
		var cities=result.list;
   		
		var newRow ="<option value='-1'>Select a city....</option>";
   		
   		for (let i = 0; i < cities.length; i++) {
							
			newRow += "<option value='"+cities[i].ID+"'>"+cities[i].Name+"</option>";	
		}  		 
		document.getElementById("cmbCity").innerHTML=newRow;  	
	})
	.catch(error => console.error('Error status:', error));	
	
	
	
}
function continentCountries(){

	document.getElementById("cmbLanguage").selectedIndex=0;
	document.getElementById("cmbCity").selectedIndex=0;
	
	var continent=document.getElementById("cmbContinent").value;
	
	var url = "../controller/cContinentCountries.php";
	var data = {'continent':continent};

	fetch(url, {
	  method: 'POST', // or 'POST'
	  body: JSON.stringify(data), 
	  headers:{'Content-Type': 'application/json'} 
	  
	})
	.then(res => res.json()).then(result => {
	       		
    		console.log(result.list);
    		
       		var countries =result.list;
       		
       		var newRow ="<h2>"+continent+" Countries</h2>";
  			newRow +="<table > ";
			newRow +="<tr><th>COUNTRY</th><th>CONTINENT</th><th>CODE</th><th>POPULATION</th><th>CAPITAL</th></tr>";
       		
			for (let i=0; i<countries.length;i++){
			
				newRow += "<tr>" +"<td>"+countries[i].Name+"</td>"
									+"<td>"+countries[i].Continent+"</td>"
									+"<td>"+countries[i].Code+"</td>"
									+"<td>"+countries[i].Population+"</td>"
									+"<td>"+countries[i].objCapital.Name+"</td>"
								+"</tr>";	
			}
       		newRow +="</table>";   
       		document.getElementById("showData").innerHTML=newRow;
	})
	.catch(error => console.error( error.message));	
}
	
function countriesLanguage()
{
	document.getElementById("cmbContinent").selectedIndex=0;
	document.getElementById("cmbCity").selectedIndex=0;
	
	var language=document.getElementById("cmbLanguage").value;
	
	var url = "../controller/cCountriesLanguage.php";
	var data = {'language':language};

	fetch(url, {
	  method: 'POST', // or 'POST'
	  body: JSON.stringify(data), 
	  headers:{'Content-Type': 'application/json'} 
	  
	})
	.then(res => res.json()).then(result => {
		
    		console.log(result.list);
    		var countries =result.list;
    		      		
    		var newRow ="<h2>Countries with official "+ language +" language</h2>";
  			newRow +="<table > ";
  			newRow +="<tr><th>COUNTRY</th><th>CONTINENT</th><th>CODE</th><th>POPULATION</th></tr>";
       		
			for (let i=0; i<countries.length;i++){
				console.log(countries[i].objCountry)
				newRow += "<tr>" +"<td>"+countries[i].objCountry.Name+"</td>"
									+"<td>"+countries[i].objCountry.Continent+"</td>"
									+"<td>"+countries[i].objCountry.Code+"</td>"
									+"<td>"+countries[i].objCountry.Population+"</td>"									
								+"</tr>";	
			}
       		newRow +="</table>";   
       		
       		document.getElementById("showData").innerHTML=newRow;
	})
	.catch(error => console.error( error.message));	
}
function cityCard()
{	 	
	document.getElementById("cmbContinent").selectedIndex=0;
	document.getElementById("cmbLanguage").selectedIndex=0;
	
	var idCity=document.getElementById("cmbCity").value;
	
	var url = "../controller/cCityCard.php";
	var data = {'idCity':idCity};

	fetch(url, {
	  method: 'POST', // or 'POST'
	  body: JSON.stringify(data), 
	  headers:{'Content-Type': 'application/json'} 
	  
	})
	.then(res => res.json()).then(result => {
   		
    		console.log(result.city);
    		
       		var city =result.city;
       		
       		var newRow ="<h2>"+city.Name+"</h2>"
						+"<p>City Population-->"+city.Population+"</p>"
						+"<p>Country Code-->"+city.CountryCode+"</p>"
						+"<p>Country Name-->"+city.countryObject.Name+"</p>"
						+"<p>Country Population-->"+city.countryObject.Population+"</p>"
						+"<p>Continent-->"+city.countryObject.Continent+"</p>";
			
			document.getElementById("showData").innerHTML=newRow;
	})
	.catch(error => console.error( error.message));	
}
function logout()
{
	var url = "../controller/cLogout.php";

	fetch(url, {
	  method: 'GET',  
	})
	.then(res => res.text()).then(result => {
	
		location.href="../index.html";
	})
	.catch(error => console.error('Error status:', error));	
}