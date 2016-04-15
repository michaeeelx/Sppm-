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
$xmlFile = "data/request.xml";

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
		 $x = $doc->getElementsByTagName("request"); 
		 
		 

		$HTML = $HTML."
				<article id='process'>
				<table class='box'><tr><td colspan ='6'><h4>Your Request:</h4></td></tr><tr><tr><td>Full Name</td><td>MedicareID</td><td>Time</td><td>Date</td></tr>";
		foreach($x as $node) 
		{ 


		     $fullname = $node->getElementsByTagName("Fullname");
		     $fullname = $fullname->item(0)->nodeValue;

		     $day = $node->getElementsByTagName("Day");
			 $day = $day->item(0)->nodeValue;

		     $month = $node->getElementsByTagName("Month");
			 $month = $month->item(0)->nodeValue;

			 $year = $node->getElementsByTagName("Year");
			 $year = $year->item(0)->nodeValue;

			 $medicarid = $node->getElementsByTagName("MedicareID");
			 $medicarid = $medicarid->item(0)->nodeValue;


			 $hour = $node->getElementsByTagName("Hour");
			 $hour = $hour->item(0)->nodeValue;

			 $minute = $node->getElementsByTagName("Minute");
			 $minute = $minute->item(0)->nodeValue;

			 if(($_SESSION["medicareid"] == $medicarid)){

		     $HTML = $HTML."<tr><td>".$fullname."</td><td>";			 
			 $HTML = $HTML.$medicarid."</td><td>";			 
			 $HTML = $HTML.$hour.":".$minute."</td><td>";			 
			 $HTML = $HTML.$day."-".$month."-".$year."</td></tr>";
			}
			 
		  
		}

		$HTML = $HTML."
		</article>";
	 }

	echo $HTML;

?>


