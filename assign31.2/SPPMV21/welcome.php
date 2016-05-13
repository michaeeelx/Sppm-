<html>
<?php include 'main.php';?>
   <head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
   <link href="css/bootstrap.min.css" rel="stylesheet">
   <!--<link href="css/StyleCK.css" rel="stylesheet">-->


      <title>PHP -- SRS logged in as <?php echo $_SESSION['login_user'];?> </title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
			background-image:url("images/rainbow.png");
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#333333 solid 1px;
         }
		 
		 button[type=button]{
		 width:300px;
		 height:50px;
		 }
		 
		 input[type=submit]{
			 width:300px;
			 height:40px;
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
	 </div>
	</div>
<!-- Start of main DiV -->
   <div id="about">
   <div style="max-width:1000px;
	    margin-top:10px;
	    margin-left: auto;
	    margin-right: auto;
	    margin-bottom:50px;
	    background-color: #F8F8FF;
	    border: 6px outset #FF0000;
	    border-radius: 15px;
        text-align:center;">
      <div align = "left">
            <div style = "font-family:verdana;background-color:#298A08; color:#FFFFFF; padding:12px;"><b>PHP Sales Report System (PHP-SRS)</b></div>
				
            <div style = "background-color:#FFFFFF; width:100%;margin:auto">
            <form action="welcome.php" method="POST">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Add Product to stock and inventory</button>
            <br/>
			<br/>
			<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal;">View Sales Records</button>
			<input type="submit" class="btn btn-primary" name="sortmonth" value="Monthly"></input>
			<br/>
			<br/>
			<input type="submit" class="btn btn-primary" name="off" value="View Stock and Inventory Levels"></input>
            <br/>
			<br/>
			<form action="welcome.php" method="POST">
              <input type="submit" class="btn btn-primary" name="clicked" value="Export To CSV"> 
            </form>
               </div>
            </div>	
         </div>	
      </div>

<div align = "center">
         <div style = "width:50%; border: solid 1px #333333; " align = "left">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Adding a Product</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post">
	<label>Product Name</label><input type="text" name="PName" placeholder="Product" class="form-control" >
	<label>Quantity</label><input type="text" name="QTY" placeholder="QTY" class="form-control" >
	<label>Date Added</label><input type="Date" name="DAdded" placeholder="YYYY/MM/DD" class="form-control" >
	<br/><br/>
	<?php
  if (isset($_POST['clicked'])) {
$sql = "SELECT * FROM Products";
   $SqlQuery = mysqli_query($db,"select *  INTO OUTFILE 'c:/orders.txt From Products;");
    }  ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="addingproduct" value="Add the Product">
        </form>
      </div>
    </div>
  </div>
</div>
            
			<div style = "font-family:verdana;background-color:#298A08; color:#FFFFFF; padding:12px;"><b>Products</b></div>
				
            <div style = "margin:40px">
            <?php 
            
			
if(isset($_POST["sortmonth"])) {
            	
            	$sql = "SELECT * FROM Products";
   $SqlQuery = mysqli_query($db,"SELECT * FROM Products ORDER by Date");
   echo "
           <table border='6' style= 'background-color: #F0FFF0; margin:10px;'>
      <thead>
        <tr>
          <th>Product Name</th>
          <th>Quantity</th>
		    <th>Sold</th>
          <th>User</th>
          <th>Date of Entry</th>
     
        </tr>
      </thead>
      <tbody>
      ";
	  if (! $SqlQuery){
   $message = "Something Has gone wrong";
echo "<script type='text/javascript'>alert('$message');</script>";
}
   
   while($row = mysqli_fetch_assoc($SqlQuery)){
            echo
            "<tr>
              <td>{$row['Product']}</td>
              <td>{$row['Quantity']}</td>
			  <td>{$row['Sold']}</td>
              <td>",Grabuser($row['User ID']),"</td>
              <td>{$row['Date']}</td> 
            </tr>\n";
          }
echo " </tbody>
    </table>";
   } ?>

        
      <?php 
          
            if(isset($_POST["off"])) {
            	
            	$sql = "SELECT * FROM Products";
   $SqlQuery = mysqli_query($db,"SELECT * FROM Products");
   echo "
      <table border='6' style= 'background-color: #F0FFF0; margin:10px;'>
      <thead>
        <tr>
          <th>Product Name</th>
          <th>Quantity</th>
          <th>User</th>
		  <th>Sold</th>
          <th>Date of Entry</th>
          <th>Edit</th>
          <th>Delete</th>
		  
        </tr>
      </thead>
      <tbody>
      ";
if (! $SqlQuery){
   $message = "Something Went Wrong, Please Try Again";
echo "<script type='text/javascript'>alert('$message');</script>";
}
   while($row = mysqli_fetch_assoc($SqlQuery)){
            echo
            "<tr>
              <td>{$row['Product']}</td>
              <td>{$row['Quantity']}</td>
              <td>",Grabuser($row['User ID']),"</td>
			  <td>{$row['Sold']}</td>
              <td>{$row['Date']}</td>
              <td><a href=edit.php?ID=",$row['ID']," class='glyphicon glyphicon-pencil'></a></td>
              <td><a href=remove.php?ID=",$row['ID']," class='glyphicon glyphicon-remove'></a></td>
            </tr>\n";
          }
echo " </tbody>
    </table>";
   } ?>

               <div style = "font-size:15px; color:#cc0000; margin-top:10px">
               </div>		
            </div>	
         </div>	
      </div>
      <?php 
     if(isset($_POST["addingproduct"])) {
   addingaproduct($_POST, $_SESSION['login_user']);
}
            ?>
			
	<div id="footer">
	<div style="text-align:center;
          border-top:groove;
          border-top-color:#FF0000;
          border-top-width:10px;
          color:#DF0101;
          background-color: #00FF00;
          background-size:100%;
          background-attachment:fixed;
          width:100%;
          margin-top :100px;
          margin-bottom :100px;
          margin-right :auto;
          margin-left :auto;">
	     <p>PHP-SRS</p>
	</div>
	</div>
   </body>
</html>