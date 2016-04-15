<?php
/**
 * booking.htm
 *
 * @package    PHP-SRS
 * @author     David Tian - 1773834
 * @copyright  2016
 * @todo 	   PHP
 */
?>
<?php
session_start();
$HTML = "";
$xmlFile = "data/patient.xml";

if(!isset($_SESSION["mngid"]))
{
	$HTML = "Please login";
}
else if (!file_exists($xmlFile)){
	 	$HTML = $HTML."No Content.";
	 }
	 else 
	 {
		 $doc = new DOMDocument();
		 $doc->load($xmlFile);
		 $x = $doc->getElementsByTagName("patient"); 
		 
		 

		$HTML = $HTML."
				<article id='process'>
				<table class='box'><tr><td colspan ='7'><h4>Patient List:</h4></td></tr><tr><tr><td>First Name</td><td>Last Name</td><td>Email</td><td>Medicare ID</td><td>Date Of Birth</td><td>Cost</td><td>Phone</td></tr>";
		foreach($x as $node) 
		{ 


		     $itemId = $node->getElementsByTagName("Fname");
		     $itemId = $itemId->item(0)->nodeValue;
		     $name = $node->getElementsByTagName("Lname");
			 $name = $name->item(0)->nodeValue;
		     $price = $node->getElementsByTagName("Email");
			 $price = $price->item(0)->nodeValue;
			 $quantity = $node->getElementsByTagName("MedicareID");
			 $quantity = $quantity->item(0)->nodeValue;
			 $hold = $node->getElementsByTagName("Age");
			 $hold = $hold->item(0)->nodeValue;


			 $cost = $node->getElementsByTagName("Cost");
			 $cost = $cost->item(0)->nodeValue;
			 $sold = $node->getElementsByTagName("Phone");
			 $sold = $sold->item(0)->nodeValue;

			 if((strtoupper($_GET["sid"]) == strtoupper($itemId)) || ($_GET["sid"] == $quantity) || (strtoupper($_GET["sid"]) == strtoupper($name)) ){

		     $HTML = $HTML."<tr><td>".$itemId."</td><td>";			 
			 $HTML = $HTML.$name."</td><td>";			 
			 $HTML = $HTML.$price."</td><td>";			 
			 $HTML = $HTML.$quantity."</td><td>";
			 $HTML = $HTML.$hold."</td><td>";
			 $HTML = $HTML."$".$cost."</td><td>";
			 $HTML = $HTML.$sold."</td></tr>";
			}
			 
		  
		}

		$HTML = $HTML."
		</article>";
	 }

	echo $HTML;

?>


