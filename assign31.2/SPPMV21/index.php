<html>
<?php include 'main.php';?>
   <head>
      <title>PHP -- SRS</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
			width:100%;
			background-image:url("images/blue.png");
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
		 
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
   <div id="header">
   <div style="max-width:1200px;
	    margin-top:10px;
	    margin-left: auto;
	    margin-right: auto;
	    margin-bottom:50px;
	    background-color: #F8F8FF;
	    border: 6px outset #FF0000;
	    border-radius: 15px;
        text-align:center;">
     <h1><div align="center"><img src="images/pharmacy.jpg" alt="Pharmacy" title="Pharmacy" width="450" height="180 " "font-family:verdana"/><br/>People Health Pharmacy</h1></div>
	 </div> //new image
      <div align = "center">
	  <div style="max-width:1000px;
	    margin-top:10px;
	    margin-left: auto;
	    margin-right: auto;
	    margin-bottom:50px;
	    background-color: #F8F8FF;
	    border: 6px outset #FF0000;
	    border-radius: 15px;
        text-align:center;">
            <div style = "background-color:#81F7F3; color:#FFFFFF; padding:8px;"><b>PHP SRS User Login </b></div>
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/>
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = "Login"/><br />
               </form></div>
               <?php  
               if($_SERVER["REQUEST_METHOD"] == "POST") {
               login($_POST);
           }
               	?>
               <div style = "font-size:11px; color:#cc0000; margin-top:10px">
               <?php echo $error; ?>
               </div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>
