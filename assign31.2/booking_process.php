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

 $xmlFile = "data/request.xml";
 $HTML = "";

 $isExistingEmail = false;

 if (file_exists($xmlFile))
 {
 	$doc = new DOMDocument();
	 $doc->load($xmlFile);
	 $customer = $doc->getElementsByTagName("request");
	 foreach($customer as $node)
	 {
	 
	 	$day = $node->getElementsByTagName("Day");
	 	$day = $day->item(0)->nodeValue;

		$month = $node->getElementsByTagName("Month");
	 	$month = $month->item(0)->nodeValue;

		$year = $node->getElementsByTagName("Year");
	 	$year = $year->item(0)->nodeValue;

	 	$hour = $node->getElementsByTagName("Hour");
	 	$hour = $hour->item(0)->nodeValue;

	 	$minute = $node->getElementsByTagName("Minute");
	 	$minute = $minute->item(0)->nodeValue;




	 	if (($day == $_GET["day"]) && ($month == $_GET["month"]) && ($year == $_GET["year"]) && ($hour == $_GET["hour"]) && ($minute == $_GET["minute"]))
	 	{
	 		$isExistingEmail = true;
	 	}
	 }
 }
 else 
 {
   $doc = new DOMDocument();
    $ele = $doc->createElement('requests');
    $ele->nodeValue = '';
    $doc->appendChild($ele);
    $doc->save($xmlFile);
 }
 
 
 
 if($isExistingEmail)
 {
	$HTML = $HTML."This time is unavailable.";
 }
 else 
 {
 
//Generated patient id
$cusid = mt_rand(10000,99999)+mt_rand(1000,99999)+mt_rand(100,99999);

$fp = fopen($xmlFile, "rb") or die("cannot open file");
$str = fread($fp, filesize($xmlFile));


	   
$xml = new DOMDocument();
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->loadXML($str) or die("Error");

// get document element
$fnode   = $xml->documentElement;

session_start();
//add a node
$ori    = $fnode->childNodes->item(1);

$customerId     = $xml->createElement("Id");
$customerIdText = $xml->createTextNode($cusid);
$customerId->appendChild($customerIdText);

$mediareid   = $xml->createElement("MedicareID");
$mediareidText = $xml->createTextNode($_SESSION["medicareid"]);
$mediareid->appendChild($mediareidText);

$phone   = $xml->createElement("Fullname");
$phoneText = $xml->createTextNode($_SESSION["fname"]." ".$_SESSION["lname"]);
$phone->appendChild($phoneText);

$firstname     = $xml->createElement("Day");
$firstnameText = $xml->createTextNode($_GET["day"]);
$firstname->appendChild($firstnameText);

$surname     = $xml->createElement("Month");
$surnameText = $xml->createTextNode($_GET["month"]);
$surname->appendChild($surnameText);

$year     = $xml->createElement("Year");
$yearText = $xml->createTextNode($_GET["year"]);
$year->appendChild($yearText);


$email     = $xml->createElement("Hour");
$emailText = $xml->createTextNode($_GET["hour"]);
$email->appendChild($emailText);

$password   = $xml->createElement("Minute");
$passwordText = $xml->createTextNode($_GET["minute"]);
$password->appendChild($passwordText);



$book   = $xml->createElement("request");
$book->appendChild($mediareid);
$book->appendChild($phone);
$book->appendChild($customerId);
$book->appendChild($firstname);
$book->appendChild($surname);
$book->appendChild($year);
$book->appendChild($email);
$book->appendChild($password);


$fnode->insertBefore($book,$ori);

$xml->saveXML();
$xml->save($xmlFile);


$HTML = $HTML."Dear ".$_SESSION["fname"].", Your request at ".$_GET["hour"].":".$_GET["minute"]." ".$_GET["day"]."-".$_GET["month"]."-".$_GET["year"]." are created into OzGP System";

}

echo $HTML;

?>


