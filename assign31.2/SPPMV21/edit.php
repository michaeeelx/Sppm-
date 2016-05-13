<html>
<?php include 'main.php';?>
   <head>
      <title>PHP -- SRS</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
			width:100%
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
   <?php 
      $product1= "Product";
      $product2= "Quantity";
	  $product3= "Sold";
      $product = Data($_GET,$product1);
      $quantity = Data($_GET,$product2);
	  $Sold = Data($_GET,$product3);
       //echo $product;
       //echo $quantity; 
   ?>
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
	 </div>
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
            <div style = "background-color:#81F7F3; color:#FFFFFF; padding:8px;"><b>Login</b></div>
				
            <div style = "margin:60px">
               
               <form action = "" method = "post"><?php
               echo"
                  <label>Product Name:</label>
                  <input value='$product' type = 'text' name = 'PName' class ='box'/>
                  <br /><br />
                  <label>Product Quantity:</label>
                  <input value='$quantity' type = 'text' name = 'QTY' class ='box' />
                  <br/><br />
				    <label>Sold Quantity:</label>
				  <input value='$Sold' type = 'text' name = 'Sold' class ='box' />
                  <input type = 'submit' name='Changing' value='Save Changes'/><br />

                  ";?>
               </form>
               <div style = "font-size:11px; color:#cc0000; margin-top:10px">
               <?php if(isset($_POST["Changing"])) {
                  ChangeData($_POST['PName'],$_POST['QTY'],$_POST['Sold'],$_GET);
} {
                  # code...
               }  ?>
               <?php echo $error; ?>
               </div>
					
            </div>
				
         </div>
			
      </div>
</div>
   </body>
</html>