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
 $xmlFile = "data/patient.xml";
 $HTML = "";

 $isExistingEmail = false;
 $isExistingMedicareId = false;

 if (file_exists($xmlFile))
 {
 	$doc = new DOMDocument();
	 $doc->load($xmlFile);
	 $customer = $doc->getElementsByTagName("patient");
	 foreach($customer as $node)
	 {
	 
	 	$mediareid = $node->getElementsByTagName("MedicareID");
	 	$mediareid = $mediareid->item(0)->nodeValue;

	 	$email = $node->getElementsByTagName("Email");
	 	$email = $email->item(0)->nodeValue;


	 	if ($mediareid == $_GET["medicareid"]){
	 		$isExistingMedicareId = true;
	 	}

	 	if($email == $_GET["email"]){
	 		$isExistingEmail = true;
	 	}
	 }
 }
 else 
 {
   $doc = new DOMDocument();
    $ele = $doc->createElement('patients');
    $ele->nodeValue = '';
    $doc->appendChild($ele);
    $doc->save($xmlFile);
 }
 
 
 
 if($isExistingMedicareId){
	$HTML = $HTML."Your Medicare ID has been registered already.";
 }
 else if($isExistingEmail){
 	$HTML = $HTML."Your Email has been registered already.";
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


//add a node
$ori    = $fnode->childNodes->item(1);

$customerId     = $xml->createElement("Id");
$customerIdText = $xml->createTextNode($cusid);
$customerId->appendChild($customerIdText);

$firstname     = $xml->createElement("Fname");
$firstnameText = $xml->createTextNode($_GET["fname"]);
$firstname->appendChild($firstnameText);

$surname     = $xml->createElement("Lname");
$surnameText = $xml->createTextNode($_GET["lname"]);
$surname->appendChild($surnameText);

$sex     = $xml->createElement("Gender");
$sexText = $xml->createTextNode($_GET["sex"]);
$sex->appendChild($sexText);

$cost     = $xml->createElement("Cost");
$costText = $xml->createTextNode($_GET["cost"]);
$cost->appendChild($costText);

$email     = $xml->createElement("Email");
$emailText = $xml->createTextNode($_GET["email"]);
$email->appendChild($emailText);

$password   = $xml->createElement("Pass");
$passwordText = $xml->createTextNode($_GET["password"]);
$password->appendChild($passwordText);

$mediareid   = $xml->createElement("MedicareID");
$mediareidText = $xml->createTextNode($_GET["medicareid"]);
$mediareid->appendChild($mediareidText);

$age   = $xml->createElement("Age");
$ageText = $xml->createTextNode($_GET["age"]);
$age->appendChild($ageText);

$add   = $xml->createElement("Address");
$addText = $xml->createTextNode($_GET["add"]);
$add->appendChild($addText);


$phone   = $xml->createElement("Phone");
$phoneText = $xml->createTextNode($_GET["phone"]);
$phone->appendChild($phoneText);

$book   = $xml->createElement("patient");
$book->appendChild($customerId);
$book->appendChild($firstname);
$book->appendChild($surname);
$book->appendChild($sex);
$book->appendChild($cost);
$book->appendChild($password);
$book->appendChild($email);
$book->appendChild($mediareid);
$book->appendChild($age);
$book->appendChild($add);
$book->appendChild($phone);

$fnode->insertBefore($book,$ori);

$xml->saveXML();
$xml->save($xmlFile);


$HTML = $HTML."Dear ".$_GET["fname"].", you are successfully registered into OzGP System, and your email is ".$_GET["email"].", which will be used to get into the system.";
}

echo $HTML;

?>


