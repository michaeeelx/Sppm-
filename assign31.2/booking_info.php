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

if(!isset($_SESSION["email"]))
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
		 
		 

		$HTML = $HTML."<article id='process'>
				<h4>Your Infomation:</h4>";
		foreach($x as $node) 
		{ 


		     $fname = $node->getElementsByTagName("Fname");
		     $fname = $fname->item(0)->nodeValue;

		     $lname = $node->getElementsByTagName("Lname");
		     $lname = $lname->item(0)->nodeValue;

		     $sex = $node->getElementsByTagName("Gender");
			 $sex = $sex->item(0)->nodeValue;

		     $cost = $node->getElementsByTagName("Cost");
			 $cost = $cost->item(0)->nodeValue;

			 $email = $node->getElementsByTagName("Email");
			 $email = $email->item(0)->nodeValue;

			 $medicarid = $node->getElementsByTagName("MedicareID");
			 $medicarid = $medicarid->item(0)->nodeValue;

			 $dob = $node->getElementsByTagName("Age");
			 $dob = $dob->item(0)->nodeValue;

			 $phone = $node->getElementsByTagName("Phone");
			 $phone = $phone->item(0)->nodeValue;

			 $add = $node->getElementsByTagName("Address");
			 $add = $add->item(0)->nodeValue;

			 if(($_SESSION["medicareid"] == $medicarid)){

		     $HTML = $HTML."<p> First Name: ".$fname."</p>";
		     $HTML = $HTML."<p> Last Name: ".$lname."</p>";
		     $HTML = $HTML."<p> Date of Birth: ".$dob."</p>";
		     $HTML = $HTML."<p> Gender: ".$sex."</p>";
		     $HTML = $HTML."<p> Email: ".$email."</p>";
		     $HTML = $HTML."<p> Medicare ID: ".$medicarid."</p>";
		     $HTML = $HTML."<p> Address: ".$add."</p>";
		     $HTML = $HTML."<p> Phone: ".$phone."</p>";
		     $HTML = $HTML."<h4> Base fee: $".$cost."</h4>";


			}
			 
		  
		}

		$HTML = $HTML."
		</article>";
	 }

	echo $HTML;

?>


