
document.addEventListener("DOMContentLoaded", function (event) {

	loggedVerify();		
})

function loggedVerify()
{
   	var url = "controller/cLoggedVerify.php";

	fetch(url, {
	  method: 'GET',  
	})
	.then(res => res.json()).then(result => {
       		
		console.log(result);
		
	    if (result.error !== "logged")
	    {
	        alert(result.error);
	        
	        document.getElementById('submit').addEventListener('click',login);
	   
	    } else {
	        alert("Your login is " + result.userName);
	    	window.location.href = "view/vWorld.html";
	    }
	})
	.catch(error => console.error('Error status:', error));	   
}
function login(){	// new login

	var userName=document.getElementById("userName").value;
	var keyWord=document.getElementById("keyWord").value;
	
	var url = "controller/cLogin.php";
	var data = { 'userName':userName, 'keyWord':keyWord};

	fetch(url, {
	  method: 'POST', // or 'POST'
	  body: JSON.stringify(data), // data can be `string` or {object}!
	  headers:{'Content-Type': 'application/json'}  //input data
	  
	})
	.then(res => res.json()).then(result => {
       		
    		console.log(result);
    		alert(result.error);
    		
    		if ( result.error == "no error"){
    			location.href="view/vWorld.html";	 			
    		}				
	})
	.catch(error => console.error('Error status:', error));	
}
	
