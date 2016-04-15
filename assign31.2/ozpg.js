/** 
* Author: 
* Purpose: 
* Created: 
* Last updated: 
*/

var xHRObject = false;

if (window.XMLHttpRequest)
    xHRObject = new XMLHttpRequest();

else if (window.ActiveXObject)
xHRObject = new ActiveXObject("Microsoft.XMLHTTP");


//
function Notification(prompt, id, style){
	var newP = document.createElement('p');
	var newNum = document.createTextNode(prompt);

	newP.appendChild(newNum);
	var newPara =document.getElementById(id);
	
	if(style == 0){
		newPara.appendChild(newP);
	}

	if(style == 1){
		newPara.appendChild(newNum);
	}

}

//Register form
function formValidation(){  

	var result = true;
	var message = "";
	var fname = document.getElementById('fname').value;
	var lname = document.getElementById('lname').value;
	var pass = document.getElementById('pass').value;
	var passC = document.getElementById('passC').value;
	var medid = document.getElementById('medid').value;
	var day = document.getElementById('day').value;
	var month = document.getElementById('month').value;
	var year = document.getElementById('year').value;
	var add = document.getElementById('add').value;
	var sex = document.getElementById('sex').value;
	var phone = document.getElementById('phone').value;
	var email = document.getElementById('email').value;

	var  sex = "";
	if (document.getElementById('sex1').checked) {
  		sex = document.getElementById('sex1').value;
	} else {
		sex = document.getElementById('sex2').value;
	}

	// Name validation
	if (fname == ""){
		message += "- Your First name cannot be blank.\n";
		
	}

	if (lname == ""){
		message += "- Your Last name cannot be blank.\n";
		
	}

	// Email validation
	var atpos = email.indexOf("@");
	var dotpos = email.lastIndexOf(".");

	if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=email.length) {
        message += "- Please enter a valid e-mail address.\n";
    }

	// Password validation
	if (pass == ""){
		message += "- Your passwrod cannot be blank.\n";
	}else if (pass.length < 6 || pass.length > 12){

		message += "- Your Password length be between 6 to 12.\n";  
	} 

	// Check Password match

	if (pass != passC){
		message += "- Passwords did not match.\n";
	}

	// Check Medicare ID

	var num = /^\d\d\d\d\d\d\d$/;

	if (medid == ""){
		message += "- Your Medicare ID cannot be blank.\n";
		
	}else if(medid != "" && !medid.match(num)){
		message += "- Your Medicare ID must have 7 characters.\n";
	}


	//check age
	var curDate = new Date();
	var dob = new Date(year,month,day);

	var cost = 0;


	var dop = day+'-'+month+'-'+year;

	var age = parseInt(curDate.getFullYear() - dob.getFullYear());

	if (day == "" || month =="" || year == ""){
		message += "- Your birth day cannot be blank.\n";

	}else if (age < 18){
		message += "- Your age must be over than 17 years old.\n";
	}

	if((age > 17) && (age < 30)){
		cost = 100;
	} else if((age => 30) && (age < 45)){
		cost = 150;
	}else{
		cost = 180;
	}

	//alert(cost);
	// Check Address

	if (add == ""){
		message += "- Your address cannot be blank.\n";
		
	}

	//Phone number format
	var letters = /^\d\d\d\d\d\d\d\d\d\d$/;

	if (phone ==""){
		message += "- Your phone number cannot be blank.\n";
	}else if(phone != "" && !phone.match(letters)){
		message += "- Please enter a valid phone number.\n";
	}

	



	if (message){
		result = false;
		alert(message);
		message = "";
		
	}else{
		//Send information to php
		xHRObject.open("GET", "register_process.php?email=" + email + "&fname=" + fname + "&lname=" + lname + "&sex=" + sex + "&add=" + add +"&cost=" + cost +"&password=" + pass + "&medicareid=" + medid + "&age=" + dop + "&phone=" + phone + "&currentdate=" + Number(new Date), true);
	    xHRObject.onreadystatechange = function() {
		           if (xHRObject.readyState == 4 && xHRObject.status == 200)
		        	   {
		        	   		if(xHRObject.responseText.trim() =='Your email has been registered already.')
	        	   			{
	        	   				alert(xHRObject.responseText);
	        	   			}
	        	   		else
	        	   			{
	        	   				alert(xHRObject.responseText);
	        	   				window.location = 'login.htm';
	        	   				
	        	   			}
		        	   } 
		}
	    xHRObject.send(null);
	}

	return result;
}


//Patient Login Form
function chkCustLogin(){

	var result = true;
	var message = "";
	var email = document.getElementById('email').value;
	var pass = document.getElementById('pass').value;

	if (email == ""){
		message += "- Please enter your email.\n";
		
	}

	if (pass == ""){
		message += "- Your password cannot be blank.\n";
		
	}


	if (message){
		result = false;
		alert(message);
		message = "";
		
	}else{
			xHRObject.open("GET", "login_process.php?email=" + email + "&password=" + pass + "&currentdate=" + Number(new Date), true);
	    	xHRObject.onreadystatechange = function() {
		           if (xHRObject.readyState == 4 && xHRObject.status == 200)
		        	   {
		        	   		if(xHRObject.responseText.trim() == "Sucessful!")
	        	   			{
	        	   				alert(xHRObject.responseText);
	        	   				window.location = "booking_info.htm";
	        	   			}
	        	   		else
	        	   			{
	        	   				alert(xHRObject.responseText);
	        	   			}
		        	   } 
			}
		    xHRObject.send(null);
		}

	return result;
}


//Manger Login Form
function chkMngLogin(){

	var result = true;
	var message = "";
	var mngid = document.getElementById('mngid').value;
	var mngpass = document.getElementById('mngpass').value;

	if (mngid == ""){
		message += "- Please enter your username .\n";
		
	}

	if (mngpass == ""){
		message += "- Your password cannot be blank.\n";
		
	}


	if (message){
		result = false;
		alert(message);
		message = "";
		
	}else{
		xHRObject.open("GET", "manager_process.php?mngid=" + mngid + "&password=" + mngpass + "&currentdate=" + Number(new Date), true);
	    xHRObject.onreadystatechange = function() {
		           if (xHRObject.readyState == 4 && xHRObject.status == 200)
		        	   {
		        	   		if(xHRObject.responseText.trim() == "Sucessful!")
	        	   			{
	        	   				alert(xHRObject.responseText);
	        	   				window.location = "listing.htm";
	        	   			}
	        	   		else
	        	   			{
	        	   				alert(xHRObject.responseText);
	        	   			}
		        	   } 
		}
	    xHRObject.send(null);
		}

	return result;
}



//Logout
function mlogout() 
{
	xHRObject.open("GET", "mlogout_process.php?currentdate=" + Number(new Date), true);
	xHRObject.onreadystatechange = function() {
	   if (xHRObject.readyState == 4 && xHRObject.status == 200)
		   {
	   			document.getElementById('logout').innerHTML = xHRObject.responseText;
		   }
	}

	xHRObject.send(null);
}

function logout() 
{
	xHRObject.open("GET", "logout_process.php?currentdate=" + Number(new Date), true);
	xHRObject.onreadystatechange = function() {
	   if (xHRObject.readyState == 4 && xHRObject.status == 200)
		   {
	   			document.getElementById('logout').innerHTML = xHRObject.responseText;
		   }
	}

	xHRObject.send(null);
}



//Search Patient
function Process(){

	var sid = document.getElementById('sid').value;

	xHRObject.open("GET", "listing_access.php?sid=" + sid + "&currentdate=" + Number(new Date), true);
		    xHRObject.onreadystatechange = function() {
			    if (xHRObject.readyState == 4 && xHRObject.status == 200){

		  	   		if(xHRObject.responseText.trim()=='Please login')
		   			{
		   				window.location = "mlogin.htm";
		   			}
		   			else
		   			{
		   				document.getElementById('itemlist').innerHTML = xHRObject.responseText;
		   			}
      	   		}
			}
	xHRObject.send(null);
}

//Search Patient
function Allocate(){

	var retVal = true;
	var message = "";
	var roomid = document.getElementById('roomid').value;
	
	var num = /^\d\d\d$/;

	if (roomid == ""){
		message += "- The room id cannot be blank.\n";
		
	}else if(roomid != "" && !roomid.match(num)){
		message += "- Cannot allocate this room ID.\n";
	}
		

	if (message){
		retValue = false;
		alert(message);
		message = "";
		
	}else{
		retValue = true;
		var msg = 'The Room '+roomid+' is sucessfully allocated.\n';
		//Notification(msg, 'itemlist', 0);
		alert(msg);
	}

	return retValue;

	}


//All Patient
function ProcessAll(){


	xHRObject.open("GET", "listing_all.php?currentdate=" + Number(new Date), true);
		    xHRObject.onreadystatechange = function() {
			    if (xHRObject.readyState == 4 && xHRObject.status == 200){

		  	   		if(xHRObject.responseText.trim()=='Please login')
		   			{
		   				window.location = "mlogin.htm";
		   			}
		   			else
		   			{
		   				document.getElementById('itemlist').innerHTML = xHRObject.responseText;
		   			}
      	   		}
			}
	xHRObject.send(null);
}

//Patient request
function Request(){


	xHRObject.open("GET", "booking_requested.php?currentdate=" + Number(new Date), true);
		    xHRObject.onreadystatechange = function() {
			    if (xHRObject.readyState == 4 && xHRObject.status == 200){

		  	   		if(xHRObject.responseText.trim()=='Please login')
		   			{
		   				window.location = "login.htm";
		   			}
		   			else
		   			{
		   				document.getElementById('itemlist').innerHTML = xHRObject.responseText;
		   			}
      	   		}
			}
	xHRObject.send(null);
}

//Patient request
function Info(){


	xHRObject.open("GET", "booking_info.php?currentdate=" + Number(new Date), true);
		    xHRObject.onreadystatechange = function() {
			    if (xHRObject.readyState == 4 && xHRObject.status == 200){

		  	   		if(xHRObject.responseText.trim()=='Please login')
		   			{
		   				window.location = "login.htm";
		   			}
		   			else
		   			{
		   				document.getElementById('itemlist').innerHTML = xHRObject.responseText;
		   			}
      	   		}
			}
	xHRObject.send(null);
}


//All request
function AllRequest(){


	xHRObject.open("GET", "listing_requested.php?currentdate=" + Number(new Date), true);
		    xHRObject.onreadystatechange = function() {
			    if (xHRObject.readyState == 4 && xHRObject.status == 200){

		  	   		if(xHRObject.responseText.trim()=='Please login')
		   			{
		   				window.location = "mlogin.htm";
		   			}
		   			else
		   			{
		   				document.getElementById('itemlist').innerHTML = xHRObject.responseText;
		   			}
      	   		}
			}
	xHRObject.send(null);
}




//Request Form
function chkRequest(){

	

	var result = true;
	var message = "";
	var day = document.getElementById('day').value;
	var month = document.getElementById('month').value;
	var year = document.getElementById('year').value;
	var hour = document.getElementById('hour').value;
	var minute = document.getElementById('minute').value;
	
	
	if ((day == "")||(year == "")||(month == "")){
		message += "- Please enter the Appointment date.\n";
	}

	if ((hour == "") || (minute == "")){
		message += "- Please enter the Appointment time.\n";
	}

	

	if (isNaN(hour) || isNaN(minute) || isNaN(day) || isNaN(month) || isNaN(year)){
		message += "- Incorrect input.\n";
	}
	else{
		var preTime = hour+":"+minute;
		var startTime = "10:30";
		var endTime = "17:30";
	
		if((preTime < startTime) || (preTime > endTime)){
			message += "- OzGP Service opens from 10:30 to 17:30.\n";
		}


		var preDate = new Date(year, month-1, day, hour, minute);

       	var curDate = new Date();

       	curDate.setHours(curDate.getHours() + 1);

       //	alert(curDate +" "+preDate);

       	if (curDate > preDate){
		message += "- The Appointment time must be after 1 hour from now.\n";
	}

	}


   

	if (message){
		result = false;
		alert(message);
		message = "";
		
	}else{
			xHRObject.open("GET", "booking_process.php?day=" + day + "&month=" + month + "&year=" + year + "&hour=" + hour +"&minute=" + minute +"&currentdate=" + Number(new Date), true);
	    	xHRObject.onreadystatechange = function() {
		           if (xHRObject.readyState == 4 && xHRObject.status == 200)
		        	   {
		        	   		if(xHRObject.responseText.trim() == "Sucessful!")
	        	   			{
	        	   				alert(xHRObject.responseText);
	        	   				window.location = "booking_requested.htm";
	        	   			}
	        	   		else
	        	   			{
	        	   				alert(xHRObject.responseText);
	        	   			}
		        	   } 
			}
		    xHRObject.send(null);
		}

	return result;
}